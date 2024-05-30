@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Perfil">
    <x-breadcrumb.lodomens.breadcrumb2 name='Perfil' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection

{{--  <x-lodomens.video />  --}}
@section('content')

<x-menu.sidebar>
    <livewire:personal-data />
</x-menu.sidebar>


@endsection
