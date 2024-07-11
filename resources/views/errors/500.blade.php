@extends('layouts.web')

@section('breadcrumb')
<div class="h-10 bg-gris-90 absolute w-full lg:top-[84px]"></div>
@endsection

@section('content')
<div class="flex w-full 2xl:min-h-[374px] lg:min-h-[278px] md:mt-1 mt-[80px]">
<div class="bg-gris-90 w-fit rounded-[3px]  p-6 mb-12 text-center lg:mx-auto h-fit mx-auto">
    <h1>500</h1>
    <h4 class="mb-4">Error interno del servidor</h4>
    <p1>Lo sentimos, esta página no funciona</p1>
  <p1>Trate de volver a cargar esta página o ponte en contacto con nosotros</p1>
  <div class="mt-8 select-none flex justify-center">
    <a href="{{ route('root') }}">
        <x-button.webprimary  class="w-fit" >Volver al inicio</x-button.webprimary>
    </a>
   </div>
</div>
</div>

@endsection

@push('scripts')

@endpush
