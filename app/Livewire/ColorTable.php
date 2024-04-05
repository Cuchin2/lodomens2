<?php

namespace App\Livewire;

use App\Models\Color;
use App\Models\Sku;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
class ColorTable extends Component
{
    use WithPagination;
    public $showModal = false;
    public $newModal = false;
    public $itemIdToDelete; public $color='';

    public $itemName;

    public $name;
    public $newHex;

    public $code;
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
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('colors')->ignore($this->color),
            ],
            'code' => [
                'size:2',
                'required',
                Rule::unique('colors')->ignore($this->color),
                ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'code.size' => 'Se Requiere 2 dígitos.',
        ];
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


    public function showDeleteModal($itemId,$itemName,$itemHex,$itemCode)
        {

            $this->itemName = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->hex = $itemHex;
            $this->code= $itemCode;
            $this->showModal = true;
        }
    public function showNewModal()
        {
            $this->resetValidation();
            $this->newModal = true;
            $this->choose = 0;
            $this->name = '';
            $this->newHex = '';
            $this->code = '';
        }
    public function showEditModal($itemId,$itemName,$itemHex,$itemCode)
        {   $this->resetValidation();
            $this->newModal = true;
            $this->name = $itemName;
            $this->itemIdToDelete = $itemId;
            $this->newHex = $itemHex;
            $this->code= $itemCode;
            $this->choose = 1;
        }
    public function createColor()
    {
        $this->color= Color::find($this->itemIdToDelete);
        $this->validate();
        if($this->choose === 0)
        {

            Color::create([
                'name'=> $this->name,
                'hex'=> $this->newHex,
                'code'=> $this->code,
                'url'=> '',
            ]);
        }
        else
        {
            $color= Color::find($this->itemIdToDelete);
            $color->name= $this->name;
            $color->hex= $this->newHex;
            $color->code= $this->code;
            $color->save();
            $skus = Sku::where('color_id',$this->itemIdToDelete)->get();
            $skus->each(function ($sku) {
                $codeDigits = substr($this->code,-2);
                $sku->code = substr_replace($sku->code, $codeDigits, -2);
                $sku->save();
            });
        }
    $this->newModal = false;
    $this->name='';
    $this->itemIdToDelete ='';
    $this->newHex='';
    $this->code='';
    }
}
