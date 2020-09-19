<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type_of_office extends Model
{
    protected $dates = ['deleted_at'];
}
