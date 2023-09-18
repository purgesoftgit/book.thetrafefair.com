<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category_blog';
    protected $fillable = ['id','category','value','slug'];
}
