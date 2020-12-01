<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use \App\Building_model;
use Livewire\withPagination;

class Index extends Component
{
    public function destroy($id) {
        $post = Building_model::find($id);
        if($post){
            $nama = str_replace('"',"", $post->name_of_model);
            $pesan = "<b>".$nama."</b> deleted successfully";
            $post->delete();
            session()->flash('success', $pesan);
            return redirect()->route('post.index');
        }
    }
    
    public function render()
    {
        return view('livewire.post.index',
                    [
                        'posts' => Building_model::latest()->paginate(5)
                    ]
                    );
    }
}
