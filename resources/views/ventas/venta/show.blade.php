@extends('layouts.admin')
@section('header')
Detalle ventas
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                    <i class="fas fa-user"></i> Proveedor: {{$venta->nombres}} {{$venta->apellidos}}
                    <small class="float-right">Fecha: {{$venta->fecha}}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Precio de Venta</th>
                                <th>Descuento</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($detalles as $detalle)
                            <tr>
                                <td>{{$detalle->cantidad}}</td>
                                <td>{{$detalle->producto}}</td>
                                <td>${{$detalle->precio_venta}}</td>
                                <td>${{$detalle->descuento}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="3">Total</th>
                                <td>
                                    <span class="badge badge-primary">
                                        ${{$venta->total}}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a href="/ventas" class="btn btn-secondary float-right" style="margin-right: 5px;">
                        <i class="fas fa-angle-left"></i> Regresar
                    </a>

                    <a href="/ventas/{{$venta->id}}/pdf" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection