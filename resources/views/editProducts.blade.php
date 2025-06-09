@extends('baseLayout.layout')

@section('title', 'Editar')

@section('content')
    @include("productsComponent.productCode")
    @section('scripts')
        @include("extraComponents.inputMask")
    @endsection
@endsection
