@extends('layouts.negocio')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Administrar Banners</h3><br>

    <div class="text-right mb-2" >
        <a href="{{ route('negocio.banner.create') }}" class="btn btn-primary">Agregar Nuevo</a>
    </div>


    @if($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @elseif($message = Session::get('delete'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @endif

    <table id="datatableNegocio" class="table table-striped table-responsive-md" style="margin-top: 40px; border-collapse: collapse">
        <thead>
            <tr class="title-table">
                <td style="width:300px">Imagen</td>
                <td>Estado</td>
                <td>Controles</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr class="body-table">
                    <td>
                        <img class="img-responsive" src="{{ url('storage/uploads/banners').'/'. $banner-> imagen }}" width="100" height="80" alt="Imagen Banner">
                    </td>

                    <td>
                        @if ($banner-> estado == 1)
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-success">Activo</p>
                        @else
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-danger">Inactivo</p>
                        @endif
                    </td>

                    <td>
                        <a type="button" href="{{ route('negocio.banner.edit', $banner->id) }}" class="btn btn-success" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen"></i></a>

                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$banner->id}}" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    </td>

                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$banner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                            </div>
                            <div class="modal-body">
                            ¿Esta seguro de que quiere eliminar el banner?
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-primary" href="{{ route('negocio.banner.delete', $banner->id) }}">Aceptar</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection

