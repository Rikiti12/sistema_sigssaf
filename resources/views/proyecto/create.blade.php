@extends('layouts.index')

<title>@yield('title') Asignar Proyectos</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Asignar Proyectos</h2>
                </div>

                <form method="post" action="{{ route('proyecto.store') }}" enctype="multipart/form-data" onsubmit="return Proyectos(this)">
                    @csrf

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre Del Proyecto</label>
                                    <input type="text" class="form-control" id="nombre_pro" name="nombre_pro" style="background: white;" value="" placeholder="Ingrese El Nombre Del Proyecto" oninput="capitalizarInput('nombre_pro')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
                                
                                <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Descripcion</label>
                                        <input type="text" class="form-control" id="descripcion_pro" name="descripcion_pro" style="background: white;" value="" placeholder="Ingrese La Descripcion" autocomplete="off" oninput="capitalizarInput('descripcion_pro')" onkeypress="return soloLetras(event);">
                                    </div>
                                    
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Persona Asignada</label>
                                    <select class="form-select" id="id_persona" name="id_persona">
                                        <option value="">Seleccione una persona</option>
                                        @foreach($personas as $persona)
                                            <option value="{{ $persona->id }}">{{ $persona->nombre }} {{ $persona->apellido }}  {{ $persona->cedula }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Comunidad Asignado</label>
                                    <select class="form-select" id="id_comunidad" name="id_comunidad">
                                        <option value="">Seleccione una comunidad </option>
                                        @foreach($comunidades as $comunidad)
                                            <option value="{{ $comunidad->id }}">{{ $comunidad->nom_comuni }}</option>
                                        @endforeach
                                    </select>                                   
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold text-dark">Memoria Fotográfica</label>
                                    <input type="file" id="imagenes" name="imagenes[]" multiple class="btn btn-outline-info d-block w-100">
                                    <div id="imagenes_container" class="mt-2"></div>
                                </div>

                                {{-- <div class="col-md-4 mb-3">
                                    <label  class="font-weight-bold text-dark">Rendición de Cuenta</label>
                                    <input type="file" id="documentos_pdf" name="documentos[]" multiple class="btn btn-outline-info w-100">
                                    <div id="pdf_container"></div>
                                </div> --}}

                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                    <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo date('d/m/Y'); ?>">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold text-dark">Fecha Final</label>
                                    <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                            
                            
                            </div>    
                              
                        </div>

                    <div class="card-body">

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('/home') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                        </center>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- * FUNCION PARA MOSTRAR LAS IMAGENES --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#imagenes').change(function () {
                const fotoContainer = document.getElementById('imagenes_container');
    
                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '50%';
                        img.style.maxHeight = '50%';
                        fotoContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    {{-- ? FUNCION PARA MOSTRAR LOS PDF --}}

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#documentos_pdf').change(function () {
                const pdfcontainer = document.getElementById('pdf_container');
                pdfcontainer.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevos archivos

                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const embed = document.createElement('embed');
                        embed.src = e.target.result;
                        embed.type = 'application/pdf';
                        embed.style.width = '100%';
                        embed.style.height = '400px';
                        pdfcontainer.appendChild(embed);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script> --}}

    {{-- ? FUNCION PARA MOSTRAR LOS PDF --}}

    {{-- <script>
        $(document).ready(function () {
            $('#documentos').change(function () {
                const pdfContainer = document.getElementById('documentos_container');
                pdfContainer.innerHTML = '';
                
                Array.from(this.files).forEach(file => {
                    if (file.type !== 'application/pdf') return;
                    
                    const pdfElement = document.createElement('div');
                    pdfElement.className = 'pdf-item flex items-center mb-2 p-2 bg-gray-100 rounded';
                    
                    // Icono de PDF
                    const icon = document.createElement('div');
                    icon.innerHTML = '📄';
                    icon.className = 'mr-2 text-xl';
                    
                    // Nombre del archivo
                    const name = document.createElement('span');
                    name.textContent = file.name;
                    name.className = 'text-sm truncate';
                    
                    pdfElement.appendChild(icon);
                    pdfElement.appendChild(name);
                    pdfContainer.appendChild(pdfElement);
                });
            });
        });
    </script> --}}

    {{-- ? FUNCION PARA CAPITALIZAR PRIMERA LETRA --}}

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </scrip>

    {{-- ! FUNCION PARA MOSTRAR ERRORES --}}

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