@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Crear categoría</h3>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(['url' => 'productos/categoria', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            {!! Form::token() !!}
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nombre...">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Descripción...">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
