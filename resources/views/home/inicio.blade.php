@extends('layouts.index')

<title>@yield('title')Inicio</title>
@section('css-datatable')
        <!-- <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script> -->
@endsection
<link  href="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css')}}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="{{ asset('https://unpkg.com/leaflet/dist/leaflet.css') }}" />
<link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css') }}">
<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
  @keyframes rotateAnimation {
    0% {
      transform: rotateY(0deg);
    }
    25% {
      transform: rotateY(360deg);
    }
    100% {
      transform: rotateY(360deg);
    }
  }

  @keyframes hoverRotateAnimation {
    from {
      transform: rotateY(0deg);
    }
    to {
      transform: rotateY(360deg);
    }
  }

  .rotate {
    animation: rotateAnimation 5s linear 1;
  }

</style>

@section('content')


<div class="container">

    <div class="page-inner">
      <div class="row">
         <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('cargo.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center" style="background-color: rgb(250, 127, 56)"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" style="color:white;" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/>
                </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Cargos</p>
                    <h4 class="card-title">{{ $count_cargo }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-3">
             <a href="{{ route('vocero.index') }}" class="card-link"></a>
             <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('vocero.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-info bubble-shadow-small"
                  >
                    <i class="fas fa-user-check"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Voceros</p>
                    <h4 class="card-title">{{ $count_vocero }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
             <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('comunidad.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                   class="icon-big text-center" style="background-color: rgb(212, 168, 248)"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" style="color:white;" fill="currentColor" class="bi bi-houses" viewBox="0 0 16 16">
                    <path d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207z"/>
                  </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Comunidades</p>
                    <h4 class="card-title">{{ $count_comunidad }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('consejo_comunal.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-success bubble-shadow-small"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" style="color:white;" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                      <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                      <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z"/>
                    </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Comunales</p>
                    <h4 class="card-title">{{ $count_consejo }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('comuna.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center icon-primary bubble-shadow-small"
                  >
                    <i class="fas fa-users"></i>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Comunas</p>
                    <h4 class="card-title">{{ $count_comuna }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

          <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('ayuda.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center" style="background-color: rgb(134, 207, 16)"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" style="color:white;" fill="currentColor" class="bi bi-box2-heart" viewBox="0 0 16 16">
                  <path d="M8 7.982C9.664 6.309 13.825 9.236 8 13 2.175 9.236 6.336 6.31 8 7.982"/>
                  <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zm0 1H7.5v3h-6zM8.5 4V1h3.75l2.25 3zM15 5v10H1V5z"/>
                </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Ayudas</p>
                    <h4 class="card-title">{{ $count_ayuda }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('proyecto.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center" style="background-color: rgb(250, 66, 66)"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"  style="color:white;" fill="currentColor" class="bi bi-clipboard-check-fill" viewBox="0 0 16 16">
                  <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                  <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm6.854 7.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                   </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Proyectos</p>
                    <h4 class="card-title">{{ $count_proyecto }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('resposanble.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center" style="background-color: rgb(250, 66, 210)"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"  style="color:white;"  fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Responsables</p>
                    <h4 class="card-title">{{ $count_resposanble }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-3">
          <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('visita.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                    class="icon-big text-center" style="background-color: rgb(250, 66, 210)"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" style="color:white;"  fill="currentColor" class="bi bi-building-check" viewBox="0 0 16 16">
                  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514"/>
                  <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1z"/>
                  <path d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Visitas</p>
                    <h4 class="card-title">{{ $count_visita }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
          <div class="col-sm-6 col-md-3">
           <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('evaluacion.create') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                  class="icon-big text-center" style="background-color: rgb(233, 138, 209)"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"  style="color:white;" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                   <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                  <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                   </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category"> Evaluaciones</p>
                    <h4 class="card-title">{{ $count_evaluacion }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
           <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('asignacion.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                  class="icon-big text-center" style="background-color: rgb(116, 38, 241)"
                  >
                 <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"  style="color:white;" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                 <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8z"/>
                  </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category"> Planificaciones</p>
                    <h4 class="card-title">{{ $count_asignacion }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
           <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('seguimiento.index') }}'" style="cursor: pointer;">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-icon">
                  <div
                     class="icon-big text-center" style="background-color: rgb(221, 157, 38)"
                     >
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" style="color:rgb(255, 255, 255);" fill="currentColor" class="bi bi-file-check-fill" viewBox="0 0 16 16">
                  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2m-1.146 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                  </svg>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                  <div class="numbers">
                    <p class="card-category">Seguimientos</p>
                    <h4 class="card-title">{{ $count_seguimiento }}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center"></div>

          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card mb-4">
                <div class="card card-stats card-round rotate" onclick="window.location.href='{{ route('asignacion.index') }}'" style="cursor: pointer;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                  <h6 class="m-0 font-weight-bold text-primary">Mapa de los Proyectos</h6>
                  <div class="dropdown no-arrow">
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <div id="mapa" style="height: 310px; width:100%; display:block;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pie Chart -->
          <div style="width:32.5%; display:block;">
            <div class="card mb-4 rotate" onclick="window.location.href='{{ route('proyecto.index') }}'" style="padding-top: 89.5px; padding-bottom: 89.5px;">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                  <h6 class="m-0 font-weight-bold text-primary">Proyecto por Parroquias</h6>
                  <div class="h5 mb-0 font-weight-bol d text-gray-800"></div> 
              </div>
              <div class="card-body">

                @php
                    // Establece la meta fija para que la barra llegue al 100%
                    $metaMaxima = 100;
                    
                    // Colores base para las barras
                    $colores = ['bg-warning', 'bg-info', 'bg-success'];
                    $i = 0;
                @endphp

                @foreach ($proyectosPorParroquia as $item)
                    @php
                        $conteo = $item['total'];
                        
                        // 1. Calcula el porcentaje: 
                        //    Si el conteo es 100 o más, el porcentaje es 100%.
                        //    De lo contrario, usa el porcentaje normal.
                        $porcentaje = min(round(($conteo / $metaMaxima) * 100), 100);
                        
                        // Asigna un color de la lista
                        $color = $colores[$i % count($colores)];
                        $i++;
                    @endphp

                    <div class="mb-3">
                        <div class="small text-gray-700">
                            <span class="font-weight-bold">{{ $item['parroquia'] }}</span>
                            
                            <div class="small float-right">
                                <b>{{ $conteo }}</b>
                            </div>
                        </div>
                        
                        <div class="progress" style="height: 12px;">
                            <div 
                                class="progress-bar {{ $color }}" 
                                role="progressbar" 
                                style="width: {{ $porcentaje }}%;" 
                                aria-valuenow="{{ $conteo }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ $metaMaxima }}" 
                                data-value="{{ $conteo }}"
                                title="{{ $porcentaje }}% ({{ $conteo }} proyectos)">
                            </div>
                        </div>
                    </div>
                @endforeach
              </div>
          </div>
        </div>

    </div>

</div>

<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js') }}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="{{ asset('https://unpkg.com/leaflet/dist/leaflet.js') }}"></script>

{{-- ! FUNCION PARA EL MAPA Y PARA CAPTURAR LOS DATOS DE LA LATITUD Y LONGITUD --}}

<script>
    const map = L.map('mapa').setView([10.2825, -68.7222], 9.6); // Latitud y longitud iniciales de Yaracuy

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var asignaciones = @json($mapa_asignaciones);

    // Definir iconos personalizados
    var asignacionIcon = L.icon({
        iconUrl: '/img/asignacion.png', // Ruta al icono de recepcion
        iconSize: [35, 41], // Tamaño del icono
        iconAnchor: [35, 41], // Punto del icono que se corresponde con la posición del marcador
        popupAnchor: [1, -34] // Punto desde el cual se abrirá el popup relativo al icono
    });

    asignaciones.forEach(function(asignacion) {
        if (asignacion.latitud && asignacion.longitud) {
            L.marker([asignacion.latitud, asignacion.longitud], { icon: asignacionIcon }).addTo(map)
                .bindPopup('Asignacion');
        }
    });

</script>

@endsection


