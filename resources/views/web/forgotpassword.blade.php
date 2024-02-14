@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Registro">
    <x-breadcrumb.lodomens.breadcrumb2 name='Registro' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection
<x-lodomens.video />
@section('content')
<div class="lg:p-[39px] px-[10px] py-[70px]">
<x-box title='Restaurar contraseña' href="{{ url()->previous() }}">
    @include('layouts.forgot_password')
</x-box>
</div>

@endsection
