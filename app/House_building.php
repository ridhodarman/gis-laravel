<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House_building extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $incrementing = false;
}
