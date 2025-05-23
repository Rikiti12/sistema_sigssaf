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

                    <input type="hidden" class="form-control" id="id_planificacion" name="id_planificacion" style="background: white;" value="{{ $planificacion->id }}" autocomplete="off">

                    <div class="card-body">
                        
                       <div class="row"> 

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Responsable del Seguimiento</label>
                                <input type="text" class="form-control" id="responsable_segui" name="responsable_segui" placeholder="Ingrese el Nombre del Responsable" oninput="capitalizarInput('responsable_segui')" autocomplete="off">
                            </div>
                            
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Detalles del Seguimiento</label>
                                <textarea class="form-control" id="detalle_segui" name="detalle_segui" placeholder="Ingrese los Detalles del Seguimiento" oninput="capitalizarTextoarea('detalle_segui')" cols="10" rows=""></textarea>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                <input type="date" class="form-control" id="fecha_segui" name="fecha_segui" value="<?php echo date('d/m/Y'); ?>">
                            </div>
                       
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Estado del Proyecto</label>
                                <select class="form-select"name="estatus" id="estatus">
                                    <option value="" selected="true" disabled>Seleccione un Estatus</option>
                                    <option value="Aprobado">Aprobado</option>
                                    <option value="Negado">Negado</option>
                                </select>
                            </div>

                            @if(auth()->user()->hasRole('Administrador'))
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
                            @endif


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

    <script>
        document.addEventListener('DOMContentLoaded' function (){
        const estatusSeguimiento = document.getElementById('estatus');
        const estatusAprobacion = document.getElementById('estatus_aprob');
        
        function toggleEstatusAprobacion(){
            if(estatusSeguimiento.value === 'Negado') {
                estatusAprobacion.style.display = 'none';
            }else if (estatusSeguimiento.value === 'Aprobado') {
                estatusAprobacion.style.display = 'block';
            } else {
                estatusAprobacion.style.display = 'block';
            }
        }

        estatusSeguimiento.addEventListener('change', toggleEstatusAprobacion);

        toggleEstatusAprobacion();

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

