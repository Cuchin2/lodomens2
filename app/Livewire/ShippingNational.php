<?php

namespace App\Livewire;

use App\Models\Shipping;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Url;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
class ShippingNational extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $perPage='5'; public $showModal = false; public  $itemId=''; public $name=''; public $description=''; public $price=''; public $logo;
    public $showModal2 = false; public $check;  public $title='';
    #[Url(history:true)]
    public $sortBy = 'order';

    #[Url(history:true)]
    public $sortDir = 'ASC';
    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'price' => [
                'required',
                ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'price.required' => 'El precio es requerido.',
        ];
    }
    public function render()
    {
        return view('livewire.shipping-national',[
            'districts' => Shipping::where('state','nacional')->orderBy($this->sortBy,$this->sortDir)->paginate($this->perPage),
        ]);
    }
    public function new()
    {
        $this->resetValidation();
        $this->clean();
        $this->showModal = true;
    }
    public function createOrUpdate($id){
        $this->validate();
        $ship = Shipping::where('state','nacional')->count();
        $shipping = Shipping::where('state','nacional')->find($id);
        if ($id == '') {
            $order = $ship + 1;
            $previousUrl = null;
        } else {
            $order = $shipping->order;
            $previousUrl = $shipping->url;
        }
        if (is_object($this->logo) && $previousUrl) {
            $fileName = time() . '-' . $this->logo->getClientOriginalName();
            $url_name = 'image/lodomens/' . $fileName;
            $shipping->update([
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
            $this->logo->storeAs('image/lodomens/', $fileName, 'public');
        }

        if($previousUrl && $this->logo ==null)
        {
            Storage::disk('public')->delete($previousUrl);
            $shipping->url = null; $shipping->save();
        }
        Shipping::updateOrCreate(['id' => $id], [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'order' => $order,
            'url' => $url_name ?? null,
            'title' => $this->title,
            'state' => 'nacional',
        ]);
        $this->showModal= false;
        $this->logo= null;
    }
    public function showEditModal($id)
    {   $shipping = Shipping::find($id);
        if(isset($shipping->url)){
            $file= asset('storage/'. $shipping->url);
        } else $file = null;

        $this->resetValidation(); $this->clean(); $this->dispatch('notify2');
        if(isset($file)){
            $this->dispatch('notify',url: $file,filename:basename(parse_url($file, PHP_URL_PATH)) );
             }
        $this->itemId=$id;
        $this->logo=$shipping->url;
        $this->name = $shipping->name;
        $this->description = $shipping->description;
        $this->price= $shipping->price;
        $this->title= $shipping->title;
        $this->showModal= true;
        $this->dispatch('open-modal');
    }
    public function sort($item,$newPosition)
    {

        $itemToMove = Shipping::find($item);
        $oldPosition = $itemToMove->order;

        if ($oldPosition < $newPosition+1) {

            Shipping::where('order', '>', $oldPosition)
                ->where('order', '<=', $newPosition+1)
                ->where('state','nacional')
                ->decrement('order');
        } else {

            Shipping::where('order', '>=', $newPosition+1)
                ->where('order', '<', $oldPosition)
                ->where('state','nacional')
                ->increment('order');
        }
        $itemToMove->order = $newPosition+1;
        $itemToMove->save();
    }
    public function clean()
    {
        $this->reset('name','description','price','itemId','title');
    }
    public function showDelete($id)
    {
        $this->itemId = $id;
        $ship = Shipping::find($id);
        $this->name= $ship->name;
        $this->showModal2= true;
    }
    public function erease($id)
    {
        $this->showModal2= false;
        $ship = Shipping::find($id);
        $deletedOrder = $ship->order;
        if(isset($ship->url)){
            Storage::disk('public')->delete($ship->url);
        }
        $ship->delete();
        Shipping::where('order', '>', $deletedOrder)->decrement('order');
        $this->clean();
    }

    public function updateContent($title){
        $this->title=$title;
    }
    public function deletelogo(){
        $this->logo = null;
    }
}