<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artefact extends Model
{
    protected $table = 'artefacts_home';
    protected $fillable = ['id','selected_website','title','description','image', 'created_at', 'updated_at'];
}
