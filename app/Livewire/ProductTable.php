<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
class ProductTable extends Component
{
    use WithPagination;
    public $showModal = false; public $showModalCreate= false;
    public $itemIdToDelete;
    #[Validate('required', message: 'Seleccione una categoría')]
     public $category_id;
    public $itemName;
    #[Validate('required', message: 'El nombre del producto es obligatorio')]
    public $productName;
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

    public function delete(Product $product)
    {
        $product->delete();
        $this->showModal = false;
    }
    public function create()
    {
        $this->validate();
         $product=Product::create([
            'name' => $this->productName,
            'slug' =>Str::slug($this->productName),
            'category_id' => $this->category_id,
        ]);
        $this->showModalCreate = false;
        $this->redirectRoute('products.edit',['product'=>$product]);
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
        return view('livewire.product-table',[
            'products' => Product::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage),
            'categories'=> Category::all()->pluck('name', 'id')->toArray(),
        ]);
    }


    public function showDeleteModal($itemId,$itemName)
        {
            $this->itemName = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->showModal = true;
        }
    public function showCreateModal()
    {
        $this->showModalCreate = true;
    }

    public function change($a)
    {
        $this->category_id= $a;
    }
}
