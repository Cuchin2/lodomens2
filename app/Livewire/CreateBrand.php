<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Brand;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
class CreateBrand extends Component
{
    use WithFileUploads;
    public $showModal2 = false;
    public $name = ''; public $slug =''; public $url=''; public $logo;
    public $description = '';

    #[On('category-modal')]
    public function showDeleteModal2()
        {
            $this->showModal2 = true;
            $this->dispatch('notify2');
        }
    public function delete(){
            $brand=Brand::create([
            'name'=> $this->name,
            'slug'=> $this->slug,
            'description'=>$this->description,
            ]);
            $fileName= time().'-'. $this->logo->getClientOriginalName();
            $url_name='image/lodomens/'.$fileName;
            $brand->images()->create([
            'url' => $url_name,
            'imageable_type'=>'App\Models\Brand',
            'imageable_id'=>$brand->id
        ]);
            $this->logo->storeAs('image/lodomens/', $fileName, 'public');
           return $this->redirect("/admin/brand");
    }
    public function render()
    {
        return view('livewire.create-brand');
    }
}
