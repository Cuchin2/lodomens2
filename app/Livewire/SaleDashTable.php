<?php

namespace App\Livewire;

use App\Models\SaleDashOrder;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
class SaleDashTable extends Component
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
    public $showModal2 = false;  public $sort_status = '';
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
    public function render()
    {
        return view('livewire.sale-dash-table',[
            'sales' => SaleDashOrder::search($this->search)
            ->when($this->sort_status !== '', function ($query) {
                $query->where('status', $this->sort_status);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
}
