<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
class PersonalData extends Component
{
    public $name;
    public $doc_type;
    public $dni;
    public $phone;
    public $last_name;
    public $second_name;
    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->last_name = $user->last_name ?? '';
        $this->second_name = $user->profile->last_name ?? '';
        $this->doc_type = $user->profile->document_type ?? '';
        $this->dni= $user->profile->dni ?? '';
        $this->phone= $user->profile->phone ?? '';
    }
    public function render()
    {
        return view('livewire.personal-data');
    }
    public function salvar(){
        $user = auth()->user();
        $user->name=$this->name;
        $user->last_name = $this->last_name;
        $user->save();
        $this->dispatch('name',name:$this->name.' '.$this->last_name);

        $user->profile->update(['last_name' => $this->second_name]);
        $user->profile->update(['phone' => $this->phone]);
        $user->profile->update(['dni' => $this->dni]);
        $user->profile->update(['document_type' => $this->doc_type]);
    }
    public function submit()
    {
        /* $this->validate(); */
        $user = auth()->user();
        $user->name=$this->name;
        $user->last_name = $this->last_name;
        $user->save();
        $this->dispatch('name',name:$this->name.' '.$this->last_name);

        $user->profile->update(['last_name' => $this->second_name]);
        $user->profile->update(['phone' => $this->phone]);
        $user->profile->update(['dni' => $this->dni]);
        $user->profile->update(['document_type' => $this->doc_type]);
        $this->dispatch('alt');
        session()->flash('message', 'Los datos personales se han actualizado correctamente.');


    }
}
