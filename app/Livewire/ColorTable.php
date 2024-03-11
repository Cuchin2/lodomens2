<?php

namespace App\Livewire;

use App\Models\Color;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ColorTable extends Component
{
    use WithPagination;
    public $showModal = false;
    public $newModal = false;
    public $itemIdToDelete;
    public $itemName;
    public $newNameColor;
    public $newHex;
    public $hex; public $choose;
    public $perPage = 5;

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

    public function delete(Color $color)
    {
        $color->delete();
        $this->showModal = false;
    }
    public function new()
    {
        $this->newModal = false;
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
        return view('livewire.color-table',[
            'colors' => Color::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }


    public function showDeleteModal($itemId,$itemName,$itemHex)
        {
            $this->itemName = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->hex = $itemHex;
            $this->showModal = true;
        }
    public function showNewModal()
        {
            $this->newModal = true;
            $this->choose = 0;
            $this->newNameColor = '';
            $this->newHex = '';
        }
    public function showEditModal($itemId,$itemName,$itemHex)
        {
            $this->newModal = true;
            $this->newNameColor = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->newHex = $itemHex;
            $this->choose = 1;
        }
    public function createColor()
    {
        if($this->choose === 0)
        {
            Color::create([
                'name'=> $this->newNameColor,
                'hex'=> $this->newHex,
                'url'=> '',
            ]);
        }
        else
        {
           $color= Color::find($this->itemIdToDelete);
           $color->name= $this->newNameColor;
           $color->hex= $this->newHex;
           $color->save();
        }
    $this->newModal = false;
    $this->newNameColor='';
    $this->itemIdToDelete ='';
    $this->newHex='';
    }
}
