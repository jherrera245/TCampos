@extends('layouts.admin')
@section('header')
Dashboard
@endsection

@section('contenido')

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$totalClientes}}</h3>

                <p>Clientes</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$totalProductos}}</h3>

                <p>Productos</p>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>$ {{$sumaVentas}}</h3>

                <p>Total Ventas</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>$ {{$sumaCompras}}</h3>

                <p>Total Compras</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar-sign"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
</div>


<div class="row">
    <div class="col-lg-6 col-xs-12">
        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 fw-bold text-primary">Ventas por Cliente</h6>
            </div>
            <div class="card-body">
                <canvas width="100" height="100" id="graficaVentasCliente"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xs-12">
        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 fw-bold text-primary">Productos por Categoria</h6>
            </div>
            <div class="card-body">
                <canvas width="100" height="100" id="graficaProductosCategoria"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('dist/js/grafica-ventas.js')}}"></script>
<script src="{{asset('dist/js/grafica-productos.js')}}"></script>
@endsection