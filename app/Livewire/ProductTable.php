<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Type;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class ProductTable extends Component
{
    use WithPagination;
    public $showModal = false; public $showModalCreate= false;
    public $itemIdToDelete;
    #[Validate('required', message: 'Seleccione una categoría')]
     public $category_id;
    public $itemName; public $product = '';
    public $name;
    public $code;
    public $perPage = 5;

    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $type = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('products')->ignore($this->product),
            ],
            'code' => [
                'required',
                'size:4',
                Rule::unique('products')->ignore($this->product),
                ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'code.required' => 'El código es requerido.',
            'code.size' => 'Se Requiere 4 dígitos.',
        ];
    }

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
            'name' => $this->name,
            'code'=> $this->code,
            'slug' =>Str::slug($this->name),
            'category_id' => $this->category_id,
            'type_id' => Type::where('is_default',1)->pluck('id')->first() ?? null,
        ]);
        $this->showModalCreate = false;
        $this->redirectRoute('inventory.products.edit',['product'=>$product]);
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
