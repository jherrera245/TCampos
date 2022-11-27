<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReporteComprasFormRequest;
use PDF;
use DB;

class ReporteComprasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index() {
        $proveedores = DB::table('proveedores')->where('status','=','1')->get();

        return View('reports.compras.index', ["proveedores"=>$proveedores]);
    }

    public function reporteCompras(ReporteComprasFormRequest $request) {

        $proveedor = $request->get('proveedor');
        $inicio = $request->get('inicio');
        $fin = $request->get('fin');

        if ($proveedor == "" and $inicio == "" and $fin == "") {
            $ingresos = ReporteComprasController::all();
        } else {
            $ingresos = ReporteComprasController::filter($proveedor, $inicio, $fin);
        }

        $pdf = PDF::loadView('reports.compras.pdf', ["ingresos" => $ingresos]);
        
        return $pdf->stream();
    }

    private function all() {
        $ingresos = DB::table('detalle_ingresos as di')
        ->join('ingresos as i', 'i.id', '=', 'di.id_ingreso')
        ->join('proveedores as p', 'p.id', '=', 'i.id_proveedor')
        ->select('p.nombres', 'p.apellidos', 'i.fecha',
        DB::raw('SUM(di.cantidad*di.precio_compra) as total'))
        ->where('i.status', '=', '1')
        ->groupBy('i.fecha')
        ->get();

        return $ingresos;
    }

    private function filter($proveedor, $inicio, $fin) {
        $ingresos = DB::table('detalle_ingresos as di')
        ->join('ingresos as i', 'i.id', '=', 'di.id_ingreso')
        ->join('proveedores as p', 'p.id', '=', 'i.id_proveedor')
        ->select('p.nombres', 'p.apellidos', 'i.fecha',
        DB::raw('SUM(di.cantidad*di.precio_compra) as total'))
        ->where(function($groupQuery) use ($proveedor, $inicio, $fin) {
            $groupQuery->where('p.id', '=', $proveedor)
            ->whereBetween('i.fecha', [$inicio, $fin]);
        })
        ->orwhere(function($groupQuery) use ($proveedor, $inicio, $fin) {
            $groupQuery->orwhere('p.id', '=', $proveedor)
            ->orwhereBetween('i.fecha', [$inicio, $fin]);
        })
        ->where('i.status', '=', '1')
        ->groupBy('i.fecha')
        ->get();

        return $ingresos;
    }
}
