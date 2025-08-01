@extends('layouts.index')

<title>@yield('title') Proyectos</title>

@section('css-datatable')
        <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                            <a href="{{ url('proyecto/pdf') }}" class="btn btn-sm btn-danger" target="_blank" id="pdfButton">
                                {{ ('PDF') }}
                            </a>

                            <h2 class="font-weight-bold text-dark">Gestión de Proyecto</h2>

                            @can('crear-comuna')
                                <form action="{{ route('proyecto.create') }}" method="get" style="display:inline;">
                                    <button type="submit" class="btn btn-primary btn-mb"> <span class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                    </span>
                                    <span class="text">Crear</span></button>
                                </form>
                            @endcan 

                        </div>
                        
                        <div class="card-body">
                        <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                                    <tr>
                                        <th class="font-weight-bold text-dark">Nombre del Proyecto</th>
                                        <th class="font-weight-bold text-dark">Descripcion</th>
                                        <th class="font-weight-bold text-dark">Tipo de proyecto</th>
                                        <th class="font-weight-bold text-dark">Prioridad</th>
                                        <th class="font-weight-bold text-dark">Fecha Inicio</th>
                                        <th class="font-weight-bold text-dark">Fecha Final</th>
                                        <th class="font-weight-bold text-dark"><center>Acciones</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyectos as $proyecto)
                                        <tr>
                                            <td class="font-weight-bold text-dark">{{ $proyecto->nombre_pro }}</td>
                                            <td class="font-weight-bold text-dark">{{ $proyecto->descripcion_pro }}</td>
                                            <td class="font-weight-bold text-dark">{{ $proyecto->tipo_pro }}</td>
                                            <td class="font-weight-bold text-dark">
                                                <span class="badge 
                                                    @if($proyecto->prioridad == 'Alta') bg-danger
                                                    @elseif($proyecto->prioridad == 'Media') bg-warning
                                                    @else bg-primary
                                                    @endif">
                                                    {{ $proyecto->prioridad }}
                                                </span>
                                            </td>
                                            <td class="font-weight-bold text-dark">{{ date('d/m/Y', strtotime( $proyecto->fecha_inicial)) }}</td>
                                            <td class="font-weight-bold text-dark">{{ date('d/m/Y', strtotime($proyecto->fecha_final)) }}</td>
                                            
                                            <td>
                                                <div style="display: flex; justify-content: center;">
                                                    @can('editar-proyecto')
                                                        <a class="btn btn-warning btn-sm" href="{{ route('proyecto.edit', $proyecto->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                            </svg>
                                                        </a>
                                                    @endcan

                                                    @can('borrar-proyecto')
                                                        <form action="{{ route('proyecto.destroy', $proyecto->id) }}" method="POST" class="sweetalert" style="margin: 0 3px;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" type="submit" value="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                                </svg>
                                                            </button>
                                                        </form> 
                                                    @endcan
                                                    
                                                    <a class="btn btn-info btn-sm" style="margin: 0 1px;" title="Ver Detalles" data-proyecto-id='{{ $proyecto->id }}' class="btn btn-primary" data-toggle="modal" data-target="#proyectoModal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16" style="color: #ffff; cursor: pointer;">
                                                            <path d="M13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                                                            <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM2 1a1 1 0 0 0-1 1v1h14V2a1 1 0 0 0-1-1zM1 4v10a1 1 0 0 0 1 1h2V4zm4 0v11h9a1 1 0 0 0 1-1V4z"/>
                                                        </svg>
                                                    </a>
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
        </div>
    </div>

    <!-- MODAL PARA VER DETALLES -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>

                <div class="modal-body" id="modal-body-content">

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
            var table = $('#dataTable').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {       
                    "lengthMenu": "Mostrar " + 
                                    `<select class='form-select'>
                                        <option value='5'>5</option>
                                        <option value='10'>10</option>
                                        <option value='15'>15</option>
                                        <option value='25'>25</option>
                                        <option value='50'>50</option>
                                        <option value='100'>100</option>
                                        <option value='-1'>Todos</option>
                                    </select>` +
                                    " Registros Por Página",
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

            

           function updatePdfLink() {
                var searchTerm = table.search();
                var pdfUrl = `{{ url('proyecto/pdf') }}?search=${encodeURIComponent(searchTerm)}`;
                $('#pdfButton').attr('href', pdfUrl);
            }

            table.on('search.dt', function () {
                var searchTerm = table.search();
                $.ajax({
                    url: "{{ url('proyecto/pdf') }}",
                    method: 'GET',
                    data: { search: searchTerm },
                    success: function(response) {
                        // Aquí puedes manejar la respuesta, si necesitas hacer algo con ella
                        console.log('PDF generado con éxito');
                    },
                    error: function(xhr) {
                        console.error('Error al generar el PDF:', xhr);
                    }
                });
                updatePdfLink();
            });
            updatePdfLink(); 
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
        $('.sweetalert').submit(function(e){
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
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Proyecto',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

    {{-- FUNCIÓN DEL MODAL PARA VER DETALLES DEL PROYECTO --}}
    
    <script>
        $(document).ready(function() {
            $('#dataTable').on('click', '.btn-info', function(event) {
                event.preventDefault();
                var proyectoId = $(this).data('proyecto-id');
    
                $.ajax({
                    url: '/proyecto/detalles/' + proyectoId,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
    
                        let proyectosHtml = `
                            <h5 class="font-weight-bold text-primary" style="text-align: center">Detalles del Proyecto</h5>

                            <p><b>Actividades del Proyecto</b>: ${data.actividades}</p>
                            <p><b>Nombre de la Ayuda Social</b>: ${data.nombre_ayuda}</p>
                            <p><b>Tipo de Ayuda Social</b>: ${data.tipo_ayuda}</p>
                
                        `;

                        // Verifica si existen imágenes y agrégalas
                        if (data.acta_conformidad && data.acta_conformidad.length > 0) {
                            proyectosHtml += `<p><b>Fotos:</b></p><div style="display: flex; flex-wrap: wrap; gap: 10px;">`;
                            let acta_conformidad = JSON.parse(data.acta_conformidad);
                            acta_conformidad.forEach(function(acta) {
                                proyectosHtml += `<img src="/acta_conformidad/proyectos/${acta}" width="60%" style="width: calc(50% - 10px); margin-bottom: 10px;">`;
                            });
                            proyectosHtml += '</div>';
                        }

                        $('#exampleModalScrollable .modal-body').html(proyectosHtml);
    
                        if (!$('#exampleModalScrollable').is(':visible')) {
                            $('#exampleModalScrollable').modal('show');
                        }
                    },
                    error: function(error) {
                        console.error("Error al obtener los datos:", error);
                        alert("Error al cargar la vocero. Por favor, inténtalo de nuevo.");
                    }
                });
            });
        });
    </script>

@endsection