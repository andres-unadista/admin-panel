@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Detalles Ingreso - {{ $income->idincome }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="form-group">
                <label for="name">Proveedor</label>
                <p>{{ $income->name }}</p>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="serie_voucher">Serie de comprobante</label>
                <p>{{ $income->serie_voucher }}</p>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="num_voucher">Número de comprobante</label>
                <p>{{ $income->num_voucher }}</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="type_voucher">Tipo de comprobante</label>
                <p>{{ $income->type_voucher }}</p>
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
                                        <th>Precio compra</th>
                                        <th>Precio venta</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail->article }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>{{ $detail->price_purchase }}</td>
                                            <td>{{ $detail->price_sale }}</td>
                                            <td>{{ $detail->price_purchase * $detail->quantity }}</td>
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
                                            <h4 id="total">{{ $income->total }}</h4>
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
