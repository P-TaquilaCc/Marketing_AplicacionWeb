<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <title>Marketing</title>
  </head>
<body>


    <div class="container-fluid" style="height: 100%">
      <div class="row" style="height: 100%">

        <div class="col-lg-7 d-none d-md-block bg-cover" >
            <img src="img/login.svg" alt="" width="100%" height="100%">
        </div>


        <div class="col-lg-5 bg-dark-light" style="margin: auto">
          <div class="row align-items-center m-h-100">
            <div class="mx-auto col-md-8">
              <div class="p-b-20 text-center">
                <p class="nombre-logo">MT-Technology</p>

              </div>
              <h4 class="card-title text-center mb-5 fw-light fs-5">Iniciar Sesión para Continuar</h4>
              <form action={{ route('negocio.check')}} method="post">
                  @if (Session::get('fail'))
                      <div class="alert alert-danger">
                          {{ Session::get('fail') }}
                      </div>
                  @endif
                  @csrf
                  <div class="form-group">

                      <input type="email" class="form-control" name="email" placeholder="Correo electrónico" >
                      <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                  </div>
                  <div class="form-group">

                      <input type="password" class="form-control" name="password" placeholder="Contraseña" value="{{ old('password') }}">
                      <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                  </div>
                  <div class="form-group" style="margin-top: 40px">
                      <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>

</body>
</html>
