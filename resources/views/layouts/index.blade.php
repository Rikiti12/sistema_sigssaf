<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Inicio</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="icon" href="{{asset ('img/icon.png') }}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>:
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/kaiadmin.min.css')}}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="/home" class="logo">
              <img
                src="{{asset('img/LOGO6.png')}}"
                width="150px"
                height="80px"/>
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section" style="color: white;">Registros</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                  <i class="fas fa-layer-group"></i>
                  <p>Registros</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <li>
                        @can('ver-vocero')
                      <a class="sidebar-link"  href="{{ url('vocero')}}" aria-expanded="false">
                        <span class="sub-item">Voceros</span>
                      </a>
                      @endcan
                    </li>
                    <li>
                        @can('ver-comunidad') 
                      <a class="sidebar-link"  href="{{ url('comunidad')}}" aria-expanded="false">
                        <span class="sub-item">Comunidades</span>
                      </a>
                        @endcan
                    </li>
                    <li>
                      @can('ver-consejocomunal')
                      <a class="sidebar-link"  href="{{ url('consejo_comunal')}}" aria-expanded="false">
                        <span class="sub-item">Consejos Comunales</span>
                      </a>
                        @endcan
                    </li>
                    <li>
                      @can('ver-comuna') 
                      <a class="sidebar-link"  href="{{ url('comuna')}}" aria-expanded="false">
                        <span class="sub-item">Comunas</span>
                      </a>
                      @endcan
                    </li>
                    <li>
                      @can('ver-ayuda')
                      <a class="sidebar-link"  href="{{ url('ayuda')}}" aria-expanded="false">
                        <span class="sub-item">Ayudas Sociales</span>
                      </a>
                      @endcan
                    </li>
                    <li>
                      @can('ver-proyecto')
                      <a class="sidebar-link"  href="{{ url('proyecto')}}" aria-expanded="false">
                        <span class="sub-item">Proyectos</span>
                      </a>
                      @endcan
                    </li>
                    <li>
                       @can('ver-resposanble')
                      <a class="sidebar-link"  href="{{ url('resposanble')}}" aria-expanded="false">
                        <span class="sub-item">Responsable</span>
                      </a>
                       @endcan
                    </li> 
                    <!-- <li>
                      <a href="components/font-awesome-icons.html">
                        <span class="sub-item">Font Awesome Icons</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/simple-line-icons.html">
                        <span class="sub-item">Simple Line Icons</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/typography.html">
                        <span class="sub-item">Typography</span>
                      </a>
                    </li> -->
                  </ul>
                </div>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section" style="color: white;">Movimientos</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                  <i class="fas fa-th-list"></i>
                  <p>Movimientos</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                  <ul class="nav nav-collapse">
                    <li>
                      @can('ver-evaluacion')
                      <a class="sidebar-link"  href="{{ url('evaluacion')}}" aria-expanded="false">
                        <span class="sub-item">Evaluaciones</span>
                      </a>
                      @endcan
                    </li>
                  <li>
                    @can('ver-asignacion')
                      <a class="sidebar-link"  href="{{ url('asignacion') }}" aria-expanded="false">
                        <span class="sub-item">Planificaciones</span>
                      </a>
                      @endcan
                    </li>
                    {{-- <li>
                      @can('ver-planificacion')
                      <a class="sidebar-link"  href="{{ url('planificacion')}}" aria-expanded="false">
                        <span class="sub-item">Planificaciones</span>
                      </a>
                      @endcan
                    </li> --}}
                    <li>
                       @can('ver-seguimiento')
                      <a class="sidebar-link"  href="{{ url('seguimiento')}}" aria-expanded="false">
                        <span class="sub-item">Seguimiento</span>
                      </a>
                      @endcan
                    </li>
                    <li>
                       @can('ver-controlseguimiento')
                      <a class="sidebar-link"  href="{{ url('controlseguimiento')}}" aria-expanded="false">
                        <span class="sub-item">Control de Seguimiento</span>
                      </a>
                      @endcan
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section" style="color: white;">Estadísticas</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#charts">
                  <i class="far fa-chart-bar"></i>
                  <p>Estadística</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="charts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ url('estadistica')}}">
                        <span class="sub-item">Estadística</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ url('bitacora')}}">
                        <span class="sub-item">Bitacora</span>
                      </a>
                    </li> 
                  </ul>
                </div>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section" style="color: white;">Reportes</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas fa-pen-square"></i>
                  <p>Reporte</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="forms/forms.html">
                        <span class="sub-item">Reporte General</span>
                      </a>
                    </li>
                    <li>
                      <a href="forms/forms.html">
                        <span class="sub-item">Reporte Especifico</span>
                      </a>
                    </li>
                  </ul>
                  
                </div>
                
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
              <MARQUEE style="color: black;">BIENVENID@ {{ Auth::user()->name }} al Implementacion de Sistema de Informacion para la Gestion de Infogobierno en la
                Sala Situacional de la Alcaldia de San Felipe. (SIGISSAF) </MARQUEE>
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown"href="#"aria-expanded="false"><i class="fas fa-user fs-5"></i>
                    {{(auth()->user()->username)}}
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <!-- <div class="avatar-lg">
                            <img
                              src="assets/img/profile.jpg"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div> -->
                          <div class="u-text">
                            <h4>{{(auth()->user()->name)}}</h4>
                            <p class="text-muted">{{(auth()->user()->email)}}</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="message-body"></div>

                        <a class="d-flex align-items-center gap-2 dropdown-item" href="{{ route('Perfil')}}">
                          <i class="fas fa-table fs-5"></i>
                          <p class="mb-0 fs-6">Gestion de Perfil</p>
                        </a>

                        <a class="d-flex align-items-center gap-2 dropdown-item" href="{{ url('roles')}}">
                          <i class="fas fa-list fs-5"></i>
                          <p class="mb-0 fs-6">Roles</p>
                        </a>

                        <a class="d-flex align-items-center gap-2 dropdown-item" href="/usuarios">
                          <i class="fas fa-user fs-5"></i>
                          <p class="mb-0 fs-6">Usuario</p>
                        </a>

                        <a class="btn btn-outline-primary mx-3 mt-2 d-block" href="/logout">Cerrar Sension</a>

                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

     <!-- Funcion para cambiar los colores del sistema -->
      <div class="custom-template">
        <div class="title">Colores del Sistema</div>
        <div class="custom-content">
          <div class="switcher">
            <div class="switch-block">
              <h4>Logo Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="selected changeLogoHeaderColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Navbar Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="selected changeTopBarColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Sidebar</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="white"
                ></button>
                <button
                  type="button"
                  class="selected changeSideBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="dark2"
                ></button>
              </div>
            </div>
          </div>
        </div>

      <!-- Funcion para cambiar los colores del sistema -->
        {{-- <div class="custom-toggle">
          <i class="icon-settings"></i>
        </div> --}}

      </div>
      @yield('content')
      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/jsvectormap/world.js')}}"></script>

    <!-- Sweet Alert -->
    <!-- <script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script> -->
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{asset('assets/js/setting-demo.js')}}"></script>
  
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>

  @yield('datatable')

  @yield('sweetalert')


  </body>
</html>
