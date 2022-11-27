@extends('layouts.pdf')

@section('cuerpo-pdf')

<h4>Reporte de Compras</h4>

<table>
    <tr>
        <th>N°</th>
        <th>Proveedor</th>
        <th>Fecha</th>
        <th>Total</th>
    </tr>

    @if(count($ingresos)>0)
    {{$count = 1}}
    @foreach ($ingresos as $ingreso)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$ingreso->nombres}} {{$ingreso->apellidos}}</td>
            <td>{{$ingreso->fecha}}</td>
            <td>$ {{$ingreso->total}}</td>
        </tr>    
    @endforeach
    @else
        <tr>
            <td colspan="5" style="text-align:center">No hay reportes que mostrar</td>
        </tr>
    @endif
</table>

@endsection