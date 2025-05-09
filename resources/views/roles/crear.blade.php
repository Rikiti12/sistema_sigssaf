@extends('layouts.index')

<title>@yield('title') Registrar Roles</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Roles</h2>

                </div>
                
            <form method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data" onsubmit="return roles(this)">
                    @csrf
                        
                <div class="card-body">
                    <div class="row">
                            <div class="col-4">
                                <label class="font-weight-bold text-dark">Nombre del Rol</label>
                                <input type="text" class="form-control" id="name" name="name" style="background: white;"  value="" oninput="capitalizarInput('name')" onkeypress="return soloLetras(event);">
                            </div>
                        </div>
                    </div>           

                    <div class="card-body">
                        
                        <div class="row">

                            <div class="form-check">
                                <input type="checkbox" id="select-all-permissions" onclick="selectAll()" class="form-check-input">
                                <label class="form-check-label" for="select-all">Seleccionar todos los roles</label>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                            
                        <div class="row">

                            <div class="form-group d-flex flex-wrap">

                                <?php $counter = 0; ?>  @foreach($permission as $value)
                                    <?php $counter++; ?>  <div class="form-check col-md-3">  <label class="form-check-label">
                                        {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input')) }}
                                        {{ $value->name }}
                                    </label>
                                    </div>

                                    <?php if ($counter % 4 === 0) { ?>  <div class="w-100"></div>  <?php $counter = 0; ?>  <?php } ?>
                                @endforeach
                            </div>
                        </div>
                    </div>

                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="{{ url('roles/') }}"><span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Regresar</span></a>
                        </center>
                </form>
            </div>
        </div>    
    </div>

    <script>
            
        function selectAll() {
        var checkboxes = document.getElementsByTagName("input");
        for (var checkbox of checkboxes) {
            if (checkbox.type === "checkbox") {
                checkbox.checked = document.getElementById('select-all-permissions').checked;
            } 
        }
        }
        
    </script>

    {{-- ? FUNCIÓN PARA CONVERTIR UNA LETRA EN MAYÚSCULAS Y LOS DEMAS EN MINÚSCULAS --}}
    
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
        var errorMessage = @json($errors->first());
        Swal.fire({
                title: 'Roles',
                text: " Este Rol Ya Existe.",
                icon: 'warning',
                showconfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: '¡OK!',
                
                }).then((result) => {
            if (result.isConfirmed) {

                this.submit();
            }
            })
    </script>
@endif

@endsection
