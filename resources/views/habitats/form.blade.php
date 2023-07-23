@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-3">
                    @if (session('message'))
                        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                            <p>{{ session('message') }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @php session()->forget([ 'message', 'type' ]); @endphp
                    @endif
                    @if (!isset($habitat))
                        <form action="{{ route('habitats.store') }}" method="POST">
                        @else
                            {!! Form::model($habitat, ['route' => ['habitats.update', 'habitat' => $habitat->id], 'method' => 'PUT']) !!}
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($habitat) ? $habitat->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="climate">Clima</label>
                        <input type="text" class="form-control" id="climate" name="climate"
                            value="{{ isset($habitat) ? $habitat->climate : old('climate') }}">
                    </div>
                    <div class="form-group">
                        <label for="continent">Continente</label>
                        <input type="text" class="form-control" id="continent" name="continent"
                            value="{{ isset($habitat) ? $habitat->continent : old('continent') }}">
                    </div>
                    <div class="form-group">
                        <label for="vegetation">Vegetación</label>
                        <input type="text" class="form-control" id="vegetation" name="vegetation"
                            value="{{ isset($habitat) ? $habitat->vegetation : old('vegetation') }}">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
