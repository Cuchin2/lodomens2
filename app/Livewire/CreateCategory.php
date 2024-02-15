<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
class CreateCategory extends Component
{
    public $showModal = false;
    public $name = '';
    public $description = '';

    #[On('category-modal')]
    public function showDeleteModal2()
        {
            $this->showModal = true;

        }
    public function delete(){
            Category::create([
            'name'=> $this->name,
            'slug'=>Str::slug($this->name, '-'),
            'description'=>$this->description,
           ]);
           return $this->redirect("/admin/categories");
    }
    public function render()
    {
        return view('livewire.create-category');
    }
}
