<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Educational_building extends Model
{
    protected $dates = ['deleted_at'];
}
