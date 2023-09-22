<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = "wallets";
    protected $fillable = ['user_id','amount','message','txn_type','amount_type','txn_data','txnid'];

    public function transactions()
    {
      return $this->belongsTo('App\Transaction','txnid','txnid');
    }

    public function user()
    {
      return $this->belongsTo('App\User','user_id','id');
    }

    public function referraluser()
    {
      return $this->belongsTo('App\User','user_id','id');
    }
}
