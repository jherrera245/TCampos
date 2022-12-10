@extends('layouts.admin')
@section('header')
Ventas
<a href="/ventas/create" class="btn btn-success">Nuevo</a>

@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Listado de ventas
                    <a class="btn btn-primary btn-sm" target="_blank" href="/ventas/report/general">
                        <i class="fa fa-download"></i>
                        PDF
                    </a>
                </h3>

                <div class="card-tools">
                    @include('ventas.venta.search') 
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Impuesto</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                        <tr>
                            <td>{{$venta->id}}</td>
                            <td>{{$venta->nombres}}</td>
                            <td>{{$venta->apellidos}}</td>
                            <td>{{$venta->impuesto}} %</td>
                            <td>$ {{$venta->total}}</td>
                            <td>
                                @if($venta->status)
                                <span class="badge badge-primary">Activo</span>
                                @else
                                <span class="badge badge-danger">Cancelado</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="/ventas/{{$venta->id}}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#venta-modal-{{$venta->id}}">
                                    <i class="fas fa-window-close"></i>
                                </button>
                            </td>
                        </tr>
                        @include('ventas.venta.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$ventas->render('vendor.pagination.bootstrap-4')}}
            </div>
            <!--/.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection