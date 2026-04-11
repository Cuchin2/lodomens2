<?php

namespace App\Livewire;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;

class SizeTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $showModal = false;
    public $which = ''; // 'CREATE', 'EDIT', 'DELETE'
    public $itemIdToDelete;
    public $name = '';
    public $type = '';
    public $sizeId;

    protected $rules = [
        'name' => 'required|string|max:50',
        'type' => 'nullable|string|max:30',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function showDeleteModal($id, $name, $action, $type = '')
    {
        $this->itemIdToDelete = $id;
        $this->name = $name;
        $this->type = $type;
        $this->which = $action;
        $this->sizeId = $id;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'type' => $this->type,
            'brand_id' => auth()->user()->brand_id,
        ];

        if ($this->which === 'CREATE') {
            Size::create($data);
            session()->flash('message', 'Talla creada correctamente.');
        } elseif ($this->which === 'EDIT') {
            $size = Size::findOrFail($this->sizeId);
            $size->update($data);
            session()->flash('message', 'Talla actualizada correctamente.');
        }

        $this->reset(['showModal', 'which', 'name', 'type', 'sizeId', 'itemIdToDelete']);
    }

    public function delete($id)
    {
        if ($this->which === 'DELETE') {
            Size::destroy($id);
            session()->flash('message', 'Talla eliminada correctamente.');
            $this->reset(['showModal', 'which', 'name', 'type', 'itemIdToDelete']);
        }
    }

    public function render()
    {
        $sizes = Size::query()
            ->when(auth()->user()->brand_id, function ($query) {
                $query->where(function ($q) {
                    $q->where('brand_id', auth()->user()->brand_id)
                      ->orWhereNull('brand_id');
                });
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('type', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.size-table', [
            'sizes' => $sizes,
        ]);
    }
    public function page($page)
    {
        $this->perPage = $page;
    }
}
