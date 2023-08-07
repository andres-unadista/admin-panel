@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Crear Artículo</h3>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    {!! Form::open(['url' => 'productos/articulo', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true']) !!}
    {!! Form::token() !!}
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" required value="{{ old('name') }}"
                    placeholder="Nombre...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="idcategory">Categoría</label>
                <select name="idcategory" id="idcategory" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->idcategory }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="code">Código</label>
                <input type="text" class="form-control" name="code" id="code" required
                    value="{{ old('code') }}" placeholder="Código...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="stock">Existencias</label>
                <input type="text" class="form-control" name="stock" id="stock" required
                    value="{{ old('stock') }}" placeholder="Stock...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description" required placeholder="Stock...">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="description">Imagen</label>
                <input type="file" class="form-control" name="image" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
