@extends('layouts.admin')
@section('header')
Usuarios
<a href="/usuarios/create" class="btn btn-success">Nuevo</a>
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Usuarios</h3>

                <div class="card-tools">
                    @include('acceso.usuarios.search') 
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Administrador</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $user)
                        @if (Auth::user()->id != $user->id)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            @if($user->is_admin == 1)
                                <td>
                                    <span class="badge rounded-pill bg-success text-white">Si</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge rounded-pill bg-danger text-white">No</span>
                                </td>
                            @endif
                            <td>
                                <a class="btn btn-primary" href="/usuarios/{{$user->id}}/edit">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#user-modal-{{$user->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endif
                        @include('acceso.usuarios.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$usuarios->render('vendor.pagination.bootstrap-4')}}
            </div>
            <!--/.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection