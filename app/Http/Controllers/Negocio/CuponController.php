<?php

namespace App\Http\Controllers\Negocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cupon;


class CuponController extends Controller
{
    public function list(){

        //Hace una consulta y llama a todos los registros que hay en la tabla CUPONES filtrando por el ID del NEGOCIO
        $cupones= Cupon::where('idNegocio', session('idNegocio'))->get();

        //Muestra los registros en la vista Cupon LIST
        return view('negocio.cupones.list', compact('cupones'));
    }

    public function create(){
        //Muestra la vista del formulario para agregar el nuevo CUPÓN
        return view('negocio.cupones.add');
    }

    public function add(Request $request){

        //Valida los campos necesarios que el usuario Negocio debe ingresar
        $request->validate([
            'codigo' => 'required',
            'porcentaje' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ],
        [
            'codigo.required' => 'El campo codigo es obligatorio',
            'porcentaje.required' => 'El campo porcentaje es obligatorio',
            'fecha_inicio.required' => 'El campo fecha inicio es obligatorio',
            'fecha_fin.required' => 'El campo fecha final es obligatorio'
        ]);


        //Obtiene todos los campos ingresados en los inputs por el usuario Negocio
        $input = $request->all();

        //Crea una nueva instancia de la entidad CUPÓN y agrega los valores ingresados en el input a sus atributos
        $cupon = new Cupon();
        $cupon->idNegocio = session('idNegocio');
        $cupon->codigo = $input['codigo'];
        $cupon->porcentaje = $input['porcentaje'];
        $cupon->fechaInicio = $input['fecha_inicio'];
        $cupon->fechaFin = $input['fecha_fin'];
        $cupon->estado = $input['estado'];

        //Guarda la instancia en la BD
        $cupon->save();

        //Muestra la vista CUPÓN index con el mensaje de agregado
        return redirect()->route('negocio.cupon.index')
        ->with('success','Cupón agregado con éxito');
    }

    public function edit($id){

        //Hace la consulta a la BD para obtener el registro a editar mediante el ID de la CUPÓN
        $data = Cupon::findOrFail($id);

        //Muestra la vista cupón EDIT, llevando el registro de la consulta
        return view('negocio.cupones.edit', compact('data'));
    }

    public function update(Request $request){
        //Valida los campos necesarios que el usuario Negocio debe ingresar
        $request->validate([
            'codigo' => 'required',
            'porcentaje' => 'required',
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
        ],
        [
            'codigo.required' => 'El campo codigo es obligatorio',
            'porcentaje.required' => 'El campo porcentaje es obligatorio',
            'fechaInicio.required' => 'El campo fecha inicio es obligatorio',
            'fechaFin.required' => 'El campo fecha final es obligatorio'
        ]);

        //Obtiene todos los campos ingresados en los inputs por el usuario Negocio
        $input = $request->all();

        //Obtiene el registro a editar mediante el ID del cupón
        $cupon = Cupon::findOrFail($request->id);
        //Actualiza la nueva instancia de la Entidad Cupón con los nuevos datos ingresados en los inputs
        $cupon->update($input);


        //Muestra la vista Cupón index con el mensaje de editado
        return redirect()->route('negocio.cupon.index')
        ->with('success','Cupón editado con éxito');
    }

    public function delete(Request $request){

        //Hace la consulta al a BD para obtener el registro a eliminar mediante el ID del CUPÓN
        $cupon = Cupon::findOrFail($request->id);

        //Elimina el registro que fue obtenido en la consulta
        $cupon->delete();

        //Muestra la vista Categoría index con el mensaje de eliminado
        return back()->with('delete','Cupón eliminado con éxito');
    }
}
