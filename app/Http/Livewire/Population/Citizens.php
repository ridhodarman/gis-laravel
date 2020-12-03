<?php

namespace App\Http\Livewire\Population;

use Livewire\Component;
use \App\Citizen;

class Citizens extends Component
{
    public function render()
    {
        $citizen = Citizen::select('national_identity_number','name')
                            ->get();
        return view ('livewire.population.citizens',['citizen' => $citizen]);
    }
}
