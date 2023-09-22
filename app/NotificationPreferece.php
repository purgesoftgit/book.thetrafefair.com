<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationPreferece extends Model
{
    protected $table = "notification_prefereces";
    protected $fillable = ['user_id','activity','title','is_email','is_phone','is_active'];
}
