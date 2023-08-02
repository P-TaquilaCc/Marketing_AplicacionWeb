@extends('layouts.negocio')
@section('content')

    <h3 style="color: #000; margin-top: 90px">Administrar Pedidos</h3><br>

    <table id="datatableNegocio" class="table table-striped table-responsive-md" style="margin-top: 40px; border-collapse: collapse">
        <thead>
            <tr class="title-table">
                <td>Nro.</td>
                <td>Cliente</td>
                <td>Teléfono</td>
                <td>Dirección</td>
                <td>Fecha - Hora</td>
                <td>Controles</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr  class="body-table">
                    <td>{{ $pedido->id }}</td>
                    <td>
                        {{ $pedido->client->name }}
                    </td>

                    <td>
                        {{ $pedido->client->telefono }}
                    </td>

                    <td>{{ $pedido->direccion }}</td>
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
                        <a type="button" class="btn btn-secondary" href="{{ route('negocio.pedido.detail', $pedido->id) }}" style="border-radius: 50%" data-toggle="tooltip" data-placement="top" title="Ver detalles"><i class="fas fa-search-plus"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

