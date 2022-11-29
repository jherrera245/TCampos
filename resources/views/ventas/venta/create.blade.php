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
                                        <div class="col-12">
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
                    <a href="/ingresos" class="btn btn-secondary">
                        <i class="fas fa-angle-left"></i>&nbsp;Cancelar
                    </a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

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

<script>
    let rows = 0; //nuemro de filas
    //botones
    const btnAgregar = document.querySelector('#agregar');
    const btnGuardar = document.querySelector('#btn-guardar');
    
    //entradas
    const selectProducto = document.querySelector('#idproducto');
    
    const inputCantidad = document.querySelector('#cantidad');
    
    const inputPrecioCompra = document.querySelector('#precio_compra');
    const inputPrecioVenta = document.querySelector('#precio_venta');
    const inputDescuento = document.querySelector('#descuento');
    const inputStock = document.querySelector('#stock');
    //contenedores
    const contentCompras = document.querySelector('#detalle-compra');
    const contentSubtotal = document.querySelector('#detalle-subtotal');
    const templeteCompras = document.querySelector('#template-detalle-compra');
    const templeteSubtotal = document.querySelector('#template-detalle-subtotal');
    const fragment = document.createDocumentFragment(); //fragmento

    let listaCompras = [];

    //eventos
       
    btnAgregar.addEventListener('click', (e) => {
        
        agregarCompra();
    })

    
    function mostrarDatos(){
        //console.log("Hola mundo");

        datosProductos=document.getElementById('idproducto').value.split('_');
        $('#precio_venta').val(datosProductos[2]);
        $('#stock').val(datosProductos[1]);
        
    }
            

    //evento remover compra
    const agregarEventoRemoverCompra = () => {
        const btnEditar = document.querySelectorAll('.btn-remove');

        btnEditar.forEach(button => {
            button.addEventListener('click', (e) => {
                let idFila = button.dataset.id;
                removerCompra(idFila);
                mostrarListaCompra();
            })
        });
    }
    function restarStock() {
        var total=0;
        var ingreso1 = document.getElementById("cantidad");
        var ingreso2 = document.getElementById("stock");
        //try{
            total=parseInt(ingreso2.value || 0)-parseInt(ingreso1.value || 0);
            console.log(total);
            document.getElementById("stock").value = total;
       /* }
        catch(e) {
            console.log(e);
        }*/
    }
    //agragar compra a objeto
    const agregarCompra = () =>{
        datosProductos=document.getElementById('idproducto').value.split('_');
        let getIdProducto = datosProductos[0];
        let getNombreProducto = selectProducto.options[selectProducto.selectedIndex].text;
        let getCantidad = parseInt(inputCantidad.value);
        let getDescuento = parseFloat(inputDescuento.value);
        let getPrecioVenta =  parseFloat(inputPrecioVenta.value);
        let getStock = parseInt(inputStock.value);
        var total=0;
        
        /*total=getCantidad-getStock;
        console.log(total);
        document.getElementById("stock").value = total;*/


        if (!isNaN(getCantidad) && !isNaN(getPrecioVenta) && !isNaN(getDescuento)) {
            if(getStock>=getCantidad){
                rows++;
            const compra = {
                id: rows,
                idProducto: getIdProducto,
                nombreProducto: getNombreProducto,
                cantidad: getCantidad,
                descuento: getDescuento,
                precioVenta: getPrecioVenta
            };

            listaCompras.push(compra);
            restarStock();
            clearInput();
            mostrarListaCompra();

            }else{
                alert("La cantidad a vender supera el stock")
            }
            
        }else {
            alert("Completa las entradas")
        }
    }

    //mostrar listado de compras en filas de una tabla
    const mostrarListaCompra = () =>{
        //limpiar la lista de compras
        contentCompras.textContent = "";

        //agregar a campos
        listaCompras.forEach(item => {
            const clone = templeteCompras.content.cloneNode(true)
            clone.querySelector(".btn-remove").dataset.id = item.id;
            clone.querySelector(".detalle-producto-id").value = item.idProducto;
            clone.querySelector(".detalle-producto-nombre").value = item.nombreProducto;
            clone.querySelector(".detalle-cantidad").value = item.cantidad;
            clone.querySelector(".detalle-precio-venta").value = item.precioVenta;
            clone.querySelector(".detalle-descuento").value = item.descuento;
            fragment.appendChild(clone);
        })

        contentCompras.appendChild(fragment);
        agregarEventoRemoverCompra();
        enabledButtonGuardar();
        mostrarSubtotal();
    }

    //calcular subtotales
    const mostrarSubtotal = () => {
        contentSubtotal.textContent = "";
        if (listaCompras.length > 0) {
            let subtotal = 0;
            //contamos las tareas pendientes
            listaCompras.forEach    (item => {
                subtotal += (item.precioVenta * item.cantidad-item.descuento);
            });
            $("#total").val(subtotal);
            console.log(subtotal);

            const clone = templeteSubtotal.content.cloneNode(true);

            clone.querySelector("#total_venta").textContent = subtotal.toFixed(2);

            clone.querySelector("#total").value = subtotal.toFixed(2);
           
           
            fragment.appendChild(clone);
            contentSubtotal.appendChild(fragment);
        }
    }

    //remover compra
    const removerCompra = (id) => {
        listaCompras = listaCompras.filter(item => item.id !== parseInt(id));
    }

    //limpiar entradas
    const clearInput = () => {
        inputCantidad.value = '';
        inputPrecioVenta.value = '';
        inputDescuento.value = '';
       
    }

    //habilitar o deshabilitar boton guardar
    const enabledButtonGuardar = () => {
        if (listaCompras.length > 0) {
            btnGuardar.disabled = false;
        }else {
            btnGuardar.disabled = true;
        }
    }
</script>

@endsection