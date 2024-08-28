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
use Illuminate\Support\Facades\DB;
use App\Models\Sku;
use App\Models\Type;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class ShopMain extends Component
{
    use WithPagination;
    public $rating=''; public $cat=''; public $cat_id=''; public $perPage = 5; public $new= ''; public $type_id=''; public $type_name='';
    public $bra=''; public $brand_id=''; public $gam=''; public $gam_id='';  public $selectedOption = ''; public $selectedPrice = '';
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
           /*  ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            }) */
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
    public function render()
    {

        return view('livewire.shop-main',[
            'gamas'=>Color::with('images')->get(),
            'products' => $this->products,
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'types'=> Type::all()
        ]);
    }
    /* filtros */
    public function clean(){
        $this->reset('rating','cat','cat_id','bra','brand_id','gam','gam_id');
    }
    public function rate($star)
    {
        $this->rating=$star;
    }
    public function categorized($name,$id)
    {
        $this->cat=$name;
        $this->cat_id=$id;
    }
    public function brandized($name,$id)
    {
        $this->bra=$name;
        $this->brand_id=$id;
    }
    public function colorized($name,$id)
    {
        $this->gam=$name;
        $this->gam_id=$id; /* $this->dispatch('out'); */
    }
    public function typerized($name,$id)
    {
        $this->type_id=$id;
        $this->type_name=$name;
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
