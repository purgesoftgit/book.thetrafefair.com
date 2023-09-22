<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefundUsers extends Model
{
    protected $table = "refund_users";
    protected $fillable = ["txn_data"];

}
