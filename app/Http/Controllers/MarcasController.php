<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marcas;
use App\Http\Requests\MarcasFormRequest;
use DB;

class MarcasController extends Controller
{
    //index
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('search'));
            $marcas = DB::table('marcas as m')
            ->select('m.id', 'm.nombre', 'm.descripcion')
            ->where('m.nombre','LIKE', '%'.$query.'%')
            ->where('m.status','=', '1')
            ->orderBy('m.id','desc')
            ->paginate(6);

            return view('almacen.marcas.index', ["marcas" =>$marcas, "search" => $query]);
        }
    }

    //vista crear
    public function create()
    {
        return view('almacen.marcas.create');
    }

    //guadar datos
    public function store(MarcasFormRequest $request)
    {
        $marca = new Marcas();
        $marca->nombre = $request->get('nombre');
        $marca->descripcion = $request->get('descripcion');
        $marca->save();
        return redirect('/marcas');
    }

    //vista editar
    public function edit($id)
    {
        $marca = Marcas::find($id);
        return view('almacen.marcas.edit', ["marca"=>$marca]);
    }

    //editar datos
    public function update(MarcasFormRequest $request, $id)
    {
        $marca = Marcas::find($id);
        $marca->nombre = $request->get('nombre');
        $marca->descripcion = $request->get('descripcion');
        $marca->update();
        return redirect('/marcas');
    }

    //elimindar datos
    public function destroy($id)
    {
        $marca = Marcas::find($id);
        $marca->status = false;
        $marca->update();
        return redirect('/marcas');
    }
}
