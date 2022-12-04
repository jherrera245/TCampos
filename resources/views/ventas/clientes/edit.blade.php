@extends('layouts.admin')
@section('header')
Nuevo Cliente
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Editar cliente: {{$clientes->nombres}}
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/clientes/{{$clientes->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" value="{{$clientes->nombres}}" name="nombres" id="nombres" 
                                placeholder="Nombre del cliente" maxLength="75" >
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" value="{{$clientes->apellidos}}" name="apellidos" id="nombres" 
                                placeholder="Apellido del cliente" maxLength="75">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="nacimiento" value="{{$clientes->fecha_nacimiento}}" id="nacimiento">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="dui">DUI</label>
                                <input type="text" class="form-control" value="{{$clientes->dui}}" name="dui" id="dui" 
                                placeholder="DUI del cliente" pattern="[0-9]{8}-[0-9]{1}" maxLength="10">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" value="{{$clientes->telefono}}" name="telefono" id="telefono"
                                placeholder="Telefono del cliente" pattern="[0-9]{4}-[0-9]{4}" maxLength="9">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{$clientes->email}}" name="email" id="email"
                                placeholder="Email del cliente">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="direccion">Dirección</label>
                                <textarea type="text" class="form-control" name="direccion" id="direccion" 
                                placeholder="Dirección del cliente" rows="4">{{$clientes->direccion}}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-edit"></i>&nbsp;Guardar
                    </button>
                    <a href="/clientes" class="btn btn-secondary">
                        <i class="fas fa-angle-left"></i>&nbsp;Cancelar
                    </a>
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

@section('scripts')
<script src="{{asset('dist/js/formatos.js')}}"></script>
@endsection