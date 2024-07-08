<?php

namespace App\Livewire;
use App\Models\Brand;
use App\Models\Sku;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
class BrandTable extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $showModal = false; public $showModalDelete = false;

    public $condition;  public $brand='';
    public $itemIdToDelete;
    public $name;
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
            'slug' => [
                'size:2',
                'required',
                Rule::unique('brands')->ignore($this->brand),
                ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'slug.size' => 'Se Requiere 2 dígitos.',
            'slug.unique' => 'El campo código ya fue registrado'
        ];
    }
    public function deleted($id)
    {
        $this->brand=Brand::find($id);
        if($this->which == 'DELETE'){
            $brand=Brand::find($id);
            if(isset($brand->images->url)){
            Storage::disk('public')->delete($brand->images->url);
            $brand->images()->delete();
            }
            $brand->delete();
            $this->showModalDelete = false;
        }

        elseif ($this->which =='CREATE'){
            $this->validate();
            $brand=Brand::create([
                'name'=> $this->name,
                'slug'=> $this->slug,
                'description'=>$this->description,
                ]);
                if ($this->logo) {
                $fileName= time().'-'. $this->logo->getClientOriginalName();
                $url_name='image/lodomens/'.$fileName;
                $brand->images()->create([
                'url' => $url_name,
                'imageable_type'=>'App\Models\Brand',
                'imageable_id'=>$brand->id
            ]);
                $this->logo->storeAs('image/lodomens/', $fileName, 'public');

            }
        }
        else
        {   $this->validate();
            $brand=Brand::find($id);
            $previousUrl = $brand->images()->value('url');
            $brand->name = $this->name;
            $brand->slug = $this->slug;
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

                if($previousUrl && $this->logo ==null)
                {
                    Storage::disk('public')->delete($previousUrl);
                    $brand->images()->delete();
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
    public function showDeleteModal($itemId,$name,$abc,$description,$slug,$file)
        { $this->resetValidation(); $this->dispatch('notify2');
           if(isset($file)){
            $this->dispatch('notify',url: $file,filename:basename(parse_url($file, PHP_URL_PATH)) );
             }
                $this->logo = $file;
                $this->name = $name;
                $this->itemIdToDelete = $itemId;
                $this->slug = $slug;
                $this->description = Brand::find($itemId)->description ?? '';
                $this->showModal = true;
                $this->which = $abc;
        }
        public function showDeleteModal2($itemId,$name,$abc,$description,$slug,$file)
        {       $this->resetValidation();
                $this->logo = $file;
                $this->name = $name;
                $this->itemIdToDelete = $itemId;
                $this->slug = $slug;
                $this->description = Brand::find($itemId)->description ?? '';
                $this->showModalDelete = true;
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
    public function codeComplete() {
        $this->slug = strtoupper($this->slug);
    }
    public function delete(Brand $brand)
    {
        $brand->delete();
        $this->showModal = false;
    }
    public function deletelogo(){
        $this->logo = null;
    }
    public function page($page)
    {
        $this->perPage = $page;
    }
}
