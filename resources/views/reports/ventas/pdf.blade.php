@extends('layouts.pdf')

@section('cuerpo-pdf')

<h4>Reporte de Ventas</h4>

<table>
    <tr>
        <th>N°</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Total</th>
    </tr>

    @if(count($ventas)>0)
    {{$count = 1}}
    @foreach ($ventas as $venta)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$venta->nombres}} {{$venta->apellidos}}</td>
            <td>{{$venta->fecha}}</td>
            <td>$ {{$venta->total}}</td>
        </tr>    
    @endforeach
    @else
        <tr>
            <td colspan="5" style="text-align:center">No hay reportes que mostrar</td>
        </tr>
    @endif
</table>

@endsection