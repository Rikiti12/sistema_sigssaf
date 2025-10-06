@extends('layouts.index')

<title>@yield('title') Actulizar La Evaluación Del Proyectos</title>
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
                    <h2 class="font-weight-bold text-dark">Actualizar la Evaluación de proyectos</h2>
                </div>

                <form method="post" action="{{ url('/evaluacion/'.$evaluacion->id) }}" enctype="multipart/form-data" onsubmit="return Evaluaciones(this)">
                    @csrf
                    {{ method_field('PATCH') }}

                <div class="card-body">

                   <div class="row">

                       <div class="col-4">  
                           <label for="id_proyecto" class="font-weight-bold text-dark">Proyecto a Evaluar</label>
                           <select class="form-select" id="id_proyecto" name="id_proyecto" required>
                               <option value="">Seleccione un proyecto...</option>
                               @foreach($proyectos as $proyecto)
                                   <option value="{{ $proyecto->id }}" {{ $evaluacion->id_proyecto == $proyecto->id ? 'selected' : '' }}>
                                       {{ $proyecto->nombre_pro }} - {{ $proyecto->descripcion_pro }}
                                   </option>
                               @endforeach
                           </select>
                       </div>
                       
                       <div class="col-4">
                           <label class="font-weight-bold text-dark">Responsable de la Evaluación</label>
                            <select class="form-select" id="id_resposanble" name="id_resposanble" required>
                               <option value="">Seleccione un Responsable...</option>
                               @foreach($resposanbles as $resposanble)
                                   <option value="{{ $resposanble->id }}" {{ $evaluacion->id_resposanble == $resposanble->id ? 'selected' : '' }}>
                                      {{ $resposanble->cedula }} - {{ $resposanble->nombre }} {{ $resposanble->apellido }}
                                   </option>
                               @endforeach
                           </select>
                       </div>


                       <div class="col-4">
                           <label class="font-weight-bold text-dark">Observaciones</label>
                           <textarea class="form-control" id="observaciones" name="observaciones" rows="4" required>{{ $evaluacion->observaciones }}</textarea>
                       </div>

                       <div class="col-4">
                           <label for="viabilidad" class="form-label">Viabilidad</label>
                           <select class="form-select" id="viabilidad" name="viabilidad" required>
                               <option value="Alta" {{ $evaluacion->viabilidad == 'Alta' ? 'selected' : '' }}>Alta</option>
                               <option value="Media" {{ $evaluacion->viabilidad == 'Media' ? 'selected' : '' }}>Media</option>
                               <option value="Baja" {{ $evaluacion->viabilidad == 'Baja' ? 'selected' : '' }}>Baja</option>
                           </select>
                       </div>
                   
                       <div class="col-4">
                           <label class="font-weight-bold text-dark">Fecha de Evaluación</label>
                           <input type="date" class="form-control" id="fecha_evalu" name="fecha_evalu" value="{{ $evaluacion->fecha_evalu }}" required>
                       </div>

                        @if(auth()->user()->hasRole('Administrador'))
                        @if ($evaluacion->estatus_resp == "" || $evaluacion->estatus_resp == "Pendiente")
                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Estatus Evaluación</label>
                                <select class="form-select" name="estatus" id="estatus">
                                    <option value="0" selected="true" disabled>Seleccione un Estatus</option>
                                    <option value="Aprobado" {{ (old('estatus', $evaluacion->estatus ?? '') === 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                                    <option value="Negado" {{ (old('estatus', $evaluacion->estatus ?? '') === 'Negado') ? 'selected' : '' }}>Negado</option>
                                </select>
                            </div>
                            @endif
                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Estatus Evaluación</label>
                                <select class="form-select" name="estatus" id="estatus">
                                    <option value="0" selected="true" disabled>Seleccione un Estatus</option>
                                    <option value="Aprobado" {{ (old('estatus', $evaluacion->estatus ?? '') === 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                                    <option value="Negado" {{ (old('estatus', $evaluacion->estatus ?? '') === 'Negado') ? 'selected' : '' }}>Negado</option>
                                </select>
                            </div>
                        @endif

                       @if(auth()->user()->hasRole('Administrador'))
                            <div class="card-body" id="estatus_respuesta" style="display: none;">
                                <label class="font-weight-bold text-dark">Estatus Aprobación</label>
                                <div class="row">
                                    <div class="custom-control custom-radio col-1 mr-2"> 
                                        <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_pen" value="Pendiente" {{ ($evaluacion->estatus_resp=="Pendiente")? "checked" : ""}}>
                                        <label class="custom-control-label" for="estatus_resp_pen">Pendiente</label>
                                    </div>
                                    <div class="custom-control custom-radio col-1 mr-2">
                                        <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_apro" value="Aprobado" {{ ($evaluacion->estatus_resp=="Aprobado")? "checked" : ""}}>
                                        <label class="custom-control-label" for="estatus_resp_apro">Aprobado</label>
                                    </div>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="estatus_resp" id="estatus_resp" value="Pendiente">
                        @endif

                   </div>
                
                </div>

                    <div class="card-body">
                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                           <a class="btn btn-info btn-lg" href="{{ route('asignacion.index') }}"><span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Regresar</span></a>
                        </center>
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

 {{-- * FUNCION PARA MOSTRAR/OCULTAR EL ESTATUS DE RESPUESTA Y ENVIAR EL VALUE OCULTO --}}

 <script>
    document.addEventListener("DOMContentLoaded", function() {
        const estatusSelect = document.getElementById('estatus');
        const estatusRespuestaDiv = document.getElementById('estatus_respuesta');

        function toggleEstatusRespuesta() {
            const selectedValue = estatusSelect.value;
            if (selectedValue === 'Aprobado') {
                estatusRespuestaDiv.style.display = 'block';
            } else {
                estatusRespuestaDiv.style.display = 'none';
            }
        }

        // Ejecutar al cargar la página
        toggleEstatusRespuesta();

        // Ejecutar al cambiar la selección
        estatusSelect.addEventListener('change', toggleEstatusRespuesta);
    });
</script>

@if ($errors->any())
    <script>
        var errors = @json($errors->all());
        errors.forEach(function(error) {
            Swal.fire({
                title: 'Evaluaciones',
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