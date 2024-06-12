@extends('layouts.web')

@section('main')
<div class=" text-gris-90 md:mt-[84px] mt-[44px]">
    <x-carrusel />
{{--      <div class="">
        <img src="{{ asset('image/lodomens/Banner_Carrusel_1.png') }}" class="w-full" alt="Lodomens">
    </div>  --}}
    <div class="grid grid-cols-2 col-span-1">
        <div class="col-6">
            <a href="https://www.youtube.com/watch?v=SI841UoThPM" target="__blank"> <img
                    src="{{ asset('image/lodomens/Banner_1.png') }}"
                    class="w-full md:border-[10px] border-black border-[3px]" alt="" srcset=""> </a>
        </div>
        <div class="col-6">
            <a href="#" target="__blank">
                <img src="{{ asset('image/lodomens/Banner_2.png') }}"
                    class="w-full md:border-[10px] border-black border-[3px]" alt="" srcset=""></a>
        </div>
    </div>
    <div class="grid col-span-1 md:grid-cols-2 bg-gris-10 md:py-[59px] lg:py-[90px] lg:px-[123px]">
        <div class="col-6 md:order-1 md:my-auto">
            <div class="mx-[44px] ">
                <img src="{{ asset('image/lodomens/Nosotros.png') }}" class="w-full my-[25px] md:my-0 ">
            </div>
        </div>
        <div class="col-6 left-0 text-justify font-[12px] mb-[29px]">
            <div class="mx-[44px] space-y-4 grid">
                <h1 class="mx-auto font-bold text-[14px] md:text-[20px] lg:text-[25px]">ACERCA DE NOSOTROS</h1>
                <p class="text-[12px] md:text-[14px] lg:text-[18px]">Somos una marca cuya propuesta busca el
                    empoderamiento masculino a través de la libre expresión de la imagen.</p>

                <p class="text-[12px] md:text-[14px] lg:text-[18px]"> La búsqueda del ideal de belleza como lenguaje de
                    comunicación a los otros, el expresarte libremente, el poder sentirte seguro de quien eres, permite
                    que tengamos un mundo con bellezas diversas donde la esencia personal es la que da vida a los
                    accesorios.</p>

                <p class="text-[12px] md:text-[14px] lg:text-[18px]"> Nuestra propuesta es completamente inclusiva
                    puesto que todos tenemos algo hermoso que enseñar al mundo.</p>

                <p class="text-[12px] md:text-[14px] lg:text-[18px]"> Eso que se considera diferente, puede ser el rasgo
                    mas importante que lo distingue.</p>
            </div>
        </div>

    </div>
</div>
@endsection
