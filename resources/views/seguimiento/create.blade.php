@extends('layouts.index')

@section('title', 'Seguimiento')

@push('styles')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
@endpush

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Seguimiento</h2>
                </div>

                <form method="post" action="{{ route('seguimiento.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                       <div class="row"> 
                          @if(isset($proyecto))
                          @else
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Proyecto Asignado:</label>
                                <select class="form-select" name="id_proyecto" id="id_proyecto">
                                    <option value="">Seleccione un Proyecto</option>
                                    @foreach ($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}">{{ $proyecto->nombre_pro }}</option>
                                    @endforeach
                                </select>
                            </div>
                         @endif

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Fecha y Hora del Seguimiento</label>
                                <input type="datetime-local" class="form-control" id="fecha_segui" name="fecha_segui" value="<?php echo date('Y-m-d\TH:i'); ?>">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Responsable del Seguimiento</label>
                                <input type="text" class="form-control" id="responsable_segui" name="responsable_segui" placeholder="Ingrese el Nombre del Responsable" oninput="capitalizarInput('responsable_segui')" autocomplete="off">
                            </div>
                            
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Detalles del Seguimiento</label>
                                <textarea class="form-control" id="detalle_segui" name="detalle_segui" placeholder="Ingrese los Detalles del Seguimiento" oninput="capitalizarTextoarea('detalle_segui')" cols="10" rows=""></textarea>
                            </div>
                       
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Estado del Proyecto</label>
                                <select class="form-control" name="estatus_proye" id="estatus_proye">
                                    <option value="">Seleccione un Estado</option>
                                    <option value="En Inicio">En Inicio</option>
                                    <option value="En Progreso">En Progreso</option>
                                    <option value="Retrasado">Retrasado</option>
                                    <option value="Completado">Completado</option>
                                    <option value="Suspendido">Suspendido</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
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

