<?php

namespace App\Livewire;
use App\Models\Brand;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
class BrandTable extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $showModal = false;public $showModalDelete = false;

    public $condition;
    public $itemIdToDelete;
    public $itemName; public $itemCode;  public $logo; public $description;
    public $perPage = 5;

    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $type = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';
    public $which='';

    public function delete($id)
    {
        if($this->which == 'DELETE'){
            $brand=Brand::find($id);
            Storage::disk('public')->delete($brand->images->url);
            $brand->images()->delete();
            $brand->delete();
            $this->showModalDelete = false;
        }

        elseif ($this->which =='CREATE'){
            $brand=Brand::create([
                'name'=> $this->itemName,
                'slug'=> $this->itemCode,
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
        {
            $brand=Brand::find($id);
            $previousUrl = $brand->images()->value('url');
            $brand->name = $this->itemName;
            $brand->slug = $this->itemCode;
            $brand->description = $this->description;
            $brand->save();
            if ($this->logo) {
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
    public function showDeleteModal($itemId,$itemName,$abc,$description,$slug,$file)
        {
           if(isset($file)){
            $this->dispatch('notify',url: $file);
             }
             if( $abc === 'CREATE') { $this->dispatch('notify2'); }
                $this->logo = $file;
                $this->itemName = $itemName;
                $this->itemIdToDelete = $itemId;
                $this->itemCode = $slug;
                $this->description = $description;
                $this->showModal = true;
                $this->which = $abc;
        }
        public function showDeleteModal2($itemId,$itemName,$abc,$description,$slug,$file)
        {
                $this->logo = $file;
                $this->itemName = $itemName;
                $this->itemIdToDelete = $itemId;
                $this->itemCode = $slug;
                $this->description = $description;
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
}
