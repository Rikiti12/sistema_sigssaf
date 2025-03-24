@extends('layouts.index')

<title>@yield('title') Registrar Persona</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Registrar Persona</h2>
                </div>

                <form method="post" action="{{ route('persona.store') }}" enctype="multipart/form-data" onsubmit="return Personas(this)">
                @csrf

                    <div class="card-body">

                        <div class="row">

                        <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Cedula </label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" style="background: white;" value="{{ old('cedula') }}" placeholder="Ingrese La Cedula" autocomplete="off" onkeypress="return solonum(event);">
                                </div>
        
                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" style="background: white;" value="{{ old('cedula') }}" placeholder="Ingrese la Cédula" autocomplete="off" onkeypress="return solonum(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"style="background: white;" value="{{ old('nombre') }}" placeholder="Ingrese el nombre" autocomplete="off" oninput="capitalizarInput('nombre')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" style="background: white;" value="{{ old('apellido') }}"  placeholder="Ingrese el apellido" autocomplete="off" oninput="capitalizarInput('apellido')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" style="background: white;" value="{{ old('fecha_nacimiento') }}" onchange="calcularEdad()">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Edad</label>
                                <input type="text" class="form-control" id="edad" name="edad" style="background: white;" value="{{ old('edad') }}" readonly>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Género</label>
                                <select class="form-select" id="genero" name="genero">
                                    <option value="">Seleccione el género</option>
                                    <option value="Masculino" {{ old('genero') === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('genero') === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="11" style="background: white;" value="{{ old('telefono') }}" placeholder="Ingrese el teléfono" autocomplete="off" onkeypress="return solonum(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" style="background: white;" value="{{ old('correo') }}" placeholder="Ingrese el correo" autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Dirección</label>
                                <textarea class="form-control" id="direccion" name="direccion" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ old('direccion') }}</textarea>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Discapacidad</label>
                                <select class="form-select" id="discapacidad" name="discapacidad">
                                    <option value="">Seleccione la discapacidad</option>
                                    <option value="NO" {{ old('discapacidad') === 'NO' ? 'selected' : '' }}>No</option>
                                    <option value="SI" {{ old('discapacidad') === 'SI' ? 'selected' : '' }}>Sí</option>
                                </select>
                            </div>

                            <div class="col-md-4" id="embarazada-container" style="display: none;">
                                <label class="font-weight-bold text-dark">Embarazada</label>
                                <select class="form-select" id="embarazada" name="embarazada">
                                    <option value="">Seleccione el embarazo</option>
                                    <option value="NO" {{ old('embarazada') === 'NO' ? 'selected' : '' }}>No</option>
                                    <option value="SI" {{ old('embarazada') === 'SI' ? 'selected' : '' }}>Sí</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Jefe de Familia</label>
                                <option value="">Seleccione el jefe familiar</option>
                                <select class="form-select" id="jefe_familia" name="jefe_familia">
                                    <option value="">Seleccione el jefe familiar</option>
                                    <option value="NO" {{ old('jefe_familia') === 'NO' ? 'selected' : '' }}>No</option>
                                    <option value="SI" {{ old('jefe_familia') === 'SI' ? 'selected' : '' }}>Sí</option>
                                </select>
                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('persona/') }}">
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

    {{--! ESTA FUNCION ES PARA CALCULAR LA EDAD DE LA PERSONA  --}}

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
                    title: 'Personas',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

    {{--? Este script es para mostrar/ocultar el campo "Embarazada" --}}
     
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     
    <script>
        $(document).ready(function () {
            $('#genero').change(function () {
                if ($(this).val() === 'Femenino') {
                    $('#embarazada-container').show();
                } else {
                    $('#embarazada-container').hide();
                }
            }).trigger('change'); // Ejecuta el cambio al cargar la página
        });
    </script>

@endsection