@extends('layouts.index')

<title>@yield('title') Actualizar Persona</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
          
                <h2 class="font-weight-bold text-dark">Actualizar Persona</h2>
          
            </div>

                <form method="post" action="{{ url('/persona/' .$persona->id) }}" enctype="multipart/form-data" onsubmit="return Persona(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                            
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" style="background: white;" value="{{ $persona->cedula }}" placeholder="Ingrese la cédula" autocomplete="off" onkeypress="return solonum(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="{{ $persona->nombre }}" placeholder="Ingrese el nombre" autocomplete="off" oninput="capitalizarInput('nombre')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" style="background: white;" value="{{ $persona->apellido }}" placeholder="Ingrese el apellido" autocomplete="off" oninput="capitalizarInput('apellido')" onkeypress="return soloLetras(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" style="background: white;" value="{{ $persona->fecha_nacimiento }}" onchange="calcularEdad()">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Edad</label>
                                <input type="text" class="form-control" id="edad" name="edad" style="background: white;" value="{{ $persona->edad }}" readonly>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Género</label>
                                <select class="form-select" id="genero" name="genero">
                                    <option value="">Seleccione el género</option>
                                    <option value="Masculino" {{ $persona->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ $persona->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="11" style="background: white;" value="{{ $persona->telefono }}" placeholder="Ingrese el teléfono" autocomplete="off" onkeypress="return solonum(event);">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" style="background: white;" value="{{ $persona->correo }}" placeholder="Ingrese el correo" autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Dirección</label>
                                <textarea class="form-control" id="direccion" name="direccion" cols="10" rows="10"style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ $persona->direccion }}</textarea>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Discapacidad</label>
                                <select class="form-select" id="discapacidad" name="discapacidad">
                                    <option value="">Seleccione la discapacidad</option>
                                    <option value="Si" {{ (old('discapacidad', $persona->discapacidad ?? '') === 'Si') ? 'selected' : '' }}>Si</option>
                                    <option value="No" {{ (old('discapacidad', $persona->discapacidad ?? '') === 'No') ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="col-md-4" id="embarazada-container" style="display: none;">
                                <label class="font-weight-bold text-dark">Embarazada</label>
                                <select class="form-select" id="embarazada" name="embarazada">
                                    <option value="">Seleccione el embarazo</option>
                                    <option value="Si" {{ (old('embarazada', $persona->embarazada ?? '') === 'Si') ? 'selected' : '' }}>Si</option>
                                    <option value="No" {{ (old('embarazada', $persona->embarazada ?? '') === 'No') ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="font-weight-bold text-dark">Jefe de Familia</label>
                                <select class="form-select" id="jefe_familia" name="jefe_familia">
                                    <option value="">Seleccione el jefe familiar</option>
                                    <option value="Si" {{ (old('jefe_familiar', $persona->jefe_familiar ?? '') === 'Si') ? 'selected' : '' }}>Si</option>
                                    <option value="No" {{ (old('jefe_familiar', $persona->jefe_familiar ?? '') === 'No') ? 'selected' : '' }}>No</option>
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

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }

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

@endsection