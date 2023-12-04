<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomAdditionalData extends Model
{
    protected $table = 'room_additional_data';
    protected $fillable = ['room_id','price','room_avail','date'];
}
