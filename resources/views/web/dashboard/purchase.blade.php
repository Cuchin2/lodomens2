@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Mi Cuenta">
    <x-breadcrumb.lodomens.breadcrumb2 name='Compras' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection

{{--  <x-lodomens.video />  --}}
@section('content')

<x-menu.sidebar>
    <livewire:web-purchase open="{{ $open }}" order_last="{{ $order_last }}"/>
</x-menu.sidebar>


@endsection
