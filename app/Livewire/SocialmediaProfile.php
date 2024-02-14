<?php

namespace App\Livewire;

use Livewire\Component;

class SocialmediaProfile extends Component
{
    public $redes;
    public $socials=['youtube','facebook','tiktok','instagram','twitter','spotify','pinterest','flikr'];
    public $newsocials=[];
    public function mount(){

        if (!empty($this->redes)) {
            $this->newsocials = $this->redes->map(function ($red) {
                return [
                    'name' => $red->name,
                    'url' => $red->url,
                ];
            })->toArray();
        }
        $existingSocialNames = collect($this->newsocials)->pluck('name')->all();
        $this->socials = array_diff($this->socials, $existingSocialNames);


    }
    public function add($a)
    {
    $this->socials = array_values(array_filter($this->socials, function ($item) use ($a) {
            return $item !== $a;
        }));
        $this->newsocials[] = [
            'name' => $a,
            'url' => '',
        ];
    }
    public function delete($a)
    {
        $this->newsocials = array_values(array_filter($this->newsocials, function ($item) use ($a) {
            return $item['name'] !== $a;
        }));
        $this->socials[] = $a;
    }
    public function render()
    {
        return view('livewire.socialmedia-profile');
    }
}
