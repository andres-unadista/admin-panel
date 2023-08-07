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
            <h3>Listado de proveedores <a href="/ventas/proveedor/create"> <button class="btn btn-success">Crear</button></a>
            </h3>
            @include('store.purchase.providers.search')
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
                    @foreach ($providers as $provider)
                        <tr>
                            <td>{{ $provider->idperson }}</td>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->type_document }}</td>
                            <td>{{ $provider->num_document }}</td>
                            <td>{{ $provider->tel }}</td>
                            <td>{{ $provider->email }}</td>
                            <td>
                                <a href="{{ route('sales.provider.edit', $provider->idperson) }}">
                                    <button class="btn btn-info">Editar</button>
                                </a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-delete{{ $provider->idperson }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        @include('store.purchase.providers.modal')
                    @endforeach

                </table>
            </div>
            {{ $providers->render() }}
        </div>
    </div>
@endsection
