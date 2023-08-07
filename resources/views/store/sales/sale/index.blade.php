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
            <h3>Listado de ventas <a href="/ventas/venta/create"> <button class="btn btn-success">Crear</button></a>
            </h3>
            @include('store.sales.sale.search')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Comprobante</th>
                            <th>Impuesto</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->date_time }}</td>
                            <td>{{ $sale->name }}</td>
                            <td>{{ $sale->type_voucher . ': ' . $sale->serie_voucher . '-' . $sale->num_voucher }}
                            </td>
                            <td>{{ $sale->tax }}</td>
                            <td>{{ $sale->total_sale }}</td>
                            <td>{{ $sale->status ? 'A' : 'C' }}</td>
                            <td>
                                <a href="{{ URL::action('sisVentas\Http\Controllers\SaleController@show', $sale->idsale) }}">
                                    <button class="btn btn-info">Detalles</button>
                                </a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-delete{{ $sale->idsale }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        @include('store.sales.sale.modal')
                    @endforeach

                </table>
            </div>
            {{ $sales->render() }}
        </div>
    </div>
@endsection
