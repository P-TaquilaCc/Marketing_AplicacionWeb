@extends('layouts.admin')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Reportes</h3><br>

    <div class="card-body">
        <form  action="{{ route('admin.listReport') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-8 mx-auto">
                    <label for="">Periodo</label>
                    <div class="input-group mb-3">
                        <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control text-center">
                        <div class="input-group-prepend input-group-append">
                            <div class="input-group-text" style="background-color: #e9ecef;">a</div>
                        </div>
                        <input id="fecha_fin" type="date" name="fecha_fin" class="form-control text-center">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            @error('fecha_inicio')
                                <div class="col-md-6"><span class="text-danger">{{$message}}</span></div>
                            @enderror
                            @error('fecha_fin')
                                <div class="col-md-6"><span class="text-danger">{{$message}}</span></div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Seleccionar Negocio</label>
                            <select class="form-control" name="negocioId">
                                {{-- <option selected="">Todos</option> --}}
                                 @foreach ($negocios as $negocio)
                                    <option value="{{ $negocio->id }}"  >{{ $negocio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <button type="submit" class="btn btn-success" id="btnAgregar">Generar Reporte</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <h5>Negocio: <span>Janderys</span></h5>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Producto</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>1</th>
                <td>Producto</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Total</td>
            </tr>
        </tbody>
        </table>
    </div>

@endsection

