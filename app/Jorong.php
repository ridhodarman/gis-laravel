<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jorong extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $casts = ['geom' => 'array',];
}
