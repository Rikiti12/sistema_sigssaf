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
                                <label class="font-weight-bold text-dark">Proyecto Asignado:</label>
                                <select class="form-select" name="id_proyecto" id="id_proyecto">
                                    <option value="">Seleccione un Proyecto</option>
                                    @foreach ($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}" {{ $seguimiento->id_proyecto == $proyecto->id ? 'selected' : '' }}>
                                            {{ $proyecto->nombre_pro }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Fecha y Hora del Seguimiento</label>
                                <input type="datetime-local" class="form-control" id="fecha_segui" name="fecha_segui"
                                       value="{{ \Carbon\Carbon::parse($seguimiento->fecha_segui)->format('Y-m-d\TH:i') }}">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Responsable del Seguimiento</label>
                                <input type="text" class="form-control" id="responsable_segui" name="responsable_segui"
                                       placeholder="Ingrese el Nombre del Responsable" oninput="capitalizarInput('responsable_segui')"
                                       autocomplete="off" value="{{ $seguimiento->responsable_segui }}">
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Detalles del Seguimiento</label>
                                <textarea class="form-control" id="detalle_segui" name="detalle_segui"
                                          placeholder="Ingrese los Detalles del Seguimiento"
                                          oninput="capitalizarTextoarea('detalle_segui')" cols="10" rows="3"
                                          style="max-height: 6rem;">{{ $seguimiento->detalle_segui }}</textarea>
                            </div>


                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Estado del Proyecto</label>
                                <select class="form-control" name="estatus_proye" id="estatus_proye">
                                    <option value="">Seleccione un Estado</option>
                                    <option value="En Inicio" {{ $seguimiento->estatus_proye == 'En Inicio' ? 'selected' : '' }}>En Inicio</option>
                                    <option value="En Progreso" {{ $seguimiento->estatus_proye == 'En Progreso' ? 'selected' : '' }}>En Progreso</option>
                                    <option value="Retrasado" {{ $seguimiento->estatus_proye == 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
                                    <option value="Completado" {{ $seguimiento->estatus_proye == 'Completado' ? 'selected' : '' }}>Completado</option>
                                    <option value="Suspendido" {{ $seguimiento->estatus_proye == 'Suspendido' ? 'selected' : '' }}>Suspendido</option>
                                    <option value="Cancelado" {{ $seguimiento->estatus_proye == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </div>
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

