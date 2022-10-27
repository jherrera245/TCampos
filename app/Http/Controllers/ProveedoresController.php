<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedores;
use App\Http\Requests\ProveedoresCreateFormRequest;
use App\Http\Requests\ProveedoresUpdateFormRequest;
use DB;


class ProveedoresController extends Controller
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

            $proveedores = DB::table('proveedores as p')
            ->select('p.id', 'p.nombres', 'p.apellidos', 'p.dui', 'p.direccion', 'p.telefono', 'p.email')
            ->where(function ($queryGroup) use ($query) {
                $queryGroup->where('p.nombres','LIKE', '%'.$query.'%')
                ->orwhere('p.apellidos','LIKE', '%'.$query.'%')
                ->orwhere('p.dui','LIKE', '%'.$query.'%');
            })
            ->where('p.status','=', '1')
            ->orderBy('p.id','desc')
            ->paginate(6);
 
            return view('compras.proveedores.index', ["proveedores" =>$proveedores, "search" => $query]);
        }
    }
 
    //vista crear
    public function create()
    {
        return view('compras.proveedores.create');
    }
 
    //guadar datos
    public function store(ProveedoresCreateFormRequest $request)
    {
        $proveedor = new Proveedores();
        $proveedor->nombres = $request->get('nombres');
        $proveedor->apellidos = $request->get('apellidos');
        $proveedor->fecha_nacimiento = $request->get('nacimiento');
        $proveedor->dui = $request->get('dui');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');
        $proveedor->save();
        return redirect('/proveedores');
    }
 
    //vista editar
    public function edit($id)
    {
        $proveedor = Proveedores::find($id);
        return view('compras.proveedores.edit', ["proveedor"=>$proveedor]);
    }
 
    //editar datos
    public function update(ProveedoresUpdateFormRequest $request, $id)
    {
        $proveedor = Proveedores::find($id);
        $proveedor->nombres = $request->get('nombres');
        $proveedor->apellidos = $request->get('apellidos');
        $proveedor->fecha_nacimiento = $request->get('nacimiento');
        $proveedor->dui = $request->get('dui');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');
        $proveedor->update();
        return redirect('/proveedores');
    }
 
    //elimindar datos
    public function destroy($id)
    {
        $proveedor = Proveedores::find($id);
        $proveedor->status = false;
        $proveedor->update();
        return redirect('/proveedores');
    }
}