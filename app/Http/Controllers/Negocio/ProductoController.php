<?php

namespace App\Http\Controllers\Negocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\CategoriaProducto;

class ProductoController extends Controller
{
    public function list(){

        //Hace una consulta y llama a todos los registros que hay en la tabla PRODUCTO
        $productos = Producto::where('idNegocio', session('idNegocio'))->get();

        //Muestra los registros en la vista producto LIST
        return view('negocio.productos.list', compact('productos'));

    }

    public function create(){

        //Obtiene los registros de la tabla CATEGORIA que estará agregado en la tabla PRODUCTO como FK
        $categorias = CategoriaProducto::where('idNegocio', session('idNegocio'))->get();

        //Muestra la vista del formulario para agregar el nuevo PRODUCTO y también se envia todo los registros de la tabla CATEGORIAS
        return view('negocio.productos.add', compact('categorias'));

    }

    public function add(Request $request){

        //Valida los campos necesarios que el usuario Negocio debe ingresar
        $request->validate([
            'categoria' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'imagen' => 'required | mimes:png,jpg,bmp,jpeg,webp'
        ],
        [
            'categoria.required' => 'El campo categoria es obligatorio',
            'nombre.required' => 'El campo nombre es obligatorio',
            'descripcion.required' => 'El campo descripcion es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
            'imagen.required' => 'La imagen es obligatorio',
            'imagen.mimes' => 'La imagen debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp'
        ]);

        //Obtiene todos los campos ingresados en los inputs por el usuario Negocio
        $input = $request->all();

        //Crea una nueva instancia de la entidad PRODUCTO y agrega los valores ingresados en el input a sus atributos
        $producto = new Producto();
        $producto->idNegocio = session('idNegocio');
        $producto->idCategoria = $input['categoria'];
        $producto->nombre = $input['nombre'];
        $producto->descripcion = $input['descripcion'];
        $producto->precio = $input['precio'];

        //Verifica si se ha ingresado una imagen
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $file->store('public/images/productos');
            $hashNameImagen = $file->hashName();
            $producto->imagen = $hashNameImagen;
        }
        $producto->estado = $input['estado'];

        //Guarda la instancia en la BD
        $producto->save();

        //Muestra la vista Producto index con el mensaje de agregado
        return redirect()->route('negocio.producto.index')
        ->with('success','Producto agregado con éxito');
    }

    public function edit($id){

        //Hace la consulta al a BD para obtener el registro a editar mediante el ID del PRODUCTO
        $data = Producto::findOrFail($id);

        //Obtiene los registros de la tabla CATEGORIA que estará agregado en la tabla PRODUCTO como FK
        $categorias = CategoriaProducto::where('idNegocio', session('idNegocio'))->get();

        //Muestra la vista producto EDIT, se envía el registro del Producto a editar y todo los registros de la tabla categoría
        return view('negocio.productos.edit', compact('data', 'categorias'));
    }

    public function update(Request $request){

        //Valida los campos necesarios que el usuario Negocio debe ingresar
        $request->validate([
            'categoria' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required'
        ],
        [
            'categoria.required' => 'El campo categoria es obligatorio',
            'nombre.required' => 'El campo nombre es obligatorio',
            'descripcion.required' => 'El campo descripcion es obligatorio',
            'precio.required' => 'El campo precio es obligatorio'
        ]);

        //Obtiene todos los campos ingresados en los inputs por el usuario Negocio
        $input = $request->all();

        //Obtiene el registro del producto a editar mediante el ID del PRODUCTO
        $producto = Producto::findOrFail($request->id);

        //Verifica si se ha ingresado una imagen
        if($request->imagen != null){
            $request->validate([
                'imagen' => 'required | mimes:png,jpg,bmp,jpeg,webp'
            ], [
                'imagen.mimes' => 'La imagen debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp'
            ]);
            $file = $request->file('imagen');
            $file->store('public/images/productos');
            $hashNameImagen = $file->hashName();
            $input["imagen"] = $hashNameImagen;
        }

        //Actualiza la nueva instancia de la Entidad Producto con los nuevos datos ingresados en los inputs
        $producto->update($input);

        //Muestra la vista Producto index con el mensaje de editado
        return redirect()->route('negocio.producto.index')
        ->with('success','Producto editado con éxito');

    }

    public function delete(Request $request){

        //Hace la consulta al a BD para obtener el registro a eliminar mediante el ID del CATEGORÍA
        $product = Producto::findOrFail($request->id);
        $query = $product->product->count();

        if($query > 0){
            return back()->with('warning','No es posible eliminar el producto porque ya existe pedidos de este producto');
        }

        //Elimina el registro que fue obtenido en la consulta
        $product->delete();

        //Muestra la vista Producto index con el mensaje de eliminado
        return back()->with('delete','Producto eliminado con éxito');
    }

    // API
    // Muestra todo los registros de productos filtrados por ID del NEGOCIO
    public function index($id){
         try {

            //Obtiene los registros de la tabla PRODUCTO
            $producto = Producto::all()->where('idNegocio', $id)->where('estado', 1);
            return response()->json($producto);

        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'msg' => 'error',
                'error' => 'Error al obtener productos'
            ], 500);
        }
    }
}

