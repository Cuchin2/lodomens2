@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Carrito">
    <x-breadcrumb.lodomens.breadcrumb2 name='Carrito' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection

{{--  <x-lodomens.video />  --}}
@section('content')

<livewire:shopping-cart />

@endsection
