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
                        <select class="form-control" name="guide_id" id="guide_id"
                            value="{{ isset($itinerary) ? $itinerary->guide_id : old('guide_id') }}">
                            @if (!isset($itinerary))
                                <option selected>Seleccione...</option>
                            @endif
                            @foreach ($guides as $guide)
                                <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="zone_id">Zona</label>
                        <select class="form-control" name="zone_id" id="zone_id"
                            value="{{ isset($itinerary) ? $itinerary->zone_id : old('zone_id') }}">
                            @if (!isset($itinerary))
                                <option selected>Seleccione...</option>
                            @endif
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duración</label>
                        <input type="text" class="form-control" id="duration" name="duration"
                            value="{{ isset($itinerary) ? $itinerary->duration : old('duration') }}">
                    </div>
                    <div class="form-group">
                        <label for="max_visitors">Maxima capacidad de visitantes</label>
                        <input type="number" class="form-control" id="max_visitors" name="max_visitors"
                            value="{{ isset($itinerary) ? $itinerary->max_visitors : old('max_visitors') }}">
                    </div>
                    <div class="form-group">
                        <label for="start_time">Hora de Inicio</label>
                        <input type="time" class="form-control" id="start_time" name="start_time"
                            value="{{ isset($itinerary) ? $itinerary->start_time : old('start_time') }}">
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