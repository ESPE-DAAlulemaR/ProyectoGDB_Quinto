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
                    @if (!isset($caregiver))
                        <form action="{{ route('caregivers.store') }}" method="POST">
                        @else
                            {!! Form::model($caregiver, [
                                'route' => ['caregivers.update', 'caregiver' => $caregiver->id],
                                'method' => 'PUT',
                            ]) !!}
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($caregiver) ? $caregiver->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Direccion</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ isset($caregiver) ? $caregiver->address : old('address') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Número telefónico</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ isset($caregiver) ? $caregiver->phone : old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ isset($caregiver) ? $caregiver->start_date : old('start_date') }}">
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
