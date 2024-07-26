<?php

namespace App\Livewire\Forms;

use App\Models\Contact;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{

    public $name= [];
    public $description = [];
    public $icon = [];
}
