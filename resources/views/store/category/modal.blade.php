<div class="modal fade" id="modal-delete{{ $category->idcategory }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    {{ Form::Open(['action' => ['sisVentas\Http\Controllers\CategoryController@destroy', $category->idcategory], 'method' => 'DELETE']) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirmación de remoción de categoría</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{ Form::Close() }}
</div>
