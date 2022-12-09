@extends('layouts.pdf')

@section('cuerpo-pdf')

<h4>Reporte General de Compras</h4>

<table>
    <tr>
        <th>N#</th>
        <th>Factura</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Impuesto</th>
        <th>Total</th>
    </tr>   

    @if(count($ingresos) > 0)
    {{$count = 1}}
    @foreach ($ingresos as $ingreso)
    <tr>
        <td>{{$count++}}</td>
        <td>{{$ingreso->factura}}</td>
        <td>{{$ingreso->nombres}}</td>
        <td>{{$ingreso->apellidos}}</td>
        <td>{{$ingreso->impuesto}} %</td>
        <td>$ {{$ingreso->total}}</td>
    </tr>   
    @endforeach
    @endif
</table>

@endsection