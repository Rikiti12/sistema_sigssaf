@extends('layouts.index')

<title>@yield('title') Registrar Comuna</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Comuna</h2>

                </div>

                    <form method="post" action="{{ route('comuna.store') }}" enctype="multipart/form-data" onsubmit="return Comuna(this)">
                        @csrf

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Vocero Asignado</label>
                                    <select class="form-select" id="id_vocero" name="id_vocero">
                                        <option value="">Seleccione un vocero</option>
                                        @foreach($voceros as $vocero)
                                            @if($vocero->tipo_vocero === 'comuna')
                                                <option value="{{ $vocero->id }}"> {{ $vocero->cedula }} {{ $vocero->nombre }} {{ $vocero->apellido }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre de la Comuna</label>
                                    <input type="text" class="form-control" id="nom_comunas" name="nom_comunas" style="background: white;" value="" placeholder="Ingrese El nombre comunidad" autocomplete="off" oninput="capitalizarInput('nombre comuna')">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Parroquia Asignado</label>
                                    <select class="form-select" id="id_parroquia" name="id_parroquia">
                                        <option value="">Seleccione una comuna </option>
                                        @foreach($parroquias as $parroquia)
                                            <option value="{{ $parroquia->id }}">{{ $parroquia->nom_parroquia }}</option>
                                        @endforeach
                                    </select>
                                </div>  

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Consejo comunal Asignado</label>
                                    <select class="form-select" id="id_consejo" name="id_consejo">
                                        <option value="">Seleccione una consejo comunal </option>
                                        @foreach($consejo_comunals as $consejo_comunal)
                                            <option value="{{ $consejo_comunal->id }}">Nombre: {{ $consejo_comunal->nom_consej }}  Codigo: {{ $consejo_comunal->situr }}  Rif: {{ $consejo_comunal->rif }}  </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Dirección de la Comuna</label>
                                    <textarea class="form-control" id="dire_comunas" name="dire_comunas" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('direccion')">{{ old('direccion') }}</textarea>
                                </div>

                            </div>

                            <br><br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('comuna/') }}"><span class="icon text-white-50">
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

    <script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                    Swal.fire({
                        title: 'Comuna',
                        text: error,
                        icon: 'warning',
                        showConfimButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                    });
                });
        </script>
    @endif

@endsection


