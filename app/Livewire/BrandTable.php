<?php

namespace App\Livewire;
use App\Models\Brand;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;

class BrandTable extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $showModal = false; public $condition;
    public $itemIdToDelete;
    public $itemName; public $itemCode;  public $logo;
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
    {   $brand=Brand::find($id);
        if($this->which == 'DELETE')
        $brand->delete();
        elseif ($this->which =='CREATE'){
            dd('hola');
        }
        else
        {
            $brand->name = $this->itemName;
            $brand->slug = $this->itemCode;
            $brand->description = $this->which;
            $brand->save();
            if ($this->logo) {
                $fileName = time() . '-' . $this->logo->getClientOriginalName();
                $url_name = 'image/lodomens/' . $fileName;
                $brand->images()->update([
                    'url' => $url_name,
                ]);
                $this->logo->storeAs('image/lodomens/', $fileName, 'public');
            }
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
    public function showDeleteModal($itemId,$itemName,$abc,$slug,$file)
        {
           if(isset($file)){
            $this->dispatch('notify',url: $file);
             }
            $this->itemName = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->itemCode = $slug;
            $this->showModal = true;
            $this->which = $abc;


        }

    public function render()
    {
        return view('livewire.brand-table',[
            'brands' =>  Brand::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
}
