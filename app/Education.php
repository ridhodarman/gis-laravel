<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'educations';
    protected $fillable = ['education_level'];
}
