<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ClienteController extends Controller
{

    public function list(){
        //Obtiene todos los registros de la tabla USUARIO
        $usuarios = User::where('tipo', 0)->get();
        //Lleva los registros de usuarios a la vista
        return view('admin.usuarios.list', compact('usuarios'));
    }


    # API

    public function register(Request $request){

        try {
            //Valida los datos ingresados
            $validator = Validator::make($request->all(),[
                'dni' => 'required|max:8',
                'telefono' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed'
            ],[
                'name.required' => 'El campo nombre es obligatorio',
                'email.required' => 'El campo correo es obligatorio',
                'password.required' => 'El campo contraseña es obligatorio'
            ]);

            //Si esta mal ingresado algún dato, devuleve un json con el error
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()], 400);
            }

            //Crea el usuario para guardar en la tabla USUARIO
            $user = User::create([
                'dni' => $request->dni,
                'telefono' => $request->telefono,
                'tipo' => 0,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'estado' => 1
            ]);

            //Devuelve el usuario creado, el token y un mensaje
            return response()->json(['message' => 'Registro con éxito', 'data' => $user], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error en el servidor'], 500);
        }

    }

    public function update(Request $request, $id){
        //Valida los datos ingresados
        $validator = Validator::make($request->all(),[
            'dni' => 'required|max:8',
            'telefono' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo correo es obligatorio',
        ]);

        //En caso de que haya errores por la validación, retorna un json con los errores
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }


        //Obtiene todos los valores ingresados en los inputs
        $input = $request->all();

        $user=User::find($id);
        $email = $user->email;
        if($email != $request->email){
            $validator = Validator::make($request->all(),[
                'email' => 'unique:users',
            ]);
        }

        //Encripta la nueva contraseña
        $input["password"] = Hash::make($request->password);

        //Actualiza el usuario en la BD
        $user->update($input);

        return response()->json(['message' => 'Usuario actualizado exitosamente']);

    }

    public function sendNotification(Request $request){
        $input = $request->all();

        $pedido = new Pedido();
        $pedido->idCliente = $input['idCliente'];
        $pedido->idNegocio = $input['idNegocio'];
        $pedido->direccion = $input['direccion'];
        $pedido->fecha = now();
        $pedido->descripcion = $input['descripcion'];
        $pedido->estado = 0;
        $pedido->save();

        foreach($input["producto"] as $value){
            $detalle_pedido = new DetallePedido();
            $detalle_pedido->idPedido = $pedido->id;
            $detalle_pedido->idProducto = $value["idProducto"];
            $detalle_pedido->cantidad = $value["cantidad"];
            $detalle_pedido->save();
        }


        $consultaPedido = Pedido::FindOrFail($pedido->id);
        //Instancia el modelo Pedido para agregar atributos y pasar al array de la notificación
        $pedido = new Pedido;
        $pedido->fecha = $consultaPedido->fecha;
        $pedido->nombreCliente = $consultaPedido->client->name;
        $pedido->id = $consultaPedido->id;

        //Obtiene el modelo Negocio para enviar Notificación
        $notification = User::first();
        $notification->notify(new OrderNotification($pedido));

        return response()->json(['message' => 'Success']);

    }

    public function login(Request $request){
        //Verifica si las credenciales ingresadas existe en la tabla USUARIo
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'tipo' => 0])){
            return response()->json(['error' => 'Correo y/o contraseña incorrectos'], 401);
        }

        //Obtiene el registro del usuario
        $user = Auth::user();
        //crea un token para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Autenticacion exitosa',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);

    }

    //Cerrar sesión
    public function logout(){
        //Elimina el token de inicio de sesipon
        auth()->user()->tokens()->delete();
        return[
            'message' => 'Ha cerrado sesión exitosamente'
        ];
    }

}
