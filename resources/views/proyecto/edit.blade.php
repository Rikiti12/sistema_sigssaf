@extends('layouts.index')

<title>@yield('title') Actualizar Proyectos</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Actualizar Proyecto</h2>

          
                 </div>

                <form method="post" action="{{ url('/proyecto/'.$proyecto->id) }}" enctype="multipart/form-data" onsubmit="return Persona(this)">
                        @csrf
                        {{ method_field('PATCH')}}

                            <div class="row">
                              <div class="col-4">
                                <label class="font-weight-bold text-dark">Nombre Del Proyecto</label>
                                <input type="text" class="form-control" id="nombre_pro" name="nombre_pro" style="background: white;" value="{{ $proyecto->nombre_pro }}" placeholder="Ingrese El Nombre Del Proyecto" oninput="capitalizarInput('nombre_pro')" autocomplete="off" onkeypress="return soloLetras(event);">
                              </div>
                            
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Descripción</label>
                                    <textarea class="form-control" id="descripcion_pro" name="descripcion_pro" rows="3" oninput="capitalizarInput('descripcion_pro')">{{ old('descripcion_pro', $proyecto->descripcion_pro) }}</textarea>
                                </div>
                            

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Tipo de Proyecto</label>
                                    <select class="form-select" id="tipo_pro" name="tipo_pro" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Infraestructura" {{ $proyecto->tipo_pro == 'Infraestructura' ? 'selected' : '' }}>Infraestructura</option>
                                        <option value="Social" {{ $proyecto->tipo_pro == 'Social' ? 'selected' : '' }}>Social</option>
                                        <option value="Educativo" {{ $proyecto->tipo_pro == 'Educativo' ? 'selected' : '' }}>Educativo</option>
                                        <option value="Salud" {{ $proyecto->tipo_pro == 'Salud' ? 'selected' : '' }}>Salud</option>
                                        <option value="Ambiental" {{ $proyecto->tipo_pro == 'Ambiental' ? 'selected' : '' }}>Ambiental</option>
                                        <option value="Otro" {{ $proyecto->tipo_pro == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="{{ $proyecto->fecha_inicial }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Final</label>
                                <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="{{ $proyecto->fecha_final }}">
                            </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Prioridad</label>
                                    <select class="form-select" id="prioridad" name="prioridad" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Alta" {{ $proyecto->prioridad == 'Alta' ? 'selected' : '' }}>Alta</option>
                                        <option value="Media" {{ $proyecto->prioridad == 'Media' ? 'selected' : '' }}>Media</option>
                                        <option value="Baja" {{ $proyecto->prioridad == 'Baja' ? 'selected' : '' }}>Baja</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                    <span class="text">Guardar</span>
                                </button>
                                <a class="btn btn-info btn-lg" href="{{ route('proyecto.index') }}">
                                    <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                    <span class="text">Regresar</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        var errors = @json($errors->all());
        errors.forEach(function(error) {
            Swal.fire({
                title: 'Proyecto',
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