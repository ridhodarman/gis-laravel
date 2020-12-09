<?php

namespace App\Http\Livewire\Population;

use Livewire\Component;
use App\Education;

class Edu extends Component
{
    public function render()
    {
        $education = Education::select('id','education_level')
                            ->selectRaw('count(citizens.national_identity_number) as jumlah')
                            ->leftJoin('citizens', 'educations.id', '=', 'citizens.educations')
                            ->groupBy('educations.id')
                            ->orderBy('id')
                            ->get();
        //return $education;
        return view ('livewire.population.edu',['pendidikan' => $education]);
    }
}
