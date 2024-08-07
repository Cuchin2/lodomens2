<?php

namespace App\Livewire;

use App\Models\SaleOrder;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Mail\OrderStatusChanged;
use Illuminate\Support\Facades\Mail;
class SaleTable extends Component
{
    use WithPagination;
    #[Url()]
    public $perPage = 10;

    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $name = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC'; public $showModal = false; public $state; public $step = 1; public $state_name = ''; public $id;
    public function updateSearch(){
        $this->resetPage();
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
    public function status($state,$id,$step,$name){
        $this->showModal = true;
        $this->step = $step;
        $this->state_name = $name;
        $this->id=$id;
        $this->state= $state;
    }
    public function update_state(){
        $sale = SaleOrder::find($this->id);
        $sale->status = $this->state;
        $sale->save();
        $email= $sale->email;
         // Enviar correo al cliente
         $data= [
            'email'=>'contacto@lodomens.com',
            'status'=>$sale->status,
            'order'=>$this->id,
            'name_client'=>$sale->name,
            'name'=>'Lodomens',
            'last_name'=>$sale->last_name,
            'subject'=>'Cambio de estado de compra'
         ];
        Mail::to($email)->send(new OrderStatusChanged($data));
        $this->showModal = false;
        $this->dispatch('state',state:$sale->convert(),id:$this->id);
    }
    public function render()
    {
        return view('livewire.sale-table',[
            'sales' => SaleOrder::search($this->search)
/*             ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            }) */
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
    public function reloadd()
    {
        $this->showModal=false;
    }
    public function page($page)
    {
        $this->perPage = $page;
    }
}
