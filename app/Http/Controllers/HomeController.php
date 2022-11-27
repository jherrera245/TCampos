<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countClientes = HomeController::countClientes();
        $countProductos = HomeController::countProductos();
        $sumVentas = HomeController::sumVentas();
        $sumCompras = HomeController::sumCompras();

        $resource = [
            "totalClientes" => $countClientes,
            "totalProductos" => $countProductos,
            "sumaVentas" => $sumVentas,
            "sumaCompras" => $sumCompras
        ];

        return view('home.index', $resource);
    }

    /**
     * Json para graficas de ventas
     * @return json_encode
     */
    public function dataVentaPorCliente() {
        $select = DB::table('ventas AS v')
        ->join('clientes AS cli', 'cli.id', '=', 'v.id_cliente')
        ->select(
            'cli.nombres', 'cli.apellidos' ,
            DB::raw("SUM(v.total) as total")
        )
        ->groupBy('cli.nombres', 'cli.apellidos')
        ->orderBy('total', 'desc')
        ->take(10)
        ->get();

        return json_encode($select);
    }

    /**
     * Json para graficas de productos por categoria
     * @return json_encode
     */
    public function dataProductoPorCategoria() {
        $select = DB::table('productos AS pro')
        ->join('categorias AS cat', 'cat.id', '=', 'pro.id_categoria')
        ->select(
            'cat.nombre',
            DB::raw("COUNT(pro.id_categoria) as total")
        )
        ->where('pro.status','=', '1')
        ->groupBy('cat.nombre')
        ->get();

        return json_encode($select);
    }

    // contar el total de clientes
    private function countClientes()
    {
        $clientes = DB::table('clientes')->where('status','=','1')->count();
        return $clientes;
    }

    // contar el total de productos
    private function countProductos()
    {
        $productos = DB::table('productos')->where('status','=','1')->count();
        return $productos;
    }

    // calcular total de ventas
    private function sumVentas()
    {
        $ventas = DB::table('ventas as v')
        ->select(
            DB::raw('SUM(v.total) as total')
        )
        ->where('v.status','=','1')
        ->first();

        $total  = ($ventas->total == null) ? 0 : $ventas->total;        
        return $total;
    }

    // calcular total de Compras
    private function sumCompras()
    {
        $ingreso = DB::table('ingresos as i')
        ->join('detalle_ingresos as di', 'di.id_ingreso', '=', 'i.id')
        ->select(
            DB::raw('SUM(di.cantidad * di.precio_compra) as total')
        )
        ->where('i.status','=','1')
        ->first();

        $total  = ($ingreso->total == null) ? 0 : $ingreso->total;        
        return $total;
    }
}
