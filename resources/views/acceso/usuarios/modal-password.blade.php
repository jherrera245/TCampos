<form action="/password-update/{{$usuario->id}}" method="post">
    @csrf
    @method('PUT')
    <!-- Modal -->
     <div class="modal fade" id="user-modal-password" tabindex="-1" role="dialog" aria-labelledby="user-modal-password"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="user-modal-password">Ingresa tus nuevas Credenciales</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Ingresa la contraseña" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Ingresa nuevamente la contraseña" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</form>