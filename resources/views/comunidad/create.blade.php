@extends('layouts.index')

<title>@yield('title') Registrar Comunidad</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
    
                    <h2 class="font-weight-bold text-dark">Registrar comunidad</h2>
    
                    </div>

                    <form method="post" action="{{ route('comunidad.store') }}" enctype="multipart/form-data" onsubmit="return Victima(this)">
                        @csrf
                            
                        <div class="card-body">

                            <center>
                                <h5 class="font-weight-bold text-dark">Datos del Jefe de la Comunidad</h5>
                            </center>

                            <br>
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Cedula Jefe</label>
                                    <input type="text" class="form-control" id="cedula_jefe" name="cedula_jefe" maxlength="8" style="background: white;" value="" placeholder="Ingrese La Cedula" autocomplete="off" onkeypress="return solonum(event);">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre Jefe</label>
                                    <input type="text" class="form-control" id="nom_jefe" name="nom_jefe" style="background: white;" value="" placeholder="Ingrese El Nombre" oninput="capitalizarInput('nombre')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Apellido Jefe</label>
                                    <input type="text" class="form-control" id="ape_jefe" name="ape_jefe" style="background: white;" value="" placeholder="Ingrese El Apellido" autocomplete="off"  oninput="capitalizarInput('apellido')" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="8" style="background: white;" value="" placeholder="Ingrese El Telefono" autocomplete="off" onkeypress="return solonum(event);">
                                </div>

                            </div>
                        
                        </div>

                        <div class="card-body">

                            <center>
                                <h5 class="font-weight-bold text-dark">Datos de la Comunidad</h5>
                            </center>

                            <br>

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre de la Comunidad</label>
                                    <input type="text" class="form-control" id="comunidad" name="nom_comuni" style="background: white;" value="" placeholder="Ingrese El nombre comunidad" autocomplete="off" oninput="capitalizarInput('nombre comuna')" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Dirección de la Comunidad</label>
                                    <textarea class="form-control" id="direccion" name="dire_comuni" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ old('direccion') }}</textarea>                                   
                                </div> 
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Comuna Asignado</label>
                                    <select class="form-select" id="c_comuna" name="id_comuna">
                                        <option value="">Seleccione una comuna </option>
                                        @foreach($comunas as $comuna)
                                            <option value="{{ $comuna->id }}">{{ $comuna->nom_comunas }}</option>
                                        @endforeach
                                    </select>                                   
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
                    title: 'Comunidades',
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