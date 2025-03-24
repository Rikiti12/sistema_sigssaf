<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="{{ asset ('img/icon.png') }}" rel="icon">

  <title>Inicio</title>
  {{-- <link  href="../asset/images/logos/favicon.png" rel="shortcut icon" type="image/png" /> --}}
  <link href="{{asset('assets/css/styles.min.css')}}" rel="stylesheet"  />
  <link href= "{{asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Inicio</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./home" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Registros</span>
            </li>
            <li class="sidebar-item">
              @can('ver-comuna')
                <a class="sidebar-link" href="{{ url('comuna') }}" aria-expanded="false">
                  <span>
                    {{-- <i class="ti ti-user-plus"></i> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-add" viewBox="0 0 16 16">
                      <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h4a.5.5 0 1 0 0-1h-4a.5.5 0 0 1-.5-.5V7.207l5-5 6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                      <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 1 0 1 0v-1h1a.5.5 0 1 0 0-1h-1v-1a.5.5 0 0 0-.5-.5"/>
                    </svg>
                  </span>
                  <span class="hide-menu">Comunas</span>
                </a>
              @endcan
            </li>
            <li class="sidebar-item">
              @can('ver-comunidad')
                <a class="sidebar-link" href="{{ url('comunidad') }}" aria-expanded="false">
                  <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-houses" viewBox="0 0 16 16">
                    <path d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207z"/>
                  </svg>
                  </span>
                  <span class="hide-menu">Comunidades</span>
                </a>
              @endcan
            </li>
             <li class="sidebar-item">
             @can('ver-persona')
                <a class="sidebar-link" href="{{ url('persona') }}" aria-expanded="false">
                  <span>
                    {{-- <i class="ti ti-alert-circle"></i> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                      <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                  </span>
                  <span class="hide-menu">Personas</span>
                </a>
                @endcan
            </li>
            <li class="sidebar-item">
            @can('ver-ayuda_sociales')
              <a class="sidebar-link" href="{{ url('ayuda_social') }}" aria-expanded="false">
             <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                    <path d="M8.864 1.667c-.344-.165-.856-.165-1.2 0L.532 5.166V6.5h3.976c.218 0 .41.107.5.5V8c0 .27.096.517.261.667a.772.772 0 0 0 .089.146c.082.076.188.13.304.134h3.978c.31 0 .588-.155.776-.39l3.5-3.5a.5.5 0 0 0-.708-.708L8.864 1.667zM6.96 9.03a1.5 1.5 0 0 1-.413.247l-.073.048c-.358.238-.83.219-1.154-.04zm3.45 1.447c.251.094.543.12.839.055l.659-.163c.244-.06.527-.24.71-.48L12 10a.5.5 0 0 1 .618-.176l.614.307c.272.136.563.32.87.518l.24-.16a1.5 1.5 0 0 1 1.056-1.685L13.433 8.3c.155-.15.248-.365.248-.598v-.128c0-.233-.093-.448-.248-.598l-.84-.84c-.317-.317-.72-.48-.994-.48l-6.14 3.07c-.272.136-.563.32-.87.518l-.24.16a1.5 1.5 0 0 1-1.056 1.685L6.567 10.7c-.155.15-.248.365-.248.598v.128c0 .233.093.448.248.598l.84.84c.317.317.72.48.994.48l6.14-3.07c.272-.136.563-.32.87-.518l.24.16a1.5 1.5 0 0 1 1.056 1.685z"/>
                </svg>
            </span>
            <span class="hide-menu">Ayuda Sociales</span>
            </a>
            @endcan
           </li>
           <li class="sidebar-item">
              @can('ver-vivienda')
                <a class="sidebar-link" href="{{ url('vivienda') }}" aria-expanded="false">
                  <span>
                    {{-- <i class="ti ti-user-plus"></i> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-add" viewBox="0 0 16 16">
                      <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h4a.5.5 0 1 0 0-1h-4a.5.5 0 0 1-.5-.5V7.207l5-5 6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                      <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 1 0 1 0v-1h1a.5.5 0 1 0 0-1h-1v-1a.5.5 0 0 0-.5-.5"/>
                    </svg>
                  </span>
                  <span class="hide-menu">Viviendas</span>
                </a>
              @endcan
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Procesos</span>
            </li>
            <li class="sidebar-item">
             @can('ver-proyecto') 
              <a class="sidebar-link" href="{{ route('proyecto.create') }}" aria-expanded="false">
                  <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                          <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                      </svg>
                  </span>
                  <span class="hide-menu"> Asignar Proyectos</span>
              </a>
              @endcan
            </li>
            <li class="sidebar-item">
             @can('ver-planificacion') 
              <a class="sidebar-link" href="{{ url('planificacion') }}" aria-expanded="false">
                  <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                          <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                      </svg>
                  </span>
                  <span class="hide-menu"> Planificaciones</span>
              </a>
              @endcan
            </li>
            <!--<li class="sidebar-item">
              <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Card</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Forms</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">Typography</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Estadisticas</span>
            </li>-->
            
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Estadisticas</span>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Icons</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Sample Page</span>
              </a>
            </li> --}}
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Reportes</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('bitacora') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Bitacora</span>
              </a>
            </li> 
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <MARQUEE style="color: rgb(0, 0, 0);"> BIENVENID@ {{ Auth::user()->name }} al Implementación de Sistema de Información para la Gestión de Infogobierno en la Sala Situacional de la Alcaldía de San Felipe.
              (SIGISSAF) </MARQUEE>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              {{-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> --}}
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  {{-- <i class="ti ti-user fs-7"></i> --}}
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                  </svg>
                  {{-- <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle"> --}}
                  {{auth()->user()->username }}</a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">

                    <a href="{{ route('Perfil') }}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mood-happy fs-6"></i>
                      <p class="mb-0 fs-3">Gestion de Perfil</p>
                    </a>

                    @can('ver-rol')
                      <a href="{{ url('roles') }}" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-list-check fs-6"></i>
                        <p class="mb-0 fs-3">Roles</p>
                      </a>
                    @endcan

                    @can('ver-usuario')
                      <a href="/usuarios" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-user fs-6"></i>
                        <p class="mb-0 fs-3">Usuario</p>
                      </a>
                    @endcan

                    <a href="/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Cerrar Sensión</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->

      @yield('content')

      
    </div>
  </div>
  <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('assets/js/app.min.js')}}"></script>
  <script src="{{asset('assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('assets/js/dashboard.js')}}"></script>

  @yield('datatable')

  @yield('sweetalert')

</body>

</html>