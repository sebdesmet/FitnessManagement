<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected  $fillable=['id_workout','id_client','workout','date_validation','isvalid'];

}
