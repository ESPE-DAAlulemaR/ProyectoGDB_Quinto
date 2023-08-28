@extends('adminlte::page')

@section('title', 'Habitats')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Habitats</h1>
        <h5>{{ session('zooArr')['name'] }}</h5>
    </div>
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
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name"
                            value="{{ isset($habitat) ? $habitat->name : old('name') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="climate">Clima</label>
                        <input type="text" class="form-control{{ $errors->has('climate') ? ' is-invalid' : '' }}" id="climate" name="climate"
                            value="{{ isset($habitat) ? $habitat->climate : old('climate') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('climate') }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="continent">Continente</label>
                        <input type="text" class="form-control{{ $errors->has('continent') ? ' is-invalid' : '' }}" id="continent" name="continent"
                            value="{{ isset($habitat) ? $habitat->continent : old('continent') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('continent') }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="vegetation">Vegetación</label>
                        <input type="text" class="form-control{{ $errors->has('vegetation') ? ' is-invalid' : '' }}" id="vegetation" name="vegetation"
                            value="{{ isset($habitat) ? $habitat->vegetation : old('vegetation') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('vegetation') }}
                            </div>
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
