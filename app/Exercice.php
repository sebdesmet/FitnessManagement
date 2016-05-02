<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    protected  $fillable=['id_workout','name','serie','repetition','repos','id_exercice'];
    public $timestamps = false;

}
