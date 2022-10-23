@extends('layouts.admin')
@section('header')
Ingresos
<a href="/ingresos/create" class="btn btn-success">Nuevo</a>
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Ingresos</h3>

                <div class="card-tools">
                    @include('compras.ingresos.search') 
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Factura</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Impuesto</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingresos as $ingreso)
                        <tr>
                            <td>{{$ingreso->id}}</td>
                            <td>{{$ingreso->factura}}</td>
                            <td>{{$ingreso->nombres}}</td>
                            <td>{{$ingreso->apellidos}}</td>
                            <td>{{$ingreso->impuesto}} %</td>
                            <td>$ {{$ingreso->total}}</td>
                            <td>
                                @if($ingreso->status)
                                <span class="badge badge-primary">Activo</span>
                                @else
                                <span class="badge badge-danger">Cancelado</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="/ingresos/{{$ingreso->id}}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ingreso-modal-{{$ingreso->id}}">
                                    <i class="fas fa-window-close"></i>
                                </button>
                            </td>
                        </tr>
                        @include('compras.ingresos.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$ingresos->render('vendor.pagination.bootstrap-4')}}
            </div>
            <!--/.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection