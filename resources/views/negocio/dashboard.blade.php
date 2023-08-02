@extends('layouts.negocio')
@section('content')
    <h3 style="color: #000; text-align:center; margin-top: 90px">Bienvenido al Dashboard del Negocio</h3><br>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="{{ route('negocio.pedido.index') }}" style="color: black">
                <div class="card p-3 mb-2 ">
                    <div class="d-flex justify-content-center">
                        <i class="icon-dashboard fas fa-list-alt"></i>
                    </div>
                    <div class="mt-3 text-center">
                        <h5 class="heading">Pedidos</h3>
                        <div class="mt-3">
                            <span>{{ $pedidos }}</span>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('negocio.producto.index') }}" style="color: black">
                    <div class="card p-3 mb-2 ">
                        <div class="d-flex justify-content-center">
                            <i class="icon-dashboard fas fa-box"></i>
                        </div>
                        <div class="mt-3 text-center">
                            <h5 class="heading">Productos</h3>
                            <div class="mt-3">
                                <span>{{ $productos }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


@endsection
