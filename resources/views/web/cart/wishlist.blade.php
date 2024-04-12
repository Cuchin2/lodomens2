@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Favoritos">
    <x-breadcrumb.lodomens.breadcrumb2 name='Favoritos' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection

<x-lodomens.video />
@section('content')

<livewire:wishlist-cart />

@endsection
