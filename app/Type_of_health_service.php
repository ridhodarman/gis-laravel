<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type_of_health_service extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
