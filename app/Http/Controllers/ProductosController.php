<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Http\Requests\ProductosFormRequest;
use Illuminate\Support\Facades\Storage;
use File;
use DB;

class ProductosController extends Controller
{
    //index
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('search'));
            $productos = DB::table('productos as p')
            ->join('categorias as c', 'p.id_categoria', '=', 'p.id_categoria')
            ->join('marcas as m', 'p.id_marca', '=', 'm.id')
            ->select(
                'p.id', 'p.nombre as producto', 'c.nombre as categoria', 
                'm.nombre as marca', 'p.codigo', 'p.stock', 'p.imagen',
            )
            ->where(function($groupQuery) use ($query) {
                $groupQuery->where('p.codigo', 'LIKE', '%'.$query.'%')
                ->orwhere('p.nombre','LIKE', '%'.$query.'%')
                ->orwhere('c.nombre','LIKE', '%'.$query.'%')
                ->orwhere('m.nombre','LIKE', '%'.$query.'%');
            })
            ->where('p.status','=', '1')
            ->orderBy('p.id','desc')
            ->paginate(6);

            return view('almacen.productos.index', ["productos" =>$productos, "search" => $query]);
        }
    }

    //vista crear
    public function create()
    {
        $categorias = DB::table('categorias')->where('status','=','1')->get();
        $marcas = DB::table('marcas')->where('status','=','1')->get();
        return view('almacen.productos.create', ["marcas" => $marcas, "categorias" => $categorias]);
    }

    //guadar datos
    public function store(ProductosFormRequest $request)
    {
        $producto = new Productos();
        $producto->nombre = $request->get('nombre');
        $producto->codigo = $request->get('codigo');
        $producto->stock = $request->get('stock');
        $producto->descripcion = $request->get('descripcion');

        //guadar imagen
        if ($request->hasFile('imagen')) {
            $url = $request->file('imagen');
            $nombre = str_replace(' ', '-', trim($request->get('nombre')));
            $nombre = hash('sha256', $nombre); //ciframos el nombre
            $file = $nombre.".".$url->guessExtension();
            //guardamos el archivo en el servidor
            Storage::disk('productos')->put($file, File::get($url));
            $producto->imagen = $file;
        }

        $producto->id_categoria = $request->get('categoria');
        $producto->id_marca = $request->get('marca');
        $producto->save();
        return redirect('/productos');
    }
    //vista editar
    public function edit($id)
    {
        $producto = Productos::find($id);
        $categorias = DB::table('categorias')->where('status','=','1')->get();
        $marcas = DB::table('marcas')->where('status','=','1')->get();

        $data = ["producto"=>$producto, "marcas"=>$marcas, "categorias"=>$categorias];
        return view('almacen.productos.edit', $data);
    }

    //editar datos
    public function update(ProductosFormRequest $request, $id)
    {
        $producto = Productos::find($id);
        $oldImage = $producto->imagen;
        $producto->nombre = $request->get('nombre');
        $producto->codigo = $request->get('codigo');
        $producto->stock = $request->get('stock');
        $producto->descripcion = $request->get('descripcion');

        //guadar imagen
        if ($request->hasFile('imagen')) {
            $url = $request->file('imagen');
            Storage::disk('productos')->delete($oldImage); //borrar imagen anterior
            $nombre = str_replace(' ', '-', trim($request->get('nombre')));
            $nombre = hash('sha256', $nombre); //ciframos el nombre
            $file = $nombre.".".$url->guessExtension();
            //guardamos el archivo en el servidor
            Storage::disk('productos')->put($file, File::get($url));
            $producto->imagen = $file;
        }

        $producto->id_categoria = $request->get('categoria');
        $producto->id_marca = $request->get('marca');
        $producto->update();
        return redirect('/productos');
    }

    //elimindar datos
    public function destroy($id)
    {
        $producto = Productos::find($id);
        $producto->status = false;
        $oldImage = $producto->imagen;
        Storage::disk('productos')->delete($oldImage);

        $producto->update();
        return redirect('/productos');
    }
}
