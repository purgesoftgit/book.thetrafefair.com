<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    protected $table = 'room_category';
    protected $fillable = ['title','image','description','price','room_services','image_order'];

    public function roomadditionaldata(){
        return $this->hasMany('App\RoomAdditionalData','room_id')->orderBy('date','desc');
    } 
}
