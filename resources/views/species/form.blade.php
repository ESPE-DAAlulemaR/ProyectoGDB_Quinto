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
                    @if (!isset($specie))
                        <form action="{{ route('species.store') }}" method="POST">
                        @else
                            {!! Form::model($specie, ['route' => ['species.update', 'species' => $specie->id], 'method' => 'PUT']) !!}
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="caregiver_id">Cuidador</label>
                        <select class="form-control" name="caregiver_id" id="caregiver_id"
                            value="{{ isset($specie) ? $specie->caregiver_id : old('caregiver_id') }}">
                            @if (!isset($specie))
                                <option selected>Seleccione...</option>
                            @endif
                            @foreach ($caregivers as $caregiver)
                                <option value="{{ $caregiver->id }}">{{ $caregiver->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="habitat_id">Habitats</label>
                        <select class="form-control" name="habitat_id" id="habitat_id"
                            value="{{ isset($habitat_id) ? $specie->habitat_id : old('habitat_id') }}">
                            @if (!isset($specie))
                                <option selected>Seleccione...</option>
                            @endif
                            @foreach ($habitats as $habitat)
                                <option value="{{ $habitat->id }}">{{ $habitat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="zone_id">Zona</label>
                        <select class="form-control" name="zone_id" id="zone_id"
                            value="{{ isset($specie) ? $specie->zone_id : old('zone_id') }}">
                            @if (!isset($specie))
                                <option selected>Seleccione...</option>
                            @endif
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($specie) ? $specie->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="scientific_name">Nombre Científico</label>
                        <input type="text" class="form-control" id="scientific_name" name="scientific_name"
                            value="{{ isset($specie) ? $specie->scientific_name : old('scientific_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="gender">Género</label>
                        <input type="text" class="form-control" id="gender" name="gender"
                            value="{{ isset($specie) ? $specie->gender : old('gender') }}">
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
