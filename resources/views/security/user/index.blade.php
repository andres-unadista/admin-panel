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
            <h3>Listado de usuarios <a href="{{ route('security.user.create') }}"> <button
                        class="btn btn-success">Crear</button></a></h3>
            @include('security.user.search')
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
                            <th>Correo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="text-capitalize">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('security.user.edit', $user->id) }}">
                                    <button class="btn btn-info">Editar</button>
                                </a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-delete{{ $user->id }}">
                                    Eliminar
                                </button>

                        </tr>
                        @include('security.user.modal')
                    @endforeach

                </table>
            </div>
            {{ $users->render() }}
        </div>
    </div>
@endsection
