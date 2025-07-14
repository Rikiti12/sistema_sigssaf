@extends('layouts.index')

<title>@yield('title') Asignar Proyectos</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
<link  href="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css')}}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Asignar Proyectos</h2>
                </div>

                <form method="post" action="{{ route('asignacion.store') }}" enctype="multipart/form-data" onsubmit="return Asignaciones(this)">
                    @csrf

                        <div class="card-body">
                            
                            <input type="hidden" class="form-control" id="id_evaluacion" name="id_evaluacion" style="background: white;" value="{{ isset($evaluacion->id)?$evaluacion->id:'' }}" placeholder="" autocomplete="off">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Vocero Asignada</label>
                                    <select class="form-select" id="id_vocero" name="id_vocero">
                                        <option value="">Seleccione un vocero</option>
                                        @foreach($voceros as $vocero)
                                            @if($vocero->tipo_vocero === 'consejo_comunal')
                                                <option value="{{ $vocero->id }}"> {{ $vocero->cedula }} {{ $vocero->nombre }} {{ $vocero->apellido }}</option>
                                            @endif
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

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Descripción del Alcance</label>
                                    <textarea class="form-control" id="descri_alcance" name="descri_alcance" placeholder="Ingrese la Descripción del Alcance" oninput="capitalizarTextoarea('descri_alcance')" cols="10" rows="10" style="max-height: 6rem;"></textarea>
                                </div>
    
                                <div class="col-2">
                                    <label class="font-weight-bold text-dark">Moneda</label>
                                    <select class="form-control" id="moneda_presu" name="moneda_presu">
                                        <option value="VES">VES</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                    </select>
                                </div>
    
                                <div class="col-3">
                                    <label class="font-weight-bold text-dark">Presupuesto</label>
                                    <input type="text" class="form-control" id="presupuesto" name="presupuesto" style="background: white;" value="" placeholder="Ingrese el Presupuesto" autocomplete="off">
                                </div>
    
                                <div class="col-3">
                                    <label class="font-weight-bold text-dark">Descripción de la Obra</label>
                                    <textarea class="form-control" id="descri_obra" name="descri_obra" placeholder="Ingrese la Descripción de la Obra" oninput="capitalizarTextoarea('descri_obra')" cols="10" rows="10" style="max-height: 6rem;"></textarea>
                                </div>

                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Latitud de Proyecto</label>
                                    <input type="text" class="form-control" id="latitud" name="latitud" style="background: white;" value="" placeholder="Ingrese la Lalitud de proyecto" oninput="capitalizarInput('nombre_pro')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Longitud de Proyecto</label>
                                    <input type="text" class="form-control" id="longitud" name="longitud" style="background: white;" value="" placeholder="Ingrese la Longitud de proyecto" autocomplete="off" oninput="capitalizarInput('descripcion_pro')" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Dirección / Lugar</label>
                                    <textarea class="form-control" id="direccion" name="direccion" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ old('direccion') }}</textarea>
                                </div>

                                <div class="col-4">
                                    <div id="mapa" style="height: 350px; width:200%; display:block;"></div>
                                </div> 
                                
                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">
    
                                <div class="col-2">
                                    <label class="font-weight-bold text-dark">Impacto Ambiental</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="impacto_ambiental" id="impacto_ambiental" value="SI" onchange=")">
                                            <label class="form-check-label" for="impacto_ambiental">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="impacto_ambiental" id="impacto_ambiental" value="NO" onchange=")">
                                            <label class="form-check-label" for="impacto_ambiental">NO</label>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-2">
                                    <label class="font-weight-bold text-dark">Impacto Social</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="impacto_social" id="impacto_social" value="SI" onchange="">
                                            <label class="form-check-label" for="impacto_social">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="impacto_social" id="impacto_social" value="NO" onchange="">
                                            <label class="form-check-label" for="impacto_social">NO</label>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Fecha de Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo date('Y-m-d'); ?>">
                                </div>
    
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Duración Estimada</label>
                                    <input type="date" class="form-control" id="duracion_estimada" name="duracion_estimada" value="<?php echo date('Y-m-d'); ?>">
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

    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js')}}"></script>


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
    </script>

    {{-- * FUNCION PARA EL MAPA Y PARA CAPTURAR LOS DATOS DE LA LATITUD Y LONGITUD --}}

    <script>

        // Inicializa el mapa en el contenedor con ID "map"
        const map = L.map('mapa').setView([10.2825,-68.7222], 9.6); // Latitud y longitud iniciales de Yaracuy
      
        // Agrega el mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
      
        // Declara una variable para el marcador
        let marcador;
      
        // Agrega un marcador cuando se hace clic en el mapa
        map.on('click', (e) => {
          const latitud = e.latlng.lat;
          const longitud = e.latlng.lng;
      
          // Utiliza la API Nominatim para obtener la dirección
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitud}&lon=${longitud}&format=json&addressdetails=1&language=es`)
            .then(response => response.json())
            .then(data => {
                let estado = data.address.state;
                if (estado.includes('State')) {
                    estado = estado.replace(' State', '');
                } 
                 
              const direccion = data.address.road + ", " + data.address.postcode + ", " + data.address.county + ", " + estado + ", " + data.address.country;
      
              // Elimina cualquier marcador existente
              if (marcador) {
                map.removeLayer(marcador);
              }
      
              // Crea un marcador en la posición del clic
              marcador = L.marker([latitud, longitud], { title: direccion }).addTo(map);
      
              // Actualiza los campos de texto con las coordenadas y la dirección
              document.getElementById('latitud').value = latitud;
              document.getElementById('longitud').value = longitud;
              document.getElementById('direccion').value = direccion;
            });
        });
      
    </script>

    {{-- ! FUNCION PARA MOSTRAR ERRORES --}}

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Asignaciones',
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