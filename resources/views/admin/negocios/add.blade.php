@extends('layouts.admin')
@section('content')

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>

    <h3 style="color: #000; margin-top: 90px">Agregar Negocios</h3><br>

    <form  action="{{ route('admin.negocio.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card py-3 m-b-15">

                <div class="col-md-6">
                    <h3>Planes</h3>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="" class="form-label" > Plan de uso mensual</label>
                            <select name="tipoplan" class="form-control">
                                <option selected disabled>Seleccione un plan</option>
                                @foreach ($planes as $plan)
                                    <option value="{{ $plan->id }}" >{{ $plan->nombre }}</option>
                                @endforeach
                            </select>
                            @error('tipoplan')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="card py-3 m-b-15">

                <div class="col-md-6">
                    <h3>Datos Legales</h3>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input opcion" type="radio" name="tipo" id="radio-empresa" value="0" required checked>
                                <label class="form-check-label" for="radio-empresa">Empresa</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input opcion" type="radio" name="tipo" id="radio-emprendedor" value="1" required>
                                <label class="form-check-label" for="radio-emprendedor">Emprendedor</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > RUC</label>
                            <input id="RUC" name="RUC" type="text" class="form-control" tabindex ="1">
                            @error('RUC')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Razón Social</label>
                            <input id="razonSocial" name="razonSocial" type="text" class="form-control" tabindex ="1">
                            @error('razonSocial')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > DNI</label>
                            <input type="" id="DNI" name="DNI" type="text" class="form-control" tabindex ="1">
                            @error('DNI')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Representante Legal</label>
                            <input type="" id="representanteLegal" name="representanteLegal" type="text" class="form-control" tabindex ="1">
                            @error('representanteLegal')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="card py-3 m-b-15">

                <div class="col-md-6">
                    <h3>Negocio</h3>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Nombre Comercial</label>
                            <input type="" id="nombres" name="nombre" type="text" class="form-control" tabindex ="1">
                            @error('nombre')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Correo electrónico</label>
                            <input type="" id="correo" name="correo" type="text" class="form-control" tabindex ="1">
                            @error('correo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Teléfono</label>
                            <input type="" id="telefono" name="telefono" type="text" class="form-control" tabindex ="1">
                            @error('telefono')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Categoría</label>
                            <select name="idCategoria" class="form-control">
                                <option selected disabled>Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                            @error('idCategoria')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Dirección</label>
                            <input type="" id="direccion" name="direccion" type="text" class="form-control" tabindex ="1">
                            @error('direccion')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Estado</label>
                            <select class="form-control" name="estado">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="imagen" class="form-label" > Imagen</label>
                            <input type="file"  name="imagen">
                        </div>
                    </div>
                    @error('imagen')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <br>
            <div class="card py-3 m-b-15">
                 <div class="col-md-6">
                    <h3>Horario</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="hora_inicio" class="form-label" >Hora de Apertura</label>
                            <input type="time" id="hora_inicio" name="hora_inicio" type="text" class="form-control" tabindex ="1">
                            @error('hora_inicio')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2" style="margin: auto 0; display: flex; justify-content: center">
                            <span>a</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="hora_fin" class="form-label" >Hora de Cierre</label>
                            <input type="time" id="hora_fin" name="hora_fin" type="text" class="form-control" tabindex ="1">
                            @error('hora_fin')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card py-3 m-b-15">
                 <div class="col-md-6">
                    <h3>Ubicación</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="" class="form-label" >Latitud</label>
                            <input id="txtlatitud" name="latitud" type="text" class="form-control" tabindex ="1">
                            @error('latitud')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label" >Longitud</label>
                            <input id="txtlongitud" name="longitud" type="text" class="form-control" tabindex ="1">
                            @error('longitud')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div id="map" style="height: 350px">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="submit" class="btn-2 btn-primary" id="btnAgregar">Guardar</button>

                </div>
            </div>

    </form>

    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3OvtvY9hsfEi_HjTIRDLBfSCNnCcYBEc&callback=initMap">
    </script>

    <script>
        var vMarker;
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'),{
                zoom: 14,
                center: new google.maps.LatLng(-18.007701, -70.247001),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(-18.007701, -70.247001),
                draggable: true
            });

            google.maps.event.addListener(vMarker, 'dragend', function (evt){
                $("#txtlatitud").val(evt.latLng.lat().toFixed(6));
                $("#txtlongitud").val(evt.latLng.lng().toFixed(6));

                map.panTo(evt.latLng);
            });

            map.setCenter(vMarker.position);
            vMarker.setMap(map)
        }
	</script>
    <script>
       $(function () {
        $(".opcion").click(function () {
          if ($(this).val() === "0") {
            $("#RUC").removeAttr("disabled");
            $("#razonSocial").removeAttr("disabled");
          } else {
            $("#RUC").attr("disabled", "disabled");
            $("#razonSocial").attr("disabled", "disabled");
          }
        });
      });
    </script>

@endsection

