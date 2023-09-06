<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CategoriaNegocio;

class CategoriaController extends Controller
{
    public function list(){

        //Hace una consulta y llama a todos los registros que hay en la tabla CATEGORIA
        $categoria_negocios = CategoriaNegocio::all();

        //Muestra los registros en la vista categorias LIST
        return view('admin.categorias.list', compact('categoria_negocios'));
    }

    public function create(){
        //Muestra la vista del formulario para agregar la nueva CATEGORÍA
        return view('admin.categorias.add');
    }

    public function add(Request $request){

        //Valida los campos necesarios que el usuario Administrador debe ingresar
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required | mimes:png',
        ],
        [
            'nombre.required' => 'El campo nombre es obligatorio',
            'imagen.required' => 'La imagen es obligatorio',
            'imagen.mimes' => 'La imagen debe ser un archivo .png'
        ]);

        //Obtiene todos los campos ingresados en los inputs por el usuario Administrador
        $input = $request->all();

        //Crea una nueva instancia de la entidad CATEGORÍA y agrega los valores ingresados en el input a sus atributos
        $categoria_negocio = new CategoriaNegocio();
        $categoria_negocio->nombre = $input['nombre'];

        //Verifica si se ha ingresado una imagen
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $file->store('public/images/categoriaNegocio');
            $hashNameImagen = $file->hashName();
            $categoria_negocio->imagen = $hashNameImagen;
        }

        $categoria_negocio->estado = $input['estado'];

        //Guarda la instancia en la BD
        $categoria_negocio->save();

        //Muestra la vista Categoría index con el mensaje de agregado
        return redirect()->route('admin.categoria.index')
        ->with('success','Categoría registrado con éxito');
    }

    public function edit($id){

        //Hace la consulta a la BD para obtener el registro a editar mediante el ID de la CATEGORÍA
        $data = CategoriaNegocio::findOrFail($id);

        //Muestra la vista categorías EDIT, llevando el registro de la consulta
        return view('admin.categorias.edit', compact('data'));

    }

    public function update(Request $request){

        //Valida los campos necesarios que el usuario Administrador debe ingresar
        $request->validate([
            'nombre' => 'required'
        ],
        [
            'nombre.required' => 'El campo nombre es obligatorio'
        ]);


        //Obtiene todos los campos ingresados en los inputs por el usuario Administrador
        $input = $request->all();

        //Actualiza la nueva instancia de la Entidad Categoría con los nuevos datos ingresados en los inputs
        $categoria_negocio = CategoriaNegocio::findOrFail($request->id);

        //Verifica si se ha ingresado una imagen
        if($request->imagen != null){
            $request->validate([
                'imagen' => 'mimes:png'
            ],
            [
                'imagen.mimes' => 'La imagen debe ser un archivo .png'
            ]);

            $file = $request->file('imagen');
            $file->store('public/images/categoriaNegocio');
            $hashNameImagen = $file->hashName();
            $input["imagen"] = $hashNameImagen;
        }

        //Actualiza la nueva instancia de la Entidad Categoría con los nuevos datos ingresados en los inputs
        $categoria_negocio->update($input);

        //Muestra la vista Categoría index con el mensaje de editado
        return redirect()->route('admin.categoria.index')
        ->with('success','Categoría editado con éxito');

    }

    public function delete(Request $request){
        //Hace la consulta al a BD para obtener el registro a eliminar mediante el ID del CATEGORÍA
        $categoria_negocio = CategoriaNegocio::findOrFail($request->id);
        $query = $categoria_negocio->category->count();

        if($query > 0){
            return back()->with('warning','No se puede eliminar la categoría porque existe negocios agregados a esta categoría');
        }

        //Elimina el registro que fue obtenido en la consulta
        $categoria_negocio->delete();

        //Muestra la vista Categoría index con el mensaje de eliminado
        return back()->with('delete','Categoría eliminado con éxito');
    }


    #API

    // Lista toda las categorías de los negocios con estado Activo(1)
    public function index(){

        try {

            $categoria_negocio = CategoriaNegocio::all()->where('estado', 1);
            if ($categoria_negocio->isEmpty()) {
                return response()->json(['message' => 'No se encontraron categorías de negocio'], 404);
            }

            return response()->json($categoria_negocio);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error en el servidor'], 500);
        }

    }
}
