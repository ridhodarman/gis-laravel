<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jorong extends Model
{
    protected $dates = ['deleted_at'];
}
