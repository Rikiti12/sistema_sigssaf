@extends('layouts.index')

<title>@yield('title') Actualizar Cargo</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                        <h2 class="font-weight-bold text-dark">Actualizar Cargo</h2>

                    </div>

                    <form method="post" action="{{ url('/cargo/'.$cargo->id) }}" enctype="multipart/form-data" onsubmit="return Cargo(this)">
                        @csrf
                        {{ method_field('PATCH')}}

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Nombre del Cargo</label>
                                    <input type="text" class="form-control" id="nombre_cargo" name="nombre_cargo" style="background: white;" value="{{ $cargo->nombre_cargo }}" placeholder="Ingrese El Nombre del Cargo" oninput="capitalizarInput('nombre_cargo')" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
                        
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Categoria</label>
                                    <select class="form-select" id="categoria" name="categoria" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Comuna" {{ $cargo->categoria == 'Comuna' ? 'selected' : '' }}>Comuna</option>
                                        <option value="Consejo comunal" {{ $cargo->categoria == 'Consejo_Comunal' ? 'selected' : '' }}>Consejo Comunal</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <br><br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg">
                                <span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                            </button>
                            <a class="btn btn-info btn-lg" href="{{ url('cargo') }}">
                                <span class="icon text-white-50"><i class="fas fa-info-circle"></i></span>
                                <span class="text">Regresar</span>
                            </a>
                        </center>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@if ($errors->any())
    <script>
        var errors = @json($errors->all());
        errors.forEach(function(error) {
            Swal.fire({
                title: 'Cargo',
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