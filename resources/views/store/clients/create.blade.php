@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Crear Cliente</h3>
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
    {!! Form::open(['route' => 'sales.client.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
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
                <label for="type_document">Tipo de documento</label>
                <select name="type_document" id="type_document" class="form-control">
                    <option value="TI">TI</option>
                    <option value="CC">CC</option>
                    <option value="NIT">NIT</option>
                    <option value="TE">TE</option>
                    <option value="CE">CE</option>
                    <option value="PAS">PAS</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="num_document">Número de documento</label>
                <input type="text" class="form-control" name="num_document" id="num_document" required
                    value="{{ old('num_document') }}" placeholder="Número de documento...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="tel">Teléfono</label>
                <input type="number" class="form-control" name="tel" id="tel" value="{{ old('tel') }}"
                    placeholder="#">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
                    placeholder="@">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}"
                    placeholder="Dirección...">
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
