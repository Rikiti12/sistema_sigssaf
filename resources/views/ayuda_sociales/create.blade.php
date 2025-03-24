@extends('layouts.index')

@section('title', 'Registrar Ayuda Social')
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Registrar Ayuda Social</h2>
                </div>

                <form method="post" action="{{ route('ayuda_social.store') }}" enctype="multipart/form-data" onsubmit="return AyudaSociales (this)">
                        @csrf

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Nombre De La Ayuda</label>
                                <input type="text" class="form-control" id="nombre_ayu" name="nombre_ayu"style="background: white;" value="" placeholder="Ingrese la ayuda" autocomplete="off" oninput="capitalizarInput('nombre_ayu')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" style="background: white;" value="" placeholder="Ingrese la descripcion de la ayuda" autocomplete="off"  oninput="capitalizarInput('descripcion')" onkeypress="return soloLetras(event);">
                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i
                                        class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('ayuda_sociales/') }}"><span class="icon text-white-50">
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
                    title: 'Ayuda Sociales',
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