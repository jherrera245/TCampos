<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Http\Requests\CategoriasFormRequest;
use DB;

class CategoriasController extends Controller
{
    //index
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('search'));
            $categorias = DB::table('categorias as c')
            ->select('c.id', 'c.nombre', 'c.descripcion')
            ->where('c.nombre','LIKE', '%'.$query.'%')
            ->where('c.status','=', '1')
            ->orderBy('c.id','desc')
            ->paginate(6);

            return view('almacen.categorias.index', ["categorias" =>$categorias, "search" => $query]);
        }
    }

    //vista crear
    public function create()
    {
        return view('almacen.categorias.create');
    }

    //guadar datos
    public function store(CategoriasFormRequest $request)
    {
        $categoria = new Categorias();
        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        $categoria->save();
        return redirect('/categorias');
    }

    //vista editar
    public function edit($id)
    {
        $categoria = Categorias::find($id);
        return view('almacen.categorias.edit', ["categoria"=>$categoria]);
    }

    //editar datos
    public function update(CategoriasFormRequest $request, $id)
    {
        $categoria = Categorias::find($id);
        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        $categoria->update();
        return redirect('/categorias');
    }

    //elimindar datos
    public function destroy($id)
    {
        $categoria = Categorias::find($id);
        $categoria->status = false;
        $categoria->update();
        return redirect('/categorias');
    }
}
