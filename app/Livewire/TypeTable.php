<?php

namespace App\Livewire;
use App\Models\Type;
use App\Models\Sku;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
class TypeTable extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $showModal = false; public $showModalDelete = false;

    public $condition;  public $brand=''; public $active = 1;
    public $itemIdToDelete;
    public $name; public $color;
    public $slug;
    public $logo; public $description;
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
                Rule::unique('brands')->ignore($this->brand),
            ],
            'color' => [
                'required',
                ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'color.required' => 'El color es requerido.',
        ];
    }
    public function delete($id)
    {
        $this->brand=Type::find($id);
        if($this->which == 'DELETE'){
            $brand=Type::find($id);
            if(isset($brand->images->url)){
            Storage::disk('public')->delete($brand->images->url);
            $brand->images()->delete();
            }
            $brand->delete();
            $this->showModalDelete = false;
        }

        elseif ($this->which =='CREATE'){
            $this->validate();
            $brand=Type::create([
                'name'=> $this->name,
                'slug'=> $this->slug,
                'hex'=> $this->color,
                'description'=>$this->description,
                ]);
                if ($this->logo) {
                $fileName= time().'-'. $this->logo->getClientOriginalName();
                $url_name='image/lodomens/'.$fileName;
                $brand->images()->create([
                'url' => $url_name,
                'imageable_type'=>'App\Models\Type',
                'imageable_id'=>$brand->id
            ]);
                $this->logo->storeAs('image/lodomens/', $fileName, 'public');

            }
        }
        else
        {   $this->validate();
            $brand=Type::find($id);
            $previousUrl = $brand->images()->value('url');
            $brand->name = $this->name;
            $brand->slug = $this->slug;
            $brand->hex = $this->color;
            $brand->description = $this->description;
            $brand->save();
            $skus = Sku::where('brand_id',$brand->id)->get();
            $skus->each(function ($sku) {
                $sku->code = substr_replace($sku->code, substr($this->slug, 0, 2), 0, 2);
                $sku->save();
            });
            if (is_object($this->logo) && $previousUrl) {
                $fileName = time() . '-' . $this->logo->getClientOriginalName();
                $url_name = 'image/lodomens/' . $fileName;
                $brand->images()->update([
                    'url' => $url_name,
                ]);
                if ($previousUrl && Storage::disk('public')->exists($previousUrl)) {
                    Storage::disk('public')->delete($previousUrl);
                }
                $this->logo->storeAs('image/lodomens/', $fileName, 'public');
            }
            else {
                if (is_object($this->logo)) {
                    $fileName= time().'-'. $this->logo->getClientOriginalName();
                    $url_name='image/lodomens/'.$fileName;
                    $brand->images()->create([
                    'url' => $url_name,
                    'imageable_type'=>'App\Models\Color',
                    'imageable_id'=>$brand->id
                ]);
                    $this->logo->storeAs('image/lodomens/', $fileName, 'public');
                }
                else{
                    if($previousUrl) {
                        Storage::disk('public')->delete($previousUrl);
                        $brand->images()->delete();
                    }
                }
            }
        }
        $this->showModal = false;
        $this->logo= null;
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
    public function showDeleteModal($itemId,$name,$abc,$description,$slug,$file,$color)
        { $this->resetValidation();
           if(isset($file)){
            $this->dispatch('notify',url: $file,filename:basename(parse_url($file, PHP_URL_PATH)) );
             }
             if( $abc === 'CREATE') { $this->dispatch('notify2'); }
                $this->logo = $file;
                $this->name = $name;
                $this->color = $color;
                $this->itemIdToDelete = $itemId;
                $this->slug = $slug;
                $this->description = $description;
                $this->showModal = true;
                $this->which = $abc;
        }
        public function showDeleteModal2($itemId,$name,$abc,$description,$slug,$file,$color)
        {       $this->resetValidation();
                $this->logo = $file;
                $this->name = $name;
                $this->color = $color;
                $this->itemIdToDelete = $itemId;
                $this->slug = $slug;
                $this->description = $description;
                $this->showModalDelete = true;
                $this->which = $abc;
        }
    public function render()
    {
        return view('livewire.type-table',[
            'brands' =>  Type::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
    public function codeComplete() {
        $this->slug = strtoupper($this->slug);
    }
    public function change($id){
        $type = Type::find($id);
        $type->is_default= 1;
        $type->save();
        Type::where('id', '!=', $id)->update(['is_default' => 0]);
    }
    public function deletelogo(){
        $this->logo = null;
    }
    public function page($page)
    {
        $this->perPage = $page;
    }
    public function updated($propertyName)
    {
        if ($propertyName === 'logo') {
            $this->dispatch('logo');
        }
    }
    public function revealButton()
    {
        $this->dispatch('revealbutton');
    }
}
