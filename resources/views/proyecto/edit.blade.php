@extends('layouts.index')

<title>@yield('title') Actulizar La Asignacion Del Proyecto</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Actulizar La Asignacion Del Proyecto</h2>
                </div>

                <form method="post" action="{{ url('/proyecto/'.$proyecto->id) }}" enctype="multipart/form-data" onsubmit="return Proyectos(this)">
                    @csrf
                    {{ method_field('PATCH') }}

                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Nombre Del Proyecto</label>
                                <input type="text" class="form-control" id="nombre_pro" name="nombre_pro" style="background: white;" value="{{ $proyecto->nombre_pro }}" placeholder="Ingrese El Nombre Del Proyecto" oninput="capitalizarInput('nombre_pro')" autocomplete="off" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Descripción</label>
                                <input type="text" class="form-control" id="descripcion_pro" name="descripcion_pro" style="background: white;" value="{{ $proyecto->descripcion_pro }}" placeholder="Ingrese La Descripción" autocomplete="off" oninput="capitalizarInput('descripcion_pro')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Persona Asignada</label>
                                <select class="form-select" id="id_persona" name="id_persona">
                                    <option value="">Seleccione una persona</option>
                                    @foreach($personas as $persona)
                                        <option value="{{ $persona->id }}" {{ $proyecto->id_persona == $persona->id ? 'selected' : '' }}>
                                            {{ $persona->nombre }} {{ $persona->apellido }} {{ $persona->cedula }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Comunidad Asignada</label>
                                <select class="form-select" id="id_comunidad" name="id_comunidad">
                                    <option value="">Seleccione una comunidad</option>
                                    @foreach($comunidades as $comunidad)
                                        <option value="{{ $comunidad->id }}" {{ $proyecto->id_comunidad == $comunidad->id ? 'selected' : '' }}>
                                            {{ $comunidad->nom_comunidades }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="{{ $proyecto->fecha_inicial }}">
                            </div>

                           

                        </div>
                    </div>

                    <div class="card-body">
                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar Cambios</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('proyecto/') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
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
    </script>

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Proyectos',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

@endsection