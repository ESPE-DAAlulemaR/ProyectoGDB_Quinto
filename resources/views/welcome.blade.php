@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Grupo 6</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-6">
            <ul>
                <li>Alulema Dannyel</li>
                <li>Manzaba Jeyner</li>
                <li>Pacheco Nataly</li>
            </ul>
        </div>

        <div class="col-6">
            @if (auth()->check())
                @if ($zoo['master'])
                    <h3>Zoo</h3>
                    @livewire('zoo-setter')
                @else
                    <h3>{{ $zoo['name'] }}</h3>
                @endif
            @else
                <h3>Debe de iniciar sesión</h3>
                <a href="{{ route('login') }}" class="btn btn-sm btn-success">Ingresar</a>
            @endif
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }
    </style>
@stop

@section('js')
    @if (!auth()->check())
        <script>
            hideMenu();
        </script>
    @endif
@stop
