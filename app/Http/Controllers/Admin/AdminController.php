<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Negocio;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function check(Request $request){

        //Validación de los datos de entrada
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ],[
            'email.required' => 'El correo electrónico es obligatorio',
            'password.required' => 'La contraseña es obligatorio'
        ]);

        //Verifica si los datos ingresados se encuentra en la tabla USUARIO
        if(Auth::guard('admin')->attempt(['email'=> $request->email,'password' => $request->password, 'tipo' => 1])){

            //Obtiene el usuario y se guarda en una Session
            $query = User::where('email','=',$request->email)->first();
            session([
                'idAdmin' => $query->id,
                'nomAdmin' => $query->name,
                'fotoAdmin' => $query->fotoPerfil
            ]);

            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login')->with('fail','Credenciales incorrectas!!');
        }
    }

    //Cerrar sesión
    function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }


    function editProfile($id){
        //Obtiene el usuario a editar mediante el ID
        $data = User::findOrFail($id);
        //Llama a la vista editar perfil, llevando el usuario a editar
        return view('admin.Perfil', compact('data'));
    }

    function updateProfile(Request $request){

        //Obtiene todo los valores ingresados en los inputs
        $input = $request->all();

        //Obtiene el usuario a editar mediante el ID
        $admin = User::findOrFail($request->id);
        $correo = $admin->email;

        //Valida que el correo sea único en la tabla Usuario
        if($correo != $request->email){
            $request->validate([
                'email' => 'unique:users'
            ]);
        }

        //Valida los datos ingresados en el input
        $request->validate([
            'dni' => 'required|max:8',
            'name' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
        ],[
            'dni.required' => 'El campo DNI es obligatorio',
            'name.required' => 'El campo Nombre Comercial es obligatorio',
            'email.required' => 'El campo correo electrónico es obligatorio',
            'telefono.required' => 'El campo telefono es obligatorio',
        ]);

        //Se valida que se haya ingresado una imagen
        if($request->fotoPerfil != null){
            $request->validate([
                'fotoPerfil' => 'mimes:png,jpg,bmp,jpeg,webp',
            ],
            [
                'fotoPerfil.mimes' => 'La imagen debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp',
            ]);

            $file = $request->file('fotoPerfil');
            $file->store('public/images/userPerfil');
            $hashNameImagen = $file->hashName();
            $input["fotoPerfil"] = $hashNameImagen;
        }

        //Se actualiza en la Session en nombre del usuario
        session(['nomAdmin' => $request->name]);

        $admin->update($input);
        return back()->with('success','Perfil actualizado con éxito');
    }

    function updatePassword(Request $request){

        //Obtiene todo los valores ingresados en los inputs
        $input = $request->all();

        //Obtiene el usuario mediante el ID a editar
        $admin = User::findOrFail($request->id);

        //Valida los datos ingresados
        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ],[
            'password.required' => 'El campo contraseña es obligatorio',
            'password.confirmed' => 'Las contraseñas deben ser iguales'
        ]);

        //Encripta la nueva contraseña ingresada
        $input['password'] = Hash::make($request->password);

        //Actualiza los campos en la BD
        $admin->update($input);
        return back()->with('success','Contraseña actualizado con éxito');

    }

    public function countItems(){

        //Devuelve la cantidad de registros en PEDIDO, NEGOCIO y USUARIO
        $pedidos = Pedido::get()->count();
        $negocios = Negocio::get()->count();
        $usuarios = User::where('tipo', 0)->get()->count();
        return view('admin.dashboard', compact('pedidos', 'negocios', 'usuarios'));
    }

}
