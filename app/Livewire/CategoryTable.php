<?php

namespace App\Livewire;
use App\Models\Category;
use App\Models\Sku;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Validation\Rule;
class CategoryTable extends Component
{
    use WithPagination;
    public $showModal = false;
    public $itemIdToDelete; public $category= '';
    public $name;
    public $code;
    public $perPage = 10;

    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $type = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';
    public $which='';
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->category),
            ],
            'code' => [
                'size:2',
                'required',
                Rule::unique('categories')->ignore($this->category),
                ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'code.size' => 'Se Requiere 2 dígitos.',
            'code.unique' => 'El campo código ya fue registrado'
        ];
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {   $this->category= Category::find($id);
        $category=Category::find($id);
        if($this->which == 'DELETE')
        $category->delete();
        else
        {   $this->validate();
            $category->name = $this->name;
            $category->code = $this->code;
            $category->description = $this->which;
            $category->save();
            $skus = Sku::where('category_id',$category->id)->get();
            $skus->each(function ($sku) {
                $codeDigits = substr($this->code, 0, 2);
                $sku->code = substr_replace($sku->code, $codeDigits, 2, 2);
                $sku->save();
            });
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
    public function showDeleteModal($itemId,$name,$abc,$code)
        {   $this->resetValidation();
            $this->name = $name;
            $this->itemIdToDelete = $itemId;
            $this->code=$code;
            $this->showModal = true;
            $this->which = $abc;
        }

    public function render()
    {
        return view('livewire.category-table',[
            'categories' =>  Category::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
    public function codeComplete() {
        $this->code = strtoupper($this->code);
    }
    public function reloadd(){
        $this->showModal = false;
    }
    public function page($page)
    {
        $this->perPage = $page;
    }
}
