<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AskQuestion extends Model
{
    protected $table = "ask_question";
    protected $fillable = ['email','question'];
}