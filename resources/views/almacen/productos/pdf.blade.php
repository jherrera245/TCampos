@extends('layouts.pdf')

@section('cuerpo-pdf')

<h4>Reporte de Productos</h4>

<table>
    <tr>
        <th>N#</th>
        <th>Producto</th>
        <th>Categoría</th>
        <th>Marca</th>
        <th>Código</th>
        <th>Stock</th>
    </tr>

    @if(count($productos) > 0)
    {{$count = 1}}
    @foreach ($productos as $producto)
    <tr>
        <td>{{$count++}}</td>
        <td>{{$producto->producto}}</td>
        <td>{{$producto->categoria}}</td>
        <td>{{$producto->marca}}</td>
        <td>{{$producto->codigo}}</td>
        <td>{{$producto->stock}}</td>
    </tr>   
    @endforeach
    @endif
</table>

@endsection