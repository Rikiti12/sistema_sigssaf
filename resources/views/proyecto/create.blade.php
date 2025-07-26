@extends('layouts.index')

<title>@yield('title')  Registrar Proyectos</title>
<script src="{{asset ('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark"> Registrar Proyectos</h2>
                </div>

                <form method="post" action="{{ route('proyecto.store') }}" enctype="multipart/form-data" onsubmit="return Proyectos(this)">
                    @csrf

                    <div class="card-body">
                    
                        <div class="row">

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Nombre Del Proyecto</label>
                                <input type="text" class="form-control" id="nombre_pro" name="nombre_pro" style="background: white;" value="" placeholder="Ingrese El Nombre Del Proyecto" oninput="capitalizarInput('nombre_pro')" autocomplete="off" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Descripción</label>
                                <textarea class="form-control" id="descripcion_pro" name="descripcion_pro" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('descripcion_pro')">{{ old('descripcion_pro') }}</textarea>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Tipo de Proyecto</label>
                                <select class="form-select" id="tipo_pro" name="tipo_pro" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Infraestructura">Infraestructura</option>
                                    <option value="Social">Social</option>
                                    <option value="Educativo">Educativo</option>
                                    <option value="Salud">Salud</option>
                                    <option value="Ambiental">Ambiental</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Actividades</label>
                                <textarea class="form-control" id="actividades" name="actividades" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('actividades')">{{ old('actividades') }}</textarea>
                            </div>
 
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Ayudas Sociales</label>
                                <select class="form-select" id="id_ayuda" name="id_ayuda">
                                    <option value="">Seleccione las Ayudas Sociales</option>
                                    @foreach($ayudas as $ayuda)
                                        <option value="{{ $ayuda->id }}">Nombre Ayuda: {{ $ayuda->nombre_ayuda }} - Tipo de Ayuda:{{ $ayuda->tipo_ayuda }}</option>
                                    @endforeach
                                </select>                                   
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo date('d/m/Y'); ?>">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Final</label>
                                <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="<?php echo date('d/m/Y'); ?>">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Prioridad</label>
                                <select class="form-select" id="prioridad" name="prioridad" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <img id="miniaturas">
                            </div>
    
                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Acta Conformidad</label>
                                <input type="file" class="form-control" id="acta_conformidad" name="acta_conformidad[]" multiple>
                                    <div id="foto_container"></div>
                            </div>

                            {{-- <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo date('d/m/Y'); ?>">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Final</label>
                                <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="<?php echo date('d/m/Y'); ?>">
                            </div> --}}

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                <input type="text" class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo date('d/m/Y'); ?>" placeholder="DD/MM/YYYY">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Fecha Final</label>
                                <input type="text" class="form-control" id="fecha_final" name="fecha_final" value="<?php echo date('d/m/Y'); ?>" placeholder="DD/MM/YYYY">
                            </div>
                            
                        </div>

                    </div>

                    <br><br>

                    <center>
                        <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                        </button>
                        <a class="btn btn-info btn-lg" href="{{ route('proyecto.index') }}"><span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Regresar</span>
                        </a>
                    </center>

                </form>
            </div>
        </div>
    </div>
</div>

    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
    
    {{-- ? FUNCION DE SELECT MULTIPLE
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicialización de Select2 para el select de actividades
            $('.select2-single').select2({
                placeholder: "Seleccione las Actividades",
                allowClear: true
            });

            // Si tienes otros selects con Select2, también inicialízalos aquí
            // $('.otro-select2-clase').select2();
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            // Asumiendo que usas jQuery UI Datepicker o similar
            // Si no lo tienes, deberás incluir la librería (ej. desde un CDN o npm)
            $("#fecha_inicial").datepicker({
                dateFormat: "dd/mm/yy", // Esto asegura que el valor del input sea DD/MM/YYYY
                onSelect: function(selectedDate) {
                    // Opcional: Asegurarse que fecha_final no sea anterior a fecha_inicial
                    $("#fecha_final").datepicker("option", "minDate", selectedDate);
                }
            });
    
            $("#fecha_final").datepicker({
                dateFormat: "dd/mm/yy", // Esto asegura que el valor del input sea DD/MM/YYYY
                onSelect: function(selectedDate) {
                    // Opcional: Asegurarse que fecha_inicial no sea posterior a fecha_final
                    $("#fecha_inicial").datepicker("option", "maxDate", selectedDate);
                }
            });
        });
    </script>

    {{-- ! FUNCION PARA UNA LETRA MAYUCUSLAS Y LAS DEMAS EN MINICUSLAS--}}

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }

        
    </script>

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#acta_conformidad').change(function () {
                const fotoContainer = document.getElementById('foto_container');
    
                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '40%';
                        img.style.maxHeight = '40%';
                        fotoContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

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