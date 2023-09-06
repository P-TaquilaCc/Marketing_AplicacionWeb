<?php

namespace App\Http\Controllers\Negocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Negocio;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
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

        //Verifica si los datos ingresados se encuentra en la tabla NEGOCIO
        if(Auth::guard('negocio')->attempt(['correo'=> $request->email,'password' => $request->password])){

            //Obtiene el usuario y se guarda en una Session
            $query = Negocio::where('correo','=',$request->email)->first();
            session([
                'idNegocio' => $query->id,
                'nombre' => $query->representanteLegal,
                'fotoPerfil' => $query->fotoPerfil
            ]);
            return redirect()->route('negocio.dashboard');
        }else{
            return redirect()->back()->with('fail','Credenciales incorrectas');
        }
    }

    //Cerrar sesión
    function logout(){
        Auth::guard('negocio')->logout();
        return redirect('/');
    }

    function editProfile($id){
        //Obtiene el usuario a editar mediante el ID
        $data = Negocio::findOrFail($id);
        //Llama a la vista editar perfil, llevando el usuario a editar
        return view('negocio.Perfil', compact('data'));
    }

    function updateProfile(Request $request){

        //Obtiene todo los valores ingresados en los inputs
        $input = $request->all();

        //Obtiene el usuario a editar mediante el ID
        $negocio = Negocio::findOrFail($request->id);
        $correo = $negocio->correo;

        //Valida que el correo sea único en la tabla Usuario
        if($correo != $request->correo){
            $request->validate([
                'correo' => 'unique:negocios'
            ]);
        }

        //Valida los datos ingresados en el input
        $request->validate([
            'DNI' => 'required|max:8',
            'representanteLegal' => 'required',
            'nombre' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required',
            'direccion' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required'
        ],[
            'DNI.required' => 'El campo DNI es obligatorio',
            'representanteLegal.required' => 'El campo representante Legal es obligatorio',
            'nombre.required' => 'El campo Nombre Comercial es obligatorio',
            'correo.required' => 'El campo correo electrónico es obligatorio',
            'telefono.required' => 'El campo telefono es obligatorio',
            'direccion.required' => 'El campo dirección es obligatorio',
            'hora_inicio.required' => 'El campo hora de Apertura es obligatorio',
            'hora_fin.required' => 'El campo hora de Cierre es obligatorio',

        ]);

        //Se valida que se haya ingresado una imagen
        if($request->imagen != null){
            $request->validate([
                'imagen' => 'mimes:png,jpg,bmp,jpeg,webp',
            ],
            [
                'imagen.mimes' => 'La imagen debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp',
            ]);

            $file = $request->file('imagen');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('storage/uploads/negocio'), $filename);

            $input["imagen"] = $filename;
        }

        //Se valida que se haya ingresado una imagen
        if($request->fotoPerfil != null){
            $request->validate([
                'fotoPerfil' => 'mimes:png,jpg,bmp,jpeg,webp'
            ],
            [
                'fotoPerfil.mimes' => 'La foto de Perfil debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp',
            ]);

            $fileProfile = $request->file('fotoPerfil');
            $fileProfile->store('public/images/negocioPerfil');
            $hashNameImagen = $fileProfile->hashName();
            $input["fotoPerfil"] = $hashNameImagen;
        }

        //Se actualiza en la Session en nombre del usuario
        session(['nombre' => $request->representanteLegal]);

        $negocio->update($input);
        return back()->with('success','Perfil actualizado con éxito');
    }

    function updatePassword(Request $request){

        //Obtiene todo los valores ingresados en los inputs
        $input = $request->all();

        //Obtiene el usuario mediante el ID a editar
        $negocio = Negocio::findOrFail($request->id);

        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ],[
            'password.required' => 'El campo contraseña es obligatorio',
            'password.confirmed' => 'Las contraseñas deben ser iguales'
        ]);

        //Encripta la nueva contraseña ingresada
        $input['password'] = Hash::make($request->password);

        //Actualiza los campos en la BD
        $negocio->update($input);
        return back()->with('success','Contraseña actualizado con éxito');

    }


    public function countItems(){

        //Devuelve la cantidad de registros en PEDIDO, NEGOCIO y USUARIO
        $productos = Producto::where('idNegocio', session('idNegocio'))->get()->count();
        $pedidos = Pedido::where('estado','1')->where('idNegocio', session('idNegocio'))->get()->count();
        return view('negocio.dashboard', compact('productos', 'pedidos'));
    }


}

