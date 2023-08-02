@extends('layouts.negocio')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Editar Perfil - [{{ $data->razonSocial }}]</h3><br>

    @if($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @endif
    <form  action="{{ route('negocio.updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card m-b-15">
                <div class="card-header"><h5 style="margin-bottom: 0">Datos Personales</h5></div>
                <div class="card-body">
                    <div class="form-row">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="form-group col-md-6">
                            <label for="DNI" class="form-label" > DNI</label>
                            <input type="text" id="DNI" name="DNI" class="form-control" tabindex ="1" value={{ $data->DNI }}>
                            @error('DNI')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="representanteLegal" class="form-label" > Representante Legal</label>
                            <input type="text" id="representanteLegal" name="representanteLegal" class="form-control" tabindex ="1" value="{{ $data->representanteLegal }}">
                            @error('representanteLegal')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nombre" class="form-label" > Nombre del Negocio</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" tabindex ="1" value="{{ $data->nombre }}">
                            @error('nombre')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="correo" class="form-label" > Correo</label>
                            <input type="text" id="correo" name="correo" class="form-control" tabindex ="1" value={{ $data->correo }}>
                            @error('correo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="telefono" class="form-label" > Teléfono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control" tabindex ="1" value={{ $data->telefono }}>
                            @error('telefono')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="direccion" class="form-label" > Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control" tabindex ="1" value="{{ $data->direccion }}">
                            @error('direccion')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                         <div class="form-group col-md-2">
                            <label for="hora_inicio" class="form-label" >Hora de Apertura</label>
                            <input type="time" id="hora_inicio" name="hora_inicio" type="text" class="form-control" tabindex ="1" value="{{ $data->hora_inicio }}">
                            @error('hora_inicio')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-2" style="margin: auto 0; display: flex; justify-content: center">
                            <span>a</span>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="hora_fin" class="form-label" >Hora de Cierre</label>
                            <input type="time" id="hora_fin" name="hora_fin" type="text" class="form-control" tabindex ="1" value="{{ $data->hora_fin }}">
                            @error('hora_fin')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6"></div>

                        <div class="form-group col-md-6">
                            <label for="imagen" class="form-label" > Imagen</label>
                            <img src="{{ url('storage/uploads/negocio').'/'. $data->imagen }}" alt="{{$data->imagen}}" width="150">
                            <br>
                            <input type="file"  name="imagen">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fotoPerfil" class="form-label" > Foto de Perfil</label>
                            @if($data->fotoPerfil != null)
                                <img class="mb-2" src="{{ url('storage/uploads/negocioPerfil').'/'. $data->fotoPerfil }}" alt="{{$data->fotoPerfil}}" width="150">
                                <br>
                            @endif
                            <input type="file"  name="fotoPerfil">
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
    <br>
    <form  action="{{ route('negocio.updatePassword') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card m-b-15">
                <div class="card-header"><h5 style="margin-bottom: 0">Cambiar contraseña</h5></div>
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password" class="form-label" > Nueva contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" tabindex ="1">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6"></div>

                        <div class="form-group col-md-6">
                            <label for="password_confirmation" class="form-label" > Confirmar contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" tabindex ="1">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
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
