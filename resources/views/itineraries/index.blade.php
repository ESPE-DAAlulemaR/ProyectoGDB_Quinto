@extends('adminlte::page')

@section('title', 'Itinerarios')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Itinerarios</h1>
        <h5>{{ session('zooArr')['name'] }}</h5>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('itineraries.create') }}" class="btn btn-primary btn-sm">
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
                                    <th>Guia</th>
                                    <th>Zona</th>
                                    <th>Duración</th>
                                    <th>Max. Visitantes</th>
                                    <th>Inico</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itineraries as $itinerary)
                                    <tr>
                                        <td>{{ $itinerary->guide }}</td>
                                        <td>{{ $itinerary->zone }}</td>
                                        <td>{{ $itinerary->duration }}</td>
                                        <td>{{ $itinerary->max_visitors }}</td>
                                        <td>{{ $itinerary->start_time }}</td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <span>...</span>
                                                {{--<a href="{{ route('itineraries.edit', ['itinerary' => $itinerary->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                {!! Form::open([ 'route' => [ 'itineraries.destroy', ['itinerary' => $itinerary->id]], 'method' => 'DELETE' ]) !!}
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                {!! Form::close() !!}--}}
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
