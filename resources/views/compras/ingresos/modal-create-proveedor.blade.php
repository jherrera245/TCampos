<form action="/ingresos/create/proveedor" method="post">
    @csrf
    <div class="modal fade" id="modal-proveedor">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registro de Proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombres" id="nombres"
                                    placeholder="Nombre del proveedor" maxLength="75">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" name="apellidos" id="nombres"
                                    placeholder="Apellido del proveedor" maxLength="75">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="nacimiento" id="nacimiento">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="dui">DUI</label>
                                <input type="text" class="form-control" name="dui" id="dui"
                                    placeholder="DUI del proveedor" pattern="[0-9]{8}-[0-9]{1}" maxLength="10">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono"
                                    placeholder="Telefono del proveedor" pattern="[0-9]{4}-[0-9]{4}" maxLength="9">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email del proveedor">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="direccion">Direcci??n</label>
                                <textarea type="text" class="form-control" name="direccion" id="direccion"
                                    placeholder="Direcci??n del proveedor" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>