@extends('layouts.index')

<title>@yield('title')  Registrar Visitas</title>
<script src="{{asset ('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark"> Registrar Visitas</h2>
                </div>

                <form method="post" action="{{ route('visita.store') }}" enctype="multipart/form-data" onsubmit="return Visitas(this)">
                    @csrf

                    <div class="card-body">
                    
                        <div class="row">

                             <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Parroquia Asignado</label>
                                    <select class="form-select" id="id_parroquia" name="id_parroquia">
                                        <option value="">Seleccione una comuna </option>
                                        @foreach($parroquias as $parroquia)
                                            <option value="{{ $parroquia->id }}">{{ $parroquia->nom_parroquia }}</option>
                                        @endforeach
                                    </select>
                                </div>  

                             <div class="col-4">
                                        <label class="font-weight-bold text-dark">Comunidad Asignada</label>
                                        <select class="form-select" id="id_comunidad" name="id_comunidad">
                                            <option value="">Seleccione una comunidad </option>
                                            @foreach($comunidades as $comunidad)
                                                <option value="{{ $comunidad->id }}">{{ $comunidad->nom_comuni }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Visita</label>
                                <input type="text" class="form-control" id="visita" name="visita" style="background: white;" value="" placeholder="Ingrese la visita" oninput="capitalizarInput('visita')" autocomplete="off" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Descripción</label>
                                <textarea class="form-control" id="descripcion_vis" name="descripcion_vis" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('descripcion_vis')">{{ old('descripcion_pro') }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <img id="miniaturas">
                            </div>
    
                           {{--  <div class="col-4">
                                <label  class="font-weight-bold text-dark">foto de la visita</label>
                                <input type="file" class="form-control" id="foto_visita" name="foto_visita[]" multiple>
                                    <div id="foto_container"></div>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Fecha de la visita</label>
                                <input type="text" class="form-control" id="fecha_visita" name="fecha_visita" value="<?php echo date('d/m/Y'); ?>" placeholder="DD/MM/YYYY">
                            </div> --}}
                            
                            
                            
                        </div>

                    </div>

                    <br><br>

                    <center>
                        <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                        </button>
                        <a class="btn btn-info btn-lg" href="{{ route('visita.index') }}"><span class="icon text-white-50">
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


    <script>
        $(document).ready(function() {
            // Asumiendo que usas jQuery UI Datepicker o similar
            // Si no lo tienes, deberás incluir la librería (ej. desde un CDN o npm)
            $("#fecha_visita").datepicker({
                dateFormat: "dd/mm/yy", // Esto asegura que el valor del input sea DD/MM/YYYY
                onSelect: function(selectedDate) {
                    // Opcional: Asegurarse que fecha_final no sea anterior a fecha_visita
                    $("#fecha_final").datepicker("option", "minDate", selectedDate);
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
            $('#foto_visita').change(function () {
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