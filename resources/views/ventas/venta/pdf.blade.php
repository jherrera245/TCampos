@extends('layouts.pdf')

@section('cuerpo-pdf')

<h4>Reporte de Ventas</h4>
<h3>Fecha {{$venta->fecha}}</h3>

<table>
    <tr>
        <th>Cliente</th>
        <th colspan="4">
            {{$venta->nombres}} {{$venta->apellidos}}
        </th>
    </tr>
    <tr>
        <th>N°</th>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Precio de Venta</th>
        <th>Descuento</th>
    </tr>

    @if(count($detalles)>0)
    {{$count = 1}}
    @foreach ($detalles as $detalle)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$detalle->cantidad}}</td>
            <td>{{$detalle->producto}}</td>
            <td>${{$detalle->precio_venta}}</td>
            <td>${{$detalle->descuento}}</td>
        </tr>    
    @endforeach
        <tr>
            <th colspan="3">Total</th>
            <th colspan="2">$ {{$venta->total}}</th>
        </tr>
    @else
        <tr>
            <td colspan="5" style="text-align:center">No hay reportes que mostrar</td>
        </tr>
    @endif
</table>

@endsection