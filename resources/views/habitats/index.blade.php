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
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('habitats.create') }}" class="btn btn-primary btn-sm">
                            Nuevo
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session('message') && session('type') == 'success')
                            <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                                <p>{{ session('message') }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @php session()->forget([ 'message', 'type' ]); @endphp
                        @endif
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Clima</th>
                                    <th>Continente</th>
                                    <th>Vegetación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($habitats as $habitat)
                                    <tr>
                                        <td>{{ $habitat->name }}</td>
                                        <td>{{ $habitat->climate }}</td>
                                        <td>{{ $habitat->continent }}</td>
                                        <td>{{ $habitat->vegetation }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('habitats.edit', ['habitat' => $habitat->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                {!! Form::open([ 'route' => [ 'habitats.destroy', ['habitat' => $habitat->id]], 'method' => 'DELETE' ]) !!}
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $('#dataTable').dataTable();
    </script>
@stop
