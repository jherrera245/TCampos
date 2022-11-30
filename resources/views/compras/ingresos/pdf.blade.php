@extends('layouts.pdf')

@section('cuerpo-pdf')

<h4>Reporte de Compras</h4>
<h3>Fecha {{$ingreso->fecha}}</h3>

<table>
    <tr>
        <th>Proveedor</th>
        <th colspan="4">
            {{$ingreso->nombres}} {{$ingreso->apellidos}}
        </th>
    </tr>
    <tr>
        <th>N°</th>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Precio de Venta</th>
        <th>Precio de Compra</th>
    </tr>

    @if(count($detalles)>0)
    {{$count = 1}}
    @foreach ($detalles as $detalle)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$detalle->cantidad}}</td>
            <td>{{$detalle->producto}}</td>
            <td>${{$detalle->precio_venta}}</td>
            <td>${{$detalle->precio_compra}}</td>
        </tr>    
    @endforeach
    <tr>
        <th colspan="3">Total</th>
        <th colspan="2">$ {{$ingreso->total}}</th>
    </tr>
    @else
        <tr>
            <td colspan="5" style="text-align:center">No hay reportes que mostrar</td>
        </tr>
    @endif
</table>

@endsection