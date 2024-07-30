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

    protected $rules = [
        'name' => 'required|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'second_name' => 'nullable|string|max:255',
        'doc_type' => 'nullable|string|max:255',
        'dni' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
    ];
    protected $messages = [
        'name.required' => 'El Nombre es obligatorio.',
    ];
    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->last_name = $user->last_name ?? null;
        $this->second_name = $user->profile->last_name ?? null;
        $this->doc_type = $user->profile->document_type ?? '';
        $this->dni = $user->profile->dni ?? null;
        $this->phone = $user->profile->phone ?? null;
    }

    public function render()
    {
        return view('livewire.personal-data');
    }

    public function submit()
    {
        $this->validate();

        $user = auth()->user();
        $user->update([
            'name' => $this->name,
            'last_name' => $this->last_name,
        ]);

        $user->profile->update([
            'last_name' => $this->second_name,
            'phone' => $this->phone,
            'dni' => $this->dni,
            'document_type' => $this->doc_type == '' ? null : $this->doc_type,
        ]);

        $this->dispatch('name', ['name' => $this->name . ' ' . $this->last_name]);
        $this->dispatch('alt');

        session()->flash('message', 'Los datos personales se han actualizado correctamente.');
    }
}
