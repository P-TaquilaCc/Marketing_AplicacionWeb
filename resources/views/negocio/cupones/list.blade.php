@extends('layouts.negocio')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Administrar Cupones</h3><br>

    <div class="text-right mb-2">
        <a href="{{ route('negocio.cupon.create') }}" class="btn btn-primary">Agregar Nuevo</a>
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
                <td>Código</td>
                <td>Descuento</td>
                <td>Fecha de inicio</td>
                <td>Fecha de expiración</td>
                <td>Estado</td>
                <td>Controles</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($cupones as $cupon)
                <tr class="body-table">
                    <td>{{ $cupon->codigo }}</td>
                    <td>{{ $cupon->porcentaje }}%</td>
                    <td>
                        @php
                            $originalDate = $cupon->fechaInicio;
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            echo $newDate;
                        @endphp
                    </td>
                    <td>
                        @php
                            $originalDate = $cupon->fechaFin;
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            echo $newDate;
                        @endphp
                    </td>
                    <td>
                        @if ($cupon->estado == 1)
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-success">Activo</p>
                        @else
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-danger">Inactivo</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <a type="button" href="{{ route('negocio.cupon.edit', $cupon->id) }}" class="btn btn-success" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen"></i></a>

                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$cupon->id}}" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>

                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$cupon->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                            </div>
                            <div class="modal-body">
                            ¿Esta seguro de que quiere eliminar el cupón?
                            </div>
                            <div class="modal-footer">
                                 <a type="button" class="btn btn-primary" href="{{ route('negocio.cupon.delete', $cupon->id) }}">Aceptar</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection

