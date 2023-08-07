@extends('layouts.admin')

@section('content')
    <div class="row">
        <h3>Editar {{ $article->name }} </h3>
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
    {!! Form::model($article, [
        'method' => 'PATCH',
        'route' => ['articulo.update', $article->idcategory],
        'files' => 'true',
    ]) !!}
    {!! Form::token() !!}
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" required value="{{ $article->name }}"
                    placeholder="Nombre...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="idcategory">Categoría</label>
                <select name="idcategory" id="idcategory" class="form-control">
                    @foreach ($categories as $category)
                        @if ($category->idcategory === $article->idcategory)
                            <option value="{{ $category->idcategory }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->idcategory }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="code">Código</label>
                <input type="text" class="form-control" name="code" id="code" required
                    value="{{ $article->code }}" placeholder="Código...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="stock">Existencias</label>
                <input type="text" class="form-control" name="stock" id="stock" required
                    value="{{ $article->stock }}" placeholder="Stock...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description" required placeholder="Stock...">{{ $article->description }}</textarea>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="description">Imagen</label>
                <input type="file" class="form-control" name="image" />
                @if (!empty($article->image))
                    <img src="{{ asset('images/articles/' . $article->image) }}" alt="{{ $article->name }}" width="200"
                        height="200">
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <button class="btn btn-success" type="submit">Actualizar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
@endsection
