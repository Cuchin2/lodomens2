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
    public $sortDir = 'DESC';
    #[Url(history:true)]
    public $sort_status = '';

    public $showModal = false; public $state; public $step = 1; public $state_name = ''; public $id;
    public $showModal2 = false;
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
        $sale = SaleOrder::with('saleDetails')->find($this->id);
        $sale->status = $this->state;
        $sale->save();
        $email= $sale->email;
        if($sale->status == 'PROCESS') {
            $subject = 'Estamos procesando tu pedido N°00'.$sale->id;}
        if($sale->status == 'TRACKING') {
            $subject = '¡Qué emoción: Tu pedido N°00'.$sale->id.' llegará pronto';}
        if($sale->status == 'DONE') {
            $subject = 'Ya entregamos tu pedido N°00'.$sale->id.' ¿Qué te pareció?';}

         // Enviar correo al cliente

         if($sale->status !== 'CANCEL' && $sale->status !== 'PAID')
         {
         $data= [
            'email'=>env('MAIL_FROM_ADDRESS'),
            'status'=>$sale->status,
            'order'=>$sale,
            'name'=>env('APP_NAME'),
            'cartItems'=>$sale->saleDetails,
            'shipping'=>$sale->shipping,
            'last_name'=>$sale->last_name,
            'deliveryOrders'=>$sale->deliveryOrders,
            'subject'=>$subject ?? '',
         ];
        Mail::to($email)->send(new OrderStatusChanged($data));
        }
        $this->showModal = false;
        $this->dispatch('state',state:$sale->convert(),id:$this->id);
        $this->dispatch('spinoff');
        $this->state_name = $sale->convert();
        $this->showModal2 = true;
    }
    public function render()
    {
        return view('livewire.sale-table',[
            'sales' => SaleOrder::search($this->search)
            ->when($this->sort_status !== '', function ($query) {
                $query->where('status', $this->sort_status);
            })
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
    public function setStatus($status)
    {
        $this->sort_status = $status;
    }
    public function clearFilters()
    {
        $this->reset('sort_status','search','sortBy','sortDir','perPage');
        $this->resetPage();   // Opcional: Restablece la paginación a la primera página
    }
}
