<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Attributes\Url;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class TagTable extends Component
{
    use WithPagination;
    public $showModal = false;
    public $itemIdToDelete; public $tag = '';
    public $name;
    public $perPage = 10;
    public $kind;
    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $type = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';
    public $which='';
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('tags')->ignore($this->tag),
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
        ];
    }
    public function delete($id)
    {
        if($id>0) {
        $tag=Tag::find($id);
        $this->tag = $tag;}
        $this->validate();
        if($this->which == 'DELETE')
        $tag->delete();
        else
        {

            $tag->name = $this->name;
            $tag->description = $this->which;
            $tag->save();
        }
        $this->showModal = false;
    }
    public function setSortBy($sortByField)
    {
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir === 'ASC') ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }
    public function render()
    {
        return view('livewire.tag-table',[
            'tags' => Tag::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }


    public function showDeleteModal($itemId,$name,$abc)
        {
            $this->resetValidation();
            $this->name = $name;
            $this->itemIdToDelete = $itemId;
            $this->showModal = true;
            $this->which = $abc;
            if($abc == 'CREATE'){  $this->which ='';}
        }
    public function page($page)
    {
        $this->perPage = $page;
    }
}
