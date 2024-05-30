<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Address;
use Illuminate\Http\Request;
class CheckoutModal extends Component
{
    public $showModal= false; public $id; public $select; public $cual;
    public $name; public $description; public $reference;
    public function render()
    {
        return view('livewire.checkout-modal');
    }
    #[On('modal')]
    public function modal(Request $request)
    {  
        $this->showModal=true;
        $this->select = $request->input('components.0.calls.0.params.1.select');
        $this->cual =  $request->input('components.0.calls.0.params.1.cual');
    }
    public function hola(){ 
        if($this->select == 'SELECT')
        {
        $address = Address::find($this->id);
/*         Address::where('id', '!=', $this->id)->where('user_id',auth()->user()->id)->update(['current' => false]);
        $address->current = true;
        $address->save(); */
        $this->showModal=false;
        if($this->cual == 1) {
        $this->dispatch('cambiazo',description:$address->description, reference:$address->reference, name:$address->name);}
        else{
            $this->dispatch('cambiazo2',description:$address->description, reference:$address->reference, name:$address->name);
        }
        }
        else {
            Address::create([
                'name'=> $this->name,
                'description'=> $this->description,
                'reference'=> $this->reference,
                'user_id'=> auth()->user()->id,
            ]);
        } 
        $this->reset('name','description','reference');
        $this->select='SELECT';   
    }
        public function reloadd(){
            $this->dispatch('ad');
    }
    public function cambio($id){
        $this->id=$id;
        
    }
    public function type($a){
        $this->select = $a;
    }

}
