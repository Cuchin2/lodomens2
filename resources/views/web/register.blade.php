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

                            <div x-data="{
                                                src: '../image/perfiles/Foto_perfil_ecowaste.jpg',
                                                src2: '', src3:'',
                                                showModal: false,
                                                activeItem: null,
                                                mainPage: true,
                                                cropper: null,
                                                croppable: false,
                                                getRoundedCanvas() {
                                                if (this.croppable && this.cropper) {
                                                    var canvas = document.createElement('canvas');
                                                    var context = canvas.getContext('2d');
                                                    var croppedCanvas = this.cropper.getCroppedCanvas(); // Obtener el canvas recortado

                                                    if (croppedCanvas) {
                                                    var width = croppedCanvas.width;
                                                    var height = croppedCanvas.height;

                                                    canvas.width = width;
                                                    canvas.height = height;
                                                    context.imageSmoothingEnabled = true;
                                                    context.drawImage(croppedCanvas, 0, 0, width, height);
                                                    context.globalCompositeOperation = 'destination-in';
                                                    context.beginPath();
                                                    context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
                                                    context.fill();
                                                    return canvas;
                                                    }
                                                }
                                                },
                                                cropAndCloseModal() {
                                                if (this.croppable && this.cropper) {
                                                    const roundedCanvas = this.getRoundedCanvas();
                                                    if (roundedCanvas) {
                                                    const croppedSrc = roundedCanvas.toDataURL();
                                                    this.src = croppedSrc;

                                                    const inputElement = document.getElementById('croppedImageBase64');

                                                    inputElement.value = croppedSrc;
                                                    };

                                                }
                                                this.mainPage = true;
                                                this.showModal = false;
                                                this.activeItem= null;
                                                },
                                                updateImage(event) {
                                                    this.mainPage = false;
                                                    this.src3 = URL.createObjectURL(event.target.files[0]);
                                                    event.target.value = null;
                                                    if (this.cropper) {
                                                        this.cropper.destroy();
                                                        this.cropper = null;
                                                    }

                                                    this.$nextTick(() => {
                                                        this.cropper = new Cropper(this.$refs.cropperImage, {
                                                            aspectRatio: 1, // Hace que el recorte sea circular
                                                            viewMode: 1,   // Muestra el área de recorte en el centro
                                                            autoCropArea: 1,
                                                            ready: () => {
                                                                this.croppable = true;
                                                            },
                                                        });
                                                    });
                                                },
                                                updateImage2(event) {
                                                    this.src2 = event.target.src;    
                                                },
                                                definiteImage (){
                                                    this.src=this.src2; this.showModal = false;
                                                    const inputElement = document.getElementById('croppedImageBase64');
                                                    inputElement.value = this.src;
                                                },


                                            }" class="text-center m-4 col-span-2 flex items-center">

                                <label class="cursor-pointer " @click="showModal = !showModal">
                                    <div class=" md:max-w-[140px] md:max-h-[140px] max-h-[100px] max-w-[100px] "
                                        style="border: 1px solid #d2d2d2; border-radius: 50%!important; margin-bottom: 5px; overflow: hidden;">
                                        <img :src="src" class="bg-black"
                                            style="object-fit: cover; clip-path: circle(50% at 50% 50%);">

                                    </div>
                                    <div class="absolute w-7 h-7 md:w-9 md:h-9 rounded-full bg-gray-400 border-[3px] border-black ml-[47px] md:ml-[102px]  mt-[-31px]"
                                        style="display: flex; align-items: center">
                                        <x-icons.camera fill="white" class="w-3 h-3 md:w-4 md:h-4 mx-auto" />
                                    </div>
                                </label>

                                {{-- modal de prueba --}}
                                <div x-show="showModal" x-cloak style="display: none"
                                    class="fixed inset-0 z-50 items-center justify-center w-screen h-screen top-0 left-0">
                                    <div class="relative rounded overflow-y-auto mx-auto">
                                        <div class="flex items-center w-screen h-screen bg-black/40 ">
                                        <div @click.away="showModal = false, activeItem = null" class="bg-gris-90 lg:w-[658px] rounded px-4 py-2 md:px-8 md:py-5 mx-auto br-10 relative border-gris-70 border-[1px]"
                                            x-show="mainPage">
                                            <label for="" @click="showModal = false, activeItem = null"
                                                class=" absolute h-6 w-6 cursor-pointer bg-corp-50 "
                                                style="top:12px; right:12px">
                                                <x-icons.cross grosor="1" class="w-3 h-3 mx-auto mt-[6.4px] cursor-pointer"
                                                    fill="white" />
                                            </label>
                                            <h1 class="font-bold mb-[19px] w-fit mx-auto" style="font-size: 22px">Foto de
                                                Perfil</h1>
                                            <div class="modal-body">
                                                <label for="fileInput"
                                                    class="mx-4 border-solid border-[1px]  my-3 cursor-pointer items-center border-gris-50 bg-gris-90 hover:bg-gris-80 br-20 font-bold flex justify-center"
                                                    style="padding: 3px">
                                                    <x-icons.camera class="w-[18px] h-[18px] mr-2" />

                                                    Subir Foto
                                                </label>
                                                <input type="file" class="hidden" value="" name="croppedImage"
                                                    id="fileInput" x-ref="croppedImage" accept="image/*"
                                                    @change="updateImage">
                                                <input type="text" name="croppedImageBase64" id="croppedImageBase64"
                                                    class="hidden">
                                                <div class="flex flex-col ">
                                                    <p class="mx-4 font-bold float-left flex">Fotos sugeridas</p>
                                                    <div class="mx-4 my-3 grid grid-cols-3 md:grid-cols-5 gap-4">
                                                        <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_01.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 1 }" alt=""
                                                            @click="updateImage2, activeItem = 1">
                                                            <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_02.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 2 }" alt=""
                                                            @click="updateImage2, activeItem = 2">
                                                            <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_03.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 3 }" alt=""
                                                            @click="updateImage2, activeItem = 3">

                                                        <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_04.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 4 }" alt=""
                                                            @click="updateImage2, activeItem = 4">
                                                            <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_05.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 5 }" alt=""
                                                            @click="updateImage2, activeItem = 5">

                                                            <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_06.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 6 }" alt=""
                                                            @click="updateImage2, activeItem = 6">
                                                            <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_07.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 7 }" alt=""
                                                            @click="updateImage2, activeItem = 7">
                                                            <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_08.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 8 }" alt=""
                                                            @click="updateImage2, activeItem = 8">
                                                            <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_09.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 9 }" alt=""
                                                            @click="updateImage2, activeItem = 9">
                                                            <img class="rounded-full border-[4px] border-gris-90 hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz"
                                                            src="{{asset('storage/image/lodomens/layouts/FotoPerfil_10.png')}}"
                                                            :class="{ ' !border-corp-50': activeItem === 10 }" alt=""
                                                            @click="updateImage2, activeItem = 10">
                                                    </div>
                                                    <div class="mx-4 mt-[19px] flex">
                                                        <x-button.main type="button" class="w-[140px]"  @click="definiteImage">Aceptar</x-button.main>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div @click.away="showModal = false, activeItem = null, mainPage = true" class="bg-gris-90 lg:w-[658px] rounded px-8 py-5 mx-auto br-10 relative border-gris-70 border-[1px]"
                                            x-show="!mainPage" x-cloak>
                                            <label for="" @click="showModal = false, activeItem = null, mainPage = true"
                                            class=" absolute h-6 w-6 cursor-pointer bg-corp-50 "
                                            style="top:12px; right:12px">
                                            <x-icons.cross grosor="1" class="w-3 h-3 mx-auto mt-[6.4px] cursor-pointer"
                                                fill="white" />
                                            </label>
                                            <h1 class="font-bold mb-3 w-fit mx-auto" style="font-size: 22px">Editar
                                                imagen</h1>
                                            <div class=" bg-gris-90 items-center justify-center ">
                                                <div class="bg-gris-90 p-0 rounded-lg shadow-md">
                                                    <div style="height: 300px">
                                                        <img x-ref="cropperImage" :src="src3" alt="">
                                                    </div>

                                                </div>
                                                <div class="mt-4 ">
                                                    <x-button.main type="button" class="w-[140px]"  @click="cropAndCloseModal">Aceptar</x-button.main>
                                                   {{--   <a id="button" @click="cropAndCloseModal"
                                                        class="mx-auto mt-3 cursor-pointer items-center  bg-turkey text-white br-20 font-bold flex bg-turkey1-hv justify-center"
                                                        style="padding: 3px; width:140px; height:32px">Guardar</a>  --}}
                                                    </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <div class="my-4">
                                    <p>Nombre <span class="text-corp-50">*</span></p>
                                    <div class="mt-0 ">
                                        <input
                                            class="w-full focus:ring-black bg-black border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30"
                                            type="text" placeholder="Ingresa tu nombre" value="{{ old('name') }}"
                                            name="name" placeholder="Nombre" required>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <div>Apellido <span class="text-corp-50">*</span></div>
                                    <div class="input-group mt-0 ">
                                        <input class="w-full focus:ring-black bg-black border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-70 placeholder-gris-30" type="text"
                                            placeholder="Ingresa tu apellido" value="{{ old('last_name') }}"
                                            name="last_name" required>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class=" pt-0 pb-0">

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
                                value="{{ old('email') }}" required>
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
                            " :type="show ? 'password' : 'text'" placeholder="Contraseña" name="password" required>

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
                                    name="password_confirmation" required>

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
                        <div class="
                        @isset ($errors->messages()['terms'])
                                        mb-0
                                        @endisset
                        ">
                            <input type="checkbox" id="check" name="terms">
                            <label  for="check"></label><label class="form-check-label"
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
                        <div class="text-center mt-8">
                            <x-button.main class="w-[141px]">Enviar</x-button.main>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css">
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.js"></script>

@endsection
