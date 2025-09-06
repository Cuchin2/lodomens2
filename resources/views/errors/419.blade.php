@extends('layouts.web')

@section('breadcrumb')
<div class="h-10 bg-gris-90 absolute w-full lg:top-[84px]"></div>
@endsection

@section('content')
<div class="flex w-full 2xl:min-h-[374px] lg:min-h-[278px] md:mt-1 mt-[80px]">
  <div class="bg-gris-90 w-fit rounded-[3px] p-6 mb-12 text-center lg:mx-auto h-fit mx-auto">
      <h1>419</h1>
      <h4>Sesión caducada</h4>
      <p class="mt-2">
          Ups... tu sesión acaba de expirar por inactividad o por seguridad.
          </p>
       <p class="mt-2">
          Serás redirigido automáticamente al inicio en
      </p>
      <p class="mt-2">
      <span id="countdown" class="font-bold text-[32px]">10</span>
      </p >
      <p class="mt-2">
         segundos.
      </p>
      <div class="mt-12 select-none flex justify-center">
        <a href="{{ route('root') }}">
            <x-button.webprimary class="w-fit">Volver al inicio ahora</x-button.webprimary>
        </a>
      </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    let seconds = 10;
    const countdownEl = document.getElementById('countdown');
    const timer = setInterval(() => {
        seconds--;
        countdownEl.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(timer);
            window.location.href = "{{ route('root') }}";
        }
    }, 1000);
</script>
@endpush
