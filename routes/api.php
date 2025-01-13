<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;

// http://localhost:8000/api/
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:api')->get('/checkToken',[AuthController::class,'checktoken']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->post('/search', [AuthController::class, 'search']);
Route::middleware('auth:api')->get('/users', [UserController::class, 'index']);

// http://localhost:8000/api/rooms/
Route::prefix('/rooms')->middleware(['auth:api'])->group(function(){
    Route::get('/',[RoomController::class,'index']);
    Route::get('/{room}',[RoomController::class,'show']);
    Route::post('/',[RoomController::class,'create']);
    Route::patch('/{room}',[RoomController::class,'update']);
    Route::delete('/{room}',[RoomController::class,'destroy']);
});

// http://localhost:8000/api/bookings/
Route::prefix('/bookings')->middleware(['auth:api'])->group(function(){        
    Route::get('/',[BookingController::class,'index']);
    Route::get('/{booking}',[BookingController::class,'show']);
    Route::post('/',[BookingController::class,'store']);
    Route::patch('/{booking}',[BookingController::class,'update']);
    Route::delete('/{booking}',[BookingController::class,'destroy']);
});

// http://localhost:8000/api/roomTypes/
Route::prefix('/roomTypes')->middleware(['auth:api'])->group(function(){
    Route::get('/',[RoomTypeController::class,'index']);
    Route::post('/',[RoomTypeController::class,'create']);
    Route::patch('/{roomType}',[RoomTypeController::class,'update']);
    Route::delete('/{roomType}',[RoomTypeController::class,'destroy']);
});

// http://localhost:8000/api/sections/
Route::prefix('/sections')->middleware(['auth:api'])->group(function(){
    Route::get('/',[SectionController::class,'index']);
    Route::post('/',[SectionController::class,'create']);
    Route::get('/{section}',[SectionController::class,'show']);
    Route::patch('/{section}',[SectionController::class,'update']);
    Route::delete('/{section}',[SectionController::class,'destroy']);
});

// http://localhost:8000/api/subjects/
Route::prefix('/subjects')->middleware(['auth:api'])->group(function(){
    Route::get('/',[SubjectController::class,'index']);
    Route::post('/',[SubjectController::class,'create']);
    Route::delete('/{subject}',[SubjectController::class,'destroy']);
    Route::patch('/{subject}',[SubjectController::class,'update']);
});
