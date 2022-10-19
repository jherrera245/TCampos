@extends('layouts.admin')
@section('header')
Nuevo Producto
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Registro de Producto
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/productos" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre Producto</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" 
                                placeholder="Nombre del producto" maxLength="50">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="nombre">Categoría</label>
                                <select class="form-control select2bs4" name="categoria" id="categoria">
                                @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="marca">Marca</label>
                                <select class="form-control select2bs4" name="marca" id="marca">
                                @foreach($marcas as $marca)
                                <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="codigo">Codigo</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" 
                                placeholder="Codigo del producto" maxLength="50">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" min="0"
                                placeholder="Stock" maxLength="50">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control" name="imagen" id="imagen">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nombre">Descripción</label>
                                <textarea type="text" class="form-control" name="descripcion" id="descripcion" 
                                placeholder="Descripción del producto" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-edit"></i>&nbsp;Guardar
                    </button>
                    <a href="/productos" class="btn btn-secondary">
                        <i class="fas fa-angle-left"></i>&nbsp;Cancelar
                    </a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

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