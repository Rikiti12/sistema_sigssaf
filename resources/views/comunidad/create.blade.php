@extends('layouts.index')

<title>@yield('title') Registrar Comunidad</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                            <h2 class="font-weight-bold text-dark">Registrar Comunidad</h2>

                        </div>

                        <form method="post" action="{{ route('comunidad.store') }}" enctype="multipart/form-data" onsubmit="return Comunidad(this)">
                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Nombre de la Comunidad</label>
                                        <input type="text" class="form-control" id="nom_comuni" name="nom_comuni" style="background: white;" value="" placeholder="Ingrese El nombre comunidad" autocomplete="off" oninput="capitalizarInput('nombre comuna')" onkeypress="return soloLetrasNumero(event);">
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-dark">Dirección de la Comunidad</label>
                                        <textarea class="form-control" id="direccion" name="dire_comuni" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ old('direccion') }}</textarea>
                                    </div>
                                    
                                    <div class="col-4">
                                    <label class="font-weight-bold text-dark">Tipo de Comunidad</label>
                                    <select class="form-select" id="tipo_comunidad" name="tipo_comunidad" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Rural">Rural</option>
                                        <option value="Urbana">Urbana</option>
                                        <option value="Residencial">Residencial</option>
                                        <option value="Indigena">Indigena</option>
                                        <option value="Empresarial">Empresarial</option>
                                    </select>
                                    </div>

                                    <div class="col-4">
                                    <label class="font-weight-bold text-dark">Tipo de vivienda</label>
                                    <select class="form-select" id="tipo_vivienda" name="tipo_vivienda" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Anexo">Anexo</option>
                                        <option value="Apartamento">Apartamento</option>
                                        <option value="Casa">Casa</option>
                                        <option value="Rancho">Rancho</option>
                                        <option value="Casa indigena">Casa indigena</option>
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
        </div>
    </div>

@endsection

