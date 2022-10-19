@extends('layouts.admin')
@section('header')
Marcas
<a href="/marcas/create" class="btn btn-success">Nuevo</a>
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Marcas</h3>

                <div class="card-tools">
                    @include('almacen.marcas.search') 
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Descripción</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marcas as $marca)
                        <tr>
                            <td>{{$marca->id}}</td>
                            <td>{{$marca->nombre}}</td>
                            <td>{{$marca->descripcion}}</td>
                            <td>
                                <a class="btn btn-primary" href="/marcas/{{$marca->id}}/edit">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#marca-modal-{{$marca->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('almacen.marcas.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$marcas->render('vendor.pagination.bootstrap-4')}}
            </div>
            <!--/.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection