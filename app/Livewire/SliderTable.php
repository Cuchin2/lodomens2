<?php

namespace App\Livewire;

use App\Models\Setting;
use App\Models\Slider;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
class SliderTable extends Component
{
    use WithPagination;
    use WithFileUploads;
    #[Url(history:true)]
    public $perPage = "10";
    #[Url(history:true)]
    public $type = '';
    #[Url(history:true)]
    public $sortBy = 'order';

    #[Url(history:true)]
    public $sortDir = 'ASC';
    #[Url(history:true)]
    public $search = '';  public $showModal = false; public $showModalDelete = false; public $logo; public $name;
    public $itemIdToDelete; public $href; public $which; public $order; public $showModalState=false; public $time;
    public $itemName=''; public $status=''; public $status2=''; public $state=''; public $color2=''; public $color1='';
    public function mount(){
        $this->time= Setting::where('name', 'time')->pluck('action')->first();
        $this->time = $this->time/1000;
    }
    public function render()
    {
        return view('livewire.slider-table',[
            'sliders' =>  Slider::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage),

        ]);
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
    public function showDeleteModal($itemId,$name,$abc,$href,$file)
        { $this->resetValidation(); $this->dispatch('notify2');
           if(isset($file)){
            $this->dispatch('notify',url: $file,filename:basename(parse_url($file, PHP_URL_PATH)) );
             }
                $this->logo = $file;
                $this->name = $name;
                $this->itemIdToDelete = $itemId;
                $this->href = $href;
                /* $this->description = Brand::find($itemId)->description ?? ''; */
                $this->showModal = true;
                $this->which = $abc;
        }
        public function deleted($id)
        {
            /* $this->brand=Slider::find($id); */
            if($this->which == 'DELETE'){
                $slider=Slider::find($id);
                if(isset($slider->url)){
                Storage::disk('public')->delete($slider->url);
                $slider->url= null; $slider->save();
                }
                $deletedOrder = $slider->order;
                $slider->delete();
                Slider::where('order', '>', $deletedOrder)->decrement('order');
                $this->showModalDelete = false;
            }

            elseif ($this->which =='CREATE'){
                /* $this->validate(); */

                $slider=Slider::create([
                    'name'=> $this->name,
                    'order'=> Slider::orderBy('order', 'desc')->pluck('order')->first() +1 ?? '0',
                    'link'=> $this->href,
                    ]);
                    if ($this->logo) {
                    $fileName= time().'-'. $this->logo->getClientOriginalName();
                    $url_name='image/lodomens/'.$fileName;
                    $slider->url = $url_name;
                    $slider->save();
                    $this->logo->storeAs('image/lodomens/', $fileName, 'public');
                }
            }
            else
            {   /* $this->validate(); */
                $slider=Slider::find($id);
                $previousUrl = $slider->url;
                $slider->name = $this->name;
                $slider->link = $this->href;
                $slider->save();
                if (is_object($this->logo) && $previousUrl) {
                    $fileName = time() . '-' . $this->logo->getClientOriginalName();
                    $url_name = 'image/lodomens/' . $fileName;
                    $slider->update([
                        'url' => $url_name,
                    ]);
                    if ($previousUrl && Storage::disk('public')->exists($previousUrl)) {
                        Storage::disk('public')->delete($previousUrl);
                    }
                    $this->logo->storeAs('image/lodomens/', $fileName, 'public');
                }

                    if (is_object($this->logo)) {
                        $fileName= time().'-'. $this->logo->getClientOriginalName();
                        $url_name='image/lodomens/'.$fileName;
                        $slider->url = $url_name;
                        $slider->save();
                        $this->logo->storeAs('image/lodomens/', $fileName, 'public');
                    }

                    if($previousUrl && $this->logo ==null)
                    {
                        Storage::disk('public')->delete($previousUrl);
                        $slider->url= null;
                        $slider->save();
                    }


        }
        $this->showModal = false;
        $this->logo= null;
    }
    public function showDeleteModal2($itemId,$name,$abc,$href,$file)
    {       /* $this->resetValidation(); */
            $this->logo = $file;
            $this->name = $name;
            $this->itemIdToDelete = $itemId;
            $this->href = $href;
            $this->showModalDelete = true;
            $this->which = $abc;
    }
    public function page($page)
    {
        $this->perPage = $page;
    }
    public function deletelogo(){
        $this->logo = null;
    }
    public function sort($item,$newPosition)
    {
/*         $old= Slider::where('order',$newPosition+1)->first();
        $new= Slider::find($item); $new_order= $new->order;
        $new->order=$newPosition+1;  $new->save();
        $old->order= $new_order;   $old->save(); */
        $itemToMove = Slider::find($item);
        $oldPosition = $itemToMove->order;

        // Reordenar los elementos que se encuentran después del elemento que estás moviendo
        if ($oldPosition < $newPosition+1) {
            // Elemento movido hacia abajo
            Slider::where('order', '>', $oldPosition)
                ->where('order', '<=', $newPosition+1)
                ->decrement('order');
        } else {
            // Elemento movido hacia arriba
            Slider::where('order', '>=', $newPosition+1)
                ->where('order', '<', $oldPosition)
                ->increment('order');
        }

        // Actualizar la posición del elemento que estás moviendo
        $itemToMove->order = $newPosition+1;
        $itemToMove->save();
    }
    public function estado($state,$id,$status,$color,$name){
        $this->showModalState = true;
        $this->itemName = $name;
        $this->status = $status;
        $this->status2 = $this->traslate($state);
        $this->itemIdToDelete = $id;
        $this->state= $state;
        $this->color2=$color;
        $this->color1=$this->traslateColor($this->status);
    }
    public function traslate($a){
        switch ($a) {
            case 'draft':
                return 'Borrador';
            case 'public':
                return 'Publicado';
            default:
                return 'Programado';
        }
    }
    public function traslateColor($b){
        switch ($b) {
            case 'Borrador':
                return 'amarillo';
            case 'Publicado':
                return 'verde';
            default:
                return 'morado';
        }
    }
    public function updatestate($id){
        $slider=Slider::find($id);
        $slider->state=$this->state;
        $slider->save();
        $this->dispatch('state',state:$this->traslate($this->state),id:$id);
        $this->showModalState = false;
    }
    public function timing(){
        Setting::updateOrCreate(
            ['name' => 'time'], // Condiciones de búsqueda
            ['description' => 'Tiempo de slider',
              'action'=>$this->time*1000,
              'name'=>'time'
            ] // Valores a actualizar o crear
        );
    }
}
