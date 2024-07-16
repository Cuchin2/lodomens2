<?php

namespace App\Livewire;

use App\Models\Rating;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Image;
use App\Models\Sku;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Cart;
class ShopMain extends Component
{
    use WithPagination;
    public $showModal = false; public $skus = ''; public $image=''; public $price_cart = '';
    public $perPage = 5; public $counts = '1'; public $colorSelected= []; public $active = '0';
    public $showCreateModal = false; public $choose; public $rating=''; public $cat=''; public $cat_id='';
    public $bra=''; public $brand_id=''; public $gam=''; public $gam_id='';
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
    }    public function render()
    {
        $a=$this->gam_id; sleep(1);
        return view('livewire.shop-main',[
            'gamas'=>Color::with('images')->get(),
            'products' => Product::search($this->search)
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
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->when($this->gam_id != '', function ($query) use ($a) {
                $query->whereHas('colors', function ($query) use ($a) {
                    $query->where('color_id', $this->gam_id);
                });
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage),
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }
    public function addToCart()
    {
        $product = $this->skus->product;
        $qtn= $this->counts;
        $price = $this->skus->sell_price;
        if(session('location') !== 'PE')
        { $price = $this->skus->usd; }
        if($this->choose === 'CART' ){
            Cart::instance('cart')->add(
            $product->id,
            $product->name,
            $qtn,
            $price,
            ['productImage' => $this->image ?? 'image/dashboard/No_image_dark.png',
            'brand'=>$product->brand->name,
            'slug'=> $product->slug,
            'sku'=> $this->skus->code,
            'color'=> $this->skus->color->name,
            'color_id'=> $this->skus->color->id,
            'stock'=> $this->skus->stock]
        )->associate('App\Models\Sku');
        if(auth()->user()){
        Cart::instance('cart')->store(auth()->user()->id);}
        $this->redirectRoute('web.shop.cart.index');
        } else {
            Cart::instance('wishlist')->add(
                $product->id,
                $product->name,
                $qtn,
                $price,
                ['productImage' => $this->image ?? 'image/dashboard/No_image_dark.png',
                'brand'=>$product->brand->name,
                'slug'=> $product->slug,
                'sku'=> $this->skus->code,
                'color'=> $this->skus->color->name,
                'color_id'=> $this->skus->color->id,
                'stock'=> $this->skus->stock]
            )->associate('App\Models\Sku');
            Cart::instance('wishlist')->store(auth()->user()->id);
            $this->redirectRoute('web.shop.webdashboard.wishlist');
        }
    }
    public function showCartModal($id,$color,$url,$colorSelected,$choose)
    {   $this->counts= 1; $this->active =0;
        $this->skus= Sku::where(['product_id'=>$id,'color_id'=>$color])->first();
        if(session('location') !== 'PE')
                { $this->skus->sell_price = $this->skus->usd; }
        $this->image= $url;
        $this->colorSelected= json_decode($colorSelected);
        $this->price_cart= $this->skus->sell_price;
        $this->choose = $choose;
        $this->showModal = true;
    }
    public function decreaseCount($rowId,$index)
    {

            $this->counts--; $this->changePrice();
            // Lógica adicional si es necesario
    }

    public function increaseCount($rowId,$index)
    {

            $this->counts++; $this->changePrice();
    }
    public function changePrice()
    {   if (!is_numeric($this->counts) || $this->counts < 1) { $this->counts = 1; }
        else  {
            if(($this->counts > $this->skus->stock))
            {$this->counts = $this->skus->stock; }
        };
        if(session('location') !== 'PE')
        { $this->skus->sell_price = $this->skus->usd; }
        $this->price_cart= number_format($this->counts*$this->skus->sell_price, 2, '.', '');

    }
    public function changeColor($key,$id,$color)
    {
        $this->active = $key;  $this->counts=1;
        $this->skus= Sku::where(['product_id'=>$id,'color_id'=>$color])->first();
        $this->image = Image::join('row_image', 'images.id', '=', 'row_image.image_id')
        ->join('rows', 'rows.id', '=', 'row_image.row_id')
        ->where('color_id', $color)
        ->where('rows.order', 0)
        ->where('images.imageable_id', $id) // Agrega esta línea
        ->first()->url ?? '/image/dashboard/No_image_dark.png';
        if(session('location') !== 'PE')
        { $this->skus->sell_price = $this->skus->usd; }
        $this->price_cart= $this->skus->sell_price;
    }
    public function showWishlistModal()
    {
        $this->showCreateModal= true;
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
        $this->gam_id=$id;
    }
}
