@extends('adminlte::page')

@section('title', 'Especies')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Especies</h1>
        <h5>{{ session('zooArr')['name'] }}</h5>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        @if (session('message'))
            <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                <p>{{ session('message') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php session()->forget([ 'message', 'type' ]); @endphp
        @endif
        <div class="accordion my-3" id="accordionExample">
            @if (!isset($specie))
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#specieWithCaregiver" aria-expanded="false" aria-controls="specieWithCaregiver"
                                style="font-size: 20px">
                                Formulario de Especie y Cuidador
                            </button>
                        </h2>
                    </div>
                    <div id="specieWithCaregiver" class="collapse {{ session('whithCaregiver') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <form action="{{ route('specie.caregiver.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6 border-right px-3">
                                        <div class="d-flex justify-content-center">
                                            <h4 class="px-2 pb-1" style="border-bottom: 3px solid #dc3545; !important">Especie</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 form-group">
                                                <label for="habitat_id">Habitats</label>
                                                <select class="form-control{{ $errors->has('habitat_id') ? ' is-invalid' : '' }}"
                                                    name="habitat_id" id="habitat_id"
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
                                            <div class="col-6 form-group">
                                                <label for="zone_id">Zona</label>
                                                <select class="form-control{{ $errors->has('zone_id') ? ' is-invalid' : '' }}" name="zone_id"
                                                    id="zone_id" value="{{ isset($specie) ? $specie->zone_id : old('zone_id') }}">
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
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                id="name" name="name" value="{{ isset($specie) ? $specie->name : old('name') }}">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="scientific_name">Nombre Científico</label>
                                            <input type="text"
                                                class="form-control{{ $errors->has('scientific_name') ? ' is-invalid' : '' }}"
                                                id="scientific_name" name="scientific_name"
                                                value="{{ isset($specie) ? $specie->scientific_name : old('scientific_name') }}">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('scientific_name') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Género</label>
                                            <input type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                                id="gender" name="gender"
                                                value="{{ isset($specie) ? $specie->gender : old('gender') }}">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('gender') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 px-3">
                                        <div class="d-flex justify-content-center">
                                            <h4 class="px-2 pb-1" style="border-bottom: 3px solid #dc3545; !important">Cuidador</h4>
                                        </div>

                                        <div class="form-group">
                                            <label for="caregiver_name">Nombre</label>
                                            <input type="text" class="form-control{{ $errors->has('caregiver_name') ? ' is-invalid' : '' }}" id="caregiver_name" name="caregiver_name"
                                                value="{{ isset($caregiver) ? $caregiver->name : old('caregiver_name') }}">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('caregiver_name') }}
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Direccion</label>
                                            <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" name="address"
                                                value="{{ isset($caregiver) ? $caregiver->address : old('address') }}">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('address') }}
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Número telefónico</label>
                                            <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" name="phone"
                                                value="{{ isset($caregiver) ? $caregiver->phone : old('phone') }}">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="start_date">Fecha de Inicio</label>
                                            <input type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" id="start_date" name="start_date"
                                                value="{{ isset($caregiver) ? $caregiver->start_date : old('start_date') }}">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('start_date') }}
                                                </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="col mt-3 btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#specieOnly" aria-expanded="true" aria-controls="specieOnly"
                            style="font-size: 20px">
                            Formulario de Especie
                        </button>
                    </h2>
                </div>

                <div id="specieOnly" class="collapse  {{ session('whithCaregiver') ? '' : 'show' }}" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body p-3">
                        @if (!isset($specie))
                            <form action="{{ route('species.store') }}" method="POST">
                            @else
                                {!! Form::model($specie, ['route' => ['species.update', 'species' => $specie->id], 'method' => 'PUT']) !!}
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-4 form-group">
                                <label for="caregiver_id">Cuidador</label>
                                <select class="form-control{{ $errors->has('caregiver_id') ? ' is-invalid' : '' }}"
                                    name="caregiver_id" id="caregiver_id"
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
                            <div class="col-4 form-group">
                                <label for="habitat_id">Habitats</label>
                                <select class="form-control{{ $errors->has('habitat_id') ? ' is-invalid' : '' }}"
                                    name="habitat_id" id="habitat_id"
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
                            <div class="col-4 form-group">
                                <label for="zone_id">Zona</label>
                                <select class="form-control{{ $errors->has('zone_id') ? ' is-invalid' : '' }}" name="zone_id"
                                    id="zone_id" value="{{ isset($specie) ? $specie->zone_id : old('zone_id') }}">
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
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                id="name" name="name" value="{{ isset($specie) ? $specie->name : old('name') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="scientific_name">Nombre Científico</label>
                            <input type="text"
                                class="form-control{{ $errors->has('scientific_name') ? ' is-invalid' : '' }}"
                                id="scientific_name" name="scientific_name"
                                value="{{ isset($specie) ? $specie->scientific_name : old('scientific_name') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('scientific_name') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender">Género</label>
                            <input type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                id="gender" name="gender"
                                value="{{ isset($specie) ? $specie->gender : old('gender') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </div>
                        </div>

                        <div class="row">
                            <button type="submit" class="col btn btn-success">Guardar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row collapse width my-3 show" id="specieOnly">
            <div class="col-12">

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop

@if (session('whithCaregiver') && session('whithCaregiver') != null && is_bool(session('whithCaregiver')))
    @php session()->forget('whithCaregiver'); @endphp
@endif
