<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Http\Requests\ClientesFormRequest;
use DB;

class ClientesController extends Controller
{
    

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
                ]);

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
        return Redirect::to('ventas/clientes');
        
    }

    public function show($id)
    {
        return view("ventas.clientes.show",
            ["clientes"=>Clientes::findOrFail($id)]);
        
    }

    public function edit()
    {
        return view("ventas.clientes.edit",
        ["clientes"=>Clientes::findOrFail($id)]);


    }

    public function update(ClientesFormRequest $request,$id)
    {
        $clientes=Clientes::findOrFail($id);
        $clientes->nombres=$request->get('nombres');
        $clientes->apellidos=$request->get('apellidos');
        $clientes->update();

    }

    public function destroy()
    {
        $clientes=Clientes::findOrFail($id);
        $clientes->status='0';
        $clientes->update();
        return Redirect::to('ventas/clientes');

    }
    
}