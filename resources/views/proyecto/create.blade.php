@extends('layouts.index')

<title>@yield('title')  Registrar Proyectos</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
<link  href="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css')}}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark"> Registrar Proyectos</h2>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('proyecto.store') }}" enctype="multipart/form-data" onsubmit="return Proyectos(this)">
                    @csrf
                   <div class="row">
                       <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre Del Proyecto</label>
                                    <input type="text" class="form-control" id="nombre_pro" name="nombre_pro" style="background: white;" value="" placeholder="Ingrese El Nombre Del Proyecto" oninput="capitalizarInput('nombre_pro')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Descripción</label>
                                    <input type="text" class="form-control" id="descripcion_pro" name="descripcion_pro" style="background: white;" value="" placeholder="Ingrese La Descripcion" autocomplete="off" oninput="capitalizarInput('descripcion_pro')" onkeypress="return soloLetras(event);">
                                </div>

                            <div class="col-4">
                                <label for="tipo_proyecto" class="form-label">Tipo de Proyecto *</label>
                                <select class="form-select" id="tipo_pro" name="tipo_pro" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Infraestructura">Infraestructura</option>
                                    <option value="Social">Social</option>
                                    <option value="Educativo">Educativo</option>
                                    <option value="Salud">Salud</option>
                                    <option value="Ambiental">Ambiental</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        

                         <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold text-dark">Fecha Inicial</label>
                                    <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="<?php echo date('d/m/Y'); ?>">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold text-dark">Fecha Final</label>
                                    <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="<?php echo date('d/m/Y'); ?>">
                                </div>

                            <div class="col-4">
                                <label for="prioridad" class="form-label">Prioridad *</label>
                                <select class="form-select" id="prioridad" name="prioridad" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                            </div>
                         </div>
                    </div>  

                        <div class="card-body">

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                           <a class="btn btn-info btn-lg" href="{{ route('proyecto.index') }}"><span class="icon text-white-50">
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
     @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Proyectos',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   
@endsection