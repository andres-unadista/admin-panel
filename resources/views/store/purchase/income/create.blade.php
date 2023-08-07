@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Nuevo Ingreso</h3>
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
    {!! Form::open(['route' => 'sales.income.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
    {!! Form::token() !!}
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="form-group">
                <label for="name">Proveedor</label>
                <select class="form-control selectpicker" name="idprovider" id="name" data-live-search="true">
                    @foreach ($people as $person)
                        <option value="{{ $person->idperson }}">{{ $person->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="serie_voucher">Serie de comprobante</label>
                <input type="text" class="form-control" name="serie_voucher" id="serie_voucher" required
                    value="{{ old('serie_voucher') }}" placeholder="Serie de comprobante...">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label for="num_voucher">Número de comprobante</label>
                <input type="text" class="form-control" name="num_voucher" id="num_voucher" required
                    value="{{ old('num_voucher') }}" placeholder="Número de comprobante...">
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="type_voucher">Tipo de comprobante</label>
                <select name="type_voucher" id="type_voucher" class="form-control">
                    <option value="boleta">boleta</option>
                    <option value="factura">factura</option>
                    <option value="ticket">ticket</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel">
            <div class="panel-primary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="type_voucher">Artículo</label>
                                <select id="pidarticle" class="form-control selectpicker" name="pidarticle"
                                    data-live-search="true">
                                    @foreach ($articles as $article)
                                        <option value="{{ $article->idarticle }}">{{ $article->article }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="pquantity">Cantidad</label>
                                <input type="number" class="form-control" name="pquantity" id="pquantity"
                                    placeholder="cantidad...">
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="ppurchase">Precio compra</label>
                                <input type="number" class="form-control" name="ppurchase" id="ppurchase"
                                    placeholder="Precio compra...">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="pselling">Precio venta</label>
                                <input type="number" class="form-control" name="pselling" id="pselling"
                                    placeholder="Precio venta...">
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <button class="btn btn-primary" id="btn_add" type="button">Agregar</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Artículo</th>
                                        <th>Cantidad</th>
                                        <th>Precio compra</th>
                                        <th>Precio venta</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <h4 id="total">$0.00</h4>
                                        </th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 form-group" id="btn_save">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
    </div>
    {!! Form::close() !!}

    @push('javascript')
        <script>
            let total = 0
            let subtotal = 0
            let counter = 0
            let data_subtotal = []

            $(document).ready(function() {
                $('#btn_add').click(function() {
                    add();
                })
            })

            function add() {
                let idarticle = $('#pidarticle').val()
                let article = $('#pidarticle option:selected').text()
                let quantity = $('#pquantity').val()
                let purchase = $('#ppurchase').val()
                let selling = $('#pselling').val()

                if (idarticle.length && article.length && quantity.length && purchase.length && selling.length) {
                    data_subtotal[counter] = (quantity * purchase)
                    total += +data_subtotal[counter]
                    console.log(total);
                    let row = `<tr class="selected" id="row${counter}">
                     <td><button class="btn btn-warning" onclick="remove(${counter})">X</button></td>
                     <td><input type="hidden" name="idarticle[]" value="${idarticle}"/>${article}</td>
                     <td><input type="hidden" name="quantity[]" value="${quantity}"/>${quantity}</td>
                     <td><input type="hidden" name="purchase[]" value="${purchase}"/>${purchase}</td>
                     <td><input type="hidden" name="selling[]" value="${selling}"/>${selling}</td>
                     <td>${data_subtotal[counter]}</td>
                 </tr>`;
                    counter++;
                    clean();
                    $('#total').html(`$${total}`)
                    showButtons();
                    $('#details').append(row)
                } else {
                    alert('Error al ingresar detalle de ingreso, por favor revisar el formulario.')
                }
            }

            function remove(index) {
                total -= data_subtotal[index]
                $('#total').html(`$${total}`)
                $('#row' + index).remove()
                showButtons();
            }

            function showButtons() {
                if (total > 0) {
                    $('#btn_save').show();
                } else {
                    $('#btn_save').hide();
                }
            }

            function clean() {
                $('#pquantity').val('')
                $('#ppurchase').val('')
                $('#pselling').val('')
            }
        </script>
    @endpush
@endsection
