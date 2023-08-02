@extends('layouts.negocio')
@section('content')

    <h3 style="color: #000; margin-top: 40px">Agregar Cupones</h3><br>

    <form  action="{{ route('negocio.cupon.add') }}" method="POST">

        @csrf
        <div class="card py-3 m-b-15">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="" class="form-label" > Código del cupón</label>
                        <input type="" id="codigo" name="codigo" type="text" class="form-control" tabindex ="1">
                        @error('codigo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="" class="form-label" > Porcentaje del descuento</label>

                        <div class="input-group">
                            <input id="porcentaje" name="porcentaje" type="text" class="form-control" tabindex ="1">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        @error('porcentaje')
                                <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="" class="form-label" > Fecha Inicio</label>
                        <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control text-center">
                        @error('fecha_inicio')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="" class="form-label" > Fecha Final</label>
                        <input id="fecha_fin" type="date" name="fecha_fin" class="form-control text-center">
                        @error('fecha_fin')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="" class="form-label" > Estado</label>
                        <select class="form-control" name="estado">
                            <option value="1">Vigente</option>
                            <option value="0">Expirado</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <button type="submit" class="btn-2 btn-primary" id="btnAgregar">Guardar</button>
            </div>
        </div>
      </form>
@endsection

