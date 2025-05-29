@extends('layouts.index')

<title>@yield('title') Registrar Consejo Comunal</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                            <h2 class="font-weight-bold text-dark">Registrar Consejo Comunal</h2>

                        </div>

                        <form method="post" action="{{ route('consejo_comunal.store') }}" enctype="multipart/form-data" onsubmit="return ConsejoComunal(this)">
                            @csrf

                            <div class="card-body">

                                <center>
                                    <h5 class="font-weight-bold text-dark">Datos de Vocero del consejo comunal</h5>
                                </center>

                                <br>

                                <div class="row">

                                    <div class="col-4">
                                        <label class="font-weight-bold text-dark">Cédula del Vocero</label>
                                        <input type="text" class="form-control" id="cedula_voce" name="cedula_voce" maxlength="8" style="background: white;" value="" placeholder="Ingrese la cédula" autocomplete="off" onkeypress="return solonum(event);">
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-dark">Nombre del Vocero</label>
                                        <input type="text" class="form-control" id="nom_voce" name="nom_voce" style="background: white;" value="" placeholder="Ingrese el nombre" oninput="capitalizarInput('nom_voce')" autocomplete="off" onkeypress="return soloLetras(event);">
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-dark">Apellido del Vocero</label>
                                        <input type="text" class="form-control" id="ape_voce" name="ape_voce" style="background: white;" value="" placeholder="Ingrese el apellido" autocomplete="off" oninput="capitalizarInput('ape_voce')" onkeypress="return soloLetras(event);">
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-dark">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" maxlength="11" style="background: white;" value="" placeholder="Ingrese el teléfono" autocomplete="off" onkeypress="return solonum(event);">
                                    </div>

                                </div>

                            </div>

                            <div class="card-body">

                                <center>
                                    <h5 class="font-weight-bold text-dark">Datos del Consejo Comunal</h5>
                                </center>

                                <br>

                                <div class="row">

                                   <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Nombre del Consejo Comunal</label>
                                        <input type="text" class="form-control" id="nom_consej" name="nom_consej" style="background: white;" value="" placeholder="Ingrese El nombre del consejo comunal" autocomplete="off" oninput="capitalizarInput('nombre consejo comunal')" onkeypress="return soloLetrasNumero(event);">
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-dark">Código SITUR</label>
                                        <input type="text" class="form-control" id="codigo_situr" name="codigo_situr" style="background: white;" value="" placeholder="Ingrese el código SITUR" autocomplete="off">
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-dark">RIF</label>
                                        <input type="text" class="form-control" id="rif" name="rif" style="background: white;" value="" placeholder="Ingrese el RIF" autocomplete="off">
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-dark">Acta</label>
                                        <input type="text" class="form-control" id="acta" name="acta" style="background: white;" value="" placeholder="Ingrese el acta" autocomplete="off">
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-dark">Dirección del Consejo</label>
                                        <textarea class="form-control" id="dire_consejo" name="dire_consejo" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('dire_consejo')">{{ old('dire_consejo') }}</textarea>
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-dark">Comunidad Asignada</label>
                                        <select class="form-select" id="id_comunidad" name="id_comunidad">
                                            <option value="">Seleccione una comunidad </option>
                                            @foreach($comunidades as $comunidad)
                                                <option value="{{ $comunidad->id }}">{{ $comunidad->nom_comuni }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <br><br>

                                <center>
                                    <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                        <span class="text">Guardar</span>
                                    </button>
                                    <a class="btn btn-info btn-lg" href="{{ route('consejo_comunal.index') }}"><span class="icon text-white-50">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   
@endsection

