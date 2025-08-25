<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Type;
use App\Models\Category;
use App\Models\Material;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use MercadoPago\Resources\User\Status;

class ProductTable extends Component
{
    use WithPagination;
    public $showModal = false; public $showModalCreate= false; public $showModalTipo= false;
    public $itemIdToDelete; public $category_selected;
    #[Validate('required', message: 'Seleccione una categoría')]
     public $category_id; public $color1='inherit';
    public $itemName; public $product = ''; public $state = ''; public $id=''; public $status= ''; public $color2='inherit'; public $change2=''; public $status2= '';
    public $name; public $tipo_name; public $tipo_new_name; public $tipo_hex; public $tipo_old_hex; public $product_name; public $type_id;
    public $code; public $category_nuevo; public $material_selected; public $state_selected; public $type_selected;
    public $perPage = 10;

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
            'code.size' => 'Se Requiere 4 dígitos .',
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {   $product=Product::find($id);
        if($this->change2 ==='STATUS') {
            if($product->colors->isEmpty() && $this->state == 'SHOP')
            {
                $this->change2 = 'STOP';
            } else{
                $product->status=$this->state;
                $product->save();
                $this->dispatch('state',state:$this->traslate($this->state),id:$id);
                $this->showModal = false;
            }
        }
        else{
            $product->delete(); $this->showModal = false;
        }

    }
    public function create()
    {
        $this->validate();
         $product=Product::create([
            'name' => $this->name,
            'code'=> $this->code,
            'slug' =>Str::slug($this->name),
            'category_id' => $this->category_id,
            'type_id' => Type::where('is_default',1)->pluck('id')->first() ?? 1,
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
        return view('livewire.product-table', [
            'typess' => Type::all()->pluck('name', 'id')->toArray(),
            'types'=>Type::all(),
            'products' => Product::search($this->search)
/*                 ->when($this->type !== '', function ($query) {
                    $query->where('type_id', $this->type);
                }) */
                ->when(!empty($this->category_selected), function ($query) {
                    $query->where('category_id', $this->category_selected);
                })
                ->when(!empty($this->material_selected), function ($query) {
                    $query->where('material_id', $this->material_selected);
                })
                ->when(!empty($this->state_selected), function ($query) {
                    $query->where('status', $this->state_selected);
                })
                ->when(!empty($this->type_selected), function ($query) {
                    $query->where('type_id', $this->type_selected);
                })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
            'categories' => Category::all()->pluck('name', 'id')->toArray(),
            'materials' => Material::all()->pluck('name', 'id')->toArray(),
            'product_states' => [
                '1'=>'Publicado',
                '2'=>'Borrador',
                '3'=>'Programado',
                '4'=>'Cancelado',
            ],
        ]);
    }


    public function showDeleteModal($itemId,$itemName)
        {
            $this->change2='';
            $this->itemName = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->showModal = true;
        }
    public function showCreateModal()
    {
        $this->name='';
        $this->category_id='';
        $this->dispatch('rest5');
        $this->showModalCreate = true;
    }

    public function selection($value,$set){
        if($set == 1){
            $this->category_selected=$value;
        }
        if($set ==2){
            $this->material_selected=$value;
        }
        if($set ==3 ){
            if($value==1){ $this->state_selected = 'SHOP';}
            if($value==2){ $this->state_selected = 'DRAFT';}
            if($value==3){ $this->state_selected = 'POS';}
            if($value==4){ $this->state_selected = 'DISABLED';}
        }
        if($set ==4 ){
            $this->type_selected = $value;
        }
        if($set ==5){
            $this->category_id=$value;

        }
    }
    public function resetSelectors(){
        $this->dispatch('rest1');
        $this->dispatch('rest2');
        $this->dispatch('rest3');
        $this->dispatch('rest4');
        $this->reset('category_selected','material_selected','state_selected','type_selected');
    }
    public function estado($state,$id,$status,$color,$name){
        $this->showModal = true;
        $this->itemName = $name;
        $this->status = $status;
        $this->status2 = $this->traslate($state);
        $this->itemIdToDelete = $id;
        $this->state= $state;
        $this->color2=$color;
        $this->color1=$this->traslateColor($this->status);
        $this->change2='STATUS';
    }
    public function tipo($id,$hex,$name_new,$name,$old_hex,$product_name,$type_id){

        $this->showModalTipo=true;
        $this->id=$id;
        $this->tipo_name=$name;
        $this->tipo_new_name=$name_new;
        $this->tipo_hex=$hex;
        $this->tipo_old_hex=$old_hex;
        $this->product_name=$product_name;
        $this->type_id=$type_id;
    }
    public function change_tipo(){
        $product_by_type= Product::find($this->id);
        $product_by_type->type_id=$this->type_id;
        $product_by_type->save();
        $this->dispatch('tipo',name:$this->tipo_new_name,hex:$this->tipo_hex);
        $this->showModalTipo=false;
    }
    public function reloadd()
    {
        $this->showModal=false;
    }
    public function traslate($a){
        switch ($a) {
            case 'DRAFT':
                return 'Borrador';
            case 'SHOP':
                return 'Publicado';
            case 'POS':
                return 'Programado';
            default:
                return 'Cancelado';
        }
    }
    public function traslateColor($b){
        switch ($b) {
            case 'Borrador':
                return 'amarillo';
            case 'Publicado':
                return 'verde';
            case 'Programado':
                return 'morado';
            default:
                return 'rojo';
        }
    }
    public function page($page)
    {
        $this->perPage = $page;
    }

}
