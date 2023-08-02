@extends('layouts.admin')
@section('content')
    <h3 style="color: #000; text-align:center; margin-top: 90px">Bienvenido al Dashboard del Administrador</h3><br>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="{{ route('admin.pedido.index') }}" style="color: black">
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
                <a href="{{ route('admin.negocio.index') }}" style="color: black">
                    <div class="card p-3 mb-2 ">
                        <div class="d-flex justify-content-center">
                            <i class="icon-dashboard fas fa-store"></i>
                        </div>
                        <div class="mt-3 text-center">
                            <h5 class="heading">Negocios</h3>
                            <div class="mt-3">
                                <span>{{ $negocios }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-md-4">
                <a href="{{ route('admin.generateReport') }}" style="color: black">
                    <div class="card p-3 mb-2 ">
                        <div class="d-flex justify-content-center">
                            <i class="icon-dashboard fa-solid fa-users"></i>
                        </div>
                        <div class="mt-3 text-center">
                            <h5 class="heading">Usuarios</h3>
                            <div class="mt-3">
                                <span>{{ $usuarios }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


@endsection
