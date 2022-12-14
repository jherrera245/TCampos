@extends('layouts.admin')
@section('header')
Nueva Venta
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Registro de Ventas 
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/ventas" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="proveedor">Cliente</label>
                                <select class="form-control select2bs4" name="idcliente" id="idcliente">
                                @foreach($clientes as $cliente)
                                <option value="{{$cliente->id}}">{{$cliente->nombres}} {{$cliente->apellidos}}</option>
                                @endforeach
                                </select>
                            </div>
                           
                        </div>
                        
                        

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="cliente-modal">Agregar Cliente</label>
                                <button type="button" class="btn btn-info w-100" data-toggle="modal" data-target="#modal-cliente">
                                    Si el cliente no existe hacer clic aquí
                                </button>
                            </div>
                        </div>

                    </div>
                    

                    <!-- Card regitro de ingresos -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-success card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-shopping-cart"></i>
                                        Registro de Ingresos
                                    </h3>
                                </div>

                                <!-- Formulario de registro de ingresos -->
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-4 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="producto">Productos</label>
                                                <select class="form-control select2bs4" onchange="mostrarDatos()"  name="idproducto" id="idproducto" >
                                                @foreach($productos as $producto)
                                                
                                                <option value="{{$producto->id}}_{{$producto->stock}}_{{$producto->precio_promedio}}">{{$producto->producto}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            

                                        </div>
                                        

                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="number" name="cantidad" class="form-control" id="cantidad"
                                                placeholder="Ingresa cantidad de producto" min="0" step="1" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="cantidad">Stock</label>
                                                <input type="number" name="stock" disabled class="form-control" id="stock" 
                                                placeholder="Stock" min="0" step="1" >
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="precio_venta">Precio Venta</label>
                                                <input type="number" disabled class="form-control" id="precio_venta" 
                                                placeholder="Ingresa el precio de venta" min="0" step="0.05">
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="descuento">Descuento</label>
                                                <input type="number" class="form-control" name="descuento" id="descuento" 
                                                placeholder="Ingresa el precio de compra" min="0" step="0.05">
                                            </div>
                                        </div>

                                       

                                        <div class="col-lg-2 col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="opciones">Opciones</label>
                                                <button type="button"class="btn btn-primary form-control" id="agregar">
                                                    <i class="fa fa-plus-square"></i>&nbsp;Agregar
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- tabla de detalles -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>Opciones</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio venta</th>
                                                    <th>Descuento</th>
                                                    <th>SubTotal</th>
                                                </thead>

                                                <tbody id="detalle-compra">
                                                    
                                                </tbody>

                                                <tr id="detalle-subtotal">

                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="btn-guardar" disabled>
                        <i class="fas fa-edit"></i>&nbsp;Guardar
                    </button>
                    <a href="/ventas" class="btn btn-secondary">
                        <i class="fas fa-angle-left"></i>&nbsp;Cancelar
                    </a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@include('ventas.venta.modal-create-cliente')

<!-- template detalle productos -->
<template id="template-detalle-compra">
    <tr>
        <td class="col-1 text-center">
            <button type="button" class="btn btn-danger btn-remove" data-id="1">
                <i class="fas fa-times"></i>
            </button>
        </td>
        <td class="col-3">
            <input type="hidden" class="form-control detalle-producto-id" name="idproducto[]">
            <input type="text" class="form-control detalle-producto-nombre" disabled>
        </td>

        <td>
            <input type="number" class="form-control detalle-cantidad" name="cantidad[]" 
            placeholder="Ingresa cantidad de producto" min="0" step="1">
        </td>

        <td>
            <input type="number" class="form-control detalle-precio-venta" name="precio_venta[]" 
            placeholder="Ingresa el precio de compra" min="0" step="0.05">
        </td>

        <td>
            <input type="number" class="form-control detalle-descuento" name="descuento[]" 
            placeholder="Ingresa el precio de venta" min="0" step="0.05">
        </td>

        <td></td>
    </tr>
</template>

<!--template subtotal compra -->
<template id="template-detalle-subtotal">
    <td colspan="5" valign="">
        Total
    </td>
    <td>
        <span class="badge badge-primary">
            $<span id="total_venta"></span>
        </span>

        <input class="form-control" type="hidden" id="total" name="total_venta" >
    </td>
</template>

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
<script src="{{asset('dist/js/ventas.js')}}"></script>
<script src="{{asset('dist/js/formatos.js')}}"></script>
@endsection