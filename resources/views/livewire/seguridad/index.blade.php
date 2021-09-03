@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @livewire('seguridad')
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
