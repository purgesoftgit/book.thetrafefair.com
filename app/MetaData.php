<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    protected $table = "meta_datas";
    protected $fillable = ['route','meta_title','meta_description','type'];
}
