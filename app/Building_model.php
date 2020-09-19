<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building_model extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = ['name_of_model'];
}
