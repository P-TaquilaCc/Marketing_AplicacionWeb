<?php

namespace App\Http\Controllers\Negocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banner;

class BannerController extends Controller
{
    public function list(){

        //Hace una consulta y llama a todos los registros que hay en la tabla BANNERS filtrando por el ID del NEGOCIO
        $banners= Banner::where('idNegocio', session('idNegocio'))->get();

        //Muestra los registros en la vista Banners LIST
        return view('negocio.banners.list', compact('banners'));
    }

    public function create(){

        //Muestra la vista del formulario para agregar el nuev Banner
        return view('negocio.banners.add');
    }

    public function add(Request $request){

        //Valida los campos necesarios que el usuario Negocio debe ingresar
        $request->validate([
            'imagen' => 'required | mimes:png,jpg,bmp,jpeg,webp'
        ],
        [
            'imagen.required' => 'La imagen es obligatorio',
            'imagen.mimes' => 'La imagen debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp'
        ]);

        //Obtiene todos los campos ingresados en los inputs por el usuario Negocio
        $input = $request->all();

        //Crea una nueva instancia de la entidad BANNER y agrega los valores ingresados en el input a sus atributos
        $banner = new Banner();
        $banner->idNegocio = session('idNegocio');

        //Valida si una imagen fue ingresada para poder guardar en la carpeta correspondiente
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/uploads/banners'), $filename);
            $banner->imagen = $filename;
        }

        $banner->estado = $input['estado'];

        //Guarda la instancia en la BD
        $banner->save();

        //Muestra la vista BANNER index con el mensaje de agregado
        return redirect()->route('negocio.banner.index')
        ->with('success','Banner agregado con éxito');

    }

    public function edit($id){

        //Hace la consulta a la BD para obtener el registro a editar mediante el ID de la BANNER
        $data = Banner::findOrFail($id);
        return view('negocio.banners.edit', compact('data'));
    }

    public function update(Request $request){
        //Obtiene todos los campos ingresados en los inputs por el usuario Negocio
        $input = $request->all();

        //Obtiene el registro a editar mediante el ID del Banner
        $banner = Banner::findOrFail($request->id);
        $input["idNegocio"] = session('idNegocio');

        //Verifica si se ha ingresado una imagen
        if($request->imagen != null){
            $request->validate([
                'imagen' => 'mimes:png,jpg,bmp,jpeg,webp'
            ],
            [
                'imagen.mimes' => 'La imagen debe ser un archivo .png, .jpg, .bmp, .jpeg, .webp'
            ]);
            $file = $request->file('imagen');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('storage/uploads/banners'), $filename);
            $input["imagen"] = $filename;
        }

        $banner->update($input);


        //Muestra la vista Banner index con el mensaje de editado
        return redirect()->route('negocio.banner.index')
        ->with('success','Banner editado con éxito');
    }

    public function delete(Request $request){
        //Hace la consulta al a BD para obtener el registro a eliminar mediante el ID del Banner
        $banner = Banner::findOrFail($request->id);

        //Elimina el registro que fue obtenido en la consulta
        $banner->delete();

        //Muestra la vista Categoría index con el mensaje de eliminado
        return back()->with('delete','Banner eliminado con éxito');
    }

    // API
    // Lista toda los banners de los negocios con estado Activo(1)
    public function show($id){

        try {

            //Obtiene todo los registros de la tabla Banners
            $banner = Banner::all()->where('idNegocio', $id)->where('estado',1);
            return response()->json($banner);

        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'msg' => 'error',
                'error' => 'Error al obtener banners'
            ], 500);
        }
    }
}
