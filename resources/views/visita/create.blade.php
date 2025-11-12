@extends('layouts.index')

<title>@yield('title') Registrar Visitas</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Visitas</h2>


                </div>

                <form method="post" action="{{ route('visita.store') }}" enctype="multipart/form-data" onsubmit="return Visita(this)">
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
                                    <label  class="font-weight-bold text-dark">Comunidad Asignado</label>
                                    <select class="form-select" id="id_comunidad" name="id_comunidad">
                                        <option value="">Seleccione una comunidad </option>
                                        @foreach($comunidades as $comunidad)
                                            <option value="{{ $comunidad->id }}">{{ $comunidad->nom_comuni }}</option>
                                        @endforeach
                                    </select>                                   
                             </div>

                             <div class="col-4">
                                <label  class="font-weight-bold text-dark">Visitas</label>
                                <input type="text" class="form-control" id="visita" name="visita" style="background: white;" value="" placeholder="Ingrese la visita" oninput="capitalizarInput('visita')" autocomplete="off" onkeypress="return soloLetras(event);">
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Descripción</label>
                                <textarea class="form-control" id="descripcion_vis" name="descripcion_vis" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('descripcion_vis')">{{ old('descripcion_vis') }}</textarea>
                            </div>
                             
                        </div>

                    </div>

                    <div class="card-body">

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('visita/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                        </center>

                    </div>

                </form>

            </div>

        </div>

    </div>

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
                    title: 'Visitas',
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