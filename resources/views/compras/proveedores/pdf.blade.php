@extends('layouts.pdf')

@section('cuerpo-pdf')

<h4>Reporte de Proveedores</h4>

<table>
    <tr>
        <th>N#</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Email</th>
    </tr>   

    @if(count($proveedores) > 0)
    {{$count = 1}}
    @foreach ($proveedores as $proveedor)
    <tr>
        <td>{{$count++}}</td>
        <td>{{$proveedor->nombres}}</td>
        <td>{{$proveedor->apellidos}}</td>
        <td>{{$proveedor->direccion}}</td>
        <td>{{$proveedor->telefono}}</td>
        <td>{{$proveedor->email}}</td>
    </tr>   
    @endforeach
    @endif
</table>

@endsection