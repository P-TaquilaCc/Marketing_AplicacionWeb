@extends('layouts.admin')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Editar Perfil - [{{ $data->name }}]</h3><br>

    @if($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @endif
    <form  action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card m-b-15">
                <div class="card-header"><h5 style="margin-bottom: 0">Datos Personales</h5></div>
                <div class="card-body">
                    <div class="form-row">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="form-group col-md-6">
                            <label for="dni" class="form-label" > DNI</label>
                            <input type="text" id="dni" name="dni" class="form-control" tabindex ="1" value={{ $data->dni }}>
                            @error('dni')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name" class="form-label" > Nombre y Apellidos</label>
                            <input type="text" id="name" name="name" class="form-control" tabindex ="1" value="{{ $data->name }}">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group col-md-6">
                            <label for="email" class="form-label" > Correo</label>
                            <input type="text" id="email" name="email" class="form-control" tabindex ="1" value={{ $data->email }}>
                            @error('email')
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
                            <label for="fotoPerfil" class="form-label" > Foto de Perfil</label>
                            @if($data->fotoPerfil != null)
                                <img class="mb-2" src="{{ url('storage/uploads/userPerfil').'/'. $data->fotoPerfil }}" alt="{{$data->fotoPerfil}}" width="150">
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
    <form  action="{{ route('admin.updatePassword') }}" method="POST" enctype="multipart/form-data">
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
