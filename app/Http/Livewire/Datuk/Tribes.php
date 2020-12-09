<?php

namespace App\Http\Livewire\Datuk;

use Livewire\Component;
use App\Tribe;

class Tribes extends Component
{
    public function render()
    {
        $tribe = Tribe::select('tribes.id','name_of_tribe')
                            ->selectRaw('count(datuks.id) as jumlah')
                            ->leftJoin('datuks', 'tribes.id', '=', 'datuks.tribe_id')
                            ->groupBy('tribes.id')
                            ->orderBy('name_of_tribe')
                            ->get();
        //return $tribe;
        return view ('livewire.datuk.tribes',['suku' => $tribe]);
    }
}
