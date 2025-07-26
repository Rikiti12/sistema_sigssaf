@extends('layouts.index')

<title>@yield('title') Actualizar Ayudas Sociales</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                        <h2 class="font-weight-bold text-dark">Actualizar Ayuda</h2>

                    </div>

                    <form method="post" action="{{ url('/ayuda/'.$ayuda->id) }}" enctype="multipart/form-data" onsubmit="return Persona(this)">
                        @csrf
                        {{ method_field('PATCH')}}

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Nombre de la Ayuda</label>
                                    <input type="text" class="form-control" id="nombre_ayuda" name="nombre_ayuda" style="background: white;" value="{{ $ayuda->nombre_ayuda }}" placeholder="Ingrese El Nombre de la Ayuda" oninput="capitalizarInput('nombre_ayuda')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
                        
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Tipo de Ayuda</label>
                                    <select class="form-select" id="tipo_ayuda" name="tipo_ayuda" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Infraestructura" {{ $ayuda->tipo_ayuda == 'Infraestructura' ? 'selected' : '' }}>Infraestructura</option>
                                        <option value="Social" {{ $ayuda->tipo_ayuda == 'Social' ? 'selected' : '' }}>Social</option>
                                        <option value="Educativo" {{ $ayuda->tipo_ayuda == 'Educativo' ? 'selected' : '' }}>Educativo</option>
                                        <option value="Salud" {{ $ayuda->tipo_ayuda == 'Salud' ? 'selected' : '' }}>Salud</option>
                                        <option value="Ambiental" {{ $ayuda->tipo_ayuda == 'Ambiental' ? 'selected' : '' }}>Ambiental</option>
                                        <option value="Otro" {{ $ayuda->tipo_ayuda == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Descripción de Ayudas Sociales</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" oninput="capitalizarInput('descripcion')">{{ old('descripcion', $ayuda->descripcion) }}</textarea>
                                </div>

                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('ayuda/') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
                        </center>
                        
                    </form>
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
                title: 'Ayuda',
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