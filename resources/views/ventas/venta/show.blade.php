@extends('layouts.admin')
@section('header')
Detalle Ingresos
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                    <i class="fas fa-user"></i> Proveedor: {{$ingreso->nombres}} {{$ingreso->apellidos}}
                    <small class="float-right">Fecha: {{$ingreso->fecha}}</small>
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
                                <th>Precio de Comprar</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($detalles as $detalle)
                            <tr>
                                <td>{{$detalle->cantidad}}</td>
                                <td>{{$detalle->producto}}</td>
                                <td>${{$detalle->precio_venta}}</td>
                                <td>${{$detalle->precio_compra}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="3">Total</th>
                                <td>
                                    <span class="badge badge-primary">
                                        ${{$ingreso->total}}
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
                    <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    
                    <a href="/ingresos" class="btn btn-secondary float-right" style="margin-right: 5px;">
                        <i class="fas fa-angle-left"></i> Regresar
                    </a>

                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection