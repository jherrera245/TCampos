<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Clientes;
use App\Models\DetalleVenta;
use App\Http\Requests\VentaFormRequest;
use App\Http\Requests\ClientesFormRequest;
use DB;
use PDF;
use Carbon\Carbon;

class VentasController extends Controller
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
    
    //index
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('search'));
            
            $ventas = DB::table('ventas as v')
            ->join('clientes as cl', 'v.id_cliente', '=', 'cl.id')
            ->join('detalle_ventas as dv', 'v.id', '=', 'dv.id_venta')
            ->select('v.id', 'cl.nombres', 'cl.apellidos', 'v.impuesto', 'v.status', 'v.fecha',
            'v.total')
            ->where('v.id', 'LIKE', '%'.$query.'%')
            ->orderBy('v.id', 'DESC')
            ->groupBy('v.id', 'cl.nombres', 'cl.apellidos', 'v.impuesto', 'v.status')
            ->paginate(7);

            return view('ventas.venta.index', ["ventas"=>$ventas, "search"=>$query]);
        }
    }

    //vista crear
    //FERNANDO X_0 SENIOR
    public function create()
    {
        $clientes = DB::table('clientes')->where('status','=','1')->get();

        $productos = DB::table('productos as p')
        ->join('detalle_ingresos as dt', 'p.id','=', 'dt.id_producto')
        ->select(DB::raw('CONCAT(p.codigo, " ",p.nombre) AS producto'),
            'p.id','p.stock',DB::raw('avg(dt.precio_venta) as precio_promedio'))
        ->where('p.status','=','1')
        ->where('p.stock','>','0')
        ->groupBy('producto','p.id','p.stock')
        ->get();

        return view('ventas.venta.create', ["clientes"=>$clientes, "productos"=>$productos]);
    }

    //guardar datos
    public function store(VentaFormRequest $request)
    {
        //try {
            DB::beginTransaction();
            $mytime = Carbon::now('America/El_Salvador');
            
            $venta=new Venta();
            $venta->id_cliente=$request->get('idcliente');
            $venta->fecha=$mytime->toDateTimeString();
            $venta->impuesto='13';
            //$venta->status='A';
            $venta->total=$request->get('total_venta');
            $venta->save();

            $id_producto = $request->get('idproducto');
            $cantidad = $request->get('cantidad');
            $descuento = $request->get('descuento');
            $precio_venta = $request->get('precio_venta');
            $count = 0;
            while ($count < count($id_producto)) {
                $detalle = new DetalleVenta();
                $detalle->id_venta = $venta->id;
                $detalle->id_producto = $id_producto[$count];
                $detalle->cantidad = $cantidad[$count];
                $detalle->descuento = $descuento[$count];
                $detalle->precio_venta = $precio_venta[$count];
                $detalle->save(); //guadar detalle
                $count++;
            }

            DB::commit();
        //} catch (\Exception $e) {
            //DB::rollback();
        //}
        return redirect('/ventas');
    }

    //detalles
    public function show($id)
    {
        $venta = DB::table('ventas as v')
        ->join('clientes as cl', 'v.id_cliente', '=', 'cl.id')
        ->join('detalle_ventas as dv', 'v.id', '=', 'dv.id_venta')
        ->select('v.id', 'v.fecha', 'cl.nombres', 'cl.apellidos', 'v.impuesto', 'v.status',
        'v.total')
        ->where('v.id','=', $id)
        ->groupBy('v.id','cl.nombres', 'cl.apellidos', 'v.impuesto', 'v.status')
        ->first();

        $detalles = DB::table('detalle_ventas as d')
        ->join('productos as p', 'd.id_producto', '=', 'p.id')
        ->select('p.nombre as producto', 'd.cantidad', 'd.descuento', 'd.precio_venta')
        ->where('d.id_venta','=',$id)
        ->get();

        return view('ventas.venta.show', ["venta"=>$venta, "detalles"=>$detalles]);
    }

    //reporte
    public function report($id)
    {
        $venta = DB::table('ventas as v')
        ->join('clientes as cl', 'v.id_cliente', '=', 'cl.id')
        ->join('detalle_ventas as dv', 'v.id', '=', 'dv.id_venta')
        ->select('v.id', 'v.fecha', 'cl.nombres', 'cl.apellidos', 'v.impuesto', 'v.status',
        'v.total')
        ->where('v.id','=', $id)
        ->groupBy('v.id','cl.nombres', 'cl.apellidos', 'v.impuesto', 'v.status')
        ->first();

        $detalles = DB::table('detalle_ventas as d')
        ->join('productos as p', 'd.id_producto', '=', 'p.id')
        ->select('p.nombre as producto', 'd.cantidad', 'd.descuento', 'd.precio_venta')
        ->where('d.id_venta','=',$id)
        ->get();

        $pdf = PDF::loadView('ventas.venta.pdf', ["venta"=>$venta, "detalles"=>$detalles]);

        return $pdf->stream();
    }

    //reporte general de las compras
    public function reporteGeneral()
    {
        $ventas = DB::table('ventas as v')
        ->join('clientes as cl', 'v.id_cliente', '=', 'cl.id')
        ->join('detalle_ventas as dv', 'v.id', '=', 'dv.id_venta')
        ->select('v.id', 'cl.nombres', 'cl.apellidos', 'v.impuesto', 'v.status', 'v.fecha',
        'v.total')
        ->orderBy('v.id', 'DESC')
        ->groupBy('v.id', 'cl.nombres', 'cl.apellidos', 'v.impuesto', 'v.status')
        ->paginate(7);

        $pdf = PDF::loadView('ventas.venta.pdf-general', ["ventas"=>$ventas]);
        return $pdf->stream();
    }

    //cancelar
    public function destroy($id)
    {
        $venta = Venta::find($id);
        $venta->status = 0;
        $venta->update();
        return redirect('/ventas');
    }

    //agregar nuevo cliente desde ingreso
    public function agregarCliente(ClientesFormRequest $request)
    {
        $clientes=new Clientes;
        $clientes->nombres=$request->get('nombres');
        $clientes->apellidos=$request->get('apellidos');
        $clientes->fecha_nacimiento=$request->get('nacimiento');
        $clientes->dui=$request->get('dui');
        $clientes->direccion=$request->get('direccion');
        $clientes->telefono=$request->get('telefono');
        $clientes->email=$request->get('email');
        $clientes->status='1';
        $clientes->save();
        return redirect('/ventas/create');
    }
}
