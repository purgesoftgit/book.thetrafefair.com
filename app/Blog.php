<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog_posts';
    protected $fillable = ['user_id','author_name','title','description','image','slug'];
}
