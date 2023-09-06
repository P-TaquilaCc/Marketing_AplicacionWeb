@extends('layouts.admin')
@section('content')
    <h3 style="color: #000; margin-top: 90px">Editar Producto - [{{ $data->nombre }}]</h3><br>
    <form  action="{{ route('admin.plan.update') }}" method="POST" >
        @csrf
            <div class="card py-3 m-b-15">
                <div class="card-body">
                    <div class="form-row">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="form-group col-md-4">
                            <label for="" class="form-label" > Nombre</label>
                            <input type="" id="nombres" name="nombre" type="text" value="{{ $data->nombre }}" class="form-control" tabindex ="1">
                            @error('nombre')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                         <div class="form-group col-md-4">
                            <label for="" class="form-label" > Precio Mensual</label>

                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">S/</span>
                                </div>
                                <input id="precioMensual" name="precioMensual" type="text" class="form-control" value="{{ $data->precioMensual }}" tabindex ="1">

                            </div>
                            @error('precioMensual')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="" class="form-label" > Porcentaje Comisión</label>

                            <div class="input-group">
                                <input id="porcentaje" name="porcentaje" type="text" value="{{ $data->porcentaje }}" class="form-control" tabindex ="1">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            @error('porcentaje')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                         <div class="form-group col-md-4">
                            <label for="" class="form-label" > Plan por Defecto</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="porDefecto" value="1" name="porDefecto" {{ $data->porDefecto == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="porDefecto">Si</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="submit" class="btn-2 btn-primary" id="btnAgregar">Guardar cambios</button>

                </div>
            </div>

      </form>
@endsection

