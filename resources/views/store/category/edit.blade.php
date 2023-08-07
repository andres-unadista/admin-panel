@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Editar {{ $category->name }} </h3>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($category, ['method' => 'PATCH', 'route' => ['categoria.update', $category->idcategory]]) !!}
            {!! Form::token() !!}
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" value="{{ $category->name }}" name="name" id="name"
                    placeholder="Nombre...">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" value="{{ $category->description }}" name="description"
                    id="description" placeholder="Descripción...">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Actualizar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
