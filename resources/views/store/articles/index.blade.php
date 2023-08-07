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
            <h3>Listado de artículos <a href="articulo/create"> <button class="btn btn-success">Crear</button></a></h3>
            @include('store.articles.search')
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
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->idarticle }}</td>
                            <td>{{ $article->name }}</td>
                            <td>{{ $article->code }}</td>
                            <td>{{ $article->category }}</td>
                            <td>{{ $article->stock }}</td>
                            <td>
                                <img src="{{ asset('images/articles/' . $article->image) }}" alt="{{ $article->name }}"
                                    height="100" width="100" class="img-thumbnail">
                            </td>
                            <td>
                                {{ $article->status ? 'Activo' : 'Inactivo' }}
                            </td>
                            <td>
                                <a href="{{ route('articulo.edit', $article->idarticle) }}">
                                    <button class="btn btn-info">Editar</button>
                                </a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-delete{{ $article->idarticle }}">
                                    Eliminar
                                </button>
                        </tr>
                        @include('store.articles.modal')
                    @endforeach

                </table>
            </div>
            {{ $articles->render() }}
        </div>
    </div>
@endsection
