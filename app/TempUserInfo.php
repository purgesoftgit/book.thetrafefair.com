<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempUserInfo extends Model
{
     protected $table = "temp_user_information";
     protected $fillable = ['room_id','checkin','checkout','price','with_tax_price','final_price','room','guest'];
}
