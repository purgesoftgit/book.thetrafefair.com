<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRequest extends Model
{
    protected $table = 'event_request';
	protected $fillable = ['hotel', 'event_name', 'guest_number', 'start_date', 'end_date', 'seating_style', 'full_name', 'phone', 'email','updated_at','created_at'];
}
