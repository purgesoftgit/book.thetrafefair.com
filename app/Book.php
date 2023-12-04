<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "booking";
    protected $fillable = ['name','email','phone','cin_date','cout_date','category','room','guests','status'];
}