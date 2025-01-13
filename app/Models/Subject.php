<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable = [
        'subject_name',
        'subject_type',
    ];

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
