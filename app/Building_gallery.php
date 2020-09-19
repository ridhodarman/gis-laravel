<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building_gallery extends Model
{
    protected $dates = ['deleted_at'];
    //protected $table = 'building_gallerys';
}
