@extends('layouts.index')

<title>@yield('title') Actulizar Seguimiento</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Actualizar Seguimiento</h2>
                </div>

                <form method="post" action="{{ route('seguimiento.update', $seguimiento->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                     <div class="card-body">

                        <input type="hidden" class="form-control" id="id_asignacion" name="id_asignacion" style="background: white;" value="{{ isset($seguimiento->asignacion->id)?$seguimiento->asignacion->id:'' }}" placeholder="" autocomplete="off">                                  
                        
                       <div class="row"> 

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Responsable del Seguimiento</label>
                                <select class="form-select" name="responsable_segui" id="responsable_segui" @readonly(true)>
                                    <option value="" selected="true" disabled>Seleccione un Responsable</option>
                                    @if($seguimiento->asignacion )
                                        <option value="{{ $seguimiento->asignacion->evaluacion->resposanbles->id }}" selected>
                                            {{ $seguimiento->asignacion->evaluacion->resposanbles->cedula }} - {{ $seguimiento->asignacion->evaluacion->resposanbles->nombre }}
                                            {{ $seguimiento->asignacion->evaluacion->resposanbles->apellido }}
                                        </option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Visita Asignado</label>
                                <select class="form-select" id="id_visita" name="id_visita">
                                    <option value="">Seleccione una visita </option>
                                    @foreach($visitas as $visita)
                                         <option value="{{ $visita->id }}" @selected($seguimiento->id_visita == $visita->id)>{{ $visita->visita }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Detalles del Seguimiento</label>
                                <textarea class="form-control" id="detalle_segui" name="detalle_segui" placeholder="Ingrese los Detalles del Seguimiento" oninput="capitalizarTextoarea('detalle_segui')" cols="10" rows="">{{ $seguimiento->detalle_segui }}</textarea>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Fecha y Hora del Seguimiento</label>
                                <input type="datetime-local" class="form-control" id="fecha_hor" name="fecha_hor" 
                                       value="{{ old('fecha_hora_segui', date('Y-m-d\TH:i', strtotime($seguimiento->fecha_hor))) }}" required>
                            </div>

                           <div class="col-4">
                                <label class="font-weight-bold text-dark">Gasto</label>
                                <input type="number"class="form-control"id="gasto"name="gasto"value="{{ isset($seguimiento->gasto) ? $seguimiento->gasto : '' }}" placeholder="Ingrese el gasto (solo números)"autocomplete="off" step="any" min="0">    
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Estado Actual</label>
                                <select class="form-select" name="estado_actual" id="estado_actual" required>
                                    <option value="" disabled>Seleccione estado</option>
                                    <option value="En progreso" {{ old('estado_actual', $seguimiento->estado_actual) == 'En progreso' ? 'selected' : '' }}>En progreso</option>
                                    <option value="Completado" {{ old('estado_actual', $seguimiento->estado_actual) == 'Completado' ? 'selected' : '' }}>Completado</option>
                                    <option value="Retrasado" {{ old('estado_actual', $seguimiento->estado_actual) == 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
                                    <option value="En revisión" {{ old('estado_actual', $seguimiento->estado_actual) == 'En revisión' ? 'selected' : '' }}>En revisión</option>
                                    <option value="En riesgo" {{ old('estado_actual', $seguimiento->estado_actual) == 'En riesgo' ? 'selected' : '' }}>En riesgo</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Riesgos identificados</label>
                                <textarea class="form-control" name="riesgos" id="riesgos"rows="3" placeholder="Describa los riesgos identificados">{{ old('riesgos', $seguimiento->riesgos) }}</textarea>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">
                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('controlseguimiento') }}"><span class="icon text-white-50">
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
            if (inputElement) { // Verifica si el elemento existe
                inputElement.value = capitalizarPrimeraLetra(inputElement.value);
            }
        }

        function capitalizarTextoarea(idTextarea) {
            const textareaElement = document.getElementById(idTextarea);
            if (textareaElement) {  // Verifica si el elemento existe
                const words = textareaElement.value.toLowerCase().split(/\s+/).map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
                textareaElement.value = words;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.select2-single').select2();
        });
    </script>
    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Seguimiento',
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

