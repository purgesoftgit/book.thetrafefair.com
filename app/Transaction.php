<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
     protected $table = "transactions";
     //protected $fillable = ['formData'];
     public function user(){
          return $this->belongsTo('App\User','user_id','id');
     }

     public function wallet(){
          return $this->belongsTo('App\Wallet','txnid','txnid');

     }
}
