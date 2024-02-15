<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Tag;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
class CreateTag extends Component
{
    public $showModal = false;
    public $name = '';
    public $description = '';
    public $type = '';
    public $translate= [
        'PRODUCT' => 'producto',
        'POST' => 'blog'
    ];
    #[On('tag-modal')]
    public function showDeleteModal2()
        {
            $this->showModal = true;

        }
    public function delete(){
            Tag::create([
            'name'=> $this->name,
            'slug'=>Str::slug($this->name, '-'),
            'description'=>$this->description,
            'type'=>$this->type,
           ]);
           return $this->redirect("/admin/tags");
    }
    public function render()
    {
        return view('livewire.create-tag');
    }
}
