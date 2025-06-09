@extends('layouts.index')

<title>@yield('title') Actualizar Voceros</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Actualizar Vocero</h2>

          
                 </div>

                <form method="post" action="{{ url('/vocero/'.$vocero->id) }}" enctype="multipart/form-data" onsubmit="return Vocero(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                            
                    <div class="card-body">

                        <div class="row">

                           <div class="col-4">
                              <label  class="font-weight-bold text-dark">Cédula </label>
                              <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" style="background: white;" value="{{ $vocero->cedula }}" placeholder="Ingrese La cedula" autocomplete="off" onkeypress="return solonum(event);">
                           </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="{{ $vocero->nombre }}" placeholder="Ingrese el nombre" autocomplete="off" oninput="capitalizarInput('nombre')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" style="background: white;" value="{{ $vocero->apellido }}" placeholder="Ingrese el apellido" autocomplete="off" oninput="capitalizarInput('apellido')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" style="background: white;" value="{{ $vocero->fecha_nacimiento }}" onchange="calcularEdad()">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Edad</label>
                                <input type="text" class="form-control" id="edad" name="edad" style="background: white;" value="{{ $vocero->edad }}" readonly>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Género</label>
                                <select class="form-select" id="genero" name="genero">
                                    <option value="">Seleccione el género</option>
                                    <option value="Masculino" {{ $vocero->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ $vocero->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="11" style="background: white;" value="{{ $vocero->telefono }}" placeholder="Ingrese el teléfono" autocomplete="off" onkeypress="return solonum(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" style="background: white;" value="{{ $vocero->correo }}" placeholder="Ingrese el correo" autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Dirección</label>
                                <textarea class="form-control" id="direccion" name="direccion" cols="10" rows="10"style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ $vocero->direccion }}</textarea>
                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('vocero/') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
                        </center>

                    </div>
                </form>

            </div>
        </div>
    </div>

    {{--? ESTA FUNCION ES PARA CONVERTIR LA PRIMERA LETRA EN MASYUCUSLA Y LAS DEMAS EN MINICUSLA  --}}

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

    {{--! ESTA FUNCION ES PARA CALCULAR LA EDAD DE LA Vocero  --}}

    <script>

        function calcularEdad() {
            const fechaNacimiento = document.getElementById("fecha_nacimiento").value;
            const fechaNacimientoObj = new Date(fechaNacimiento);
            const hoy = new Date();
            let edad = hoy.getFullYear() - fechaNacimientoObj.getFullYear();
            const mes = hoy.getMonth() - fechaNacimientoObj.getMonth();

            if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimientoObj.getDate())) {
                edad--;
            }

            document.getElementById("edad").value = edad;
        }
    </script>

    {{--* ESTE SCRIPT ES PARA MOSTRAR LOS ERRORES DE VALIDACION  --}}

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Voceros',
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