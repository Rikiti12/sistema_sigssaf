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

                        <div class="card-body">

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
                            

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Actividades</label>
                                    <textarea class="form-control" id="actividades" name="actividades" rows="3" oninput="capitalizarInput('actividades')">{{ old('actividades', $proyecto->actividades) }}</textarea>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Ayudas Sociales</label>
                                    <select class="form-select" id="id_ayuda" name="id_ayuda">
                                        @foreach($ayudas as $ayuda)
                                            <option value="{{ $ayuda->id }}" @selected($proyecto->id_ayuda == $ayuda->id)>Nombre Ayuda: {{ $ayuda->nombre_ayuda }} - {{ $ayuda->tipo_ayuda }} </option>
                                        @endforeach
                                    </select>                                   
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
                               
                                <div class="grid grid-cols-1 mt-5 mx-7">
                                    <img id="miniaturas">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Acta Conformidad</label>
                                    <input type="file" class="form-control" id="acta_conformidad" name="acta_conformidad[]" multiple value="{{ $proyecto->acta_conformidad }}" class="btn btn-outline-info">
                                        <div id="foto_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
                                </div>

                                <div class="col-md-4">
                                    <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                    <input type="text" class="form-control" id="fecha_inicial" name="fecha_inicial" value="{{ $proyecto->fecha_inicial }}" placeholder="DD/MM/YYYY">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="font-weight-bold text-dark">Fecha Final</label>
                                    <input type="text" class="form-control" id="fecha_final" name="fecha_final"  value="{{ $proyecto->fecha_final }}" placeholder="DD/MM/YYYY">
                                </div>

                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('proyecto/') }}">
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

    <script>
        $(document).ready(function() {
            $("#fecha_inicial").datepicker({
                dateFormat: "dd/mm/yy", // Esto asegura que el valor del input sea DD/MM/YYYY
                onSelect: function(selectedDate) {
                    $("#fecha_final").datepicker("option", "minDate", selectedDate);
                }
            });

            $("#fecha_final").datepicker({
                dateFormat: "dd/mm/yy", // Esto asegura que el valor del input sea DD/MM/YYYY
                onSelect: function(selectedDate) {
                    $("#fecha_inicial").datepicker("option", "maxDate", selectedDate);
                }
            });
        });
    </script>

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        
    <script>
        $(document).ready(function () {
            const fotos = JSON.parse(@json($acta_conformidad)); // Decodifica el JSON de las fotos
            const fotoContainer = document.getElementById('foto_container');

            // Función para crear una imagen con botón de eliminación
            function createImageElement(src) {
                const div = document.createElement('div');
                div.style.position = 'relative';
                div.style.display = 'inline-block';
                div.style.margin = '5px';
                div.style.width = 'calc(50% - 10px)'; // Ajusta el ancho para dos columnas
                div.style.boxSizing = 'border-box'; // Asegura que el margen no afecte el ancho total

                const img = document.createElement('img');
                img.src = src;
                img.style.width = '100%'; // Asegura que la imagen ocupe todo el div
                img.style.height = 'auto'; // Mantiene la proporción de la imagen
                img.style.display = 'block';

                const btn = document.createElement('button');
                btn.innerText = 'X';
                // btn.classList.add('btn btn-danger btn-sm');
                btn.style.position = 'absolute';
                btn.style.top = '0';
                btn.style.right = '0';
                btn.style.backgroundColor = 'black';
                btn.style.color = 'white';
                btn.style.border = 'none';
                btn.style.borderRadius = '50%';
                btn.style.cursor = 'pointer';
                btn.style.transform = 'translate(-15%, 15%)';
                btn.style.width = '20px';  // Ancho del botón
                btn.style.height = '20px'; // Alto del botón
                btn.style.fontSize = '12px';

                btn.addEventListener('click', () => {
                    fotoContainer.removeChild(div);
                });

                div.appendChild(img);
                div.appendChild(btn);
                return div;
            }

            // Muestra las fotos registradas
            fotos.forEach(foto => {
                const imgElement = createImageElement(`{{ asset('acta_conformidad/proyectos/') }}/${foto}`);
                fotoContainer.appendChild(imgElement);
            });

            // Agrega nuevas fotos seleccionadas por el usuario
            $('#acta_conformidad').change(function () {
                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const imgElement = createImageElement(e.target.result);
                        fotoContainer.appendChild(imgElement);
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