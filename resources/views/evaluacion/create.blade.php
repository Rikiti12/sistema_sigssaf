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
                           <input type="text" class="form-control" id="respon_evalu" name="respon_evalu" style="background: white;" placeholder="Ingrese el nombre del responsable" oninput="capitalizarInput('responsable')" autocomplete="off" onkeypress="return soloLetras(event);" required>
                       </div>
                       
                        <div class="col-4">
                           <label for="estado_evalu" class="font-weight-bold text-dark">Estado de la Evaluación</label>
                           <select class="form-select" id="estado_evalu" name="estado_evalu" required>
                               <option value="">Seleccione...</option>
                               <option value="Pendiente">Pendiente</option>
                               <option value="En Proceso">En Proceso</option>
                               <option value="Completada">Completada</option>
                               <option value="Aprobada">Aprobada</option>
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
                           <label class="font-weight-bold text-dark">Documentos Adjuntos</label>
                           <input type="file" class="form-control" id="documentos" name="documentos[]" multiple>
                           <small class="text-muted">Puede seleccionar múltiples archivos si es necesario</small>
                       </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection