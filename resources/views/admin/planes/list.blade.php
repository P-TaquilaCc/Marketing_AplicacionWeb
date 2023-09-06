@extends('layouts.admin')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Administrar Plan</h3><br>

    <div class="text-right mb-2">
        <a href="{{ route('admin.plan.create') }}" class="btn btn-primary">Agregar Nuevo</a>
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
                <td>Nombre</td>
                <td>Precio Mensual</td>
                <td>Porcentaje Comisión</td>
                <td>Estado</td>
                <td>Controles</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($planes as $plan)
                <tr class="body-table">
                    <td>{{ $plan ->nombre }}</td>
                    <td>S/ {{ number_format($plan ->precioMensual, 2, '.', ' ') }}</td>
                    <td>{{ $plan ->porcentaje }}%</td>
                    <td>
                        @if ($plan ->porDefecto == 1)
                            <span class="badge badge-success">Por defecto</span>
                        @endif
                    </td>
                    <td>
                        <a type="button" href="{{ route('admin.plan.edit', $plan->id) }}" class="btn btn-success" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen"></i></a>

                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$plan->id}}" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                            </div>
                            <div class="modal-body">
                            ¿Esta seguro de que quiere eliminar el Plan de uso?
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-primary" href="{{ route('admin.plan.delete', $plan->id) }}">Aceptar</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <br>
@endsection

