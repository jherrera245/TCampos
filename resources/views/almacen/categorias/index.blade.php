@extends('layouts.admin')
@section('header')
Categorias
<a href="/categorias/create" class="btn btn-success">Nuevo</a>
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Categorias</h3>

                <div class="card-tools">
                    @include('almacen.categorias.search') 
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{$categoria->id}}</td>
                            <td>{{$categoria->nombre}}</td>
                            <td>
                                <a class="btn btn-primary" href="/categorias/{{$categoria->id}}/edit">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#categoria-modal-{{$categoria->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('almacen.categorias.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$categorias->render('vendor.pagination.bootstrap-4')}}
            </div>
            <!--/.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection