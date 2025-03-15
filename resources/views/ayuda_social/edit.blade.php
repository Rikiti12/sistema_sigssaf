@extends('layouts.index')

@section('title', 'Actualizar Ayuda Social')
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Actualizar Ayuda Social</h2>
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

                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Persona Asignada</label>
                                <select class="form-select" id="persona_id" name="persona_id">
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->id }}"
                                            {{ $ayuda_social->id_persona == $persona->id ? 'selected' : '' }}>
                                            {{ $persona->nombre }} {{ $persona->apellido }} - {{ $persona->cedula }}
                                        </option>
                                    @endforeach
                                    </select>                                   
                                </div>

                            </div>

                            <br><br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('ayuda_social/') }}"><span class="icon text-white-50">
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