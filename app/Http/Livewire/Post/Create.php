<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use \App\Building_model;

class Create extends Component
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
        return redirect()->route('post.index');
    }

    public function render()
    {
        return view('livewire.post.create');
    }
}
