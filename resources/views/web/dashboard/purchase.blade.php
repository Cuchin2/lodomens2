@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Perfil">
    <x-breadcrumb.lodomens.breadcrumb2 name='Compras' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection

{{--  <x-lodomens.video />  --}}
@section('content')

<x-menu.sidebar>
    <livewire:web-purchase />
</x-menu.sidebar>


@endsection
