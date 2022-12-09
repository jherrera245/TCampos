@extends('layouts.pdf')

@section('cuerpo-pdf')

<h4>Reporte General de Ventas</h4>

<table>
    <tr>
        <th>N#</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Impuesto</th>
        <th>Total</th>
    </tr>   

    @if(count($ventas) > 0)
    {{$count = 1}}
    @foreach ($ventas as $venta)
    <tr>
        <td>{{$count++}}</td>
        <td>{{$venta->fecha}}</td>
        <td>{{$venta->nombres}}</td>
        <td>{{$venta->apellidos}}</td>
        <td>{{$venta->impuesto}} %</td>
        <td>$ {{$venta->total}}</td>
    </tr>   
    @endforeach
    @endif
</table>

@endsection