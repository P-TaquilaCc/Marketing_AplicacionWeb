<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Plan;

class PlanController extends Controller
{
    public function list(){

        //Hace una consulta y llama a todos los registros que hay en la tabla PLAN
        $planes = Plan::all();

        //Muestra los registros en la vista planes LIST
        return view('admin.planes.list', compact('planes'));

    }

    public function create(){
        //Muestra la vista del formulario para agregar el nuevo PLAN
        return view('admin.planes.add');
    }

    public function add(Request $request){

        //Valida los campos necesarios que el usuario Administrador debe ingresar
        $request->validate([
            'nombre' => 'required',
            'precioMensual' => 'required',
            'porcentaje' => 'required'
        ],
        [
            'nombre.required' => 'El campo nombre es obligatorio',
            'precioMensual.required' => 'El campo precio mensual es obligatorio',
            'porcentaje.required' => 'El campo porcentaje es obligatorio'
        ]);

        //Obtiene todos los campos ingresados en los inputs por el usuario Administrador
        $input = $request->all();

        //Crea una nueva instancia de la entidad PLAN y agrega los valores ingresados en el input a sus atributos
        $plan = new Plan();

        $plan->nombre = $input['nombre'];
        $plan->precioMensual = $input['precioMensual'];
        $plan->porcentaje = $input['porcentaje'];

        //Guarda la instancia en la BD
        $plan->save();

        //Muestra la vista Plan index con el mensaje de agregado
        return redirect()->route('admin.plan.index')
        ->with('success','Plan agregado con éxito');
    }

    public function edit($id){
        //Hace la consulta al a BD para obtener el registro a editar mediante el ID del PLAN
        $data = Plan::findOrFail($id);

        //Muestra la vista planes EDIT, llevando el registro de la consulta
        return view('admin.planes.edit', compact('data'));
    }

    public function update(Request $request){

        //Valida los campos necesarios que el usuario Administrador debe ingresar
        $request->validate([
            'nombre' => 'required',
            'precioMensual' => 'required',
            'porcentaje' => 'required'
        ],
        [
            'nombre.required' => 'El campo nombre es obligatorio',
            'precioMensual.required' => 'El campo precio mensual es obligatorio',
            'porcentaje.required' => 'El campo porcentaje es obligatorio'
        ]);

        //Obtiene todos los campos ingresados en los inputs por el usuario Administrador
        $input = $request->all();

        //Hace la consulta al a BD para obtener el registro a editar mediante el ID del PLAN
        $plan = Plan::findOrFail($request->id);

        //Actualiza la nueva instancia de la Entidad Plan con los nuevos datos ingresados en los inputs
        $plan->update($input);

        //Muestra la vista Plan index con el mensaje de editado
        return redirect()->route('admin.plan.index')
        ->with('success','Plan editado con éxito');

    }

    public function delete(Request $request){
        //Hace la consulta al a BD para obtener el registro a eliminar mediante el ID del PLAN
        $plan = Plan::findOrFail($request->id);
        $query = $plan->plan->count();

        if($query > 0){
            return back()->with('warning','No se puede eliminar el plan porque existe negocios agregados a este plan');
        }

        //Elimina el registro que fue obtenido en la consulta
        $plan->delete();

        //Muestra la vista Plan index con el mensaje de eliminado
        return back()->with('delete','Plan eliminado con éxito');
    }

}
