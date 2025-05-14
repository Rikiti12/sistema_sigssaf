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
                        
                       <div class="row"> 

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Responsable del Seguimiento</label>
                                <input type="text" class="form-control" id="responsable_segui" name="responsable_segui" value="{{ $seguimiento->responsable_segui}}" placeholder="Ingrese el Nombre del Responsable" oninput="capitalizarInput('responsable_segui')" autocomplete="off">
                            </div>
                            
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Detalles del Seguimiento</label>
                                <textarea class="form-control" id="detalle_segui" name="detalle_segui" value="{{ $seguimiento->detalle_segui }}" placeholder="Ingrese los Detalles del Seguimiento" oninput="capitalizarTextoarea('detalle_segui')" cols="10" rows=""></textarea>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                <input type="date" class="form-control" id="fecha_segui" name="fecha_segui" value="{{ $seguimiento->fecha_seguii }}"<?php echo date('d/m/Y'); ?>">
                            </div>
                       
                            {{-- <div class="col-4">
                                <label class="font-weight-bold text-dark">Estado del Proyecto</label>
                                <select class="form-select"name="estatus" id="estatus">
                                    <option value="" selected="true" disabled>Seleccione un Estatus</option>
                                    <option value="Aprobado">Aprobado</option>
                                    <option value="Negado">Negado</option>
                                </select>
                            </div> --}}

                            @if(auth()->user()->hasRole('Asistente'))
                                @if ($seguimiento->estatus_resp == "" || $seguimiento->estatus_resp == "Pendiente")
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Estatus del proyectos</label>
                                    <select class="select2single form-control" name="estatus" id="estatus">
                                        <option value="0" selected="true" disabled>Seleccione un Estatus</option>
                                        <option value="Aprobado" {{ (old('estatus', $seguimiento->estatus ?? '') === 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                                        <option value="Negado" {{ (old('estatus', $seguimiento->estatus ?? '') === 'Negado') ? 'selected' : '' }}>Negado</option>
                                    </select>
                                </div>
                                @endif
                            @elseif(auth()->user()->hasRole('Administrador'))
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Estatus del proyectos</label>
                                    <select class="select2single form-control" name="estatus" id="estatus">
                                        <option value="0" selected="true" disabled>Seleccione un Estatus</option>
                                        <option value="Aprobado" {{ (old('estatus', $seguimiento->estatus ?? '') === 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                                        <option value="Negado" {{ (old('estatus', $seguimiento->estatus ?? '') === 'Negado') ? 'selected' : '' }}>Negado</option>
                                    </select>
                                </div>
                            @endif

                            {{-- @if(auth()->user()->hasRole('Administrador'))
                                <div class="card-body" id="estatus_aprob">
                                    <label class="font-weight-bold text-dark">Estatus Aprobacion</label>
                                    <div class="row">
                                        <div class="form-check form-check-inline col-1 mr-2">
                                            <input class="form-check-input" type="radio" name="estatus_res" id="estatus_res_pen" value="Pendiente" checked>
                                            <label class="form-check-label" for="estatus_res_pen">Pendiente</label>
                                        </div>
                                        <div class="form-check form-check-inline col-1 mr-2">
                                            <input class="form-check-input" type="radio" name="estatus_res" id="estatus_res_apro" value="Aprobado">
                                            <label class="form-check-label" for="estatus_rep_apro">Aprobado</label>
                                        </div>
                                        <div class="form-check form-check-inline col-1 mr-2">
                                            <input class="form-check-input" type="radio" name="estatus_res" id="estatus_res_neg" value="Negado">
                                            <label class="form-check-label" for="estatus_res_neg">Negado</label>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}

                            @if(auth()->user()->hasRole('Administrador'))
                                <div class="card-body" id="estatus_respuesta" style="display: none;">
                                    <label class="font-weight-bold text-primary">Estatus Aprobación</label>
                                    <div class="row">
                                        <div class="custom-control custom-radio col-1 mr-2"> 
                                            <input class="custom-control-input" type="radio" name="estatus_res" id="estatus_resp_pen" value="Pendiente" {{ ($seguimiento->estatus_res=="Pendiente")? "checked" : ""}}>
                                            <label class="custom-control-label" for="estatus_res_pen">Pendiente</label>
                                        </div>
                                        <div class="custom-control custom-radio col-1 mr-2">
                                            <input class="custom-control-input" type="radio" name="estatus_res" id="estatus_resp_apro" value="Aprobado" {{ ($seguimiento->estatus_res=="Aprobado")? "checked" : ""}}>
                                            <label class="custom-control-label" for="estatus_res_apro">Aprobado</label>
                                        </div>
                                        <div class="custom-control custom-radio col-1 mr-2">
                                            <input class="custom-control-input" type="radio" name="estatus_res" id="estatus_resp_neg" value="Negado" {{ ($seguimiento->estatus_res=="Negado")? "checked" : ""}}>
                                            <label class="custom-control-label" for="estatus_res_neg">Negado</label>
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
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('controlseguimiento.index') }}"><span class="icon text-white-50">
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

