@extends('layouts.web')
@section('breadcrumb')
<x-breadcrumb.lodomens.breadcrumb title="CONTACTO">
    <x-breadcrumb.lodomens.breadcrumb2 name='Contacto' />
</x-breadcrumb.lodomens.breadcrumb>
@endsection
@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<style>
    .leaflet-layer,
    .leaflet-control-zoom-in,
    .leaflet-control-zoom-out,
    .leaflet-control-attribution {
    filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
}
</style>
@endsection
@section('content')

<div class="lg:grid lg:grid-cols-3 xl:w-3/4 lg:w-full lg:gap-4 mx-auto lg:px-20 px-4">
    <div class="lg:col-span-2" x-data="{
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

            axios.post('{{ route('email') }}', form)
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

        <div class="px-4 md:px-8 py-4 m-4 border rounded-[3px] border-gris-70 mx-auto bg-black w-full">
            <h6 class="text-center mb-8">FORMULARIO DE CONTACTO</h6>
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
                <p1 class="mx-auto">Su correo se envio satisfactoriamente</p1>
                </div>
            <x-slot name="footer">
                <div class="flex justify-center w-full">
                <x-button.corp1  @click=" show=false;">Aceptar</x-button.corp1>
                </div>
            </x-slot>
        </x-web.modal.modal>
        {{--  fin del modal  --}}
        <div id="mi_mapa" class="my-4 w-full h-[203px] border border-gris-50 shadow rounded-[3px] z-0">

        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4 mx-auto my-4 w-full">
            @foreach ($contacts as $contact )
            <x-web.card.contact title="{{ $contact->name }}">
                <x-slot name="icon">
                    @if($contact->icon)
                    <x-dynamic-component :component="'icons.'.$contact->icon" class="w-6 h-6 mx-auto"/>
                    @endif

                </x-slot>

                <div>
                        {!! nl2br(e($contact->description)) !!}
                </div>
            </x-web.card.contact>
            @endforeach

                <div class="bg-gris-90 border-[2px] border-corp-70 shadow rounded-[3px] p-4 text-center">
                    <h6 class="mb-6">AGENDA CITAS</h6>
                    <p class="text-[14px]">Santiago de Surco, 15056</p>
                    <p class="text-[14px]">Lima, Perú</p>
                    <div class="flex mt-4 justify-center">
                        <a href="https://wa.link/7mmbr5" @click="console.log('hola bb')" target="blank">
                        <x-button.webprimary class="w-fit px-8 scale-[80%]">AGENDAR
                        </x-button.webprimary></a>
                    </div>
                </div>
        </div>
    </div>
</div>
{{--  <livewire:shop-main/>  --}}
@endsection

@push('scripts')

{{--  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="" data-navigate-track></script>  --}}

<script>
    function initializeMap() {
        let map = L.map('mi_mapa').setView([-12.072223538634375, -77.04822961384393], 20);
        var myIcon = L.icon({
            iconUrl: '{{ asset('storage/image/marker-icon-2x2.png') }}',
            iconSize: [25, 41],
            popupAnchor: [0, -20],
        });
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> Lodomens'
        }).addTo(map);

        L.marker([-12.072223538634375, -77.04822961384393], {icon: myIcon}).addTo(map).bindPopup("<b>Tienda Lodomens</b> <br>Av. Arnaldo Marquez 1165 <br> Jesús María, Lima");
    }

    // Ejecuta la función al cargar la página
    initializeMap();

    // Escucha el evento livewire:navigate y vuelve a ejecutar la función
    document.addEventListener('livewire:navigate', function() {
        initializeMap();
    });
</script>
@endpush

