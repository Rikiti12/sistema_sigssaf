@extends('layouts.index')

<title>@yield('title')Inicio</title>
@section('css-datatable')
        <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
@endsection

@section('content')
<div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center"></div>

        <div class="row">

              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card h-100 rotate hover-rotate" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; border-radius: 10px;">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-uppercase mb-1">Comunas</div>
                          <div class="h5 mb-0 font-weight-bold text-uppercase-800">{{ $count_comuna }}</div>
                        </div>
                        <div class="col-auto">
                          <img src="{{ asset('img/comuna.png') }}" width="50" height="50" class="mb-3"></img>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 rotate hover-rotate" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; border-radius: 10px;">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Comunidades</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_comunidad }}</div>
                      </div>
                      <div class="col-auto">
                        <img src="{{ asset('img/comunidad.png') }}" width="50" height="50" class="mb-3"></img>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 rotate hover-rotate" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; border-radius: 10px;">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Consejo Comunal</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_consejo }}</div>
                      </div>
                      <div class="col-auto">
                        <img src="{{ asset('img/conejo comunl.png') }}" width="50" height="50" class="mb-3"></img>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 rotate hover-rotate" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; border-radius: 10px;">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Personas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_persona }}</div>
                      </div>
                      <div class="col-auto">
                        <img src="{{ asset('img/persona.png') }}" width="50" height="50" class="mb-3"></img>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 rotate hover-rotate" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; border-radius: 10px;">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Ayuda sociales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_ayuda }}</div>
                      </div>
                      <div class="col-auto">
                        <img src="{{ asset('img/ayuda.png') }}" width="50" height="50" class="mb-3"></img>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 rotate hover-rotate" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; border-radius: 10px;">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Viviendas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_vivienda }}</div>
                      </div>
                      <div class="col-auto">
                        <img src="{{ asset('img/vivienda.png') }}" width="50" height="50" class="mb-3"></img>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 rotate hover-rotate" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; border-radius: 10px;">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Asignación de Proyectos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_proyecto }}</div>
                      </div>
                      <div class="col-auto">
                        <img src="{{ asset('img/ayuda.png') }}" width="50" height="50" class="mb-3"></img>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 rotate hover-rotate" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; border-radius: 10px;">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Planificaciones</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_planificacion }}</div>
                      </div>
                      <div class="col-auto">
                        <img src="{{ asset('img/ayuda.png') }}" width="50" height="50" class="mb-3"></img>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        
        
        </div>

</div>



@endsection




