<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Negocio;

class ReporteController extends Controller
{
    public function generateReport(){
        $negocios = Negocio::all();
        return view('admin.reporte.report', compact('negocios'));
    }

    public function listReport(Request $request){
        $input = $request->all();
        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required'
        ], [
            'fecha_inicio.required' => 'La fecha inicial es obligatorio',
            'fecha_fin.required' => 'La fecha final es obligatorio'
        ]);

        $negocio = Negocio::findOrFail($request->negocioId);

        dd($input);
    }
}
