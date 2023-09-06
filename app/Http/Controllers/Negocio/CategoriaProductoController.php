<?php

namespace App\Http\Controllers\Negocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CategoriaProducto;

class CategoriaProductoController extends Controller
{
    public function list(){

        //Hace una consulta y llama a todos los registros que hay en la tabla CATEGORIA filtrando por el ID del NEGOCIO
        $categoria_productos = CategoriaProducto::where('idNegocio', session('idNegocio'))->get();

        //Muestra los registros en la vista Categorias LIST
        return view('negocio.categorias.list', compact('categoria_productos'));
    }

    public function create(){
        //Muestra la vista del formulario para agregar la nueva CATEGORÍA
        return view('negocio.categorias.add');
    }

    public function add(Request $request){

        //Valida los campos necesarios que el usuario Negocio debe ingresar
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required | mimes:png'
        ],
        [
            'nombre.required' => 'El campo nombre es obligatorio',
            'imagen.required' => 'La imagen es obligatorio',
            'imagen.mimes' => 'La imagen debe ser un archivo .png'
        ]);

        //Obtiene todos los campos ingresados en los inputs por el usuario Negocio
        $input = $request->all();

        //Crea una nueva instancia de la entidad CATEGORÍA y agrega los valores ingresados en el input a sus atributos
        $categoria_producto = new CategoriaProducto();
        $categoria_producto->idNegocio = session('idNegocio');
        $categoria_producto->nombre = $input['nombre'];

        //Verifica si se ha ingresado una imagen
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $file->store('public/images/categoriaProducto');
            $hashNameImagen = $file->hashName();
            $categoria_producto->imagen = $hashNameImagen;
        }

        $categoria_producto->estado = $input['estado'];

        //Guarda la instancia en la BD
        $categoria_producto->save();

        //Muestra la vista Categoría index con el mensaje de agregado
        return redirect()->route('negocio.categoria.index')
        ->with('success','Categoría registrado con éxito');

    }

    public function edit($id){

        //Hace la consulta a la BD para obtener el registro a editar mediante el ID de la CATEGORÍA
        $data = CategoriaProducto::findOrFail($id);

        //Muestra la vista categorías EDIT, llevando el registro de la consulta
        return view('negocio.categorias.edit', compact('data'));
    }

    public function update(Request $request){
        //Valida los campos necesarios que el usuario Administrador debe ingresar
        $request->validate([
            'nombre' => 'required'
        ],
        [
            'nombre.required' => 'El campo nombre es obligatorio'
        ]);

        //Obtiene todos los campos ingresados en los inputs por el usuario Negocio
        $input = $request->all();

        //Obtiene el registro a editar mediante el ID de la categoría del Producto
        $categoria_producto = CategoriaProducto::findOrFail($request->id);

        //Verifica si se ha ingresado una imagen
        if($request->imagen != null){
            $request->validate([
                'imagen' => 'mimes:png'
            ],
            [
                'imagen.mimes' => 'La imagen debe ser un archivo .png'
            ]);
            $file = $request->file('imagen');
            $file->store('public/images/categoriaProducto');
            $hashNameImagen = $file->hashName();
            $input["imagen"] = $hashNameImagen;
        }

        //Actualiza la nueva instancia de la Entidad Categoría con los nuevos datos ingresados en los inputs
        $categoria_producto->update($input);

        //Muestra la vista Categoría index con el mensaje de editado
        return redirect()->route('negocio.categoria.index')
        ->with('success','Categoría editado con éxito');

    }

    public function delete(Request $request){

        //Hace la consulta al a BD para obtener el registro a eliminar mediante el ID del CATEGORÍA
        $categoria_producto = CategoriaProducto::findOrFail($request->id);
        $query = $categoria_producto->productos->count();

        if($query > 0){
            return back()->with('warning','No se puede eliminar la categoría, primero debe quitar los productos relacionados a esta categoría');
        }

        //Elimina el registro que fue obtenido en la consulta
        $categoria_producto->delete();

        //Muestra la vista Categoría index con el mensaje de eliminado
        return back()->with('delete','Categoría eliminado con éxito');

    }


    // API
    public function show($id){
        //Obtiene las categorias de un negocio mediante el ID del NEGOCIO
        $categoria = CategoriaProducto::all()->where('idNegocio', $id)->where('estado', 1);
        return response()->json($categoria);

    }
}
