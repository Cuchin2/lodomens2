<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AccountDashboard extends Component
{
    public $password; public $newPassword; public $renewPassword; public $user;

    public function mount()
    {
        $this->user=auth()->user();
    }
    public function render()
    {
        return view('livewire.account-dashboard',[
            'user'=>auth()->user(),
        ]);
    }
    public function save()
    {   dd(Hash::make($this->password));
        if($this->user->password == Hash::make($this->password))
        {
            dd('contraseñas iguales');
        }
        else
        {
            dd('contraseñas diferentes');
        }
        /* dd(Hash::make($this->password)); */
        /* dd($this->user->password); */
    }
}
