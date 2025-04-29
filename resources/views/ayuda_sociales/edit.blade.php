@extends('layouts.index')

<title>@yield('title') Actualizar Ayuda Sociales</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Actualizar Ayuda Sociales</h2>

                </div>    

                    <form method="post" action="{{ url('/ayuda_social/'.$ayuda_social->id) }}" enctype="multipart/form-data" onsubmit="return AyudaSociales(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                            
                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre De La Ayuda</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre_ayu" style="background: white;" value="{{ isset($ayuda_social->nombre_ayu)?$ayuda_social->nombre_ayu:'' }}" placeholder="Ingrese El Nombre" oninput="capitalizarInput('nombre')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Descripcion</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" style="background: white;" value="{{ isset($ayuda_social->descripcion)?$ayuda_social->descripcion:'' }}" placeholder="Ingrese El descripcion" autocomplete="off"  oninput="capitalizarInput('descripcion')" onkeypress="return soloLetras(event);">
                                </div>

                            </div>

                            <br><br><br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('ayuda_sociales/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>

                        </div>

                    </form>

               

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