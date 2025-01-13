<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Artisan;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Section;
use App\Models\Subject;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /**
         * Generate passport keys
         */
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        // User 2
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        // User 3
        User::create([
            'name' => 'Alice Johnson',
            'email' => 'alice.johnson@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        // User 4
        User::create([
            'name' => 'Bob Brown',
            'email' => 'bob.brown@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        // User 5
        User::create([
            'name' => 'Charlie Davis',
            'email' => 'charlie.davis@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        // User 6
        User::create([
            'name' => 'David Wilson',
            'email' => 'david.wilson@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        // User 7
        User::create([
            'name' => 'Eva White',
            'email' => 'eva.white@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        // User 8
        User::create([
            'name' => 'Frank Black',
            'email' => 'frank.black@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        // User 9
        User::create([
            'name' => 'Grace Green',
            'email' => 'grace.green@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        // User 10
        User::create([
            'name' => 'Hank Blue',
            'email' => 'hank.blue@example.com',
            'password' => bcrypt('password123'), // Ensure you hash the password
            'role' => 'admin',
        ]);

        RoomType::create([
            'room_type' => 'Laboratory'
        ]);
        RoomType::create([
            'room_type' => 'Classroom'
        ]);
        RoomType::create([
            'room_type' => 'Auditorium'
        ]);
        RoomType::create([
            'room_type' => 'Conference Room'
        ]);
        RoomType::create([
            'room_type' => 'Library'
        ]);

        Section::create([
            'section_name' => '1e2',
            'section_type' => 'DTS'
        ]);
        Section::create([
            'section_name' => '1e1',
            'section_type' => 'DTS'
        ]);
        Section::create([
            'section_name' => 'stem',
            'section_type' => 'Senior High'
        ]);

        Subject::create([
            'subject_name' => 'Mathematics',
            'subject_type' => 'Core',
        ]);
        Subject::create([
            'subject_name' => 'Physics',
            'subject_type' => 'Core',
        ]);
        Subject::create([
            'subject_name' => 'Chemistry',
            'subject_type' => 'Core',
        ]);
        Subject::create([
            'subject_name' => 'Biology',
            'subject_type' => 'Core',
        ]);
        Subject::create([
            'subject_name' => 'History',
            'subject_type' => 'Elective',
        ]);
        Subject::create([
            'subject_name' => 'Geography',
            'subject_type' => 'Elective',
        ]);
        Subject::create([
            'subject_name' => 'English Literature',
            'subject_type' => 'Elective',
        ]);
        Subject::create([
            'subject_name' => 'Computer Science',
            'subject_type' => 'Elective',
        ]);
        Subject::create([
            'subject_name' => 'Philosophy',
            'subject_type' => 'Elective',
        ]);
        Subject::create([
            'subject_name' => 'Art',
            'subject_type' => 'Elective',
        ]);

        Room::create([
            'room_name' => 'Room 1',
            'room_type_id' => 1,
            'location' => 'Location 1',
            'description' => 'Description for Room 1',
            'capacity' => 2,
            'image' => null, // Optional image, set null if not provided
        ]);
        Room::create([
            'room_name' => 'Room 2',
            'room_type_id' => 2,
            'location' => 'Location 2',
            'description' => 'Description for Room 2',
            'capacity' => 4,
            'image' => null,
        ]);
        Room::create([
            'room_name' => 'Room 3',
            'room_type_id' => 3,
            'location' => 'Location 3',
            'description' => 'Description for Room 3',
            'capacity' => 5,
            'image' => null,
        ]);
        Room::create([
            'room_name' => 'Room 4',
            'room_type_id' => 1,
            'location' => 'Location 4',
            'description' => 'Description for Room 4',
            'capacity' => 6,
            'image' => null,
        ]);
        Room::create([
            'room_name' => 'Room 5',
            'room_type_id' => 2,
            'location' => 'Location 5',
            'description' => 'Description for Room 5',
            'capacity' => 8,
            'image' => null,
        ]);
        Room::create([
            'room_name' => 'Room 6',
            'room_type_id' => 3,
            'location' => 'Location 6',
            'description' => 'Description for Room 6',
            'capacity' => 4,
            'image' => null,
        ]);
        Room::create([
            'room_name' => 'Room 7',
            'room_type_id' => 1,
            'location' => 'Location 7',
            'description' => 'Description for Room 7',
            'capacity' => 3,
            'image' => null,
        ]);
        Room::create([
            'room_name' => 'Room 8',
            'room_type_id' => 2,
            'location' => 'Location 8',
            'description' => 'Description for Room 8',
            'capacity' => 2,
            'image' => null,
        ]);
        Room::create([
            'room_name' => 'Room 9',
            'room_type_id' => 3,
            'location' => 'Location 9',
            'description' => 'Description for Room 9',
            'capacity' => 5,
            'image' => null,
        ]);
        Room::create([
            'room_name' => 'Room 10',
            'room_type_id' => 1,
            'location' => 'Location 10',
            'description' => 'Description for Room 10',
            'capacity' => 6,
            'image' => null,
        ]);

        Booking::create([
            'user_id' => 1,
            'room_id' => 1,
            'subject_id' => 1,
            'section_id' => 1,
            'start_time' => '2024-12-29 09:00:00',
            'end_time' => '2024-12-29 10:00:00',
            'day_of_week' => 'Monday',
            'status' => 'confirmed',
            'book_from' => '2024-12-29',
            'book_until' => '2024-12-29',
        ]);
    
        Booking::create([
            'user_id' => 2,
            'room_id' => 2,
            'subject_id' => 1,
            'section_id' => 2,
            'start_time' => '2024-12-29 11:00:00',
            'end_time' => '2024-12-29 12:00:00',
            'day_of_week' => 'Monday',
            'status' => 'confirmed',
            'book_from' => '2024-12-29',
            'book_until' => '2024-12-29',
        ]);
    
        Booking::create([
            'user_id' => 3,
            'room_id' => 3,
            'subject_id' => 2,
            'section_id' => 1,
            'start_time' => '2024-12-30 08:00:00',
            'end_time' => '2024-12-30 09:00:00',
            'day_of_week' => 'Tuesday',
            'status' => 'pending',
            'book_from' => '2024-12-30',
            'book_until' => '2024-12-30',
        ]);
    
        Booking::create([
            'user_id' => 4,
            'room_id' => 4,
            'subject_id' => 3,
            'section_id' => 3,
            'start_time' => '2024-12-30 10:00:00',
            'end_time' => '2024-12-30 11:00:00',
            'day_of_week' => 'Tuesday',
            'status' => 'confirmed',
            'book_from' => '2024-12-30',
            'book_until' => '2024-12-30',
        ]);
    
        Booking::create([
            'user_id' => 5,
            'room_id' => 5,
            'subject_id' => 4,
            'section_id' => 1,
            'start_time' => '2024-12-31 13:00:00',
            'end_time' => '2024-12-31 14:00:00',
            'day_of_week' => 'Wednesday',
            'status' => 'confirmed',
            'book_from' => '2024-12-31',
            'book_until' => '2024-12-31',
        ]);
    
        Booking::create([
            'user_id' => 6,
            'room_id' => 6,
            'subject_id' => 5,
            'section_id' => 2,
            'start_time' => '2024-12-31 15:00:00',
            'end_time' => '2024-12-31 16:00:00',
            'day_of_week' => 'Wednesday',
            'status' => 'confirmed',
            'book_from' => '2024-12-31',
            'book_until' => '2024-12-31',
        ]);
    
        Booking::create([
            'user_id' => 7,
            'room_id' => 7,
            'subject_id' => 6,
            'section_id' => 3,
            'start_time' => '2025-01-01 09:00:00',
            'end_time' => '2025-01-01 10:00:00',
            'day_of_week' => 'Thursday',
            'status' => 'confirmed',
            'book_from' => '2025-01-01',
            'book_until' => '2025-01-01',
        ]);
    
        Booking::create([
            'user_id' => 8,
            'room_id' => 8,
            'subject_id' => 7,
            'section_id' => 1,
            'start_time' => '2025-01-02 11:00:00',
            'end_time' => '2025-01-02 12:00:00',
            'day_of_week' => 'Friday',
            'status' => 'pending',
            'book_from' => '2025-01-02',
            'book_until' => '2025-01-02',
        ]);
    
        Booking::create([
            'user_id' => 9,
            'room_id' => 9,
            'subject_id' => 8,
            'section_id' => 2,
            'start_time' => '2025-01-03 14:00:00',
            'end_time' => '2025-01-03 15:00:00',
            'day_of_week' => 'Saturday',
            'status' => 'confirmed',
            'book_from' => '2025-01-03',
            'book_until' => '2025-01-03',
        ]);
    
        Booking::create([
            'user_id' => 10,
            'room_id' => 10,
            'subject_id' => 9,
            'section_id' => 3,
            'start_time' => '2025-01-04 16:00:00',
            'end_time' => '2025-01-04 17:00:00',
            'day_of_week' => 'Sunday',
            'status' => 'confirmed',
            'book_from' => '2025-01-04',
            'book_until' => '2025-01-04',
        ]);
        // Continue creating other bookings...
        
        Artisan::call('passport:keys');
        Artisan::call('passport:client --personal --no-interaction');
    }
}
