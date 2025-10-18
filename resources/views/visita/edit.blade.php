@extends('layouts.index')

<title>@yield('title') Actualizar Visitas</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                        <h2 class="font-weight-bold text-dark">Actualizar Visita</h2>

                    </div>

                    <form method="post" action="{{ url('/visita/'.$visita->id) }}" enctype="multipart/form-data" onsubmit="return Visita(this)">
                        @csrf
                        {{ method_field('PATCH')}}

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                           <label class="font-weight-bold text-dark">Responsable de la Visita</label>
                            <select class="form-select" id="id_resposanble" name="id_resposanble" required>
                               <option value="">Seleccione un Responsable...</option>
                               @foreach($resposanbles as $resposanble)
                                   <option value="{{ $resposanble->id }}" {{ $evaluacion->id_resposanble == $resposanble->id ? 'selected' : '' }}>
                                      {{ $resposanble->cedula }} - {{ $resposanble->nombre }} {{ $resposanble->apellido }}
                                   </option>
                               @endforeach
                           </select>
                       </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Visita</label>
                                    <input type="text" class="form-control" id="visita" name="visita" style="background: white;" value="{{ $visita->visita }}" placeholder="Ingrese de la visita" oninput="capitalizarInput('visita')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
                            
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Descripción</label>
                                    <textarea class="form-control" id="descripcion_vis" name="descripcion_vis" rows="3" oninput="capitalizarInput('descripcion_vis')">{{ old('descripcion_vis', $visita->descripcion_vis) }}</textarea>
                                </div>
                                  
                                <div class="grid grid-cols-1 mt-5 mx-7">
                                    <img id="miniaturas">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">foto de la visita</label>
                                    <input type="file" class="form-control" id="foto_visita" name="foto_visita[]" multiple value="{{ $visita->foto_visita }}" class="btn btn-outline-info">
                                        <div id="foto_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
                                </div>

                                <div class="col-md-4">
                                    <label class="font-weight-bold text-dark">Fecha de la visita</label>
                                    <input type="text" class="form-control" id="fecha_visita" name="fecha_visita" value="{{ $visita->fecha_visita ? Carbon\Carbon::parse($visita->fecha_visita)->format('d/m/Y') : '' }}">
                                </div>


                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('visita/') }}">
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

    {{-- <script>
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
    </script> --}}

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        
    <script>
        $(document).ready(function () {
            const fotos = JSON.parse(@json($foto_visita)); // Decodifica el JSON de las fotos
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
                const imgElement = createImageElement(`{{ asset('foto_visita/visitas/') }}/${foto}`);
                fotoContainer.appendChild(imgElement);
            });

            // Agrega nuevas fotos seleccionadas por el usuario
            $('#foto_visita').change(function () {
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
                title: 'Visita',
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