<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use \App\Building_model;

class Edit extends Component
{
    public $ModelId;
    public $name_of_model;

    public function mount($id){
        $post = Building_model::find($id);
        if($post){
            $this->ModelId = $post->id;
            $this->name_of_model = $post->name_of_model;
        }
    }

    public function update(){
        $post = Building_model::find($this->ModelId);
        if($post){
            $post->update([
                'name_of_model' => $this->name_of_model
            ]);
            $nama = str_replace('"',"", $this->name_of_model);
            $pesan = "<b>".$nama."</b> updated successfully";
            session()->flash('success', $pesan);
            return redirect()->route('post.index');
        }
    }

    public function render()
    {
        return view('livewire.post.edit');
    }
}
