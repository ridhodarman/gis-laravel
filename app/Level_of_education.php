<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level_of_education extends Model
{
    protected $dates = ['deleted_at'];
}
