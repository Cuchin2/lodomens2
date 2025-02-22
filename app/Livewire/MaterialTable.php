<?php

namespace App\Livewire;

use App\Models\Material;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class MaterialTable extends Component
{
    use WithPagination;
    public $showModal = false;
    public $newModal = false;
    #[Url(history:true)]
    public $type = ''; public $name = ''; public $material=''; public $description='';
    public $perPage = 10;
    #[Url(history:true)]
    public $search = '';
    public $itemName; public $itemIdToDelete; public $choose;
    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('materials')->ignore($this->material),
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.unique' => 'El nombre es único',
        ];
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.material-table',[
            'materials' => Material::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
    public function page($page)
    {
        $this->perPage = $page;
    }
    public function showNewModal()
    {
        $this->reset('description','name');
        $this->resetValidation();
        $this->newModal = true;
        $this->choose = 0;
        $this->dispatch('notify2');
    }
    public function createMaterial(){
        $this->validate();
        if($this->choose === 0)
        {
            Material::create([
                'name'=> $this->name,
                'slug' =>Str::slug($this->name),
                'description'=> $this->description,

            ]);
        }
        if($this->choose === 1){
            $material= Material::find($this->itemIdToDelete);
            $material->name= $this->name;
            $material->description= $this->description;
            $material->save();
        }
        $this->reset('description','name');
        $this->newModal = false;
    }
    public function showEditModal($itemId,$itemName,$itemDescription)
    {   $this->resetValidation(); $this->dispatch('notify2');
        $this->choose = 1;
        $this->newModal = true;
        $this->name = $itemName;
        $this->itemIdToDelete = $itemId;
        $this->description = $itemDescription;
    }
    public function showDeleteModal($itemId,$itemName)
    {
        $this->itemName = $itemName;
        $this->itemIdToDelete = $itemId;
        $this->choose = 2;
        $this->showModal = true;
    }
}
