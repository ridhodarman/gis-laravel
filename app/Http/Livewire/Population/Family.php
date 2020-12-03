<?php

namespace App\Http\Livewire\Population;

use Livewire\Component;
use App\Family_card;
use App\House_building;

class Family extends Component
{
    public function render()
    {
        $kk = Family_card::select('family_cards.family_card_number','house_building_id')
                            ->selectRaw('count(citizens.national_identity_number) as jumlah')
                            ->leftJoin('citizens', 'family_cards.family_card_number', '=', 'citizens.family_card_number')
                            ->groupBy('family_cards.family_card_number')
                            ->get();
        //return $kk;
        $query = House_building::Select('house_building_id')->get();
        return view ('livewire.population.family',['kk' => $kk, 'rumah' => $query]);
    }
}
