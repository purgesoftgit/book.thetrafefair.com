<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleReviews extends Model
{
    protected $table = "google_reviews";
    protected $fillable = ['name','overall_rating','room_rating','service_rating','location_rating','experience','image','kind_trip','travel','describe_hotel','more_about','activity'];
}
