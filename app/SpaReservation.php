<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaReservation extends Model
{
    protected $table = 'spa_reservation';
    protected $fillable = ['name','email','phone','start_date','end_date','start_time','end_time','selectedPeople','request'];
}
