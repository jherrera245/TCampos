@extends('layouts.admin')

@section('contenido')

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardUsuario" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardUsuario">
                <h6 class="m-0 font-weight-bold text-primary">Actualización de Perfil</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardUsuario">
                <div class="card-body">
                    <h5>Perfil de: {{$usuario->name}}</h5>

                    <form action="/profile/{{$usuario->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" name="name" value="{{$usuario->name}}" placeholder="Ingresa el username" required>
                            </div>
                            
                            <div class="col-lg-12 col-xs-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$usuario->email}}" placeholder="Ingresa el correo del usuario" required>
                            </div>
                        </div>

                        <a href="/home" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actulizar Perfil</button>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#user-modal-password">Cambiar Contraseña</button>
                    </form>

                    @include('acceso.usuarios.modal-password')

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
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
