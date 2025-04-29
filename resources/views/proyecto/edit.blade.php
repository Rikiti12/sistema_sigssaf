@extends('layouts.index')

<title>@yield('title') Actulizar La Asignacion Del Proyectos</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Actualizar proyectos</h2>
                </div>

                <form method="post" action="{{ url('/proyecto/'.$proyecto->id) }}" enctype="multipart/form-data" onsubmit="return Proyectos(this)">
                    @csrf
                    {{ method_field('PATCH') }}

                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Nombre Del Proyecto</label>
                                <input type="text" class="form-control" id="nombre_pro" name="nombre_pro" style="background: white;" value="{{ $proyecto->nombre_pro }}" placeholder="Ingrese El Nombre Del Proyecto" oninput="capitalizarInput('nombre_pro')" autocomplete="off" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Descripción</label>
                                <input type="text" class="form-control" id="descripcion_pro" name="descripcion_pro" style="background: white;" value="{{ $proyecto->descripcion_pro }}" placeholder="Ingrese La Descripción" autocomplete="off" oninput="capitalizarInput('descripcion_pro')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Persona Asignada</label>
                                <select class="form-select" id="id_persona" name="id_persona">
                                    <option value="">Seleccione una persona</option>
                                    @foreach($personas as $persona)
                                        <option value="{{ $persona->id }}" {{ $proyecto->id_persona == $persona->id ? 'selected' : '' }}>
                                            {{ $persona->nombre }} {{ $persona->apellido }} {{ $persona->cedula }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Comunidad Asignada</label>
                                <select class="form-select" id="id_comunidad" name="id_comunidad">
                                    <option value="">Seleccione una comunidad</option>
                                    @foreach($comunidades as $comunidad)
                                        <option value="{{ $comunidad->id }}" {{ $proyecto->id_comunidad == $comunidad->id ? 'selected' : '' }}>
                                            {{ $comunidad->nom_comuni }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <img id="miniaturas">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label  class="font-weight-bold text-primary">Reseña Fotográfica</label>
                                <input type="file" id="imagenes" name="imagenes[]" multiple value="{{ $imagenes }}" class="btn btn-outline-info d-block w-100">
                                    <div id="foto_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
                            </div>

                            {{-- <div class="col-md-4 mb-3">
                                <label  class="font-weight-bold text-primary">Comprobante</label>
                                <input type="file" id="documentos" name="documentos[]" multiple value="{{ $documentos }}" class="btn btn-outline-info d-block w-100">
                                <div id="pdf_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
                            </div> --}}

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="{{ $proyecto->fecha_inicial }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-dark">Fecha Final</label>
                                <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="{{ $proyecto->fecha_final }}">
                            </div>

                        </div>

                    </div>

                    <div class="card-body">
                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('planificacion/') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
                        </center>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script>
        $(document).ready(function () {
            const fotos = JSON.parse(@json($imagenes)); // Decodifica el JSON de las fotos
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
                const imgElement = createImageElement(`{{ asset('imagenes/') }}/${foto}`);
                fotoContainer.appendChild(imgElement);
            });
    
            // Agrega nuevas fotos seleccionadas por el usuario
            $('#imagenes').change(function () {
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

    {{-- * FUNCION PARA MOSTRAR EL PDF --}}

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>

        $(document).ready(function () {
            const pdfs = JSON.parse(@json($documentos)); // Decodifica el JSON de los PDFs
            const pdfContainer = document.getElementById('pdf_container');

            // Función para crear un elemento PDF con botón de eliminación
            function createPdfElement(src) {
                const div = document.createElement('div');
                div.style.position = 'relative';
                div.style.display = 'inline-block';
                div.style.margin = '5px';
                div.style.width = 'calc(50% - 10px)'; // Ajusta el ancho para dos columnas
                div.style.boxSizing = 'border-box'; // Asegura que el margen no afecte el ancho total

                const iframe = document.createElement('iframe');
                iframe.src = src;
                iframe.style.width = '200%'; // Asegura que el iframe ocupe todo el div
                iframe.style.height = '400px'; // Altura fija para el iframe
                iframe.style.display = 'block';

                const btn = document.createElement('button');
                btn.innerText = 'X';
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
                    pdfContainer.removeChild(div);
                });

                div.appendChild(iframe);
                div.appendChild(btn);
                return div;
            }

            // Muestra los PDFs registrados
            pdfs.forEach(pdf => {
                const pdfElement = createPdfElement(`{{ asset('pdf/') }}/${pdf}`);
                pdfContainer.appendChild(pdfElement);
            });

            // Agrega nuevos PDFs seleccionados por el usuario
            $('#documentos').change(function () {
                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const pdfElement = createPdfElement(e.target.result);
                        pdfContainer.appendChild(pdfElement);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

    </script> --}}

    {{-- * FUNCION PARA CAPITALIZAR LA PRIMERA LETRA --}}

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Proyectos',
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