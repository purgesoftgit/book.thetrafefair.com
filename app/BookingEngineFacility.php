<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingEngineFacility extends Model
{
    protected $table = 'booking_engine_facility';
    protected $fillable = ['title','image','data'];
}
