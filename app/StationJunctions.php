<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationJunctions extends Model
{
    public $fillable = ['name','customer_id','station_id'];
}
