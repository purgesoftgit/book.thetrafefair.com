<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $table = 'promocodes';
	protected $fillable = ['code','is_used'];

    public function usedpromo(){
        return  $this->belongsTo('App\UsedPromocode','id','promocode_id');
     }
}
