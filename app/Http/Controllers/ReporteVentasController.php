<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReporteVentasFormRequest;
use PDF;
use DB;

class ReporteVentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index() {
        $clientes = DB::table('clientes')->where('status','=','1')->get();

        return View('reports.ventas.index', ["clientes"=>$clientes]);
    }

    public function reporteVentas(ReporteVentasFormRequest $request) {
        $cliente = $request->get('cliente');
        $inicio = $request->get('inicio');
        $fin = $request->get('fin');

        if ($cliente == "" and $inicio == "" and $fin == "" ) {
            $ventas = ReporteVentasController::all();
        }else {
            $ventas = ReporteVentasController::filter($cliente, $inicio, $fin);
        }
    
        $pdf = PDF::loadView('reports.ventas.pdf', ["ventas" => $ventas]);
        
        return $pdf->stream();
    }

    private function all() {
        $ventas = DB::table('detalle_ventas as dv')
        ->join('ventas as v', 'v.id', '=', 'dv.id_venta')
        ->join('clientes as c', 'c.id', '=', 'v.id_cliente')
        ->select('c.nombres', 'c.apellidos', 'v.fecha',
        DB::raw('SUM( (dv.cantidad*dv.precio_venta) - dv.descuento) as total'))
        ->where('v.status', '=', '1')
        ->groupBy('v.fecha')
        ->get();

        return $ventas;
    }

    private function filter($cliente, $inicio, $fin) {
        $ventas = DB::table('detalle_ventas as dv')
        ->join('ventas as v', 'v.id', '=', 'dv.id_venta')
        ->join('clientes as c', 'c.id', '=', 'v.id_cliente')
        ->select('c.nombres', 'c.apellidos', 'v.fecha',
        DB::raw('SUM( (dv.cantidad*dv.precio_venta) - dv.descuento) as total'))
        ->orwhere(function($groupQuery) use ($cliente, $inicio, $fin) {
            $groupQuery->where('c.id', '=', $cliente)
            ->whereBetween('v.fecha', [$inicio, $fin]);
        })
        ->orwhere(function($groupQuery) use ($cliente, $inicio, $fin) {
            $groupQuery->orwhere('c.id', '=', $cliente)
            ->orwhereBetween('v.fecha', [$inicio, $fin]);
        })
        ->where('v.status', '=', '1')
        ->groupBy('v.fecha')
        ->get();
        return $ventas;
    }
}
