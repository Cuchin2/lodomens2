<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Material;
use App\Models\Type;

class ShopMain extends Component
{
    use WithPagination;

    // Filtros
    public $rating = '';
    public $cat = ''; public $bra = ''; public $gam = '';
    public $cat_id = '';
    public $type_id = '';
    public $material_id = '';
    public $brand_id = '';
    public $gam_id = '';

    public $type_name = '';
    public $material_name = '';

    public $perPage = 16;
    public $new = '';                 // 'created_at' si "Productos nuevos"
    public $selectedPrice = '';       // 'asc' | 'desc'
    public $selectedOption = '';      // solo para el <select> (visual)
    public $page = 1;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    /** Claves que persistimos en sesión */
    protected array $persistable = [
        'rating','cat_id','brand_id','search','sortBy','sortDir',
        'type_id','material_id','gam_id','selectedPrice','new'
    ];

    public function mount()
    {
        // Restaurar valores desde sesión
        foreach ($this->persistable as $prop) {
            $this->$prop = session("shop.$prop", $this->$prop);
        }
        $this->hydrateDerivedLabels();
    }

    /** Calcula nombres/labels a partir de los IDs (no se guardan en sesión) */
    protected function hydrateDerivedLabels(): void
    {
        $this->cat           = $this->cat_id       ? (Category::whereKey($this->cat_id)->value('name') ?? '') : '';
        $this->bra           = $this->brand_id     ? (Brand::whereKey($this->brand_id)->value('name') ?? '') : '';
        $this->type_name     = $this->type_id      ? (Type::whereKey($this->type_id)->value('name') ?? '') : '';
        $this->material_name = $this->material_id  ? (Material::whereKey($this->material_id)->value('name') ?? '') : '';
        $this->gam           = $this->gam_id       ? (Color::whereKey($this->gam_id)->value('name') ?? '') : '';
    }

    /** Persistimos en sesión automáticamente en cada request */
    public function dehydrate()
    {
        foreach ($this->persistable as $prop) {
            session()->put("shop.$prop", $this->$prop);
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getProductsProperty()
    {
        return Product::search($this->search)
            ->where('status', 'SHOP')
            ->when($this->rating, fn($q) => $q->where('rating', $this->rating))
            ->when($this->cat_id, fn($q) => $q->where('category_id', $this->cat_id))
            ->when($this->brand_id, fn($q) => $q->where('brand_id', $this->brand_id))
            ->when($this->type_id, fn($q) => $q->where('type_id', $this->type_id))
            ->when($this->material_id, fn($q) => $q->where('material_id', $this->material_id))
            ->when($this->gam_id !== '', fn($q) =>
                $q->whereHas('colors', fn($cq) => $cq->where('color_id', $this->gam_id))
            )
            ->when($this->selectedPrice !== '', fn($q) => $q->orderBy('sell_price', $this->selectedPrice))
            ->when($this->new, fn($q) => $q->orderBy($this->new, 'desc'))
            ->with('type.images')
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);
    }

    public function render()
    {
        /* dump(session('shop')); */

        return view('livewire.shop-main', [
            'gamas'      => Color::with('images')->get(),
            'products'   => $this->products,
            'categories' => Category::all(),
            'brands'     => Brand::all(),
            'types'      => Type::all(),
            'materials'  => Material::all(),
        ]);
    }

    /** Acciones de filtros */
    public function clean()
    {
        // Reset props
        $this->reset(
            'rating','cat','cat_id','bra','brand_id','gam','gam_id',
            'type_id','type_name','material_id','material_name',
            'selectedPrice','new'
        );

        // Limpiar sesión de todos los filtros persistidos
        session()->forget(array_map(fn($p) => "shop.$p", $this->persistable));

        $this->resetPage();

        // Si usabas Alpine/localStorage, emite evento para limpiar frontend (opcional)
        $this->dispatch('clear-filters');
    }

    public function rate($star)              { $this->rating = $star; $this->resetPage(); }
    public function categorized($name,$id)   { $this->cat = $name; $this->cat_id = $id; $this->resetPage(); }
    public function brandized($name,$id)     { $this->bra = $name; $this->brand_id = $id; $this->resetPage(); }
    public function colorized($name,$id)     { $this->gam = $name; $this->gam_id = $id; $this->resetPage(); }
    public function typerized($name,$id)     { $this->type_name = $name; $this->type_id = $id; $this->resetPage(); }
    public function materialized($name,$id)  { $this->material_name = $name; $this->material_id = $id; $this->resetPage(); }

    #[On('option-selected')]
    public function abc($value)
    {
        if ($value === 'new') {
            $this->new = 'created_at';
            $this->selectedPrice = '';
        } else {
            $this->new = '';
            $this->selectedPrice = $value; // 'asc' | 'desc'
        }
    }
}
