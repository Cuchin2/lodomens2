<?php

namespace App\Livewire;

use App\Models\Rating;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Material;
use Illuminate\Support\Facades\DB;
use App\Models\Sku;
use App\Models\Type;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class ShopMain extends Component
{
    use WithPagination;
    public $rating=''; public $cat=''; public $cat_id=''; public $perPage = 16; public $new= ''; public $type_id=''; public $type_name=''; public $material_id=''; public $material_name='';
    public $bra=''; public $brand_id=''; public $gam='';  public $selectedOption = ''; public $selectedPrice = ''; public $page = 1;
    #[Url(history:true)]
    public $gam_id='';
    #[Url(history:true)]
    public $search = '';
    #[Url(history:true)]
    public $type = '';
    #[Url(history:true)]
    public $material = '';
    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function mount(){
        if (!empty($this->cat_id)) {
            $category = Category::where('id', $this->cat_id)->value('name');
            $this->cat = $category;
        }
    }
    public function getProductsProperty()
    {
        return   Product::search($this->search)
            ->where('status','SHOP')
            ->when($this->rating, function ($query) {
                $query->where('rating', $this->rating);
            })
            ->when($this->cat_id, function ($query) {
                $query->where('category_id', $this->cat_id);
            })
            ->when($this->brand_id, function ($query) {
                $query->where('brand_id', $this->brand_id);
            })
            ->when($this->type_id, function ($query) {
                $query->where('type_id', $this->type_id);
            })
            ->when($this->material_id, function ($query) {
                $query->where('material_id', $this->material_id);
            })
            ->when($this->gam_id != '', function ($query) {
                $query->whereHas('colors', function ($query) {
                    $query->where('color_id', $this->gam_id);
                });
            })
            ->when($this->selectedPrice != '',function($query){
                $query->orderBy('sell_price', $this->selectedPrice);
            })
            ->when($this->new,function($query){
                $query->orderBy($this->new, 'desc');
            })->with('type.images')
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage);

    }
    public function updated($propertyName)
    {
        // Reinicia la página a 1 cuando cambia cualquier filtro
        if (in_array($propertyName, ['search', 'rating', 'cat_id', 'brand_id', 'type_id', 'gam_id', 'selectedPrice', 'new', 'sortBy', 'sortDir','material_id'])) {
            $this->resetPage();
        }
    }
    public function render()
    {

        return view('livewire.shop-main',[
            'gamas'=>Color::with('images')->get(),
            'products' => $this->getProductsProperty(), /* 'products' => $this->products, */
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'types'=> Type::all(),
            'materials'=>Material::all()
        ]);
    }
    /* filtros */
    public function clean(){
        $this->reset('rating','cat','cat_id','bra','brand_id','gam','gam_id','type_id','type_name','material_id','material_name');
        $this->resetPage();
    }
    public function rate($star)
    {
        $this->rating=$star;
        $this->resetPage();
    }
    public function categorized($name,$id)
    {
        $this->cat=$name;
        $this->cat_id=$id;
        $this->resetPage();
    }
    public function brandized($name,$id)
    {
        $this->bra=$name;
        $this->brand_id=$id;
        $this->resetPage();
    }
    public function colorized($name,$id)
    {
        $this->gam=$name;
        $this->gam_id=$id; /* $this->dispatch('out'); */
        $this->resetPage();
    }
    public function typerized($name,$id)
    {
        $this->type_id=$id;
        $this->type_name=$name;
        $this->resetPage();
    }
    public function materialized($name,$id)
    {
        $this->material_id=$id;
        $this->material_name=$name;
        $this->resetPage();
    }
    #[On('option-selected')]
    public function abc($value)
    {
        if($value == 'new'){
            $this->new='created_at';
            $this->selectedPrice='';
        }
        else{
            $this->selectedPrice=$value;
        }
    }

}
