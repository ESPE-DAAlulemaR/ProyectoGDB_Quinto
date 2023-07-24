@extends('adminlte::page')

@section('title', 'Itinerarios')

@section('content_header')
    <h1>Itinerarios</h1>
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
                    @if (!isset($itinerary))
                        <form action="{{ route('itineraries.store') }}" method="POST">
                        @else
                            {!! Form::model($itinerary, [
                                'route' => ['itineraries.update', 'itinerary' => $itinerary->id],
                                'method' => 'PUT',
                            ]) !!}
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="guide_id">Guía</label>
                        <select class="form-control{{ $errors->has('guide_id') ? ' is-invalid' : '' }}" name="guide_id" id="guide_id"
                            value="{{ isset($itinerary) ? $itinerary->guide_id : old('guide_id') }}">
                            @if (!isset($itinerary))
                                <option selected>Seleccione...</option>
                            @endif
                            @foreach ($guides as $guide)
                                <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('guide_id') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zone_id">Zona</label>
                        <select class="form-control{{ $errors->has('zone_id') ? ' is-invalid' : '' }}" name="zone_id" id="zone_id"
                            value="{{ isset($itinerary) ? $itinerary->zone_id : old('zone_id') }}">
                            @if (!isset($itinerary))
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
                        <label for="duration">Duración</label>
                        <input type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" id="duration" name="duration"
                            value="{{ isset($itinerary) ? $itinerary->duration : old('duration') }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('duration') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="max_visitors">Maxima capacidad de visitantes</label>
                        <input type="number" class="form-control{{ $errors->has('max_visitors') ? ' is-invalid' : '' }}" id="max_visitors" name="max_visitors"
                            value="{{ isset($itinerary) ? $itinerary->max_visitors : old('max_visitors') }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('max_visitors') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Hora de Inicio</label>
                        <input type="time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" id="start_time" name="start_time"
                            value="{{ isset($itinerary) ? $itinerary->start_time : old('start_time') }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('start_time') }}
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
