<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = ['job_name'];
}
