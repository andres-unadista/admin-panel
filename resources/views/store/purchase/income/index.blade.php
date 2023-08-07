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
            <h3>Listado de ingresos <a href="/compras/ingresos/create"> <button class="btn btn-success">Crear</button></a>
            </h3>
            @include('store.purchase.income.search')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Comprobante</th>
                            <th>Impuesto</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($incomes as $income)
                        <tr>
                            <td>{{ $income->date_time }}</td>
                            <td>{{ $income->name }}</td>
                            <td>{{ $income->type_voucher . ': ' . $income->serie_voucher . '-' . $income->num_voucher }}
                            </td>
                            <td>{{ $income->tax }}</td>
                            <td>{{ $income->total }}</td>
                            <td>{{ $income->status ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <a
                                    href="{{ URL::action('sisVentas\Http\Controllers\IncomeController@show', $income->idincome) }}">
                                    <button class="btn btn-info">Detalles</button>
                                </a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-delete{{ $income->idincome }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        @include('store.purchase.income.modal')
                    @endforeach

                </table>
            </div>
            {{ $incomes->render() }}
        </div>
    </div>
@endsection
