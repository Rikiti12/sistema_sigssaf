@extends('layouts.index')

<title>@yield('title') Registrar Vivienda</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Vivienda</h2>

                </div>

                <form method="post" action="{{ route('vivienda.store') }}" enctype="multipart/form-data" onsubmit="return Vivienda(this)">
                    @csrf

                    <div class="card-body">

                        <div class="row">

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Tipo de Vivienda</label>
                                <input type="text" class="form-control" id="tipo_vivie" name="tipo_vivie" style="background: white;" value="" placeholder="Ingrese El Tipo" autocomplete="off" oninput="capitalizarInput('tipo_vivie')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-4">
                                <label  class="font-weight-bold text-dark">Dirección</label>
                                <textarea class="form-control" id="direccion" name="dire_vivie" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ old('direccion') }}</textarea>                                   
                            </div>
                             
                        </div>

                    </div>

                    <div class="card-body">

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('vivienda/') }}"><span class="icon text-white-50">
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
                    title: 'Viviendas',
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