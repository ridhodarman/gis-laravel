<?php

namespace App\Http\Livewire\Datuk;

use Livewire\Component;
use App\Datuk;

class Index extends Component
{
    public function render()
    {
        $datuk = Datuk::select('id','datuk_name')
                            ->selectRaw('count(citizens.national_identity_number) as jumlah')
                            ->leftJoin('citizens', 'datuks.id', '=', 'citizens.datuk_id')
                            ->groupBy('datuks.id')
                            ->orderBy('datuk_name')
                            ->get();
        //return $datuk;
        return view ('livewire.datuk.index',['datuk' => $datuk]);
    }
}
