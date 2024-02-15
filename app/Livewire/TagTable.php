<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Attributes\Url;
use Livewire\Component;

use Livewire\WithPagination;

class TagTable extends Component
{
    use WithPagination;
    public $showModal = false;
    public $itemIdToDelete;
    public $itemName;
    public $perPage = 5;
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

    public function delete($id)
    {   $tag=Tag::find($id);
        if($this->which == 'DELETE')
        $tag->delete();
        else
        {
            $tag->name = $this->itemName;
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


    public function showDeleteModal($itemId,$itemName,$abc)
        {
            $this->itemName = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->showModal = true;
            $this->which = $abc;
        }
}
