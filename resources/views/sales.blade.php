@extends('baseLayout.layout')

@section('title', 'Estoque')

@section('content')
    @include('salesComponents.salesContentWrapper')
    @section('scripts')
        @include("extraComponents.inputMask")
    @endsection
@endsection
