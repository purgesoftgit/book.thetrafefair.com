<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'careerjobs';
	protected $fillable = ['job_title','department','qualification','age','experience','job_position','location','selected_website','description'];
}
