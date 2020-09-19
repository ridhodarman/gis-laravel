<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worship extends Model
{
    protected $dates = ['deleted_at'];
    protected $tabel = "worship_building";
}
