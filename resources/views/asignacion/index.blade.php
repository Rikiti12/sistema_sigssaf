@extends('layouts.index')

<title>@yield('title') Evaluación de Proyectos</title>

@section('css-datatable')
    <link href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                            <h2 class="font-weight-bold text-dark">Asignación de Proyectos</h2>
                        </div>

                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="dataTable">
                                <thead class="thead-light">
                                    <tr> 
                                        <th class="font-weight-bold text-dark">Proyecto</th>
                                        <th class="font-weight-bold text-dark">Responsable</th>
                                        <th class="font-weight-bold text-dark">Viabilidad</th>
                                        <th class="font-weight-bold text-dark">Estado de Proyecto</th>
                                        <th class="font-weight-bold text-dark"><center>Acciones</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evaluaciones as $evaluacion)
                                        <tr>
                                            <td class="font-weight-bold text-dark">{{ $evaluacion->proyectos->nombre_pro }} {{ $evaluacion->proyectos->descripcion_pro }}</td>
                                            <td class="font-weight-bold text-dark">{{ $evaluacion->respon_evalu }}</td>
                                            <td class="font-weight-bold text-dark">
                                                <span class="badge 
                                                    @if($evaluacion->viabilidad == 'Alta') bg-danger
                                                    @elseif($evaluacion->viabilidad == 'Media') bg-warning
                                                    @else bg-primary
                                                    @endif">
                                                    {{ $evaluacion->viabilidad }}
                                                </span>
                                            </td>
                                            <td class="font-weight-bold text-dark">{{ $evaluacion->estado_evalu }}</td>


                                             <td>
                                        <div style="display: flex; justify-content: center;">

                                            @can('crear-asignacion')
                                                <a class="btn btn-primary btn-sm" title="Asignar Proyecto" href="{{ route('asignacion.create', ['id' => $evaluacion->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                                    </svg>
                                                </a>
                                            @endcan
                                            
                                            @can('editar-evaluacion')
                                                <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar la valuacion" href="{{ route('evaluacion.edit',$evaluacion->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                    </svg>
                                                </a>
                                            @endcan

                                            {{-- <a class="btn btn-info btn-sm" style="margin: 0 1px;" title="Ver Detalles" data-evaluacion-id='{{ $evaluacion->id }}' class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16"  style="color: #ffff; cursor: pointer;">
                                                <path d="M13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                                                <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM2 1a1 1 0 0 0-1 1v1h14V2a1 1 0 0 0-1-1zM1 4v10a1 1 0 0 0 1 1h2V4zm4 0v11h9a1 1 0 0 0 1-1V4z"/>
                                             </svg></a> --}}

                                        
                                                    
                                                    @can('ver-detalles-evaluacion')
                                                        <a class="btn btn-info btn-sm mx-2" title="Ver Detalles" 
                                                           data-evaluacion-id="{{ $evaluacion->id }}" 
                                                           data-toggle="modal" 
                                                           data-target="#evaluacionModal">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endcan

                                                    {{-- @can('generar-informe-evaluacion')
                                                        <a class="btn btn-danger btn-sm" title="Generar PDF" 
                                                           href="{{ route('evaluacion.pdf', $evaluacion->id) }}" 
                                                           target="_blank">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </a>
                                                    @endcan --}}
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

    <!-- Modal para Detalles de Evaluación -->
    <div class="modal fade" id="evaluacionModal" tabindex="-1" role="dialog" aria-labelledby="evaluacionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="evaluacionModalLabel">Detalles de Evaluación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalEvaluacionContent">
                    <!-- Contenido cargado por AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                language: {
                    lengthMenu: "Mostrar " + `
                        <select class='form-select'>
                            <option value='5'>5</option>
                            <option value='10'>10</option>
                            <option value='15'>15</option>
                            <option value='25'>25</option>
                            <option value='50'>50</option>
                            <option value='100'>100</option>
                            <option value='-1'>Todos</option>
                        </select>` + " registros por página",
                    infoEmpty: 'No hay registros disponibles',
                    zeroRecords: 'No se encontraron registros',
                    info: 'Mostrando página _PAGE_ de _PAGES_',
                    infoFiltered: '(filtrado de _MAX_ registros totales)',
                    search: "Buscar:",
                    paginate: {
                        next: 'Siguiente',
                        previous: 'Anterior'
                    }
                }
            });
        });
    </script>
@endsection

@section('scripts')
    {{-- <script>
        $(document).ready(function() {
            // Cargar detalles de evaluación via AJAX
            $('#dataTable').on('click', '[data-evaluacion-id]', function() {
                var evaluacionId = $(this).data('evaluacion-id');
                
                $.ajax({
                    url: '/evaluacion/detalles/' + evaluacionId,
                    type: 'GET',
                    success: function(data) {
                        var html = `
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">Información del Proyecto</h6>
                                    <p><b>Nombre:</b> ${data.proyecto.nombre_proyecto || 'N/A'}</p>
                                    <p><b>Descripción:</b> ${data.proyecto.descripcion || 'N/A'}</p>
                                    <p><b>Fecha Inicio:</b> ${data.proyecto.fecha_inicio || 'N/A'}</p>
                                    <p><b>Fecha Fin:</b> ${data.proyecto.fecha_fin || 'N/A'}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold">Detalles de Evaluación</h6>
                                    <p><b>Avance:</b> ${data.avance}%</p>
                                    <p><b>Estado:</b> <span class="badge badge-${data.estado == 'Aprobado' ? 'success' : data.estado == 'Rechazado' ? 'danger' : 'info'}">${data.estado}</span></p>
                                    <p><b>Evaluador:</b> ${data.evaluador.nombre || 'N/A'} ${data.evaluador.apellido || ''}</p>
                                    <p><b>Fecha Evaluación:</b> ${data.fecha_evaluacion || 'N/A'}</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold">Observaciones</h6>
                                    <p>${data.observaciones || 'No hay observaciones registradas'}</p>
                                </div>
                            </div>
                        `;
                        
                        $('#modalEvaluacionContent').html(html);
                    },
                    error: function(xhr) {
                        $('#modalEvaluacionContent').html(`
                            <div class="alert alert-danger">
                                Error al cargar los detalles de la evaluación. Por favor intente nuevamente.
                            </div>
                        `);
                    }
                });
            });
        });
    </script> --}}
@endsection