@extends('layouts.admin')
@section('content')
    <h3 style="color: #000; margin-top: 90px">Editar Categoría - [{{ $data->nombre }}]</h3><br>
    <form  action="{{ route('admin.categoria.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card py-3 m-b-15">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <label for="" class="form-label" > Nombres</label>
                        <input type="" id="nombre" name="nombre" value="{{ $data->nombre }}" type="text" class="form-control" tabindex ="1">
                        @error('nombre')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                        <div class="form-group col-md-6">
                        <label for="" class="form-label" > Estado</label>
                        <select class="form-control" name="estado">
                            <option value="1" {{$data->estado == 1 ? 'selected' : ''}} >Activo</option>
                            <option value="0" {{$data->estado == 0 ? 'selected' : ''}} >Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">

                        <label for="imagen" class="form-label" > Imagen</label>
                        <img src="{{ url('storage/uploads/categoriaNegocio').'/'. $data->imagen }}" alt="{{$data->nombre}}" width="150">
                        <br>
                        <input type="file"  name="imagen" class="mt-2">
                        <br>
                        @error('imagen')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
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
