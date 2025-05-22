@extends('baseLayout.layout')

@section('title', 'Adicionar')

@section('content')
    @include("productsComponent.addProductsContentWrapper")
    @section('scripts')
        @include("extraComponents.inputMask")
    @endsection
@endsection
