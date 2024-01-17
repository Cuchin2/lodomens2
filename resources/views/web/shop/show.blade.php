@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="TIENDA">
    <x-breadcrumb.lodomens.breadcrumb2 name='Tienda' href="{{ route('web.shop.index') }}"/>
    <x-breadcrumb.lodomens.breadcrumb2 name='{{$product->name}}' />
</x-breadcrumb.lodomens.breadcrumb>
     
@endsection

@section('content')


@endsection