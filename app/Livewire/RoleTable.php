<?php

namespace App\Livewire;
use App\Models\Role;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class RoleTable extends Component
{
    use WithPagination;
    public $showModal = false;
    public $itemIdToDelete;
    public $itemName;
    public $perPage = 10;

    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $type = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete(Role $role)
    {
        $role->delete();
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
        return view('livewire.role-table',[
            'roles' => Role::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }


    public function showDeleteModal($itemId,$itemName)
        {
            $this->itemName = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->showModal = true;
        }
        public function page($page)
        {
            $this->perPage = $page;
        }
}
