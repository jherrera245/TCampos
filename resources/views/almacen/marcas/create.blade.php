@extends('layouts.admin')
@section('header')
Nueva Marca
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Registro de Marcas
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/marcas" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre Marca</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" 
                                placeholder="Nombre de la Marca" maxLength="50">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="descripcion">Descripción Marca</label>
                                <textarea type="text" class="form-control" name="descripcion" id="descripcion" 
                                placeholder="Descripción de la Marca" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-edit"></i>&nbsp;Guardar
                    </button>
                    <a href="/marcas" class="btn btn-secondary">
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