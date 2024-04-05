<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
class CreateCategory extends Component
{
    public $showModal = false;
    #[Validate('required', message: 'El nombre es necesario')]
    #[Validate('unique:categories,name', message: 'Ya existe un nombre así')]
    public $name = '';
    #[Validate('required', message: 'El código es necesario')]
    #[Validate('unique:categories,code', message: 'Ya existe un código así')]
    #[Validate('size:2', message: 'Requiere 2 carácteres')]
    public $code;
    public $description = '';

    #[On('category-modal')]
    public function showDeleteModal2()
        {   $this->resetValidation();
            $this->reset('name','code','description');
            $this->showModal = true;

        }
    public function delete(){
        $this->validate();
            Category::create([
            'name'=> $this->name,
            'code'=> $this->code,
            'slug'=>Str::slug($this->name, '-'),
            'description'=>$this->description,
           ]);
           $this->showModal = false;
           $this->reset('name','code','description');
    }
    public function render()
    {
        return view('livewire.create-category');
    }
    public function codeComplete() {
        $this->code = strtoupper($this->code);
    }
}
