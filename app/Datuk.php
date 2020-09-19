<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Datuk extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = ['datuk_name'];
}
