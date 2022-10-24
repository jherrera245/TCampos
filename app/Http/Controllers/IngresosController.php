<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingresos;
use App\Models\DetalleIngresos;
use App\Http\Requests\IngresosFormRequest;
use DB;
use Carbon\Carbon;

class IngresosController extends Controller
{
    //index
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('search'));
            
            $ingresos = DB::table('ingresos as i')
            ->join('proveedores as p', 'i.id_proveedor', '=', 'p.id')
            ->join('detalle_ingresos as di', 'i.id', '=', 'di.id_ingreso')
            ->select('i.id', 'p.nombres', 'p.apellidos', 'i.impuesto', 'i.status', 'i.fecha',
            'i.codigo_factura as factura', DB::raw('SUM(di.cantidad*di.precio_compra) as total'))
            ->where('i.codigo_factura', 'LIKE', '%'.$query.'%')
            ->orderBy('i.id', 'DESC')
            ->groupBy('i.id', 'p.nombres', 'p.apellidos', 'i.impuesto', 'i.status')
            ->paginate(6);

            return view('compras.ingresos.index', ["ingresos"=>$ingresos, "search"=>$query]);
        }
    }

    //vista crear
    public function create()
    {
        $proveedores = DB::table('proveedores')->where('status','=','1')->get();

        $productos = DB::table('productos as p')
        ->join('marcas as m', 'p.id_marca','=', 'm.id')
        ->select('p.id', 'p.nombre as producto', 'm.nombre as marca')
        ->where('p.status','=','1')
        ->get();

        return view('compras.ingresos.create', ["productos"=>$productos, "proveedores"=>$proveedores]);
    }

    //guardar datos
    public function store(IngresosFormRequest $request)
    {
        try {
            DB::beginTransaction();
            //fecha actual
            $mytime= Carbon::now('America/El_Salvador');

            //modelo de la tabla ingresos
            $ingreso = new Ingresos();
            $ingreso->id_proveedor  = $request->get('proveedor');
            $ingreso->codigo_factura = $request->get('factura');
            $ingreso->fecha = $mytime->toDateTimeString();
            $ingreso->impuesto = '13';
            $ingreso->save(); //guadar ingreso
            //agreglo de datos desde el formulario
            $productos = $request->get('producto');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            $count = 0;

            while ($count < count($productos)) {
                $detalle = new DetalleIngresos();
                $detalle->id_ingreso = $ingreso->id;
                $detalle->id_producto = $productos[$count];
                $detalle->cantidad = $cantidad[$count];
                $detalle->precio_compra = $precio_compra[$count];
                $detalle->precio_venta = $precio_venta[$count];
                $detalle->save(); //guadar detalle
                $count++;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect('/ingresos');
    }

    //detalles
    public function show($id)
    {
        $ingreso = DB::table('ingresos as i')
        ->join('proveedores as p', 'i.id_proveedor', '=', 'p.id')
        ->join('detalle_ingresos as di', 'i.id', '=', 'di.id_ingreso')
        ->select('i.id', 'i.fecha', 'p.nombres', 'p.apellidos', 'i.impuesto', 'i.status',
        'i.codigo_factura as factura', DB::raw('SUM(di.cantidad*di.precio_compra) as total'))
        ->where('i.id','=', $id)
        ->groupBy('i.id','p.nombres', 'p.apellidos', 'i.impuesto', 'i.status')
        ->first();

        $detalles = DB::table('detalle_ingresos as di')
        ->join('productos as p', 'di.id_producto', '=', 'p.id')
        ->select('p.nombre as producto', 'di.cantidad', 'di.precio_compra', 'di.precio_venta')
        ->where('di.id_ingreso','=',$id)
        ->get();

        return view('compras.ingresos.show', ["ingreso"=>$ingreso, "detalles"=>$detalles]);
    }

    //cancelar
    public function destroy($id)
    {
        $ingreso = Ingresos::find($id);
        $ingreso->status = false;
        $ingreso->update();
        return redirect('/ingresos');
    }
}
