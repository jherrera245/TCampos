<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Http\Requests\ClientesFormRequest;
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
            
             return view('ventas.clientes.index', 
                [
                    "clientes"=>$clientes,
                    "searchText"=>$query
                ]
            );
        }

    }

    public function create()
    {
        return view("ventas.clientes.create");

    }

    public function store(ClientesFormRequest $request)
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
        return redirect('/clientes');
        
    }

    public function show($id)
    {
        $clientes=Clientes::findOrFail($id);
        return view("ventas.clientes.edit", ["clientes"=>$clientes]);
    }

    public function edit($id)
    {
        $clientes=Clientes::findOrFail($id);
        return view("ventas.clientes.edit", ["clientes"=>$clientes]);
    }

    public function update(ClientesFormRequest $request,$id)
    {
        $clientes=Clientes::findOrFail($id);
        $clientes->nombres=$request->get('nombres');
        $clientes->apellidos=$request->get('apellidos');
        $clientes->fecha_nacimiento=$request->get('nacimiento');
        $clientes->dui=$request->get('dui');
        $clientes->direccion=$request->get('direccion');
        $clientes->telefono=$request->get('telefono');
        $clientes->email=$request->get('email');
        $clientes->update();
        return redirect('/clientes');

        return redirect('clientes');  
    }

    public function destroy($id)
    {
        $clientes=Clientes::findOrFail($id);
        $clientes->status='0';
        $clientes->update();
        return redirect('/clientes');

     
    }
    
}