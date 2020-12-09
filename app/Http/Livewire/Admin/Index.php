<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\User;

class Index extends Component
{
    public function render()
    {
        $user = User::select('id','name', 'username', 'email')->get();
        //return $job;
        return view ('livewire.admin.index',['user' => $user]);
    }
}
