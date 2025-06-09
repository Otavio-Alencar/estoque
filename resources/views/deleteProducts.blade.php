@extends('baseLayout.layout')

@section('title', 'Excluir')

@section('content')
    @include("productsComponent.productCode")
    @section('scripts')
        @include("extraComponents.inputMask")
    @endsection
@endsection
