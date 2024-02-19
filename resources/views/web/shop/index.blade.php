@extends('layouts.web')
@section('breadcrumb')
<x-breadcrumb.lodomens.breadcrumb title="TIENDA">
    <x-breadcrumb.lodomens.breadcrumb2 name='Tienda' />
</x-breadcrumb.lodomens.breadcrumb>
@endsection
@section('content')
<x-lodomens.video />
<livewire:shop-main/>
@endsection
