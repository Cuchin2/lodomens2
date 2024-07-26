<?php

namespace App\Livewire;
use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
class ContactApp extends Component
{
    public ContactForm $form; public $name = ''; public $id = '';
    public $elements = []; public $condition = true; public $showModal=false;
    public $icons = [
        'mail' => 'Correo',
        'planet' => 'Planeta',
        'address' =>  'Dirección',
        'info' => 'información',
        'phone_whatsapp'=>'WhatsApp',
        'phone'=>'Teléfono',
        'camera'=>'Cámara',
        'calendar'=>'Calendario'
    ];
    public function render()
    {
        $contacts= Contact::orderBy('order','asc')->get();

        if ($contacts->isNotEmpty()) {
            foreach ($contacts as $key => $contact) {
                $this->form->name[$key] = $contact->name;
                $this->form->description[$key] = $contact->description;
                $this->form->icon[$key] = $contact->icon;
            }
        }
        return view('livewire.contact-app',[
            'contacts'=>$contacts,
        ]);
    }
    public function updateForm($id,$key){
        $messages = [
            'form.description.'.$key.'.required' => 'El campo de descripción es obligatorio.',
            'form.description.'.$key.'.max' => 'El campo de descripción  no puede tener más de 255 caracteres.',
            'form.name.'.$key.'.required' => 'El campo de nombre es obligatorio.',
            'form.name.'.$key.'.max' => 'El campo de nombre  no puede tener más de 255 caracteres.',
            'form.icon.'.$key.'.required' =>'El campo de icono es obligatorio.',
        ];
        $this->validate([
            'form.name.'.$key => 'required|max:255',
            'form.description.'.$key => 'required|max:255',
            'form.icon.'.$key => 'required',
        ],$messages);

        Contact::updateOrCreate(['id' => $id],
        [
            'name' => $this->form->name[$key],
            'description' =>  $this->form->description[$key],
            'icon' =>  $this->form->icon[$key]
        ]);
        $this->dispatch('success');
    }

    public function addElement()
    {
        $newElement = ['id' => uniqid(),
        'name' => '',
        'description'=>'',
        'icon'=>'',
    ];
        array_push($this->elements, $newElement); $this->condition=false;
    }

    public function createForm($key){
        $messages = [
            'elements.description.'.$key.'.required' => 'El campo de descripción es obligatorio.',
            'elements.description.'.$key.'.max' => 'El campo de descripción  no puede tener más de 255 caracteres.',
            'elements.name.'.$key.'.required' => 'El campo de nombre es obligatorio.',
            'elements.name.'.$key.'.max' => 'El campo de nombre  no puede tener más de 255 caracteres.',
        ];
        $this->validate([
            'elements.name.'.$key => 'required|max:255',
            'elements.description.'.$key => 'required|max:255',
        ],$messages);

        Contact::create(
        [
            'name' =>$this->elements['name'][$key],
            'description' => $this->elements['description'][$key],
            'order'=>Contact::orderBy('order','asc')->count()
        ]);
        $this->elements = [];
        session()->flash('message', 'Se creó satisfactoriamente.');
        $this->condition=true;
        $this->redirectRoute('mypage.contact.index');
    }
    public function sort($item, $newPosition)
    {
        $itemToMove = Contact::find($item);
        $oldPosition = $itemToMove->order;

        // Reordenar los elementos que se encuentran después del elemento que estás moviendo
        if ($oldPosition < $newPosition) {
            // Elemento movido hacia abajo
            Contact::where('order', '>', $oldPosition)
                ->where('order', '<=', $newPosition)
                ->decrement('order');
        } else {
            // Elemento movido hacia arriba
            Contact::where('order', '>=', $newPosition)
                ->where('order', '<', $oldPosition)
                ->increment('order');
        }

        // Actualizar la posición del elemento que estás moviendo
        $itemToMove->order = $newPosition;
        $itemToMove->save();
        $this->redirectRoute('mypage.contact.index');
    }
    public function selection($value,$key)
    {
            $this->form->icon[$key]=$value;

    }
    public function beforeDelete($id,$name)
    {
        $this->name= $name;
        $this->id= $id;
        $this->showModal=true;
    }
    public function afterDelete()
    {
        $contacto = Contact::find($this->id);
        $contacto->delete();
        $this->showModal=false;
        $this->dispatch('success');
    }
}
