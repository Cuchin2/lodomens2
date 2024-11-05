@props(['img'=>'','pos'=>' ml-[47px] md:ml-[102px]  mt-[-31px] w-7 h-7 md:w-9 md:h-9' ,
'cam'=>'w-3 h-3 md:w-4 md:h-4 ','axios'=>'no'])

<div x-data="{
    src: '{{ old('profile_photo_url') ? old('profile_photo_url') : ( auth()->user() ? Auth::user()->profile_photo_url : '../image/perfiles/Foto_perfil_ecowaste.jpg') }}',
    src2: '', src3:'', live: '{{ $axios }}',
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

        const inputElement = document.getElementById('profile_photo_url');

        inputElement.value = croppedSrc;
        };
        if(this.live === 'si') {
        this.submitImage('cropped');}
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
        const inputElement = document.getElementById('profile_photo_url');
        inputElement.value = this.src;
        if(this.live === 'si') {
        this.submitImage('simple');}
    },
    submitImage(source) {
        // Obtener la imagen según el origen
        const croppedImage = source === 'cropped' ? this.getRoundedCanvas().toDataURL() : this.src;

        axios.post('{{ route('web.shop.webdashboard.uploadphoto') }}', {
            profile_photo_url: croppedImage,
        })
        .then(response => {
            // Manejar la respuesta exitosa
            console.log('Imagen enviada con éxito', response.data);
            $dispatch('photoprofile', { photo: response.data });
        })
        .catch(error => {
            // Manejar errores
            console.error('Error al enviar la imagen', error);
        });
    }
    }" class="text-center m-4 col-span-2 flex items-center">

<label class="cursor-pointer " @click="showModal = !showModal" >
<div class=" md:max-w-[140px] md:max-h-[140px] max-h-[100px] max-w-[100px] "
style="border: 1px solid #d2d2d2; border-radius: 50%!important; margin-bottom: 5px; overflow: hidden;">
<img :src="src" class="bg-black {{ $img }}"
style="object-fit: cover; clip-path: circle(50% at 50% 50%);">

</div>
<div class="absolute  rounded-full bg-gray-400 border-[3px] border-black {{ $pos }}"
style="display: flex; align-items: center">
<x-icons.camera fill="white" class="{{ $cam }}mx-auto" />
</div>
@isset ($errors->messages()['profile_photo_url'])
@foreach ($errors->messages()['profile_photo_url'] as $key=>$error)
<p class="text-red-600 ml-2a5">{{ $errors->messages()['profile_photo_url'][$key] }}</p>
@endforeach
@endisset
</label>
{{--   <x-specials.uploadCrop />  --}}
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
        class="mx-4 border-solid border-[1px] rounded-[3px] my-3 cursor-pointer items-center border-gris-50 bg-gris-90 hover:bg-gris-80 br-20 font-bold flex justify-center"
        style="padding: 3px">
        <x-icons.camera class="w-[18px] h-[18px] mr-2" />

        Subir Foto
    </label>
    <input type="file" class="hidden" value="{{old('profile_photo_url')}}" name="croppedImage"
        id="fileInput" x-ref="croppedImage" accept="image/*"
        @change="updateImage">
    <input type="text" name="profile_photo_url" id="profile_photo_url" value="{{old('profile_photo_url')}}"
        class="hidden">
    <div class="flex flex-col ">
        <p class="mx-4 font-bold float-left flex">Fotos sugeridas</p>
        <div class="mx-4 my-3 grid grid-cols-3 md:grid-cols-5 gap-4">
            <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
            <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                src="{{asset('storage/image/lodomens/layouts/FotoPerfil_01.png')}}"
                :class="{ ' !border-corp-50': activeItem === 1 }" alt=""
                @click="updateImage2, activeItem = 1">
            </div>
            <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
                <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                    src="{{asset('storage/image/lodomens/layouts/FotoPerfil_02.png')}}"
                    :class="{ ' !border-corp-50': activeItem === 2 }" alt=""
                    @click="updateImage2, activeItem = 2">
            </div>
            <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
                <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                    src="{{asset('storage/image/lodomens/layouts/FotoPerfil_03.png')}}"
                    :class="{ ' !border-corp-50': activeItem === 3 }" alt=""
                    @click="updateImage2, activeItem = 3">
            </div>
            <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
                <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                    src="{{asset('storage/image/lodomens/layouts/FotoPerfil_04.png')}}"
                    :class="{ ' !border-corp-50': activeItem === 4 }" alt=""
                    @click="updateImage2, activeItem = 4">
            </div>
            <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
                <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                    src="{{asset('storage/image/lodomens/layouts/FotoPerfil_05.png')}}"
                    :class="{ ' !border-corp-50': activeItem === 5 }" alt=""
                    @click="updateImage2, activeItem = 5">
            </div>

            <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
                <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                    src="{{asset('storage/image/lodomens/layouts/FotoPerfil_06.png')}}"
                    :class="{ ' !border-corp-50': activeItem === 6 }" alt=""
                    @click="updateImage2, activeItem = 6">
                </div>
                <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
                    <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                        src="{{asset('storage/image/lodomens/layouts/FotoPerfil_07.png')}}"
                        :class="{ ' !border-corp-50': activeItem === 7 }" alt=""
                        @click="updateImage2, activeItem = 7">
                </div>
                <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
                    <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                        src="{{asset('storage/image/lodomens/layouts/FotoPerfil_08.png')}}"
                        :class="{ ' !border-corp-50': activeItem === 8 }" alt=""
                        @click="updateImage2, activeItem = 8">
                </div>
                <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
                    <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                        src="{{asset('storage/image/lodomens/layouts/FotoPerfil_09.png')}}"
                        :class="{ ' !border-corp-50': activeItem === 9 }" alt=""
                        @click="updateImage2, activeItem = 9">
                </div>
                <div class="border-[1px] border-gris-70 rounded-full hover:border-transparent transition-all duration-300 ease-in-out" :class="{ ' !border-transparent': activeItem === 1 }">
                    <img class="rounded-full border-[3px] border-transparent hover:border-corp-50 w-[100px] h-[100px] cursor-pointer xyz transition-all duration-300 ease-in-out"
                        src="{{asset('storage/image/lodomens/layouts/FotoPerfil_10.png')}}"
                        :class="{ ' !border-corp-50': activeItem === 10 }" alt=""
                        @click="updateImage2, activeItem = 10">
                </div>


        </div>
        <div class="mx-4 mt-[19px] flex">
            <x-button.webprimary type="button" class="w-[140px] mx-auto"  @click="definiteImage">Aceptar</x-button.webprimary>
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
        <x-button.webprimary  type="button" class="w-[140px] mx-auto"  @click="cropAndCloseModal">Aceptar</x-button.webprimary>

        </div>
</div>
</div>
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css">
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.js"></script>

@endsection
