<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class career extends Model
{
    protected $table = "career";
    protected $fillable = ["first_name",'last_name','email','phone_number','job_title','qualification','s_qualification','job_location','job_position','experience','pdf'];

}
