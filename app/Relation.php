<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $fillable = [
        'email', 'id', 'relation',
    ];
}
