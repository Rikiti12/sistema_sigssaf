@extends('layouts.index')

<title>@yield('title') Seguimiento</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Seguimiento</h2>
                </div>

                <form method="post" action="{{ route('seguimiento.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" class="form-control" id="id_asignacion" name="id_asignacion" style="background: white;" value="{{ $asignacion->id }}" autocomplete="off">

                    <div class="card-body">
                        
                       <div class="row">
                        
                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Responsable del Seguimiento</label>
                                <select class="form-select" name="responsable_segui" id="responsable_segui">
                                    <option value="" selected="true" disabled>Seleccione un Responsable</option>
                                    @if($asignacion )
                                        <option value="{{ $asignacion->evaluacion->resposanbles->id }}">
                                            {{ $asignacion->evaluacion->resposanbles->cedula }} - {{ $asignacion->evaluacion->resposanbles->nombre }}
                                            {{ $asignacion->evaluacion->resposanbles->apellido }}
                                        </option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Visita Asignado</label>
                                <select class="form-select" id="id_visita" name="id_visita">
                                    <option value="">Seleccione una visita </option>
                                    @foreach($visitas as $visita)
                                        <option value="{{ $visita->id }}">{{ $visita->visita }}</option>
                                    @endforeach
                                </select>
                            </div>  

                            
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Detalles del Seguimiento</label>
                                <textarea class="form-control" id="detalle_segui" name="detalle_segui" placeholder="Ingrese los Detalles del Seguimiento" oninput="capitalizarTextoarea('detalle_segui')" cols="10" rows=""></textarea>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Fecha y Hora del Seguimiento *</label>
                                <input type="datetime-local" class="form-control" id="fecha_hor" name="fecha_hor" 
                                       value="{{ date('Y-m-d\TH:i') }}" required>
                            </div>


                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Gasto</label>
                                <input type="text" class="form-control" id="gasto" name="gasto" placeholder="Ingrese el Nombre del Responsable" autocomplete="off">
                            </div>


                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Estado Actual *</label>
                                <select class="form-select" name="estado_actual" id="estado_actual" required>
                                    <option value="" disabled selected>Seleccione estado</option>
                                    <option value="En progreso">En progreso</option>
                                    <option value="Completado">Completado</option>
                                    <option value="Retrasado">Retrasado</option>
                                    <option value="En revisión">En revisión</option>
                                    <option value="En riesgo">En riesgo</option>
                                </select>
                            </div>
                             
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Riesgos identificados</label>
                                <textarea class="form-control" name="riesgos" id="riesgos" rows="3" placeholder="Describa los riesgos identificados" >{{ old('riesgos') ?? '' }}</textarea>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">
                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('/seguimiento') }}"><span class="icon text-white-50">
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

