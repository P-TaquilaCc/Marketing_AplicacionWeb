@extends('layouts.negocio')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Editar Producto - [{{ $data->nombre }}]</h3><br>
    <form  action="{{ route('negocio.producto.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card py-3 m-b-15">
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Categoría</label>
                            <select name="categoria" class="form-control">
                                <option selected disabled>Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{$data->idCategoria == $categoria->id ? 'selected' : ''}} >{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                            @error('categoria')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Nombre</label>
                            <input type="" id="nombre" name="nombre" type="text" class="form-control" tabindex ="1" value="{{ $data->nombre }}">
                            @error('nombre')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="" class="form-label" > Descripción</label>
                            <textarea name="descripcion" class="form-control" cols="50" rows="4">{{ $data->descripcion }}</textarea>
                            @error('descripcion')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="" class="form-label" > Precio</label>
                            <input name="precio" type="text" class="form-control" tabindex ="1" value="{{ $data->precio }}">
                            @error('precio')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
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
                            <img src="{{ url('storage/uploads/productos').'/'. $data->imagen }}" alt="{{$data->nombre}}" width="150">
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
                    <button type="submit" class="btn-2 btn-primary">Guardar</button>

                </div>
            </div>

      </form>

@endsection

