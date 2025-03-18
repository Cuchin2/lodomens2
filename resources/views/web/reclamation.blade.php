@extends('layouts.web')

@section('breadcrumb')
<div class="h-10 bg-gris-90 absolute w-full lg:top-[84px]"></div>
@endsection

@section('content')
@auth()
<div class="xl:w-2/3 lg:w-full  mx-auto lg:px-20 px-4"
x-data="{
    email : '',
    name : '',
    subject :'',
    body : '',
    errors : {},
    sendEmail() {
       try {
           this.errors = [];
           let form = new FormData();
           form.append('fromName', this.name);
           form.append('correo', this.email);
           form.append('subject', this.subject);
           form.append('body', this.body);

           axios.post('{{ route('reclamation.send') }}', form)
               .then(response => {
                   console.log('Cambios guardados exitosamente');
                   this.confirmation();
               })
               .catch(error => {
                           if (error.response.status === 422) {

                       console.error('Error al guardar los cambios:', error.response.data);

                       this.errors = error.response.data.errors;
                       console.log(this.errors.fromName[0]);
                   } else {
                       console.error('Error al guardar los cambios:', error);
                   }
                           });
                   } catch (error) {
                       console.error('Error al guardar los cambios:', error);
                   }
               },
    confirmation (){
       console.log(this.email);
       this.name= '';
       this.email= '';
       this.subject= '';
       this.body= '';
       $dispatch('fire2');
    }
   }">

<div class="flex w-full 2xl:min-h-[374px] lg:min-h-[278px] md:mt-1 mt-[80px]">
    <div class="px-4 md:px-8 py-4 m-4 border rounded-[3px] border-gris-70 mx-auto bg-black w-full">
        <h6 class="text-center mb-8">FORMULARIO DE RECLAMACIONES</h6>
        <div class="mb-1">
        <x-web.input.input-free title="Nombre" x-model="name" span="true"  type="text"/>
            <p1 x-text="errors.fromName[0]" class="text-corp-10"></p1>
        </div>
        <div class="mb-1">
        <x-web.input.input-free title="Correo" x-model="email" span="true" type="email"/>
            <p1 x-text="errors.correo[0]" class="text-corp-10"></p1>
        </div>
        <div class="mb-5">
            <x-web.input.input-free title="Asunto" x-model="subject" span="true" type="text"/>
            <p1 x-text="errors.subject[0]" class="text-corp-10"></p1>
        </div>
        <div>
            <x-web.input.textarea-free title="Mensaje" x-model="body" span="true" type="text" rows="5"/>
            <p1 x-text="errors.body[0]" class="text-corp-10"></p1>
        </div>
        <div class="flex mt-4 justify-center">
            <x-button.webprimary class="w-fit px-8 scale-[80%]" @click="$dispatch('fire1')"> Enviar
            </x-button.webprimary>
        </div>
    </div>
</div>
        {{--  modal.js  --}}
        <x-web.modal.modal maxWidth="sm" id="1">
            <x-slot name="title">
                Confirmación
            </x-slot>
            <p1>Estás seguro de enviar el correo de contacto</p1>
            <x-slot name="footer">
                <x-button.corp_secundary @click="show = false" wire:loading.attr="disabled">Cancelar</x-button.corp_secundary>
                <x-button.corp1  @click="sendEmail(); show=false;">Aceptar</x-button.corp1>
            </x-slot>
        </x-web.modal.modal>
        {{--  fin del modal  --}}
        <x-web.modal.modal maxWidth="sm" id="2">
            <x-slot name="title">
                <x-elements.success scale="0.75" />
            </x-slot>
                <div class="text-center">
                <p1 class="mx-auto">Su mensaje se envio satisfactoriamente</p1>
                </div>
            <x-slot name="footer">
                <div class="flex justify-center w-full">
                <x-button.corp1  @click=" show=false;">Aceptar</x-button.corp1>
                </div>
            </x-slot>
        </x-web.modal.modal>
        {{--  fin del modal  --}}
</div>
@endauth
@guest
<div class="flex w-full 2xl:min-h-[374px] lg:min-h-[278px] md:mt-1 mt-[80px] xl:w-2/3 lg:w-full  mx-auto lg:px-20 px-4">
<div class="px-4 md:px-8 py-4 m-4 border rounded-[3px] border-gris-70 mx-auto bg-black w-full">
    <h6 class="text-center mb-8">FORMULARIO DE RECLAMACIONES</h6>
    <div class="mb-1 text-justify">
        <p>
            Para que puedas enviarnos tu reclamación de forma segura y eficiente, te pedimos que inicies sesión en tu cuenta. Este paso nos permite verificar su identidad, lo que agiliza el proceso de atención y nos ayuda a brindarte una solución más rápida. Si aún no tienes una cuenta, el registro es rápido y sencillo.
        </p>
    <div class="flex mt-4 justify-center">
        <a href="{{ route('web.login_register') }}">
        <x-button.webprimary class="w-fit px-8 scale-[80%]" > Ir a registrarse
        </x-button.webprimary>
    </a>
    </div>
</div>
</div>
@endguest


@endsection

@push('scripts')

@endpush
