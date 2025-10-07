@extends('layouts.index')

<title>@yield('title') Evaluación de Proyecto</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
<link  href="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css')}}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Evaluación de Proyecto</h2>
                </div>
              
                <form method="post" action="{{ route('evaluacion.store') }}" enctype="multipart/form-data" onsubmit="return Evaluaciones(this)">
                    @csrf
                   
                    <div class="card-body">

                        <div class="row">

                            <div class="col-4">
                                <label for="id_proyecto" class="font-weight-bold text-dark">Proyecto a Evaluar</label>
                                <select class="form-select" id="id_proyecto" name="id_proyecto" required>
                                    <option value="">Seleccione un proyecto</option>
                                    @foreach($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}">{{ $proyecto->nombre_pro }} - {{ $proyecto->descripcion_pro }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Responsable de la Evaluación</label>
                                 <select class="form-select" id="id_resposanble" name="id_resposanble" required>
                                    <option value="">Seleccione un Responsable</option>
                                    @foreach($resposanbles as $resposanble)
                                        <option value="{{ $resposanble->id }}">{{ $resposanble->cedula}} - {{ $resposanble->nombre}} {{ $resposanble->apellido }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="font-weight-bold text-dark">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="4" placeholder="Ingrese las observaciones de la evaluación" required></textarea>
                            </div>
                        
                            <div class="col-4">
                                <label for="viabilidad" class="font-weight-bold text-dark">Viabilidad</label>
                                <select class="form-select" id="viabilidad" name="viabilidad" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Fecha de Evaluación</label>
                                <input type="date" class="form-control" id="fecha_evalu" name="fecha_evalu" value="<?php echo date('Y-m-d'); ?>">
                            </div>

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Estatus Evaluación</label>
                                <select class="form-select" name="estatus" id="estatus">
                                    <option value="" selected="true" disabled>Seleccione un Estatus</option>
                                    <option value="Aprobado">Aprobado</option>
                                    <option value="Negado">Negado</option>
                                </select>
                            </div>

                            @if(auth()->user()->hasRole('Administrador'))
                                <div class="card-body" id="estatus_aprob">
                                    <label class="font-weight-bold text-dark">Estatus Aprobación</label>
                                    <div class="row">
                                        <div class="custom-control custom-radio col-1 mr-2"> 
                                            <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_pen" value="Pendiente" checked>
                                            <label class="custom-control-label" for="estatus_resp_pen">Pendiente</label>
                                        </div>
                                        <div class="custom-control custom-radio col-1 mr-2">
                                            <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_apro" value="Aprobado">
                                            <label class="custom-control-label" for="estatus_resp_apro">Aprobado</label>
                                        </div>
                                        <div class="custom-control custom-radio col-1 mr-2">
                                            <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_neg" value="Negado">
                                            <label class="custom-control-label" for="estatus_resp_neg">Negado</label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <input type="hidden" name="estatus_resp" value="Pendiente">

                        </div>  

                        <div class="card-body">
                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                    <span class="text">Guardar</span>
                                </button>
                                <a class="btn btn-info btn-lg" href="{{ url('/home') }}"><span class="icon text-white-50">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    <span class="text">Regresar</span></a>
                            </center>
                        </div>

                    </div> 

                </form>

                </div>
            </div>
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
        
        function validarEvaluacion(form) {
            // Aquí puedes agregar validaciones adicionales si es necesario
            return true;
        }
    </script>

    {{-- * FUNCION  PARA MOSTRAR EL ESTATUS APROBACION SEGUN EL ESTATUS DE EVALUACION --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const estatusEvaluacion = document.getElementById('estatus');
        const estatusAprobacion = document.getElementById('estatus_aprob');

        function toggleEstatusAprobacion() {
            if (estatusEvaluacion.value === 'Negado') {
                estatusAprobacion.style.display = 'none';
            } else if (estatusEvaluacion.value === 'Aprobado') {
                estatusAprobacion.style.display = 'block';
            } else {
                estatusAprobacion.style.display = 'block';
            }
        }

        estatusEvaluacion.addEventListener('change', toggleEstatusAprobacion);

        // Ejecutar al cargar la página para establecer el estado inicial
        toggleEstatusAprobacion();
        });
    </script>

@if ($errors->any())
    <script>
        var errors = @json($errors->all());
        errors.forEach(function(error) {
            Swal.fire({
                title: ' Evaluaciones',
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