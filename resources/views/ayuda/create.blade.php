@extends('layouts.index')

<title>@yield('title') Registrar Ayudas</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                    <h2 class="font-weight-bold text-dark">Registrar Ayuda</h2>

                </div>

                    <form method="post" action="{{ route('ayuda.store') }}" enctype="multipart/form-data" onsubmit="return Ayuda(this)">
                        @csrf

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Nombre de la Ayuda</label>
                                    <input type="text" class="form-control" id="nombre_ayuda" name="nombre_ayuda" style="background: white;" value="" placeholder="Ingrese El nombre de la ayuda" autocomplete="off" oninput="capitalizarInput('nombre ayuda')">
                                </div>  
                                
                                <div class="col-4">
                                    <label class="font-weight-bold text-dark">Tipo de Ayda</label>
                                    <select class="form-select" id="tipo_ayuda" name="tipo_ayuda" >
                                        <option value="">Seleccione...</option>
                                        <option value="Infraestructura">Infraestructura</option>
                                        <option value="Social">Social</option>
                                        <option value="Educativo">Educativo</option>
                                        <option value="Salud">Salud</option>
                                        <option value="Ambiental">Ambiental</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Descripción de la Ayuda</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('descripcion')">{{ old('descripcion') }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 mt-5 mx-7">
                                    <img id="miniaturas">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-dark">Comprobante de la Ayuda</label>
                                    <input type="file" class="form-control" id="foto_ayuda" name="foto_ayuda[]" multiple>
                                        <div id="foto_container"></div>
                                </div>

                            </div>

                            <br><br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('ayuda/') }}"><span class="icon text-white-50">
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

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#foto_ayuda').change(function () {
                const fotoContainer = document.getElementById('foto_container');
    
                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '40%';
                        img.style.maxHeight = '40%';
                        fotoContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

@endsection


