@extends('layouts.admin')
@section('header')
Proveedores
<a href="/proveedores/create" class="btn btn-success">Nuevo</a>
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Lista de Proveedores
                    <a class="btn btn-primary btn-sm" target="_blank" href="/proveedores/report/pdf">
                        <i class="fa fa-download"></i>
                        PDF
                    </a>
                </h3>

                <div class="card-tools">
                    @include('compras.proveedores.search') 
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DUI</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>{{$proveedor->id}}</td>
                            <td>{{$proveedor->nombres}}</td>
                            <td>{{$proveedor->apellidos}}</td>
                            <td>{{$proveedor->dui}}</td>
                            <td>{{$proveedor->telefono}}</td>
                            <td>{{$proveedor->email}}</td>
                            <td>
                                <a class="btn btn-primary" href="/proveedores/{{$proveedor->id}}/edit">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#proveedor-modal-{{$proveedor->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('compras.proveedores.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$proveedores->render('vendor.pagination.bootstrap-4')}}
            </div>
            <!--/.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection