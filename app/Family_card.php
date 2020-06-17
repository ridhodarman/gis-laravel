<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family_card extends Model
{
    protected $fillable =   [
        'family_card_number',
        'house_building_id',
        'category',
        'residence_status'
    ];
    protected $primaryKey = 'family_card_number';
    protected $casts = [ 'family_card_number' => 'string' ];
}
