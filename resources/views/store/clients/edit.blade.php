@extends('layouts.admin')

@section('content')
    <div class="row">
        <h3>Editar {{ $client->name }} </h3>
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
    {!! Form::model($client, [
        'method' => 'PATCH',
        'route' => ['sales.client.update', $client->idperson],
    ]) !!}
    {!! Form::token() !!}
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" required value="{{ $client->name }}"
                    placeholder="Nombre...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="type_document">Tipo de documento</label>
                <select name="type_document" id="type_document" class="form-control">
                    <option value="TI" @if ($client->type_document === 'TI') selected @endif>TI</option>
                    <option value="CC" @if ($client->type_document === 'CC') selected @endif>CC</option>
                    <option value="NIT" @if ($client->type_document === 'NIT') selected @endif>NIT</option>
                    <option value="TE" @if ($client->type_document === 'TE') selected @endif>TE</option>
                    <option value="CE" @if ($client->type_document === 'CE') selected @endif>CE</option>
                    <option value="PAS" @if ($client->type_document === 'PAS') selected @endif>PAS</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="num_document">Número de documento</label>
                <input type="text" class="form-control" name="num_document" id="num_document" required
                    value="{{ $client->num_document }}" placeholder="Número de documento...">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="tel">Teléfono</label>
                <input type="number" class="form-control" name="tel" id="tel" value="{{ $client->tel }}"
                    placeholder="#">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $client->email }}"
                    placeholder="@">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ $client->address }}"
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
