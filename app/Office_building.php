<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office_building extends Model
{
    protected $dates = ['deleted_at'];
}
