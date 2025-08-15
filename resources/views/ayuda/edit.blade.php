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

                                <div class="grid grid-cols-1 mt-5 mx-7">
                                    <img id="miniaturas">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Comprobante de la Ayuda</label>
                                    <input type="file" class="form-control" id="foto_ayuda" name="foto_ayuda[]" multiple value="{{ $ayuda->foto_ayuda }}" class="btn btn-outline-info">
                                        <div id="foto_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
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

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            
    <script>
        $(document).ready(function () {
            const fotos = JSON.parse(@json($foto_ayuda)); // Decodifica el JSON de las fotos
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
                const imgElement = createImageElement(`{{ asset('foto_ayuda/ayudas/') }}/${foto}`);
                fotoContainer.appendChild(imgElement);
            });

            // Agrega nuevas fotos seleccionadas por el usuario
            $('#foto_ayuda').change(function () {
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

@endsection