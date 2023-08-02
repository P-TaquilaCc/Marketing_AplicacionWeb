@extends('layouts.negocio')
@section('content')

    <h3 style="color: #000; margin-top: 40px">Detalle del pedido</h3><br>

    <div class="conteiner">
        <div class="card pt-2 m-b-30">
            <div class="card-body">
                <h4>Pedido #{{ $pedido->id }}</h4>

                <div class="ml-3">
                    <h5>Cliente</h5>
                    <p class="lead ml-3">{{ $pedido->client->name }}</p>
                    <h5>DNI</h5>
                    <p class="lead ml-3"> {{ $pedido->client->dni }} </p>
                    <h5>Teléfono</h5>
                    <p class="lead ml-3"> {{ $pedido->client->telefono }} </p>
                    <h5>Dirección</h5>
                    <p class="lead ml-3"> {{ $pedido->direccion }} </p>
                    <h5>Fecha y Hora</h5>
                    <p class="lead ml-3"> {{ $pedido->fecha }} </p>
                    <h5>Descripción</h5>
                    <p class="lead ml-3"> {{ $pedido->descripcion }} </p>
                </div>
            </div>
        </div>

        <br>

        <div class="card pt-2 m-b-30">
            <div class="card-body">
                <h4>Resumen</h4>

                <table class = "table table-striped table-responsive-md" style="border-collapse: collapse">
                    <thead>
                        <tr style="font-weight: bold; text-align: center">
                            <td style="width: 350px">Imagen</td>
                            <td>Producto</td>
                            <td>Precio</td>
                            <td>Cantidad</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($detalle_pedido as $detalle)
                            <tr  style="text-align: center">
                                <td>
                                    <img class="img-responsive" src="{{ url('storage/uploads/productos').'/'.$detalle->product->imagen }}" height="80" alt="Imagen Producto">
                                </td>
                                <td> {{ $detalle->product->nombre}}</td>
                                <td> S/ {{ number_format($detalle->product->precio, 2)}}</td>
                                <td> {{ $detalle->cantidad}}</td>
                                <td>
                                    @php
                                        $total = ($detalle->product->precio *  $detalle->cantidad);
                                        echo "S/ " . number_format($total,2);
                                    @endphp
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>



@endsection
