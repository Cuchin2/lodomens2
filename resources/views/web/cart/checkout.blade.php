@extends('layouts.web')

@section('breadcrumb')
 <x-breadcrumb.progress />
@endsection

@section('content')

<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75  pb-1 2xl:min-h-[374px] lg:min-h-[278px] mb-5">
    <form action="{{ route('checkout.create') }}" method="post" onsubmit="handleSubmit(event)">@csrf
    <div class="px-4 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1 md:col-span-2">
            <div>
                <h5 class="p-2">DETALLES DE FACTURACIÓN</h5>
                <div class="bg-gris-100 p-4 rounded-[3px]">
                    <div class=" grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <input name="user_id" value="{{ $user->id }}" hidden>
                            <input name="total" value="{{ Cart::instance('cart')->total() }}" hidden>

                            <x-labelweb>Nombre <x-required /> </x-labelweb>
                            <x-input-web name="name"  placeholder="Ingrese su nombre" value="{{ old('name',$form1->name ?? ($user->name ?? '')) }}"></x-input-web>
                        </div>
                        <div>
                            <x-labelweb>Apellido <x-required /></x-labelweb>
                            <x-input-web name="last_name" placeholder="Ingrese su apellido" value="{{ old('last_name',$form1->last_name ?? ($user->last_name ?? ''))}}"></x-input-web>
                                @error('last_name')
                                <p1 class="text-corp-10 ml-2"> {{ $message }}</p1>
                                @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-labelweb>Nombre de la empresa (opcional)</x-labelweb>
                        <x-input-web name="business" placeholder="Ingrese el número de la empresa" value="{{ $form1->business ?? '' }}"></x-input-web>
                    </div>
                    <div class=" grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-labelweb>Documento <x-required /></x-labelweb>
                            <x-select-web name="document_type">
                                <option value="DNI" @if(old('document_type', $form1->document_type ??( $user->profile->document_type ?? '')) === 'DNI') selected @endif>DNI</option>
                                <option value="PASS" @if(old('document_type', $form1->document_type ??( $user->profile->document_type ?? '')) === 'PASS') selected @endif>Passaporte</option>
                                <option value="CARD" @if(old('document_type', $form1->document_type ??( $user->profile->document_type ?? '')) === 'CARD') selected @endif>Carnet de Estrangería</option>
                                <option value="">Otros</option>
                            </x-select-web>
                            @error('document_type')
                            <p1 class="text-corp-10 ml-2"> {{ $message }}</p1>
                            @enderror
                        </div>

                        <div>
                            <x-labelweb>N° de documento <x-required /></x-labelweb>
                            <x-input-web name="dni" placeholder="Ingrese su N° de documento" value="{{ old('dni',$form1->dni ?? ($user->profile->dni ?? ''))}}"></x-input-web>
                            @error('dni') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                        </div>
                    </div>
                    <div x-data="{ address: { name: '', reference: '{{ old('reference', $form1->reference ?? '') }}', description: '{{ old('address', $form1->address ?? '') }}' }, open:''}" x-init="address= ´{{ json_encode($address)}}´; if(address.name == '') { open= false;} else { open=true;}"
                        >
                        <div class="mb-4" @cambiazo.window="address.description=$event.detail.description;
                        address.reference=$event.detail.reference; address.name=$event.detail.name; open=true;
                        ">
                            <div class="flex space-x-2">
                            <x-labelweb class="mr-2" x-bind:class="open ? '!mr-0' : ''">Dirección <x-required /> <p x-text="'('+address.name+')'" x-show="open" class="text-white text-[10px] mt-[5px] ml-5"></p></x-labelweb>
                            <x-icons.chevron-down @click="$dispatch('modal',{ select: 'SELECT', cual:1 })" height="10px" width="10px" grosor="1" class="mt-[7px] hover:text-white cursor-pointer"/></div>
                            <div class="relative">
                            <x-input-web x-model="address.description" @input="open=false" name="address" placeholder="Ingrese su dirección" />
                            <x-icons.plus @click="$dispatch('modal',{ select: 'CREATE' })" class="h-[14px] w-[14px] cursor-pointer absolute top-[7px] right-[7px] hover:fill-white"/>
                            @error('address') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                        </div>
                        </div>
                        <div class="mb-4">
                            <x-labelweb>Referencia (opcional)</x-labelweb>
                            <x-input-web  x-model="address.reference" name="reference" placeholder="Ingrese su referencia" @input="open=false"></x-input-web>
                        </div>
                    </div>
                        {{-- Pruebas --}}
                        <div x-data="countryStateCity1()" class="grid grid-cols-2 gap-4" x-init="startfunction">
                            <div>
                                <x-labelweb>País <x-required /> </x-labelweb>
                                <x-select-web x-model="selectedCountry" @change="fetchStates" name="country">
                                    <option value="" disabled selected>Selecciona el pais</option>
                                    <template x-for="country in countries" :key="country.code">
                                        <option :value="country.code" x-text="country.name" x-bind:selected="country.code === '{{ old('country',$form1->country ?? 'PE') }}' ? true : false"></option>
                                        {{--  <option :value="country.code" x-text="country.name"></option>  --}}
                                    </template>
                                </x-select-web>
                                    @error('country') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                                <x-labelweb class="mt-4">Ciudad <x-required /> </x-labelweb>
                                <x-select-web x-model="selectedCity" @change="fetchDistrits"  name="city" x-bind:class="{ '!cursor-not-allowed bg-red-600/20': !selectedStateRdy }"  x-bind:disabled=" !selectedStateRdy" x-bind:disabled=" !selectedState">
                                    <option value="">Selecciona la ciudad</option>
                                    <template x-for="city in cities" :key="city.geonameId">
                                        <option :value="city.geonameId" x-text="city.name" x-bind:selected="city.geonameId === {{ old('city',$form1->city ?? '') }} ? true : false"></option>
                                    </template>
                                </x-select-web>
                                    @error('city') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                            </div>
                            <div>
                                <x-labelweb >Estado/Provincia <x-required /> </x-labelweb>
                                <x-select-web x-model="selectedState" @change="fetchCities" name="state">
                                    <option value="" >Selecciona el Estado/Departamento</option>
                                    <template x-for="state in states" :key="state.geonameId">
                                        <option :value="state.geonameId" x-text="state.name" x-bind:selected="state.geonameId === {{ old('state',$form1->state ?? '') }} ? true : false"></option>
                                    </template>
                                </x-select-web>
                                @error('state') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror

                                <x-labelweb class="mt-4">Distrito/Localidad <x-required /> </x-labelweb>

                                <x-select-web x-model="selectedDistrit" name="district" x-bind:class="{ '!cursor-not-allowed bg-red-600/20': !selectedCityRdy }"  x-bind:disabled=" !selectedCityRdy" >
                                    <option value="" >Selecciona el distrito</option>
                                    <template x-for="distrit in distrits" :key="distrit.geonameId">
                                        <option :value="distrit.geonameId" x-text="distrit.name" x-bind:selected="distrit.geonameId === {{ old('district',$form1->district ?? '') }} ? true : false"></option>
                                    </template>
                                </x-select-web>

                                @error('district') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                            </div>
                        </div>
                        <script>
                            function countryStateCity1() {

                                    return {
                                        countries: @json($getCountry),
                                        states: @json($getState),
                                        cities: @json($getCity),
                                        distrits: @json($getDistrit),
                                        selectedCountry: '{{  old('country',$form1->country ?? 'PE') }}',
                                        selectedState: '{{ old('state',$form1->state ?? '') }}',
                                        selectedCity: '{{ old('city',$form1->city ?? '') }}',
                                        selectedDistrit : '{{ old('district',$form1->district ?? '') }}',
                                        selectedCityRdy : '{{ old('city',$form1->city ?? '') }}',
                                        selectedStateRdy: '{{ old('state',$form1->state ?? '') }}',
                                        fetchCountries() {
                                            axios.get('/api/countries')
                                                .then(response => {
                                                    this.countries = response.data;
                                                });
                                        },
                                        fetchStates() {
                                            axios.get(`/api/states/${this.selectedCountry}`)
                                                .then(response => {
                                                    this.states = response.data;
                                                    this.cities = [];
                                                    this.distrits = [];
                                                    this.selectedState = null;
                                                    this.selectedCity = null;
                                                    this.selectedDistrit = null;
                                                    this.selectedCityRdy = '';
                                                    this.selectedStateRdy = '';
                                                });
                                        },
                                        fetchCities() {
                                            axios.get(`/api/cities/${this.selectedState}`)
                                                .then(response => {
                                                    this.cities = response.data;
                                                    this.distrits = [];
                                                    this.selectedCity = null;
                                                    this.selectedCityRdy= '';
                                                    this.selectedDistrit = '';
                                                    this.selectedStateRdy ='ready';
                                                });
                                        },
                                        fetchDistrits() {
                                            axios.get(`/api/distrits/${this.selectedCity}`)
                                                .then(response => {
                                                    this.distrits = response.data;
                                                    this.selectedCityRdy='ready';
                                                });
                                        },
                                        startfunction(){
                                          probar = '{{ $errors->any() }}' ;
                                          form1  =  '{{ $form1 }}';
                                            if(!form1){
                                                this.fetchStates();
                                            }
                                            /* this.fetchStates(); */
                                        }
                                    }
                                }
                                document.addEventListener('alpine:init', () => {
                                    Alpine.data('countryStateCity1', countryStateCity1);

                                });
                        </script>
                        {{-- Fin de pruebas --}}


                    <div class=" grid grid-cols-2 gap-4 my-4">
                        <div>
                            <x-labelweb>Código postal</x-labelweb>
                            <x-input-web placeholder="Ingrese su código postal"  name="zip_code" value="{{ old('zip_code',$form1->zip_code ?? '') }}"></x-input-web>
                        </div>
                        <div>
                            <x-labelweb>Teléfono <x-required /> </x-labelweb>
                            <x-input-web placeholder="Ingrese su teléfono" name="phone" value="{{ old('phone',$form1->phone ?? ($user->profile->phone ?? '')) }}" ></x-input-web>
                            @error('phone') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                        </div>
                    </div>
                    <div class=" mb-4">
                        <x-labelweb>Correo electrónico <x-required /> </x-labelweb>
                        <x-input-web placeholder="Ingrese su correo" name="email" value="{{ old('email',$form1->email ?? ($user->email ?? '')) }}" ></x-input-web>
                        @error('email') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                    </div>
                    {{--  Formulario 2  --}}
                    <div x-data="{open:{{ old('otra',$on)}} }">
                        <h5 class="p-2">DETALLES DE ENVIO</h5>
                        <div class="flex space-x-3 ">
                            <p>¿Enviar a una dirección diferente?</p>
                                <input type="text" name="otra" x-model="open" hidden>
                            <div class="flex items-center me-4">
                                <x-checkbox.webcheckbox @change="open= !open" ::checked="open" />
                            </div>

                        </div>
                        <div x-show="open" x-cloak class="p-2 mt-4">
                            <div class=" grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <x-labelweb>Nombre <x-required /> </x-labelweb>
                                    <x-input-web placeholder="Ingrese su nombre" value="{{ old('name2',$form2->name ?? '') }}" name="name2" ></x-input-web>
                                    @error('name2') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                                </div>
                                <div>
                                    <x-labelweb>Apellido <x-required /> </x-labelweb>
                                    <x-input-web placeholder="Ingrese su apellido" value="{{ old('last_name2',$form2->last_name ?? '')}}" name="last_name2"></x-input-web>
                                    @error('last_name2') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                                </div>
                            </div>
                            <div x-data="{ address: { name: '', reference: '{{ old('reference', $form2->reference ?? '') }}', description: '{{ old('address', $form2->address ?? '') }}' }, open:''}"
                            x-init="address= ´{{ json_encode($address2) }}´; if(address.name == '') { open= false;} else {open=true;}"
                                @cambiazo2.window="address.description=$event.detail.description;
                                address.reference=$event.detail.reference; address.name=$event.detail.name; open=true;
                                ">
                                <div class="mb-4">
                                    <div class="flex space-x-2">
                                        <x-labelweb class="mr-2" x-bind:class="open ? '!mr-0' : ''">Dirección <x-required /> <p x-text="'('+address.name+')'" x-show="open" class="text-white text-[10px] mt-[5px] ml-5"></p></x-labelweb>
                                    <x-icons.chevron-down @click="$dispatch('modal',{ select: 'SELECT', cual:2  })" height="10px" width="10px" grosor="1" class="mt-[7px] hover:text-white cursor-pointer"/></div>
                                    <div class="relative">
                                    <x-input-web x-model="address.description" placeholder="Ingrese su dirección" name="address2" @input="open=false"/>
                                    @error('address2') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <x-labelweb>Referencia (opcional)</x-labelweb>
                                    <x-input-web x-model="address.reference" placeholder="Ingrese su referencia" name="reference2" @input="open=false"></x-input-web>
                                </div>
                             </div>
                              {{-- Pruebas --}}
                        <div x-data="countryStateCity()" class="grid grid-cols-2 gap-4" x-init="startfunction">
                            <div>
                                <x-labelweb>País <x-required /> </x-labelweb>
                                <x-select-web x-model="selectedCountry" @change="fetchStates" name="country2">
                                    <option value="" disabled selected>Selecciona el pais</option>
                                    <template x-for="country in countries" :key="country.code">
                                        <option :value="country.code" x-text="country.name" x-bind:selected="country.code === '{{ old('country2',$form2->country ?? 'PE') }}' ? true : false"></option>
                                        {{--  <option :value="country.code" x-text="country.name"></option>  --}}
                                    </template>
                                </x-select-web>
                                @error('country2') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                                <x-labelweb class="mt-4">Ciudad <x-required /> </x-labelweb>
                                <x-select-web x-model="selectedCity" @change="fetchDistrits"  name="city2" x-bind:class="{ '!cursor-not-allowed bg-red-600/20': !selectedStateRdy }"  x-bind:disabled=" !selectedStateRdy" x-bind:disabled=" !selectedState">
                                    <option value="">Selecciona la ciudad</option>
                                    <template x-for="city in cities" :key="city.geonameId">
                                        <option :value="city.geonameId" x-text="city.name" x-bind:selected="city.geonameId === {{ old('city2',$form2->city ?? '') }} ? true : false"></option>
                                    </template>
                                </x-select-web>
                                @error('city2') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                            </div>
                            <div>
                                <x-labelweb >Estado/Provincia <x-required /> </x-labelweb>
                                <x-select-web x-model="selectedState" @change="fetchCities" name="state2">
                                    <option value="" >Selecciona el Estado/Departamento</option>
                                    <template x-for="state in states" :key="state.geonameId">
                                        <option :value="state.geonameId" x-text="state.name" x-bind:selected="state.geonameId === {{ old('state2',$form2->state ?? '') }} ? true : false"></option>
                                    </template>
                                </x-select-web>
                                @error('state2') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                                <x-labelweb class="mt-4">Distrito/Localidad <x-required /> </x-labelweb>
                                <x-select-web x-model="selectedDistrit" name="district2" x-bind:class="{ '!cursor-not-allowed bg-red-600/20': !selectedCityRdy }"  x-bind:disabled=" !selectedCityRdy" >
                                    <option value="" >Selecciona el distrito</option>
                                    <template x-for="distrit in distrits" :key="distrit.geonameId">
                                        <option :value="distrit.geonameId" x-text="distrit.name" x-bind:selected="distrit.geonameId === {{ old('district2',$form2->district ?? '') }} ? true : false"></option>
                                    </template>
                                </x-select-web>
                                @error('district2') <p1 class="text-corp-10 ml-2"> {{ $message }}</p1> @enderror
                            </div>
                        </div>
                        <script>
                            function countryStateCity() {
                                    return {
                                        countries: @json($getCountry),
                                        states: @json($getState2),
                                        cities: @json($getCity2),
                                        distrits: @json($getDistrit2),
                                        selectedCountry: '{{  old('country',$form2->country ?? 'PE') }}',
                                        selectedState: '{{ $form2->state ?? null }}',
                                        selectedCity: '{{ $form2->city ?? null }}',
                                        selectedDistrit : '{{ $form2->district ?? null }}',
                                        selectedCityRdy : '{{ old('city',$form1->city ?? '') }}',
                                        selectedStateRdy: '{{ old('state',$form1->state ?? '') }}',
                                        fetchCountries() {
                                            axios.get('/api/countries')
                                                .then(response => {
                                                    this.countries = response.data;
                                                });
                                        },

                                        fetchStates() {
                                            axios.get(`/api/states/${this.selectedCountry}`)
                                                .then(response => {
                                                    this.states = response.data;
                                                    this.cities = [];
                                                    this.distrits = [];
                                                    this.selectedState = null;
                                                    this.selectedCity = null;
                                                    this.selectedDistrit = null;
                                                    this.selectedCityRdy = '';
                                                    this.selectedStateRdy = '';
                                                });
                                        },
                                        fetchCities() {
                                            axios.get(`/api/cities/${this.selectedState}`)
                                                .then(response => {
                                                    this.cities = response.data;
                                                    this.distrits = [];
                                                    this.selectedCity = null;
                                                    this.selectedCityRdy= '';
                                                    this.selectedDistrit = '';
                                                    this.selectedStateRdy ='ready';
                                                });
                                            },
                                        fetchDistrits() {
                                            axios.get(`/api/distrits/${this.selectedCity}`)
                                                .then(response => {
                                                    this.distrits = response.data;
                                                    this.selectedCityRdy='ready';
                                                });
                                        },
                                        startfunction(){
                                          probar = '{{ $errors->any() }}' ;
                                          form2  =  '{{ $form2 }}';
                                            if(!form2){
                                                this.fetchStates();
                                            }
                                            /* this.fetchStates(); */
                                        }
                                    }
                                }
                                document.addEventListener('alpine:init', () => {
                                    Alpine.data('countryStateCity', countryStateCity);
                                });
                        </script>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div>
            <div>
                <h5 class="p-2">TU PEDIDO</h5>
                <div class="bg-gris-100 p-4 rounded-[3px]">
                    <div>
                        <h5>Resumen de pedido</h5>
                        <div class="flex justify-between my-8">
                            <p>Subtotal ({{ Cart::instance('cart')->content()->count() }})</p>
                            <p>{{session('currency')}}{{ Cart::instance('cart')->subtotal() }}</p>
                        </div>
                        <div class="flex justify-between my-2 text-white">
                            <p>Total</p>
                            <p>{{session('currency')}}{{ Cart::instance('cart')->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-2 p-4">
                @foreach (Cart::instance('cart')->content() as $item)
                <div class="mb-4">
                  <div class="flex justify-between mb-1">
                    <p class="font-bold">{{ $item->name }}</p> <p class="font-bold">{{session('currency')}} {{ $item->qty*$item->price }}</p>
                  </div>
                  <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-1">
                        <a class="flex w-max items-center"
                        href="{{ route('web.shop.show',['product'=>$item->options->slug,'color'=>$item->options->color_id]) }}">
                        <x-outstock text="text-[10px]" class="!w-[50px] !h-[50px] md:!w-[65px] md:!h-[65px]" url="{{ $item->options->productImage }}" name="{{ $item->name }}" stock="{{ $item->options->stock }}" color="{{$item->options->hex}}" img="{{$item->options->src}}" param="scale-50 top-0 left-0"/>
                    </a>
                    </div>
                    <div class="col-span-2">
                        <p1>Precio unidad: {{session('currency')}}{{ $item->price }}</p1>
                        <p1>Color: {{ $item->options->color }}</p1>
                        <p1> {{ $item->qty == 1 ? '1 unidad' : $item->qty.' unidades' }}</p1>
                    </div>
                  </div>
                </div>
                @endforeach


            </div>

            <div class="my-4 select-none flex justify-center">
             <x-button.webprimary type="submit" class="w-[90%]" @click="$dispatch('heart')">Continuar</x-button.webprimary>
            </div>
        </div>
    </div>
    </form>
</div>
<livewire:checkout-modal />
<x-preloader.heart />
@endsection

@push('scripts')
<script>
    function handleSubmit(event) {
        event.preventDefault();
        // Validación HTML5 se realiza automáticamente con el submit

        const form = event.target;

        if (form.checkValidity()) {
            // Si la validación HTML5 es exitosa, envía el formulario
            window.dispatchEvent(new CustomEvent('heart'));
            form.submit();
            // Ejecuta tu función adicional aquí después de enviar el formulario
            additionalFunction();
        } else {
            // Si hay errores de validación, se pueden manejar aquí (opcional)
            alert("Por favor, complete todos los campos requeridos.");
        }
    }

    function additionalFunction() {
        // Tu lógica adicional aquí
        console.log("Formulario enviado y lógica adicional ejecutada.");
    }
</script>
@endpush
