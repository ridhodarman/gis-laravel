<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Citizen extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable =   [
        'national_identity_number',
        'name',
        'gender',
        'birth_date'
    ];
    protected $primaryKey = 'national_identity_number';
    protected $casts = [ 'national_identity_number' => 'string' ];
}
