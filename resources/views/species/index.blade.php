@extends('adminlte::page')

@section('title', 'Especies')

@section('content_header')
    <h1>Especies</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('species.create') }}" class="btn btn-primary btn-sm">
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
                                    <th>Nombre científico</th>
                                    <th>Género</th>
                                    <th>Cuidador</th>
                                    <th>Habitat</th>
                                    <th>Zona</th>
                                    <th>Prueba</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($species as $specie)
                                    <tr>
                                        <td>{{ $specie->name }}</td>
                                        <td>{{ $specie->scientific_name }}</td>
                                        <td>{{ $specie->gender }}</td>
                                        <td>{{ $specie->caregiver }}</td>
                                        <td>{{ $specie->habitat }}</td>
                                        <td>{{ $specie->zone }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('species.edit', ['species' => $specie->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                {!! Form::open([ 'route' => [ 'species.destroy', ['species' => $specie->id]], 'method' => 'DELETE' ]) !!}
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
