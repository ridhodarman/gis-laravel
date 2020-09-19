<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family_card extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable =   [
        'family_card_number',
        'house_building_id',
        'category',
        'residence_status'
    ];
    protected $primaryKey = 'family_card_number';
    protected $casts = [ 'family_card_number' => 'string' ];
}
