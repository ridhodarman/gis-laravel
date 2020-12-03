<?php

namespace App\Http\Livewire\Building;

use Livewire\Component;

use App\Worship_building;
use App\House_building;
use App\Office_building;
use App\Educational_building;
use App\Health_service_building;
use App\Msme_building;

class Index extends Component
{
    public function render()
    {
        $ibadah = Worship_building::count();
        $rumah = House_building::count();
        $kantor = Office_building::count();
        $pendidikan = Educational_building::count();
        $kesehatan = Health_service_building::count();
        $umkm = Msme_building::count();
        return view ('livewire.building.index', 
                [
                    'ibadah' => $ibadah,
                    'rumah' => $rumah,
                    'kantor' => $kantor,
                    'pendidikan' => $pendidikan,
                    'kesehatan' => $kesehatan,
                    'umkm' => $umkm
                ]
            
            );
        //return view('livewire.building.index');
    }
}
