@extends('layouts.index')

<title>@yield('title') Actualizar Comunidad</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Actualizar Comunidad</h2>

                    </div>

                    <form method="post" action="{{ url('/comunidad/'.$comunidad->id) }}" enctype="multipart/form-data" onsubmit="return Comunidad(this)">
                        @csrf
                        {{ method_field('PATCH')}}

                        <div class="card-body">

                            <center>
                                <h5 class="font-weight-bold text-dark">Datos del Vocero de la Comunidad</h5>
                            </center>

                            <br>

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Cédula Vocero</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula_jefe" maxlength="8" style="background: white;" value="{{ $comunidad->cedula_jefe ?? '' }}" placeholder="Ingrese La Cédula" autocomplete="off" onkeypress="return solonum(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre Vocero</label>
                                    <input type="text" class="form-control" id="nombre" name="nom_jefe" style="background: white;" value="{{ $comunidad->nom_jefe ?? '' }}" placeholder="Ingrese El Nombre" oninput="capitalizarInput('nombre')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Apellido Vocero</label>
                                    <input type="text" class="form-control" id="apellido" name="ape_jefe" style="background: white;" value="{{ $comunidad->ape_jefe ?? '' }}" placeholder="Ingrese El Apellido" autocomplete="off"  oninput="capitalizarInput('apellido')" onkeypress="return soloLetras(event);">
                                </div>
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="12" style="background: white;" value="{{ $comunidad->telefono ?? '' }}" placeholder="Ingrese El Telefono" autocomplete="off" onkeypress="return solonum(event);">
                                </div>

                            </div>

                        </div>

                        <div class="card-body">

                            <center>
                                <h5 class="font-weight-bold text-dark">Datos de la Comunidad</h5>
                            </center>

                            <br>

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre de la Comunidad</label>
                                    <input type="text" class="form-control" id="comunidad" name="nom_comuni" style="background: white;" value="{{ $comunidad->nom_comuni ?? '' }}" placeholder="Ingrese El nombre comunidad" autocomplete="off" oninput="capitalizarInput('nombre comuna')" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Dirección</label>
                                    <textarea class="form-control" id="direccion" name="dire_comuni" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ $comunidad->dire_comuni ?? '' }}</textarea>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Comuna Asignado</label>
                                    <select class="form-select" id="id_comuna" name="id_comuna">
                                        @foreach($comunas as $comuna)
                                            <option value="{{ $comuna->id }}" @selected($comunidad->id_comuna == $comuna->id)>{{ $comuna->nom_comunas }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-12">
                                    <label class="font-weight-bold text-dark">¿Desea crear un proyecto para esta comunidad?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="crear_pro" id="si_proyecto" value="Si" {{ ($comunidad->crear_pro=="Si")? "checked" : ""}} onchange="mostrarOcultarProyecto(this.value)">
                                        <label class="form-check-label" for="si_proyecto">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="crear_pro" id="no_proyecto" value="NO" {{ ($comunidad->crear_pro=="NO")? "checked" : ""}} onchange="mostrarOcultarProyecto(this.value)">
                                        <label class="form-check-label" for="no_proyecto">No</label>
                                    </div>
                                </div>
                            </div>

                            <div id="datos_proyecto" style="display: none;">
                                <div class="row">
                                    <br>
                                    <center>
                                        <h5 class="font-weight-bold text-dark">Crear Proyecto</h5>
                                    </center>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Nombre de Proyecto</label>
                                        <input type="text" class="form-control" id="nom_proyecto" name="nom_proyecto" style="background: white;" value="{{ isset($comunidad->nom_proyecto)?$comunidad->nom_proyecto:'' }}" placeholder="Ingrese El nombre del proyecto" autocomplete="off" oninput="capitalizarInput('nombre comuna')" onkeypress="return soloLetras(event);">
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Descripción del Proyecto</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('descripcion')">{{ $comunidad->descripcion }}</textarea>                                   
                                    </div>
                                </div> 
                            </div>


                            <br><br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('comunidad/') }}"><span class="icon text-white-50">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    <span class="text">Regresar</span></a>
                            </center>

                        </div>

                    </form>

                </div>

            </div>

    </div>

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }

        function mostrarOcultarProyecto() {
            const siProyecto = document.getElementById('si_proyecto');
            const datosProyectoDiv = document.getElementById('datos_proyecto');

            if (siProyecto.checked) {
                datosProyectoDiv.style.display = 'block';
            } else {
                datosProyectoDiv.style.display = 'none';
                // Limpiar los campos del proyecto si se ocultan (opcional en edición)
                // document.getElementById('nom_proyecto').value = '';
                // document.getElementById('descripcion').value = '';
            }
        }

        // Ejecutar la función al cargar la página para establecer la visibilidad inicial
        document.addEventListener('DOMContentLoaded', function() {
            mostrarOcultarProyecto();
        });
    </script>

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Comunidad',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        function mostrarOcultarProyecto(value) {
            const datosProyecto = document.getElementById('datos_proyecto');
            datosProyecto.style.display = (value === 'Si') ? 'block' : 'none';
        }

        // Inicializar al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const selected = document.querySelector('input[name="crear_pro"]:checked');
            if (selected) mostrarOcultarProyecto(selected.value);
        });
    </script>


@endsection