@extends('layouts.index')

<title>@yield('title') Actulizar La Asignacion Del Planificacion</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Actualizar Planificación</h2>
                </div>

                <form method="post" action="{{ route('planificacion.update', $planificacion->id) }}" enctype="multipart/form-data" onsubmit="return Planificacion(this)">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">

                        <div class="row">

                            <input type="hidden" class="form-control" id="id_proyecto" name="id_proyecto" style="background: white;" value="{{ isset($planificacion->id_proyecto)?$planificacion->id_proyecto:'' }}" placeholder="" autocomplete="off">

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Descripción del Alcance</label>
                                <textarea class="form-control" id="descri_alcance" name="descri_alcance" rows="3" placeholder="Ingrese la Descripción del Alcance" oninput="capitalizarTextoarea('descri_alcance')" cols="10" rows="10" style="max-height: 6rem;">{{ $planificacion->descri_alcance }}</textarea>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Presupuesto</label>
                                <input type="text" class="form-control" id="presupuesto" name="presupuesto" style="background: white;" value="{{ $planificacion->presupuesto }}" placeholder="Ingrese el Presupuesto" autocomplete="off">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Descripción de la Obra</label>
                                <textarea class="form-control" id="descri_obra" name="descri_obra" rows="3" placeholder="Ingrese la Descripción de la Obra" oninput="capitalizarTextoarea('descri_obra')" cols="10" rows="10" style="max-height: 6rem;">{{ $planificacion->descri_obra }}</textarea>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-2">
                                <label class="font-weight-bold text-dark">Impacto Ambiental</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="impacto_ambiental" id="impacto_ambiental" value="SI" {{ ($planificacion->impacto_ambiental=="SI")? "checked" : ""}}>
                                        <label class="form-check-label" for="impacto_ambiental">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="impacto_ambiental" id="impacto_ambiental" value="NO" {{ ($planificacion->impacto_ambiental=="NO")? "checked" : ""}}>
                                        <label class="form-check-label" for="impacto_ambiental">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2">
                                <label class="font-weight-bold text-dark">Impacto Ambiental</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="impacto_social" id="impacto_social" value="SI" {{ ($planificacion->impacto_social=="SI")? "checked" : ""}}>
                                        <label class="form-check-label" for="impacto_social">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="impacto_social" id="impacto_social" value="NO" {{ ($planificacion->impacto_social=="NO")? "checked" : ""}}>
                                        <label class="form-check-label" for="impacto_social">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $planificacion->fecha_inicio }}">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Duración Estimada</label>
                                <input type="text" class="form-control" id="duracion_estimada" name="duracion_estimada" style="background: white;" value="{{ $planificacion->duracion_estimada }}" placeholder="Ingrese la Duración Estimada (ej: 3 meses, 15 días)" autocomplete="off">
                            </div>

                        </div>

                    </div>

                    <div class="card-body">
                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ route('planificacion.index') }}"><span class="icon text-white-50">
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
        $(document).ready(function() {
            $('.select2-single').select2();
        });

        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }

        function capitalizarTextoarea(idTextarea) {
            const textareaElement = document.getElementById(idTextarea);
            const words = textareaElement.value.toLowerCase().split(/\s+/).map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
            textareaElement.value = words;
        }

        function soloNumeros(event) {
            return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46; // Allows numbers and the decimal point
        }
    </script>

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Planificación',
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