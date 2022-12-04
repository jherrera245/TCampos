<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\UsuariosFormRequest;
use App\Http\Requests\UsuariosUpdateFormRequest;
use App\Http\Requests\ProfileUserFormRequest;
use App\Http\Requests\PasswordUpdateFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class UsuariosController extends Controller
{
    //contruct
    public function __construct(){
        $this->middleware('admin');
    }

    //cargar datos de bd en la vista
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('search'));
            $usuarios = DB::table('users as u')
            ->select('u.id', 'u.name','u.email', 'u.is_admin')
            ->where('u.name','LIKE', '%'.$query.'%')
            ->orderBy('u.id','desc')
            ->paginate(7);

            return view('acceso.usuarios.index', ["usuarios"=>$usuarios, "search"=>$query]);
        }
    }

    //cargamos los datos en la vista de registro
    public function create()
    {
        return view('acceso.usuarios.create');
    }

    //almacenamos los registros
    public function store(UsuariosFormRequest $request)
    {
        $usuario = new User();
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=Hash::make($request->get('password'));
        $usuario->is_admin=($request->get('admin') == 1) ? 1 : 0;
        $usuario->save();

        return redirect('/usuarios');
    }

    //cargamos los datos en la vista de edit
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('acceso.usuarios.edit', ["usuario"=>$usuario]);
    }

    //leer usuario
    public function profile($id)
    {
        $usuario = User::find(Auth::user()->id);
        return view('acceso.usuarios.profile', ["usuario"=>$usuario]);
    }

    //actualizar registros
    public function profileUserUpdate(ProfileUserFormRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->update();
        return redirect('/home');
    }

    //actualizar contraseña
    public function profilePasswordUpdate(PasswordUpdateFormRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->password=Hash::make($request->get('password'));
        $usuario->update();
        return redirect('/home');
    }
    
    //actualizar registros
    public function update(UsuariosUpdateFormRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=Hash::make($request->get('password'));
        $usuario->is_admin=($request->get('admin') == 1) ? 1 : 0;
        $usuario->update();
        return redirect('/usuarios');
    }

    // eliminar registros
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        return redirect('/usuarios');
    }
}
