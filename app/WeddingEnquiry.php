<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeddingEnquiry extends Model
{
    public $table = "wedding_enquiry";
    public $fillable  = ['name','email','phone','city','enquiry'];

}
