@extends('layouts.negocio')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Editar Cupón - [{{ $data->codigo }}]</h3><br>

    <form  action="{{ route('negocio.cupon.update') }}" method="POST">

        @csrf
        <div class="card py-3 m-b-15">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <label for="" class="form-label" > Código del cupón</label>
                        <input type="" id="codigo" name="codigo" type="text" class="form-control" tabindex ="1" value="{{$data->codigo}}">
                        @error('codigo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="" class="form-label" > Porcentaje del descuento</label>

                        <div class="input-group">
                            <input id="porcentaje" name="porcentaje" type="text" class="form-control" tabindex ="1" value="{{$data->porcentaje}}">
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
                        @php
                            $fechaOriginal = $data->fechaInicio;
                            $nuevaFechaInicio = date("Y-m-d", strtotime($fechaOriginal));
                        @endphp
                        <input id="fechaInicio" type="date" name="fechaInicio" class="form-control text-center" value="{{$nuevaFechaInicio}}">
                        @error('fechaInicio')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="" class="form-label" > Fecha Final</label>
                        @php
                            $fechaOriginal = $data->fechaFin;
                            $nuevaFechaFin = date("Y-m-d", strtotime($fechaOriginal));
                        @endphp
                        <input id="fechaFin" type="date" name="fechaFin" class="form-control text-center" value="{{$nuevaFechaFin}}">
                        @error('fechaFin')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="" class="form-label" > Estado</label>
                        <select class="form-control" name="estado">
                            <option value="1" {{$data->estado == 1 ? 'selected' : ''}}>Vigente</option>
                            <option value="0" {{$data->estado == 0 ? 'selected' : ''}}>Expirado</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <button type="submit" class="btn-2 btn-primary" id="btnAgregar">Guardar Cambios</button>
            </div>
        </div>
      </form>
@endsection

