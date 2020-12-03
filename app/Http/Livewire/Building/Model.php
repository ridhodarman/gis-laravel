<?php

namespace App\Http\Livewire\Building;

use Livewire\Component;
use \App\Building_model;

class Model extends Component
{
    public $name_of_model;
    
    public function store() {
        $data = $this->validate([
            'name_of_model' => 'required|max:40|unique:building_models|not_regex:/`/i'
        ]);
        Building_model::create($data);
        $nama = str_replace('"',"", $this->name_of_model);
        $pesan = "<b>".$nama."</b> added successfully";
        session()->flash('success', $pesan);
        return redirect()->route('livewire.building.model');
    }
    
    public function render()
    {
        $model = Building_model::select('id','name_of_model')
                            ->selectRaw('count(buildings.building_id) as jumlah')
                            ->leftJoin('buildings', 'building_models.id', '=', 'buildings.building_model')
                            ->groupBy('building_models.id')
                            ->orderBy('building_models.name_of_model')
                            ->get();
        //return $model;
        return view ('livewire.building.model',['model' => $model]);
    }
}
