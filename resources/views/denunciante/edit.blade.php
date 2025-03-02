@extends('layouts.index')

<title>@yield('title') Registrar Denunciante</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
    
                    <h2 class="font-weight-bold text-dark">Registrar Denuncia</h2>
    
                    </div>

                    <form method="post" action="{{ url('/denunciante/'.$denunciante->id) }}" enctype="multipart/form-data" onsubmit="return Denunciante(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                            
                        <div class="card-body">
                            
                            <div class="row">
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Cédula</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" style="background: white;" value="{{ isset($denunciante->cedula)?$denunciante->cedula:'' }}" placeholder="Ingrese La Cédula" autocomplete="off" onkeypress="return solonum(event);">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="{{ isset($denunciante->nombre)?$denunciante->nombre:'' }}" placeholder="Ingrese El Nombre" oninput="capitalizarInput('nombre')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Apellido</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" style="background: white;" value="{{ isset($denunciante->apellido)?$denunciante->apellido:'' }}" placeholder="Ingrese El Apellido" autocomplete="off"  oninput="capitalizarInput('apellido')" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="8" style="background: white;" value="{{ isset($denunciante->telefono)?$denunciante->telefono:'' }}" placeholder="Ingrese El Telefono" autocomplete="off" onkeypress="return solonum(event);">
                                </div>
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Municipio Asignado</label>
                                    <select class="form-select" id="c_municipio" name="id_municipio">
                                        @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->id }}" @selected($denunciante->id_municipio == $municipio->id)>{{ $municipio->nom_municipio }}</option>
                                        @endforeach
                                    </select>                                   
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Dirección</label>
                                    <textarea class="form-control" id="direccion" name="direccion" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ $denunciante->direccion }}</textarea>                                   
                                </div>
                                
                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('denunciante/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
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
                    title: 'Denunciante',
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