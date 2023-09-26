<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CMSPage extends Model
{
    protected $table = 'cms_pages';
	protected $fillable = ['title','slug','description','meta_title','meta_description','meta_keywords'];
}
