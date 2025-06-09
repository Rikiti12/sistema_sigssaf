@extends('layouts.index')

<title>@yield('title') Actualizar Comunidad</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                        <h2 class="font-weight-bold text-dark">Actualizar Comunidad</h2>

                        </div>

                        <form method="post" action="{{ url('/comunidad/'.$comunidad->id) }}" enctype="multipart/form-data" onsubmit="return Comunidad(this)">
                            @csrf
                            {{ method_field('PATCH')}}

                            <div class="card-body">

                                <center>
                                    <h5 class="font-weight-bold text-dark">Datos de la Comunidad</h5>
                                </center>

                                <br>

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Nombre de la Comunidad</label>
                                        <input type="text" class="form-control" id="comunidad" name="nom_comuni" style="background: white;" value="{{ $comunidad->nom_comuni ?? '' }}" placeholder="Ingrese El nombre comunidad" autocomplete="off" oninput="capitalizarInput('nombre comuna')">
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Dirección</label>
                                        <textarea class="form-control" id="direccion" name="dire_comuni" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ $comunidad->dire_comuni ?? '' }}</textarea>
                                    </div>

                                </div>

                                <br><br>

                                <center>
                                    <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                    <span class="text">Guardar</span>
                                    </button>
                                    <a  class="btn btn-info btn-lg" href="{{ url('comunidad/') }}"><span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Regresar</span></a>
                                </center>

                            </div>

                        </form>

                    </div>
                </div>
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


@endsection