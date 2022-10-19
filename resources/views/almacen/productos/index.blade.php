@extends('layouts.admin')
@section('header')
Productos
<a href="/productos/create" class="btn btn-success">Nuevo</a>
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Productos</h3>

                <div class="card-tools">
                    @include('almacen.productos.search') 
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Categoría</th>
                            <th>Marca</th>
                            <th>Código</th>
                            <th>Stock</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td>{{$producto->id}}</td>
                            <td>{{$producto->producto}}</td>
                            <td>
                                @if(Storage::disk('productos')->exists($producto->imagen))
                                <img class="img-thumbnail" style="width: 100px" src="{{asset('img-producto/'.$producto->imagen)}}" alt="{{$producto->imagen}}">
                                @else
                                <img class="img-thumbnail" style="width: 100px" src="{{asset('img-producto/default_product.jpg')}}" alt="{{$producto->imagen}}">
                                @endif
                            </td>
                            <td>{{$producto->categoria}}</td>
                            <td>{{$producto->marca}}</td>
                            <td>{{$producto->codigo}}</td>
                            <td>{{$producto->stock}}</td>
                            <td>
                                <a class="btn btn-primary" href="/productos/{{$producto->id}}/edit">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#producto-modal-{{$producto->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('almacen.productos.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$productos->render('vendor.pagination.bootstrap-4')}}
            </div>
            <!--/.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection