<?php

namespace App\Livewire;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Component;

class CategoryTable extends Component
{
    use WithPagination;
    public $showModal = false;
    public $itemIdToDelete;
    public $itemName;
    public $perPage = 5;

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
    {   $category=Category::find($id);
        if($this->which == 'DELETE')
        $category->delete();
        else
        {
            $category->name = $this->itemName;
            $category->description = $this->which;
            $category->save();
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
    public function showDeleteModal($itemId,$itemName,$abc)
        {
            $this->itemName = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->showModal = true;
            $this->which = $abc;
        }

    public function render()
    {
        return view('livewire.category-table',[
            'categories' =>  Category::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
}
