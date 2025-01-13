<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * 
     */

     protected $table = 'bookings';
     protected $fillable = [
        'user_id', 
        'room_id', 
        'subject_id', 
        'section_id',
        'start_time', 
        'end_time', 
        'day_of_week',
         'status', 
         'book_from',
         'book_until'
    ];

public function users()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

public function rooms()
{
    return $this->belongsTo(Room::class, 'room_id', 'id');
}

public function roomtypes()
{
    return $this->belongsTo(RoomType::class, 'roomtype_id', 'id'); 
}

public function subjects()
{
    return $this->belongsTo(Subject::class, 'subject_id', 'id');
}

public function sections()
{
    return $this->belongsTo(Section::class, 'section_id', 'id');
}


}
