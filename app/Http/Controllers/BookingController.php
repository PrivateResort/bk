<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     * http://localhost:8000/api/bookings/
     */
     public function index()
    {
        // Fetch all bookings with their related models
        $bookings = Booking::with(['users', 'rooms', 'roomtypes', 'subjects', 'sections'])->get();

        return response()->json([
            'ok' => true,
            'message' => 'Retrieved Successfully',
            'data' => $bookings,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * http://localhost:8000/api/bookings/
     */
    public function store(Request $request) {
        $user = Auth::user();
        
        $today = now()->format('Y-m-d');

        $validator = validator($request->all(), [
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'section_id' => 'required|exists:sections,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'day_of_week' => 'required|array|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', 
            'day_of_week.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', 
            'book_from' => 'required|date|after_or_equal:' . $today, 
            'book_until' => 'required|date|after_or_equal:book_from', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => 'Booking Creation Failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $bookings = [];
        foreach ($request->day_of_week as $day) {
            // Step 1: Check if there are any existing bookings for the same room and day
            $existingBookings = Booking::where('room_id', $request->room_id)
                ->where('day_of_week', $day)
                ->whereBetween('book_from', [$request->book_from, $request->book_until])
                ->whereBetween('book_until', [$request->book_from, $request->book_until]);

            // Step 2: Check if the start_time and end_time overlap with existing bookings
            $overlap = $existingBookings->where(function ($query) use ($request) {
                // Check if the new booking's start_time overlaps with any existing booking's time
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($query) use ($request) {
                          // Check if the new booking is fully contained within an existing booking's time 
                          $query->where('start_time', '<=', $request->start_time)
                                ->where('end_time', '>=', $request->end_time);
                      });
            })->exists();

            // Step 3: If there's an overlap cancel the booking
            if ($overlap) {
                return response()->json([
                    'ok' => false,
                    'message' => 'Room has already been booked for the selected time range.',
                ], 400);
            }

            // Step 4: Create the booking if no overlap is found
            $booking = Booking::create([
                'user_id' => $request->user_id,
                'room_id' => $request->room_id,
                'subject_id' => $request->subject_id,
                'section_id' => $request->section_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'day_of_week' => $day, 
                'status' => $user->role == 'admin' ? 'approved' : 'pending',
                'book_from' => $request->book_from,
                'book_until' => $request->book_until
            ]);
            $bookings[] = $booking;
        }

        return response()->json([
            'ok' => true,
            'message' => $user->role == 'admin' 
                ? 'Booking Created Successfully' 
                : 'Booking Created Successfully, Please wait for admin approval',
            'data' => $bookings
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * http://localhost:8000/api/bookings/{booking}
     */
    public function update(Request $request, Booking $booking) {
        $user = Auth::user();
        if($user->role != 'admin') {
            return response()->json([
                'ok' => false,
                'message' => 'Access Denied',
            ], 403);
        }

        $today = now()->format('Y-m-d');

        $validator = validator($request->all(), [
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'section_id' => 'required|exists:sections,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'day_of_week' => 'required|array|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', 
            'day_of_week.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', 
            'book_from' => 'required|date|after_or_equal:' . $today, 
            'book_until' => 'required|date|after_or_equal:book_from',
            'status' => 'required|in:confirmed,rejected'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => 'Booking Update Failed',
                'errors' => $validator->errors()
            ], 400);
        }

        // Check if there are any existing bookings for the same room and day
        $existingBookings = Booking::where('room_id', $request->room_id)
            ->where('day_of_week', $request->day_of_week)
            ->whereBetween('book_from', [$request->book_from, $request->book_until])
            ->whereBetween('book_until', [$request->book_from, $request->book_until])
            ->whereNotIn('id', [$booking->id]);

        // Check if the start_time and end_time overlap with existing bookings
        $overlap = $existingBookings->where(function ($query) use ($request) {
            // Check if the new booking's start_time overlaps with any existing booking's time
            $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                  ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                  ->orWhere(function ($query) use ($request) {
                      // Check if the new booking is fully contained within an existing booking's time 
                      $query->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                  });
        })->exists();

        // If there's an overlap cancel the booking
        if ($overlap) {
            return response()->json([
                'ok' => false,
                'message' => 'Room has already been booked for the selected time range.',
            ], 400);
        }

        $booking->update($validator->validated());

        return response()->json([
            'ok' => true,
            'message' => 'Booking Updated Successfully',
            'data' => $booking
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * http://localhost:8000/api/bookings/{booking}
     */
    public function destroy(Booking $booking) {
        $booking->delete();
        return response()->json([
            'ok' => true,
            'message' => 'Booking Deleted Successfully',
            'data' => $booking
        ], 200);
    }
}
