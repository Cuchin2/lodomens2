<?php

namespace App\Livewire;

use App\Models\SaleDashOrder;
use App\Models\SaleDashDetail;
use App\Models\SaleNotes;
use App\Models\Sku;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Http;
class ShopSaleTable extends Component
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
    public $showModal = false; public $state; public $step = 1; public $state_name = ''; public $id;
    public $showModal2 = false;  public $sort_status = ''; public $salesperson='';  public $id_dashorder=''; public $salesperson_id='';
    public $showModal3 = false;  public $name_note =''; public $description_note=''; public $id_note=''; public $user_id_note=''; public $salesperson_ab= false;
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
        $order = SaleDashOrder::find($this->id);
        $order->status = $this->state;
        $order->save();
        $this->dispatch('spinoff');
        $this->dispatch('state',state:$this->state,id:$this->id);
        $this->showModal = false;
        $this->cancelOrder();
    }
    public function cancelOrder()
    {
        $orderDetails = SaleDashDetail::where('order_dash_id', $this->id)->get();

        foreach ($orderDetails as $detail) {
            $sku = Sku::where('code', $detail->sku)->first();

            if ($sku) {
                $sku->increment('stock', $detail->qtn);
            }
        }
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
    public function SendNote($name,$id,$salesperson_id){
        $this->id_dashorder=$id;
        $this->reset('salesperson','name_note','description_note','user_id_note','id_note','salesperson_id');

        $note = SaleNotes::where('dashorder_id',$id)->first() ?? false;
        if($note) {
        $this->id_note=$note->id;
        $this->user_id_note=$note->user_id;
        $this->name_note = $note->name;
        $this->description_note= $note->description; }
        $this->showModal3 = true;
        $this->salesperson = $name;
        $this->salesperson_id=$salesperson_id;
        $this->salesperson_ab=$salesperson_id == auth()->user()->id ? false : true;

    }
    public function updateNote(){
        SaleNotes::updateOrCreate(
            ['id' => $this->id_note], // Condiciones de búsqueda: busca un producto con el id especificado
            [
                'name' => $this->name_note,
                'description' => $this->description_note,
                'dashorder_id' =>$this->id_dashorder,
                'user_id' => auth()->user()->id
            ] // Valores a actualizar o crear
        );
        $this->showModal3 = false;
    }
    public function clearFilters()
    {
        $this->reset('sort_status','search','sortBy','sortDir','perPage');
        $this->resetPage();   // Opcional: Restablece la paginación a la primera página
    }
    public function render()
    {
/*         return view('livewire.shop-sale-table',[
            'sales' => SaleDashOrder::search($this->search)
            ->when($this->sort_status !== '', function ($query) {
                $query->where('status', $this->sort_status);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]); */
    $response = Http::get('https://gamarra.lodomens.com/api/sales', [
        'search' => $this->search,
        'status' => $this->sort_status,
        'sortBy' => $this->sortBy,
        'sortDir' => $this->sortDir,
        'perPage' => $this->perPage,
    ]);

    $sales = $response->json();

    return view('livewire.sale-dash-table',[
        'sales' => collect($sales['data']),
        'links' => $sales['links'] ?? null
    ]);
    }
}
