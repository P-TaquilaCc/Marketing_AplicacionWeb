@extends('layouts.admin')
@section('content')
    <h3 style="color: #000; margin-top: 90px">Administrar Categorías</h3><br>

    <div class="text-right mb-2">
        <a href="{{ route('admin.categoria.create') }}" class="btn btn-primary">Agregar Nuevo</a>
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

    <table id="datatableAdmin" class="table table-striped table-responsive-md" style="width: 100%">
        <thead>
            <tr class="title-table">
                <td style="width:300px">Nombre</td>
                <td>Imagen</td>
                <td>Estado</td>
                <td>Controles</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoria_negocios as $categoria)
                <tr class="body-table">
                    <td>{{ $categoria-> nombre }}</td>
                    <td >
                        <img src="{{ asset('storage/images/categoriaNegocio/'. $categoria->imagen) }}" width="100" height="80" alt="Imagen negocio">
                    </td>
                    <td>
                        @if ($categoria->estado == 1)
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-success">Activo</p>
                        @else
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-danger">Inactivo</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <a type="button" href="{{ route('admin.categoria.edit', $categoria->id) }}" class="btn btn-success" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen"></i></a>

                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$categoria->id}}" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    </td>

                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$categoria->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                            </div>
                            <div class="modal-body">
                            ¿Esta seguro de que quiere eliminar la categoría?
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-primary" href="{{ route('admin.categoria.delete', $categoria->id) }}">Aceptar</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection

