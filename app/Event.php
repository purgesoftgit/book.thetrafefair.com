<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
	protected $fillable = ['title','image'/*,'author_name'*/,'description','location','start_datetime','end_datetime'];
}
