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
    public $showModal = false; public $state; public $step = 1; public $state_name = ''; public $id; public $page = 1;
    public $showModal2 = false;  public $sort_status = ''; public $salesperson='';  public $id_dashorder=''; public $salesperson_id='';
    public $showModal3 = false;  public $name_note =''; public $description_note=''; public $id_note=''; public $user_id_note=''; public $salesperson_ab= false;

    public function mount()
    {
        $this->page = 1; // ✅ Aseguramos que siempre inicie en la página 1
    }
    public function updateSearch(){
        $this->resetPage();
    }
     public function setPagina($page)
    {
        if ($page) {
            $this->page = (int) $page;
        }
    }
        private function extractPage($url)
    {
        if ($url) {
            $parsedUrl = parse_url($url);
            parse_str($parsedUrl['query'] ?? '', $query);
            return $query['page'] ?? 1;
        }
        return 1;
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
    public function holabb($page)
    {
        $this->perPage = $page;
    }
    public function setStatus($status)
    {
        $this->sort_status = $status;
    }
    public function SendNote($name,$descripcion,$salesperson_name){

        $this->reset('salesperson','name_note','description_note','user_id_note','id_note','salesperson_id');

        if($name) {

        $this->name_note = $name;
        $this->description_note= $descripcion; }
        $this->showModal3 = true;
      $this->salesperson = $salesperson_name; /*
        $this->salesperson_id=$salesperson_id;
        $this->salesperson_ab=$salesperson_id == auth()->user()->id ? false : true; */

    }
    public function clearFilters()
    {
        $this->reset('sort_status','search','sortBy','sortDir','perPage');
        $this->resetPage();   // Opcional: Restablece la paginación a la primera página
    }
public function render()
{
    $response = Http::get('http://127.0.0.1:8000/api/stores/sales', [
        'search' => $this->search,
        'status' => $this->sort_status,
        'sortBy' => $this->sortBy,
        'sortDir' => $this->sortDir,
        'perPage' => $this->perPage,
        'page' => $this->page,
    ]);

    if ($response->successful()) {
        $sales = $response->json();
        $salesData = collect($sales['data'] ?? []);
        $links = collect($sales['links'] ?? []);
    } else {
        $salesData = collect();
        $links = collect();
    }

    return view('livewire.shop-sale-table', [
        'sales' => $salesData,
        'links' => $links,
    ]);
}





}
