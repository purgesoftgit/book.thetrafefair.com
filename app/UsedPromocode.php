<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedPromocode extends Model
{
    protected $table = 'used_promocodes';
	protected $fillable = ['user_id','promocode_id'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

}
