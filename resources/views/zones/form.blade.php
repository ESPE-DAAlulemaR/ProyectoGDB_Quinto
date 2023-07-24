@extends('adminlte::page')

@section('title', 'Zonas')

@section('content_header')
    <h1>Zonas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-3">
                    @if (!isset($zone))
                        <form action="{{ route('zones.store') }}" method="POST">
                    @else
                        {!! Form::model($zone, [ 'route' => [ 'zones.update', 'zone' => $zone->id ], 'method' => 'PUT' ]) !!}
                    @endif
                    @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ isset($zone) ? $zone->name : old('name') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="extension">Extensión</label>
                            <input type="text" class="form-control{{ $errors->has('extension') ? ' is-invalid' : '' }}" id="extension" name="extension" value="{{ isset($zone) ? $zone->extension : old('extension') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('extension') }}
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
