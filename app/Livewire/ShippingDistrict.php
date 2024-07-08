<?php

namespace App\Livewire;

use App\Models\Shipping;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Url;
use Illuminate\Validation\Rule;
class ShippingDistrict extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $perPage='5'; public $showModal = false; public  $itemId=''; public $name=''; public $description=''; public $price=''; public $logo;
    public $showModal2 = false; public $check; public $latitude=null; public $longitude=null;  public $title='';
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
        return view('livewire.shipping-district',[
            'districts' => Shipping::where('state','district')->orderBy($this->sortBy,$this->sortDir)->paginate($this->perPage),
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
        $ship = Shipping::where('state','district')->count();
        if ($id == '') {
            $order = $ship + 1;
        } else {
            $order = Shipping::find($id)->order;
        }
        Shipping::updateOrCreate(['id' => $id], [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'order' => $order,
            'title' => $this->title,
            'state' => 'district',
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);
        $this->showModal= false;
    }
    public function showEditModal($id)
    {
        $this->resetValidation(); $this->clean();
        $this->itemId=$id;
        $shipping = Shipping::find($id);
        if($shipping->latitude){
            $this->check = true;
        }
        $this->name = $shipping->name;
        $this->description = $shipping->description;
        $this->price= $shipping->price;
        $this->title= $shipping->title;
        $this->latitude= $shipping->latitude;
        $this->longitude= $shipping->longitude;
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
                ->where('state','district')
                ->decrement('order');
        } else {

            Shipping::where('order', '>=', $newPosition+1)
                ->where('order', '<', $oldPosition)
                ->where('state','district')
                ->increment('order');
        }
        $itemToMove->order = $newPosition+1;
        $itemToMove->save();
    }
    public function clean()
    {
        $this->reset('name','description','price','itemId','latitude','longitude','title');
        $this->check=false;
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
        $ship->delete();
        Shipping::where('order', '>', $deletedOrder)->decrement('order');
        $this->clean();
    }
    public function location()
    {
        $this->check = !$this->check;
        if($this->check == false)
        {
            $this->latitude = null;
            $this->longitude = null;
        }
    }
    public function updateContent($title){
        $this->title=$title;
    }
}
