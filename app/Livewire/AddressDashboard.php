<?php

namespace App\Livewire;

use App\Models\Address;
use Livewire\Component;

class AddressDashboard extends Component
{
    public $showModal = false; public $choise='';
    public $name; public $address_id; public $check;
    public $description; public $address;
    public $reference;

    public function render()
    {
        return view('livewire.address-dashboard');
    }
    public function modal($a,$b,$id)
    {   $this->choise = $a;
        $this->name = $b;
        $this->showModal = true;
        $this->address_id=$id;
        if($a == 'EDIT'){
            $address = Address::find($id);
            $this->description= $address->description;
            $this->reference = $address->reference;
        }
        else{
            $this->reset('description','reference');
        }
    }
    public function send(){

        if($this->choise == 'DELETE') {
            $address= Address::find($this->address_id);
            $address->delete();
            $this->reloadd();
        }

        if($this->choise == 'CREATE')
            {
                Address::create([
                    'name' => $this->name,
                     'description' => $this->description,
                     'reference' => $this->reference,
                     'user_id' => auth()->user()->id,
                 ]);  $this->redirectRoute('web.shop.webdashboard.address',navigate:true);
            }
            if($this->choise == 'EDIT')
            {
                $address = Address::find($this->address_id);
                $address->name= $this->name;
                $address->description = $this->description;
                $address->reference= $this->reference;
                $address->save();
            }
            $this->redirectRoute('web.shop.webdashboard.address',navigate:true);
            /*         $this->reloadd();
                    $this->reset(); */
    }
    public function hola($id){
        $address = Address::find($id);
        Address::where('id', '!=', $id)->where('user_id',auth()->user()->id)->update(['current' => false]);
        $address->current = true;
        $address->save();
    }
        public function reloadd(){
            $this->dispatch('ad');
    }

}
