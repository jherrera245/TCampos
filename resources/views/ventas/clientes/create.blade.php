@extends('layouts.admin')
@section('header')
Nuevo Cliente
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Registro de clientes
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/clientes" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombres" id="nombres" 
                                placeholder="Nombre del proveedor" maxLength="75">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" name="apellidos" id="nombres" 
                                placeholder="Apellido del proveedor" maxLength="75">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="nacimiento" id="nacimiento">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="dui">DUI</label>
                                <input type="text" class="form-control" name="dui" id="dui" 
                                placeholder="DUI del proveedor" pattern="[0-9]{8}-[0-9]{1}" maxLength="10">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono"
                                placeholder="Telefono del proveedor" pattern="[0-9]{4}-[0-9]{4}" maxLength="9">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                placeholder="Email del proveedor">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="direccion">Dirección</label>
                                <textarea type="text" class="form-control" name="direccion" id="direccion" 
                                placeholder="Dirección del proveedor" rows="4"></textarea>
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

<script>
    const inputDui = document.querySelector("#dui");
    const inputTelefono = document.querySelector("#telefono");

    // creacion de mascaras
    const maskDui = "########-#"
    const maskTelefono = "####-####"

    let current = ""
    let duiNumber = []
    let telefonoNumber = []

    //agregar el evento para cuando se presione la tecla

    inputDui.addEventListener("keydown", (e) => {
        if (e.key === "Tab") {
            return
        }

        e.preventDefault()
        handleInput(maskDui, e.key, duiNumber)
        inputDui.value = duiNumber.join("");
    })

    inputTelefono.addEventListener("keydown", (e) => {
        if (e.key === "Tab") {
            return
        }

        e.preventDefault()
        handleInput(maskTelefono, e.key, telefonoNumber)
        inputTelefono.value = telefonoNumber.join("");
    })

    const handleInput = (mask, key, arr) => {
        let numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]

        if (key === "Backspace" && arr.length > 0) {
            arr.pop()
            return
        }

        if (numbers.includes(key) && arr.length + 1 <= mask.length) {
            if (mask[arr.length] === "-") {
                arr.push(mask[arr.length], key)
            }else {
                arr.push(key)
            }
        }
    }
</script>

@endsection