@extends('layouts.admin')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Administrar Pedidos</h3><br>

    <table id="datatableAdmin" class="table table-striped table-responsive-md" style="width: 100%">
        <thead>
            <tr class="title-table">
                <td>Nro.</td>
                <td>Cliente</td>
                <td>Dirección</td>
                <td>Negocio</td>
                <td>Fecha - Hora</td>
                <td>Estado</td>
                <td>Controles</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr class="body-table">
                    <td>{{ $pedido->id }}</td>
                    <td>
                        {{ $pedido->client->name }}
                    </td>
                    <td>{{ $pedido->direccion }}</td>
                    <td>{{ $pedido->negocio->nombre }}</td>
                    <td>
                        @php
                            $Date = $pedido->fecha;
                            $Hour = $pedido->fecha;
                            $newDate = date("d-m-Y", strtotime($Date));
                            $newHour = date("H:i:s A", strtotime($Hour));
                            echo $newDate . " | " . $newHour;
                        @endphp
                    </td>
                    <td>
                        @if ($pedido->estado == 1)
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-success">Enviado</p>
                        @else
                            <p class="btn btn-sm m-b-15 ml-2 mr-2 state-pending">Pendiente</p>
                        @endif
                    </td>

                    <td>
                        @if($pedido->estado == 0)
                            <a type="button" class="btn btn-success position-relative" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Enviar notificación"><i class="fas fa-paper-plane"></i>
                                <span class="stretched-link" data-toggle="modal" data-target="#exampleModal{{$pedido->id}}"></span>
                            </a>
                        @endif

                        <a type="button" class="btn btn-secondary" href="{{ route('admin.pedido.detail', $pedido->id) }}" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Ver detalles"><i class="fas fa-search-plus"></i></a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$pedido->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
                                    </div>
                                    <div class="modal-body">
                                    ¿Desea enviar la notificación al negocio?
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-primary" href="{{ route('admin.pedido.notification', $pedido->id) }}">Aceptar</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $('.bootstrap-tooltip').tooltip();
    </script>
@endsection




