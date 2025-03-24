@extends('layouts.index')

<title>@yield('title') Planificación</title>

@section('css-datatable')
    <link href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-center mb-4"></div>
            <div class="col-12 w-100">
                <div class="card mb-4 w-100">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                    <a href="{{ route('planificacion/pdf') }}" class="btn btn-sm btn-danger" target="_blank" id="pdfButton">
                        {{ ('PDF') }}
                        </a>

                <h2 class="font-weight-bold text-dark" style="margin-left: 6%;">Gestión de Planificacion</h2>
                        {{-- @can('crear-comisionado') --}}
                            <form action="{{ route('planificacion.create') }}" method="get" style="display:inline;">
                                <button type="submit" class="btn btn-primary btn-mb"> <span class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                </span>
                                <span class="text">Crear</span></button>
                            </form>
                        {{-- @endcan --}}
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th class="font-weight-bold text-dark">Nombre Del Proyecto</th>
                                <th class="font-weight-bold text-dark">Descripcion</th>
                                <th class="font-weight-bold text-dark">Persona Asignada</th>
                                <th class="font-weight-bold text-dark">Comunidad Asignado</th>
                                <th class="font-weight-bold text-dark">Fecha Inicial</th>
                                <th class="font-weight-bold text-dark">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (proyectos as $proyecto)
                                <tr>
                                    <td class="font-weight-bold text-dark">{{ $proyecto->nombre_pro }}</td> 
                                    <td class="font-weight-bold text-dark">{{ $proyecto->descrpcion }}</td>
                                    <td class="font-weight-bold text-dark">{{ $proyecto->persona->cedula}} {{ $proyecto->persona->nombre}} {{ $proyecto->persona->apellido}}</td>
                                    <td class="font-weight-bold text-dark">{{ $proyecto->comunidad->nom_comuni }}</td>
                                   <td class="font-weight-bold text-dark">{{ $proyecto->fecha_inicial }}</td>
                                    <td>
                                        <div style="display: flex; justify-content: center;">
                                            @can('editar-planificacion')
                                                <a class="btn btn-warning btn-sm" href="{{ route('planificacion.edit', $planificacion->id_planificacion) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('borrar-planificacion')
                                                <form action="{{ route('planificacion.destroy', $planificacion->id_planificacion) }}" method="POST" class="sweetalert" style="margin: 0 3px;">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm" type="submit" value="">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('datatable')
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar " + `<select class = 'form-select'>
                                    <option value = '5'>5</option>
                                    <option value = '10'>10</option>
                                    <option value = '15'>15</option>
                                    <option value = '25'>25</option>
                                    <option value = '50'>50</option>
                                    <option value = '100'>100</option>
                                    <option value = '-1'>Todos</option>
                                </select>` + " Registros Por Página",
                    "infoEmpty": 'No Hay Registros Disponibles.',
                    "zeroRecords": 'Nada Encontrado Disculpa.',
                    "info": 'Mostrando La Página _PAGE_ de _PAGES_',
                    "infoFiltered": '(Filtrado de _MAX_ Registros Totales)',
                    "search": "Buscar: ",
                    "paginate": {
                        'next': 'Siguiente',
                        'previous': 'Anterior',
                    },
                    decimal: ',',
                    thousands: '.',
                },
            });
        });
    </script>
@endsection

@section('sweetalert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'Se Eliminó Con Éxito.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.sweetalert').submit(function (e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás Seguro?',
                text: "Al Hacer Estó Se Eliminará Definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function (error) {
                Swal.fire({
                    title: 'Planificación',
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