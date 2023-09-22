<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";
    protected $fillable = ['user_id','selected_website_value','liked','unliked','review','item_id','item_type'];
}
