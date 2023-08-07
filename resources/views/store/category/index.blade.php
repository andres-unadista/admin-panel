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
            <h3>Listado de categorías <a href="categoria/create"> <button class="btn btn-success">Crear</button></a></h3>
            @include('store.category.search')
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
                            <th>Descripción</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->idcategory }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description ?? 'Sin descripción' }}</td>
                            <td>
                                <a href="{{ route('categoria.edit', $category->idcategory) }}">
                                    <button class="btn btn-info">Editar</button>
                                </a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-delete{{ $category->idcategory }}">
                                    Eliminar
                                </button>

                        </tr>
                        @include('store.category.modal')
                    @endforeach

                </table>
            </div>
            {{ $categories->render() }}
        </div>
    </div>
@endsection
