@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Detalle venta - {{ $sale->idsale }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="form-group">
                <label for="name">Cliente</label>
                <p>{{ $sale->name }}</p>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="serie_voucher">Serie de comprobante</label>
                <p>{{ $sale->serie_voucher }}</p>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="num_voucher">Número de comprobante</label>
                <p>{{ $sale->num_voucher }}</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="type_voucher">Tipo de comprobante</label>
                <p>{{ $sale->type_voucher }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel">
            <div class="panel-primary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Artículo</th>
                                        <th>Cantidad</th>
                                        <th>Precio venta</th>
                                        <th>Descuento</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail->article }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>{{ $detail->price_sale }}</td>
                                            <td>{{ $detail->discount }}</td>
                                            <td>{{ $detail->price_sale * $detail->quantity - $detail->discount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <h4 id="total">{{ $sale->total_sale }}</h4>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
