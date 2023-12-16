@extends('layouts.web')

@section('content')
<div class="h-[1000px] text-gris-90 md:mt-[84px] mt-[44px]">
<div class="w-full">
    <img src="{{ asset('image/lodomens/Banner_Carrusel_1.png') }}" alt="Lodomens">
</div>
<div class="grid md:grid-cols-2  col-span-1">
    <div class="col-12 md:col-6">
        <img src="{{ asset('image/lodomens/Banner_1.png') }}" alt="" srcset="">
    </div>
    <div class="col-12 md:col-6">
        <img src="{{ asset('image/lodomens/Banner_2.png') }}" alt="" srcset="">
    </div>
</div>
</div>
@endsection
