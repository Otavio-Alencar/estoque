@extends('baseLayout.layout')

@section('title', 'Perfil')
@section('titlePage','perfil')
@section('page','perfil')
@section('content')
    @include('profileComponents.profileContentWrapper')
    @section('scripts')
        @include("extraComponents.nameEdit")
    @endsection

@endsection
