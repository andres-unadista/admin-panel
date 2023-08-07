@extends('layouts.admin')

@section('content')
    <div class="row">
        <h3>Editar {{ $provider->name }} </h3>
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
    {!! Form::model($provider, [
        'method' => 'PATCH',
        'route' => ['sales.provider.update', $provider->idperson],
    ]) !!}
    {!! Form::token() !!}
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" required value="{{ $provider->name }}"
                    placeholder="Nombre...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="type_document">Tipo de documento</label>
                <select name="type_document" id="type_document" class="form-control">
                    <option value="TI" @if ($provider->type_document === 'TI') selected @endif>TI</option>
                    <option value="CC" @if ($provider->type_document === 'CC') selected @endif>CC</option>
                    <option value="NIT" @if ($provider->type_document === 'NIT') selected @endif>NIT</option>
                    <option value="TE" @if ($provider->type_document === 'TE') selected @endif>TE</option>
                    <option value="CE" @if ($provider->type_document === 'CE') selected @endif>CE</option>
                    <option value="PAS" @if ($provider->type_document === 'PAS') selected @endif>PAS</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="num_document">Número de documento</label>
                <input type="text" class="form-control" name="num_document" id="num_document" required
                    value="{{ $provider->num_document }}" placeholder="Número de documento...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="tel">Teléfono</label>
                <input type="number" class="form-control" name="tel" id="tel" value="{{ $provider->tel }}"
                    placeholder="#">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $provider->email }}"
                    placeholder="@">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ $provider->address }}"
                    placeholder="Dirección...">
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
