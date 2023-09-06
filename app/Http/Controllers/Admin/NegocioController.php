<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Negocio;
use App\Models\CategoriaNegocio;
use App\Models\Plan;

class NegocioController extends Controller
{
    public function list(){

        //Hace una consulta y llama a todos los registros que hay en la tabla NEGOCIO
        $negocios= Negocio::all();

        //Muestra los registros en la vista negocios LIST
        return view('admin.negocios.list', compact('negocios'));
    }

    public function create(){
        //Obtiene toda las categorias para mostrar en la vista donde se agregará el nuevo Negocio
        $categorias = CategoriaNegocio::get();

        //Obtiene todos los planes para mostrar en la vista donde se agregará el nuevo Negocio
        $planes = Plan::get();

        //Redirecciona la vista negocios ADD con los todo los registros de Categorias y Planes
        return view('admin.negocios.add', compact('categorias', 'planes'));
    }

    public function add(Request $request){

        //Obtiene todos los campos ingresados por el usuario Administrador
        $input = $request->all();

        //Crea una nueva instancia del modelo NEGOCIO
        $negocio = new Negocio;

        //Valida los campos necesarios que el usuario Administrador debe ingresar
        //En caso el tipo de NEGOCIO sea EMPRESARIO ingresa a esta sección del código
        if($input['tipo'] == 0){
            $request->validate([
                'tipoplan' => 'required',
                'RUC' => [
                    'required',
                    'string',
                    'size:11',
                    'regex:/^[0-9]{11}$/',
                ],
                'razonSocial' => 'required',
                'DNI' => [
                    'required',
                    'string',
                    'size:8',
                    'regex:/^[0-9]{8}$/',
                ],
                'representanteLegal' => 'required',
                'nombre' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
                'correo' => 'required|email|unique:negocios',
                'idCategoria' => 'required',
                'imagen' => 'required | mimes:png,jpg,bmp,jpeg,webp',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'latitud' => 'required',
                'longitud' => 'required'
            ],
            [
                'tipoplan.required' => 'El campo tipo de plan es obligatorio',
                'RUC.required' => 'El campo RUC es obligatorio',
                'RUC.regex' => 'El campo RUC debe ser un número entero',
                'RUC.size' => 'El campo RUC debe tener exactamente 11 dígitos',
                'razonSocial.required' => 'El campo razón Social es obligatorio',
                'DNI.required' => 'El campo DNI es obligatorio',
                'DNI.regex' => 'Ingrese un DNI válido',
                'DNI.size' => 'El campo DNI debe tener exactamente 8 dígitos',
                'representanteLegal.required' => 'El campo representante Legal es obligatorio',
                'nombre.required' => 'El campo Nombre Comercial es obligatorio',
                'telefono.required' => 'El campo telefono es obligatorio',
                'direccion.required' => 'El campo dirección es obligatorio',
                'correo.required' => 'El campo correo electrónico es obligatorio',
                'idCategoria.required' => 'El campo categoría es obligatorio',
                'imagen.required' => 'La imagen es obligatorio',
                'hora_inicio.required' => 'El campo hora de Apertura es obligatorio',
                'hora_fin.required' => 'El campo hora de Cierre es obligatorio',
                'latitud.required' => 'El campo latitud es obligatorio',
                'longitud.required' => 'El campo longitud es obligatorio',
                'imagen.mimes' => 'La imagen debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp'
            ]);

            $negocio->RUC = $input['RUC'];
            $negocio->razonSocial = $input['razonSocial'];
        }
        //En caso de que el tipo de NEGOCIO sea EMPRENDEDOR, ingresa a esta sección del código
        else{
            $request->validate([
                'tipoplan' => 'required',
                'DNI' => [
                    'required',
                    'string',
                    'size:8',
                    'regex:/^[0-9]{8}$/',
                ],
                'representanteLegal' => 'required',
                'nombre' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
                'correo' => 'required|email|unique:negocios',
                'idCategoria' => 'required',
                'imagen' => 'required | mimes:png,jpg,bmp,jpeg,webp',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'latitud' => 'required',
                'longitud' => 'required'
            ],
            [
                'tipoplan.required' => 'El campo tipo de plan es obligatorio',
                'DNI.required' => 'El campo DNI es obligatorio',
                'DNI.regex' => 'Ingrese un DNI válido',
                'DNI.size' => 'El campo DNI debe tener exactamente 8 dígitos',
                'representanteLegal.required' => 'El campo representante Legal es obligatorio',
                'nombre.required' => 'El campo Nombre Comercial es obligatorio',
                'telefono.required' => 'El campo telefono es obligatorio',
                'direccion.required' => 'El campo dirección es obligatorio',
                'correo.required' => 'El campo correo electrónico es obligatorio',
                'idCategoria.required' => 'El campo categoría es obligatorio',
                'imagen.required' => 'La imagen es obligatorio',
                'hora_inicio.required' => 'El campo hora de Apertura es obligatorio',
                'hora_fin.required' => 'El campo hora de Cierre es obligatorio',
                'latitud.required' => 'El campo latitud es obligatorio',
                'longitud.required' => 'El campo longitud es obligatorio',
                'imagen.mimes' => 'La imagen debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp'
            ]);
        }

        $negocio->idCategoria = $input['idCategoria'];
        $negocio->idPlan = $input['tipoplan'];
        $negocio->tipo = $input['tipo'];
        $negocio->DNI = $input['DNI'];
        $negocio->representanteLegal = $input['representanteLegal'];
        $negocio->nombre = $input['nombre'];
        $negocio->telefono = $input['telefono'];
        $negocio->direccion = $input['direccion'];
        $negocio->correo = $input['correo'];

        //Verifica si se ha cargado alguna imagen
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $file->store('public/images/negocio');
            $hashNameImagen = $file->hashName();
            $negocio->imagen = $hashNameImagen;
        }

        $negocio->password = Hash::make("123456");
        $negocio->hora_inicio = $input['hora_inicio'];
        $negocio->hora_fin = $input['hora_fin'];
        $negocio->latitud = $input['latitud'];
        $negocio->longitud = $input['longitud'];
        $negocio->estado = $input['estado'];


        //Guarda la Instancia del modelo NEGOCIO con sus atributos a la BD
        $negocio->save();

        //Redirecciona a la vista index con el mensaje de agregado
        return redirect()->route('admin.negocio.index')
        ->with('success','Negocio agregado con éxito');
    }

    public function edit($id){

        //Consulta en la BD el registro del negocio que se desea editar mediante el ID del NEGOCIO
        $data = Negocio::findOrFail($id);

        $planes = Plan::get();
        $categorias = CategoriaNegocio::get();

        //Lleva el resultado de las consultas
        return view('admin.negocios.edit', compact('data', 'planes', 'categorias'));
    }

    public function update(Request $request){

        //Obtiene todos los datos ingresados por el usuario Administrador
        $input = $request->all();

        //Valida los campos necesarios que el usuario Administrador debe ingresar
        //En caso el tipo de NEGOCIO sea EMPRESARIO ingresa a esta sección del código
        if($input['tipo'] == 0){
            $request->validate([
                'idPlan' => 'required',
                'RUC' => [
                    'required',
                    'string',
                    'size:11',
                    'regex:/^[0-9]{11}$/',
                ],
                'razonSocial' => 'required',
                'DNI' => [
                    'required',
                    'string',
                    'size:8',
                    'regex:/^[0-9]{8}$/',
                ],
                'representanteLegal' => 'required',
                'nombre' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
                'correo' => 'required',
                'idCategoria' => 'required',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'latitud' => 'required',
                'longitud' => 'required'
            ],
            [
                'idPlan.required' => 'El campo tipo de plan es obligatorio',
                'RUC.required' => 'El campo RUC es obligatorio',
                'RUC.regex' => 'El campo RUC debe ser un número entero',
                'RUC.size' => 'El campo RUC debe tener exactamente 11 dígitos',
                'razonSocial.required' => 'El campo razón Social es obligatorio',
                'DNI.required' => 'El campo DNI es obligatorio',
                'DNI.regex' => 'Ingrese un DNI válido',
                'DNI.size' => 'El campo DNI debe tener exactamente 8 dígitos',
                'representanteLegal.required' => 'El campo representante Legal es obligatorio',
                'nombre.required' => 'El campo Nombre Comercial es obligatorio',
                'telefono.required' => 'El campo telefono es obligatorio',
                'direccion.required' => 'El campo dirección es obligatorio',
                'correo.required' => 'El campo correo electrónico es obligatorio',
                'idCategoria.required' => 'El campo categoría es obligatorio',
                'hora_inicio.required' => 'El campo hora de Apertura es obligatorio',
                'hora_fin.required' => 'El campo hora de Cierre es obligatorio',
                'latitud.required' => 'El campo latitud es obligatorio',
                'longitud.required' => 'El campo longitud es obligatorio',
            ]);
        }
        //En caso de que el tipo de NEGOCIO sea EMPRENDEDOR, ingresa a esta sección del código
        else{
            $request->validate([
                'idPlan' => 'required',
                'DNI' => [
                    'required',
                    'string',
                    'size:8',
                    'regex:/^[0-9]{8}$/',
                ],
                'representanteLegal' => 'required',
                'nombre' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
                'correo' => 'required',
                'idCategoria' => 'required',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'latitud' => 'required',
                'longitud' => 'required'
            ],
            [
                'idPlan.required' => 'El campo tipo de plan es obligatorio',
                'DNI.required' => 'El campo DNI es obligatorio',
                'DNI.regex' => 'Ingrese un DNI válido',
                'DNI.size' => 'El campo DNI debe tener exactamente 8 dígitos',
                'representanteLegal.required' => 'El campo representante Legal es obligatorio',
                'nombre.required' => 'El campo Nombre Comercial es obligatorio',
                'telefono.required' => 'El campo telefono es obligatorio',
                'direccion.required' => 'El campo dirección es obligatorio',
                'correo.required' => 'El campo correo electrónico es obligatorio',
                'idCategoria.required' => 'El campo categoría es obligatorio',
                'hora_inicio.required' => 'El campo hora de Apertura es obligatorio',
                'hora_fin.required' => 'El campo hora de Cierre es obligatorio',
                'latitud.required' => 'El campo latitud es obligatorio',
                'longitud.required' => 'El campo longitud es obligatorio',
            ]);

            $input["RUC"] = NULL;
            $input["razonSocial"] = NULL;
        }

        //Consulta a la BD el registro que se va a editar mediante el ID del NEGOCIO
        $negocio = Negocio::findOrFail($request->id);

        //Se verifica si hay alguna imagen nueva que fue cargada
        if($request->imagen != null){
            $request->validate([
                'imagen' => 'mimes:png'
            ],
            [
                'imagen.mimes' => 'La imagen debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp'
            ]);
            $file = $request->file('imagen');
            $file->store('public/images/negocio');
            $hashNameImagen = $file->hashName();
            $input["imagen"] = $hashNameImagen;
        }

        //Se realiza la modificación del registro
        $negocio->update($input);

        //Se retorna a la vista Negocio INDEX con el mensjae de editado
        return redirect()->route('admin.negocio.index')
        ->with('success','Negocio editado con éxito');
    }

    public function delete(Request $request){

        //Consulta a la BD el negocio que se desea eliminar mediante el Id del NEGOCIo
        $negocio = Negocio::findOrFail($request->id);
        $query = $negocio->negocio->count();

        if($query > 0){
            return back()->with('warning','No es posible eliminar el negocio porque ya existen pedidos para este negocio');
        }

        $negocio->delete();
        //Retorna a la vista anterior con el mensaje de eliminado
        return back()->with('delete','Negocio eliminado con éxito');
    }

    # API

    //Listar todo los negocios para la APP
    public function index(){

        try {
            $negocios = Negocio::all()->where('estado', 1);
            return response()->json($negocios);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error en el servidor'], 500);
        }

    }


    //Listar todo los negocios para la Landing page
    public function listNegocios(){

        try {

            $negocios = Negocio::all()->where('estado', 1);
            if ($negocios->isEmpty()) {
                return response()->json(['error' => 'No se encontraron negocios activos'], 404);
            }

            $negociosConURL = $negocios->map(function ($negocio) {
                $negocio->imagenUrl = asset('storage/images/negocio') . '/' . $negocio->imagen;
                return $negocio;
            });

            return response()->json(['negocios' => $negociosConURL]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error en el servidor'], 500);
        }

    }

    //Guardar Negocio
    public function store(Request $request){

        try {
            //Obtiene todo los valores ingresados en los inputs
            $input = $request->all();
            $RUC = $input['RUC'];
            $DNI = $input['DNI'];
            $correo = $input['correo'];

            if (strlen($RUC) !== 10 || !ctype_digit($RUC)) {
                return response()->json(['error' => 'El RUC debe contener exactamente 10 dígitos numéricos.'], 400);
            }

            if (strlen($DNI) !== 8 || !ctype_digit($DNI)) {
                return response()->json(['error' => 'El DNI debe contener exactamente 8 dígitos numéricos.'], 400);
            }

            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['error' => 'El correo electrónico no es válido.'], 400);
            }

            $negocio = new Negocio;
            $imagen = $request->file('image');
            $imagen->store('public/images/negocio');
            $hashNameImagen = $imagen->hashName();

            if($input['tipo'] == 0){
                $negocio->RUC = $input['RUC'];
                $negocio->razonSocial = $input['razonSocial'];
            }

            $idPlan = Plan::where('porDefecto', 1)->value('id');
            $negocio->idCategoria = $input['idCategoria'];
            $negocio->idPlan = $idPlan;
            $negocio->tipo = $input['tipo'];
            $negocio->DNI = $input['DNI'];
            $negocio->representanteLegal = $input['representanteLegal'];
            $negocio->nombre = $input['nombre'];
            $negocio->telefono = $input['telefono'];
            $negocio->direccion = $input['direccion'];
            $negocio->correo = $input['correo'];
            $negocio->hora_inicio = $input['hora_inicio'];
            $negocio->hora_fin = $input['hora_fin'];
            $negocio->latitud = $input['latitud'];
            $negocio->longitud = $input['longitud'];
            $negocio->estado = 1;
            $negocio->password = Hash::make("123456");
            $negocio->imagen = $hashNameImagen;


            //Se guarda todos los valores ingresados en la instancia del modelo a la BD
            $negocio->save();
            return response()->json($negocio, 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error en el servidor'. $e], 500);
        }

    }
}
