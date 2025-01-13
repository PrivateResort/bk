<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //

    protected $fillable = [
        'section_name',
        'section_type'
    ];

    public function bookings(){
        return $this->hasMany(Booking::class); 
    }
}
