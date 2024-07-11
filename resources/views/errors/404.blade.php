@extends('layouts.web')

@section('breadcrumb')
<div class="h-10 bg-gris-90 absolute w-full lg:top-[84px]"></div>
@endsection

@section('content')
<div class="flex w-full 2xl:min-h-[374px] lg:min-h-[278px] md:mt-1 mt-[80px]">
<div class="bg-gris-90 w-fit rounded-[3px]  p-6 mb-12 text-center lg:mx-auto h-fit mx-auto">
    <h1>404</h1>
    <h4>Página no encontrada</h4>
  <p>Lo sentimimos no se pudo encontrar la página que estas buscando</p>
  <div class="mt-12 select-none flex justify-center">
    <a href="{{ route('root') }}">
        <x-button.webprimary  class="w-fit" >Volver al inicio</x-button.webprimary>
    </a>
   </div>
</div>
</div>

@endsection

@push('scripts')

@endpush
