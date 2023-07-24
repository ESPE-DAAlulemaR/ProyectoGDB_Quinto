@extends('adminlte::page')

@section('title', 'Especies')

@section('content_header')
    <h1>Especies</h1>
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
                        <select class="form-control{{ $errors->has('caregiver_id') ? ' is-invalid' : '' }}" name="caregiver_id" id="caregiver_id"
                            value="{{ isset($specie) ? $specie->caregiver_id : old('caregiver_id') }}">
                            @if (!isset($specie))
                                <option selected>Seleccione...</option>
                            @endif
                            @foreach ($caregivers as $caregiver)
                                <option value="{{ $caregiver->id }}">{{ $caregiver->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('caregiver_id') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="habitat_id">Habitats</label>
                        <select class="form-control{{ $errors->has('habitat_id') ? ' is-invalid' : '' }}" name="habitat_id" id="habitat_id"
                            value="{{ isset($habitat_id) ? $specie->habitat_id : old('habitat_id') }}">
                            @if (!isset($specie))
                                <option selected>Seleccione...</option>
                            @endif
                            @foreach ($habitats as $habitat)
                                <option value="{{ $habitat->id }}">{{ $habitat->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('habitat_id') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zone_id">Zona</label>
                        <select class="form-control{{ $errors->has('zone_id') ? ' is-invalid' : '' }}" name="zone_id" id="zone_id"
                            value="{{ isset($specie) ? $specie->zone_id : old('zone_id') }}">
                            @if (!isset($specie))
                                <option selected>Seleccione...</option>
                            @endif
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('zone_id') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name"
                            value="{{ isset($specie) ? $specie->name : old('name') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="scientific_name">Nombre Científico</label>
                        <input type="text" class="form-control{{ $errors->has('scientific_name') ? ' is-invalid' : '' }}" id="scientific_name" name="scientific_name"
                            value="{{ isset($specie) ? $specie->scientific_name : old('scientific_name') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('scientific_name') }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="gender">Género</label>
                        <input type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" id="gender" name="gender"
                            value="{{ isset($specie) ? $specie->gender : old('gender') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('gender') }}
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
