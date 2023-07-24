@extends('adminlte::page')

@section('title', 'Guías')

@section('content_header')
    <h1>Guías</h1>
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
                    @if (!isset($guide))
                        <form action="{{ route('guides.store') }}" method="POST">
                        @else
                            {!! Form::model($guide, ['route' => ['guides.update', 'guide' => $guide->id], 'method' => 'PUT']) !!}
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name"
                            value="{{ isset($guide) ? $guide->name : old('name') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Direccion</label>
                        <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" name="address"
                            value="{{ isset($guide) ? $guide->address : old('address') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Número telefónico</label>
                        <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" name="phone"
                            value="{{ isset($guide) ? $guide->phone : old('phone') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email"
                            value="{{ isset($guide) ? $guide->email : old('email') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Fecha de Inicio</label>
                        <input type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" id="start_date" name="start_date"
                            value="{{ isset($guide) ? $guide->start_date : old('start_date') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('start_date') }}
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
