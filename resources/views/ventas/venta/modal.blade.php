<form action="/ingresos/{{$ingreso->id}}" method="post">
    @csrf
    @method('DELETE')
    <div  class="modal fade" id="ingreso-modal-{{$ingreso->id}}" tabindex="-1" role="dialog" 
        aria-labelledby="ingreso-modal-{{$ingreso->id}}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Estado del ingreso</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro que desea cancelar el ingreso?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>