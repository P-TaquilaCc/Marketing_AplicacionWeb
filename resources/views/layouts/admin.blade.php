<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MT-Technology</title>

    <link href=" {{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href=" {{ URL::asset('css/custom.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/custom.min.css"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <style>
        .left_col,
        .nav_title,
        body{
            background-color: #2F323A
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
            color: black !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            color: black !important;
        }
    </style>

</head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            {{-- <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a> --}}
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                            @if(session('fotoAdmin') != null)
                                <img src="{{ asset('storage/images/userPerfil').'/'. session('fotoAdmin') }}" alt="Foto de Perfil" class="img-circle profile_img">
                            @else
                                <img src="{{ asset('img/foto-perfil.png') }}" alt="Foto de Perfil" class="img-circle profile_img">
                            @endif
                            </div>
                            <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2>{{session('nomAdmin')}}</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
                        <br />
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">

                            <ul class="nav side-menu">
                                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                                </li>
                                <li><a href="{{ route('admin.negocio.index') }}"><i class="fas fa-store"></i> Negocio</a>
                                </li>
                                <li><a href="{{ route('admin.categoria.index') }}"><i class="fas fa-edit"></i> Categoría</a>
                                </li>
                                <li><a href="{{ route('admin.pedido.index') }}"><i class="fas fa-list-alt"></i> Pedidos</a>
                                </li>
                                <li><a href="{{ route('admin.plan.index') }}"><i class="fa-solid fa-clipboard-list"></i> Planes</a>
                                </li>
                                <li><a href="{{ route('admin.usuario.index') }}"><i class="fa-solid fa-users"></i> Usuarios</a>
                                </li>
                                <li><a href="{{ route('admin.generateReport') }}"><i class="fa-solid fa-chart-line"></i> Reportes</a>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>

              <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <nav class="nav navbar-nav">
                            <ul class=" navbar-right">
                                <li class="nav-item dropdown open" style="padding-left: 15px;">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                        @if(session('fotoAdmin') != null)
                                            <img src="{{ asset('storage/images/userPerfil'). '/'. session('fotoAdmin') }}" alt="Foto de perfil">{{session('nomAdmin')}}
                                        @else
                                            <img src="{{ asset('img/foto-perfil.png') }}" alt="Foto de Perfil">{{session('nomAdmin')}}
                                        @endif
                                    </a>
                                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"  href="{{ route('admin.editProfile', session('idAdmin')) }}"> Perfil</a>
                                        <a class="dropdown-item"  href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
                                        <form action="{{ route('admin.logout') }}" id="logout-form" method="post">@csrf</form>
                                    </div>
                                </li>

                                {{-- Menú para las notificaciones --}}
                                <li role="presentation" class="nav-item dropdown open">
                                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-bell"></i>
                                        <span class="badge bg-green">{{ auth()->user()->unreadNotifications->count() }}</span>
                                    </a>
                                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                                        @if(auth()->user()->unreadNotifications->count() == 0)
                                            <li class="nav-item">
                                                <a class="dropdown-item">
                                                    <span class="message">
                                                        Tiene 0 notificaciones nuevas
                                                    </span>
                                                </a>
                                            </li>
                                        @endif
                                        @foreach (auth()->user()->unreadNotifications as $notification)
                                            <li class="nav-item">
                                                <a class="dropdown-item" href="{{ route('admin.pedido.aNotifications', [$notification->id, $notification->data['id']]) }}">
                                                    <span class="image"><i class="fa-solid fa-cart-shopping"></i></span>
                                                    <span>
                                                        <span>¡Nuevo Pedido!</span>
                                                    </span>
                                                    <span class="message">
                                                        El cliente {{$notification->data['nombreCliente']}} ha realizado un pedido
                                                    </span>
                                                </a>
                                            </li>
                                        @endforeach
                                        @if(auth()->user()->unreadNotifications->count() != 0)
                                            <li class="nav-item">
                                                <div class="text-center">
                                                    <a class="dropdown-item" href="{{ route('admin.pedido.allNotifications') }}">
                                                        <strong>Ver todo</strong>
                                                    </a>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="right_col" role="main">
                    @yield('content')
                </div>

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset('js/custom.min.js') }}"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

        <script>
            $(document).ready(function() {
                $('#datatableAdmin').dataTable( {
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                } );
            });

            $(document).ready(function () {
                $('#datatableAdmin').DataTable();
            });
        </script>
        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 5000);
        </script>
    </body>
</html>
