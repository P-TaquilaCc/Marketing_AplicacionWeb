@extends('layouts.admin')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Administrar Negocios</h3><br>

    <div class="text-right mb-2">
        <a href="{{ route('admin.negocio.create') }}" class="btn btn-primary">Agregar Nuevo</a>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @elseif($message = Session::get('delete'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @elseif($message = Session::get('warning'))
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @endif

    <table  id="datatableAdmin" class="table table-striped table-responsive-md" style="width: 100%">
        <thead>
            <tr class="title-table">
                <td>Imagen</td>
                <td>Nombre</td>
                <td>Categoría</td>
                <td>Teléfono</td>
                <td>E-mail</td>
                <td>Horario</td>
                <td>Estado</td>
                <td>Controles</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($negocios as $negocio)
                <tr class="body-table">
                    <td>
                        @if($negocio->imagen != null)
                            <img class="img-responsive" src="{{ url('storage/uploads/negocio').'/'. $negocio->imagen }}" width="100" height="80" alt="Imagen negocio">
                        @else
                            <img class="img-responsive" src="../../img/no-image.jpg" width="100" height="80" alt="Imagen negocio">
                        @endif
                    </td>
                    <td>{{ $negocio->nombre }}</td>
                    <td>{{ $negocio->category->nombre }}</td>
                    <td>{{ $negocio->telefono }}</td>
                    <td>{{ $negocio->correo }}</td>
                    <td>
                        @php
                            $timeStart = strtotime($negocio->hora_inicio);
                            $timeEnd = strtotime($negocio->hora_fin);
                            $newTime = date('H:i A',$timeStart) . " - " . date('H:i A',$timeEnd);
                            echo $newTime;
                        @endphp
                    </td>
                    <td>
                        @if ($negocio->estado == 1)
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-success">Activo</p>
                        @else
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-danger">Inactivo</p>
                        @endif
                    </td>

                    <td>
                        <a type="button" href="{{ route('admin.negocio.edit', $negocio->id) }}" class="btn btn-success" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen"></i></a>

                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$negocio->id}}" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$negocio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                            </div>
                            <div class="modal-body">
                            ¿Esta seguro de que quiere eliminar el negocio?
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-primary" href="{{ route('admin.negocio.delete', $negocio->id) }}">Aceptar</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection

