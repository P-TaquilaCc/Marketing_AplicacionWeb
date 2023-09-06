@extends('layouts.admin')
@section('content')

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
     <script
      src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>

    <h3 style="color: #000; margin-top: 90px">Editar Negocio - [{{ $data->nombre }}]</h3><br>

    <form  action="{{ route('admin.negocio.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card py-3 m-b-15">
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="col-md-6">
                    <h3>Planes</h3>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="" class="form-label" > Plan de uso mensual</label>
                            <select name="idPlan" class="form-control">
                                <option selected disabled>Seleccione un plan</option>
                                @foreach ($planes as $plan)
                                    <option value="{{ $plan->id }}" {{$data->idPlan == $plan->id ? 'selected' : ''}} >{{ $plan->nombre }}</option>
                                @endforeach
                            </select>
                            @error('idPlan')
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
                                <input class="form-check-input opcion" type="radio" name="tipo" id="radio-empresa" value="0"
                                {{ $data->tipo == 0 ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="radio-empresa">Empresa</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input opcion" type="radio" name="tipo" id="radio-emprendedor" value="1"
                                {{ $data->tipo == 1 ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="radio-emprendedor">Emprendedor</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > RUC</label>
                            <input type="" id="RUC" name="RUC" type="text" class="form-control" tabindex ="1" value="{{$data->RUC}}">
                            @error('RUC')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Razón Social</label>
                            <input type="" id="razonSocial" name="razonSocial" type="text" class="form-control" tabindex ="1" value="{{$data->razonSocial}}">
                            @error('razonSocial')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > DNI</label>
                            <input type="" id="DNI" name="DNI" type="text" class="form-control" tabindex ="1" value="{{$data->DNI}}">
                            @error('DNI')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Representante Legal</label>
                            <input type="" id="representanteLegal" name="representanteLegal" type="text" class="form-control" tabindex ="1" value="{{$data->representanteLegal}}">
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
                            <input type="" id="nombres" name="nombre" type="text" class="form-control" tabindex ="1" value="{{$data->nombre}}">
                            @error('nombre')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Correo electrónico</label>
                            <input type="" id="correo" name="correo" type="text" class="form-control" tabindex ="1" value="{{$data->correo}}">
                            @error('correo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Teléfono</label>
                            <input type="" id="telefono" name="telefono" type="text" class="form-control" tabindex ="1" value="{{$data->telefono}}">
                            @error('telefono')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Categoría</label>
                            <select name="idCategoria" class="form-control">
                                <option selected disabled>Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{$data->idCategoria == $categoria->id ? 'selected' : ''}} >{{ $categoria->nombre }}</option>
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
                            <input type="" id="direccion" name="direccion" type="text" class="form-control" tabindex ="1" value="{{$data->direccion}}">
                            @error('direccion')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="form-label" > Estado</label>
                            <select class="form-control" name="estado">
                                <option value="1" {{$data->estado == 1 ? 'selected' : ''}} >Activo</option>
                                <option value="0" {{$data->estado == 0 ? 'selected' : ''}} >Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">

                            <label for="imagen" class="form-label" > Imagen</label>
                            <img src="{{ asset('storage/images/negocio/'. $data->imagen) }}" alt="Imagen negocio" width="150">
                            <br>
                            <input type="file"  name="imagen" class="mt-2">
                            <br>
                            @error('imagen')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
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
                            <input type="time" id="hora_inicio" name="hora_inicio" type="text" class="form-control" tabindex ="1" value="{{$data->hora_inicio}}">
                            @error('hora_inicio')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2" style="margin: auto 0; display: flex; justify-content: center">
                            <span>a</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="hora_fin" class="form-label" >Hora de Cierre</label>
                            <input type="time" id="hora_fin" name="hora_fin" type="text" class="form-control" tabindex ="1" value="{{$data->hora_fin}}">
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
                            <input type="" id="txtlatitud" name="latitud" type="text" class="form-control" tabindex ="1" value="{{$data->latitud}}">
                            @error('latitud')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="form-label" >Longitud</label>
                            <input type="" id="txtlongitud" name="longitud" type="text" class="form-control" tabindex ="1" value="{{$data->longitud}}">
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
                center: new google.maps.LatLng(parseFloat($("#txtlatitud").val()), parseFloat($("#txtlongitud").val())),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat($("#txtlatitud").val()), parseFloat($("#txtlongitud").val())),
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
        $(document).ready(function () {
            if ($('#radio-emprendedor').is(':checked')) {
                $("#RUC").attr("disabled", "disabled");
                $("#razonSocial").attr("disabled", "disabled");
            }
        });

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

