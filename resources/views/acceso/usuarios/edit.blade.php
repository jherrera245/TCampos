@extends('layouts.admin')
@section('header')
Actualizar Usuarios
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Editar Usuario: {{$usuario->name}}
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/usuarios/{{$usuario->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" name="name" value="{{$usuario->name}}"
                                placeholder="Ingresa el username" required>
                        </div>

                        <div class="col-lg-6 col-xs-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{$usuario->email}}"
                                placeholder="Ingresa el correo del usuario" required>
                        </div>

                        <div class="col-lg-6 col-xs-12 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Ingresa la contraseña" required>
                        </div>

                        <div class="col-lg-6 col-xs-12 mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Ingresa nuevamente la contraseña" required>
                        </div>

                        <div class="col-lg-6 col-xs-12 mb-3">
                            <label for="admin" class="form-label">Seleccionar rol</label>
                            <div class="custom-control custom-switch">
                                @if($usuario->is_admin== 1)
                                <input type="checkbox" class="custom-control-input" name="admin" value="1" id="admin"
                                    checked>
                                <label class="custom-control-label" for="admin">Administrator</label>
                                @else
                                <input type="checkbox" class="custom-control-input" name="admin" value="1" id="admin">
                                <label class="custom-control-label" for="admin">Administrator</label>
                                @endif
                            </div>
                        </div>
                    </div>

                    <a href="/usuarios" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

@endsection