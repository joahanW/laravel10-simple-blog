<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class PostList extends Component
{

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';

    public function setSort($sort){
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
    }

    #[On('search')]
    public function updateSearch($search){
        $this->search = $search;
//        dd('search');
    }

    #[Computed()]
    public function posts(){
        return Post::published()
            ->orderBy('published_at',$this->sort)
            ->where('title','like',"%{$this->search}%")
            ->paginate(3);
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
