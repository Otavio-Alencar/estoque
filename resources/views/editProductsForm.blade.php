@extends('baseLayout.layout')

@section('title', 'editar')

@section('content')
    @include("productsComponent.editProductsContentWrapper")
    @section('scripts')
        @include("extraComponents.inputMask")
    @endsection
@endsection
