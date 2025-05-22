@extends('baseLayout.layout')

@section('title', 'Produtos')

@section('content')
    @include("productsComponent.productsContentWrapper")

    @section('scripts')
        @include("extraComponents.table")
    @endsection
@endsection

