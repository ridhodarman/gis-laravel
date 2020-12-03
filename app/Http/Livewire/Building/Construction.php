<?php

namespace App\Http\Livewire\Building;

use Livewire\Component;
use \App\Type_of_construction;

class Construction extends Component
{
    public function render()
    {
        $konstruksi = Type_of_construction::select('id','name_of_type')
                            ->selectRaw('count(buildings.building_id) as jumlah')
                            ->leftJoin('buildings', 'type_of_constructions.id', '=', 'buildings.type_of_construction')
                            ->groupBy('type_of_constructions.id')
                            ->orderBy('type_of_constructions.name_of_type')
                            ->get();
        //return $konstruksi;
        return view ('livewire.building.construction',['konstruksi' => $konstruksi]);
        //return view('livewire.building.construction');
    }
}
