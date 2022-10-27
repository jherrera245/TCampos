<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Http\Request\ClientesFormRequest;
use DB;

class ClientesController extends Controller
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

    public function index(Request $request)
    {
        if($request){
            $query=trim($request->get('searchText'));
            $clientes=DB::table('clientes')->where('nombres','LIKE','%'.$query.'%')
             ->where('status','=','1')
             ->orderBy('id','desc')
             ->paginate(7);
             return view('almacen.clientes.index',
                [
                "clientes"=>$clientes,
                "searchText"=>$query
                ]);

        }


    }

    public function create()
    {
        return view("almacen.clientes.create");

    }

    public function store(ClientesFormRequest $request)
    {
        $clientes=new Clientes;
        $clientes->nombres=$request->get('nombres');
        $clientes->apellidos=$request->get('apellidos');
        $clientes->fecha_nacimiento=$request->get('fecha_nacimiento');
        $clientes->dui=$request->get('dui');
        $clientes->direccion=$request->get('direccion');
        $clientes->telefono=$request->get('telefono');
        $clientes->email=$request->get('email');
        $clientes->status='1';
        $clientes->save();
        return Redirect::to('almacen/clientes');
        
    }

    public function show(){

    }

    public function edit(){


    }

    public function update(){

    }

    public function destroy(){

    }
    
}
