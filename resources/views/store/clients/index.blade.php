@extends('layouts.admin')

@section('styles')
    <style>
        td {
            color: black;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Listado de clientes <a href="/ventas/cliente/create"> <button class="btn btn-success">Crear</button></a></h3>
            @include('store.clients.search')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Tipo documento</th>
                            <th>Número de documento</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->idperson }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->type_document }}</td>
                            <td>{{ $client->num_document }}</td>
                            <td>{{ $client->tel }}</td>
                            <td>{{ $client->email }}</td>
                            <td>
                                <a href="{{ route('sales.client.edit', $client->idperson) }}">
                                    <button class="btn btn-info">Editar</button>
                                </a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-delete{{ $client->idperson }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        @include('store.clients.modal')
                    @endforeach

                </table>
            </div>
            {{ $clients->render() }}
        </div>
    </div>
@endsection
