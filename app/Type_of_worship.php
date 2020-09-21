<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type_of_worship extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
