@extends('layouts.admin')
@section('header')
Reportes de Compras
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Filtro de reportes de compras
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/pdf-compras" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="proveedor">Proveedores</label>
                                <select class="form-control select2bs4" name="proveedor" id="proveedor">
                                <option value="">Selecciona un proveedor</option>
                                @foreach($proveedores as $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombres}} {{$proveedor->apellidos}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="inicio">Fecha Inicio</label>
                                <input type="date" class="form-control" name="inicio">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="fin">Fecha Inicio</label>
                                <input type="date" class="form-control" name="fin">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-file"></i>&nbsp;Generar PDF
                    </button>
                    <a href="/home" class="btn btn-secondary">
                        <i class="fas fa-angle-left"></i>&nbsp;Cancelar
                    </a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection