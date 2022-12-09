@extends('layouts.pdf')

@section('cuerpo-pdf')

<h4>Reporte de Clientes</h4>

<table>
    <tr>
        <th>N#</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Email</th>
    </tr>

    @if(count($clientes) > 0)
    {{$count = 1}}
    @foreach ($clientes as $cliente)
    <tr>
        <td>{{$count++}}</td>
        <td>{{$cliente->nombres}}</td>
        <td>{{$cliente->apellidos}}</td>
        <td>{{$cliente->direccion}}</td>
        <td>{{$cliente->telefono}}</td>
        <td>{{$cliente->email}}</td>
    </tr>   
    @endforeach
    @endif
</table>

@endsection