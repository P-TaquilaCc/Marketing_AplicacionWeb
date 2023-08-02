@extends('layouts.negocio')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Editar Banner - [{{ $data->id }}]</h3><br>

    <form  action="{{ route('negocio.banner.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card py-3 m-b-15">
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="imagen" class="form-label" > Imagen</label>
                            <img src="{{ url('storage/uploads/banners').'/'. $data->imagen }}" alt="{{$data->nombre}}" width="150">
                            <br>
                            <input type="file"  name="imagen" class="mt-2">
                            <br>
                            @error('imagen')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="" class="form-label" > Estado</label>
                            <select class="form-control" name="estado">
                                <option value="1" {{$data->estado == 1 ? 'selected' : ''}}>Activo</option>
                                <option value="0" {{$data->estado == 0 ? 'selected' : ''}}>Inactivo</option>
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

