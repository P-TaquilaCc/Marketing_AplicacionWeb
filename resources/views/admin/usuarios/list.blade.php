@extends('layouts.admin')
@section('content')
    <h3 style="color: #000; margin-top: 90px">Usuarios</h3><br>

    <table id="datatableAdmin" class="table table-striped table-responsive-md" style="width: 100%">
        <thead>
            <tr class="title-table">
                <td>Foto de Perfil</td>
                <td>DNI</td>
                <td style="width:300px">Nombre y Apellidos</td>
                <td>Correo</td>
                <td>Teléfono</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr class="body-table">
                    <td >
                        @if($usuario->fotoPerfil != null)
                            <img class="img-responsive" src="{{ url('storage/uploads/fotoCliente').'/'.$usuario->fotoPerfil }}" width="100" height="80" alt="Perfil">
                        @else
                            <img class="img-responsive" src="../../img/foto-perfil.png" width="100" height="80" alt="Perfil">
                        @endif

                    </td>
                    <td>{{ $usuario->dni }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->telefono }}</td>
                </tr>

            @endforeach
        </tbody>
    </table>


@endsection
