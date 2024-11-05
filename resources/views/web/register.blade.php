@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Registro">
    <x-breadcrumb.lodomens.breadcrumb2 name='Registro' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection

{{--  <x-lodomens.video />  --}}
@section('content')

<div class="container lg:max-w-[766px] mx-auto">
    <div class="row">
        <div class="col-12 col-lg-8 mt-5 mb-5">
            <div class="rounded-[3px] border-[1px] border-gris-70 bg-black md:py-8 md:px-10 py-4 px-5">
                <div class="text-center ">
                    <h3 class="">REGISTRARSE</h3>

                    {{-- <h3 class="login__register">REGISTER</h3> --}}
                </div>
                @if ($errors->any())
                <div>
                    <div class="text-center text-red-600">{{ __('Uuups! Algo salió mal.') }}</div>
                </div>
                {{-- @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach --}}
                @endif
                <form action="{{route('web.store_register')}}" method="post" enctype="multipart/form-data" class="mb-0">
                    @csrf
                    <div class="">
                        <div class="grid grid-cols-6">
                            <x-specials.uploadCrop />

                            <div class="col-span-4">
                                <div class="my-4">
                                    <p>Nombre <span class="text-corp-50">*</span></p>
                                    <div class="mt-0 ">
                                        <input
                                            class="w-full focus:ring-black bg-black border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30"
                                            type="text" placeholder="Ingresa tu nombre" value="{{ old('name') }}"
                                            name="name" placeholder="Nombre" >
                                            @isset ($errors->messages()['name'])
                                            @foreach ($errors->messages()['name'] as $key=>$error)
                                            <p class="text-red-600 ml-2a5">{{ $errors->messages()['name'][$key] }}</p>
                                            @endforeach
                                            @endisset
                                    </div>
                                </div>
                                <div class="my-4">
                                    <div>Apellido <span class="text-corp-50">*</span></div>
                                    <div class="input-group mt-0 ">
                                        <input class="w-full focus:ring-black bg-black border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30" type="text"
                                            placeholder="Ingresa tu apellido" value="{{ old('last_name') }}"
                                            name="last_name" >
                                            @isset ($errors->messages()['last_name'])
                                            @foreach ($errors->messages()['last_name'] as $key=>$error)
                                            <p class="text-red-600 ml-2a5">{{ $errors->messages()['last_name'][$key] }}</p>
                                            @endforeach
                                            @endisset
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class=" pt-0 pb-0" x-data="{check: false}">

                        <p class="flex">Correo Electrónico</p>

                        <div class="input-group mt-0
                        @isset ($errors->messages()['email'])
                                mb-0
                        @endisset
                        ">
                            <input class="w-full focus:ring-black bg-black border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30
                            @isset ($errors->messages()['email'])
                                alerta
                            @endisset
                            " type="email" placeholder="Ingresa tu correo electrónico" name="email"
                                value="{{ old('email') }}">
                        </div> {{-- {{ dd($errors->messages()['email'][0]) }} --}}
                        @isset ($errors->messages()['email'])
                        @foreach ($errors->messages()['email'] as $key=>$error)
                        <p class="text-red-600 ml-2a5">{{ $errors->messages()['email'][$key] }}</p>
                        @endforeach
                        @endisset
                        {{-- <div class="input-group group-password"> --}}
                            <div class="mt-4 login__label flex">Contraseña
                                <div x-data="{ tooltip: false }" class="relative">
                                    <div x-on:mouseenter="tooltip = true" x-on:mouseleave="tooltip = false">
                                        <x-icons.info class="w-5 ml-2 mt-[1.5px]" />
                                    </div>
                                    <div x-show="tooltip"
                                        class="z-50 absolute bg-gris-90 px-3 ml-2  left-10 top-0 border border-gris-70 w-[230px]">
                                        <li>Mínimo de 6 caractéres</li>
                                    </div>
                                </div>
                            </div>
                            <div class="relative mt-0 " x-data="{ show: true }">
                                <input class="w-full focus:ring-black bg-black border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30
                            @isset ($errors->messages()['password'])
                                        alerta
                                @endisset
                            " :type="show ? 'password' : 'text'" placeholder="Contraseña" name="password">

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 cursor-pointer">
                                    <x-icons.eye_close class="h-6 text-gris-30" />
                                    <x-icons.eye_open class="h-6 text-gris-30" />
                                </div>

                            </div>

                            <div class="mt-4">Confirmar Contraseña</div>
                            <div class="relative mt-0
                                        @isset ($errors->messages()['password'])
                                        mb-0
                                        @endisset
                            " x-data="{ show: true }">
                                <input class="w-full focus:ring-black bg-black border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30
                                @isset ($errors->messages()['password'])
                                alerta
                                @endisset
                                " :type="show ? 'password' : 'text'" placeholder="Contraseña"
                                    name="password_confirmation">

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 cursor-pointer">
                                    <x-icons.eye_close class="h-6 text-gris-30" />
                                    <x-icons.eye_open class="h-6 text-gris-30" />

                                </div>

                            </div>
                            @isset ($errors->messages()['password'])
                            @foreach ($errors->messages()['password'] as $key=>$error)
                            <p class="text-red-600 ml-2a5">{{
                                $errors->messages()['password'][$key] }}</p>
                            @endforeach
                            @endisset
                            {{-- <div class="input-group-append">
                                <button class="btn forgot-pass" type="button">Forgot?</button>
                            </div> --}}
                            {{--
                        </div> --}}
                        <div class="mt-6
                        @isset ($errors->messages()['terms'])
                                        mb-0
                                        @endisset
                        " >
                        <x-checkbox.webcheckbox @change="check= !check" ::value="check" id="check" />
                            <label class="form-check-label"  for="check"
                                style="padding-left: 1.95em;">Al registrarte estás
                                aceptando los<a href="#"><b class="turkey turkey1-hv"> Términos y
                                        Condiciones</b></a></label>
                        </div>
                        @isset ($errors->messages()['terms'])
                        @foreach ($errors->messages()['terms'] as $key=>$error)
                        <p class="text-red-600 ml-2a5">El campo de términos y condiciones es obligatorio{{-- {{
                            $errors->messages()['password'][$key] }} --}}</p>
                        @endforeach
                        @endisset
                        <div class="text-center mt-8 " :class="check ? '' : 'opacity-40 '">
                            <x-button.webprimary ::class="check ? 'cursor-pointer' :'cursor-not-allowed'"
                            ::disabled="!check" type="submit" class="w-[141px]" @click="$dispatch('heart')">Enviar</x-button.webprimary>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<x-preloader.heart />
@endsection


