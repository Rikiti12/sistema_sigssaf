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
                                            
                                            
                                            {{-- <td>
                                                <div style="display: flex; justify-content: center;">   
                                                    @can('crear-asignacion') --}}
                                                            {{-- <a class="btn btn-success btn-sm aprobar-solicitud" style="margin: 0 3px;" title="Aprobar Solicitud" data-evaluacion-id='{{ $evaluacion->id }}'>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                                                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                                                </svg>
                                                            </a>                                            
                                                            
                                                            <meta name="csrf-token" content="{{ csrf_token() }}">

                                                            @if (!$evaluacion->yaAsignada)
                                                            <a class="btn btn-primary btn-sm" title="Asignar Proyecto" href="{{ route('asignacion.create', ['id' => $evaluacion->id]) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16" style="color: #ffff; cursor: pointer; position: center;">
                                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                                                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                                                </svg>
                                                            </a>

                                                        @endif --}}

                                                        <td>
                                                            <div style="display: flex; justify-content: center;">
                                                        
                                                                {{-- Botón Aprobar Solicitud --}}
                                                                @can('crear-asignacion') {{-- Asegúrate de que el permiso 'crear-asignacion' siga siendo relevante para aprobar --}}
                                                                    <a class="btn btn-success btn-sm aprobar-solicitud" style="margin: 0 3px;" title="Aprobar Solicitud" data-evaluacion-id='{{ $evaluacion->id }}'>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                                                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                                                        </svg>
                                                                    </a>
                                                                @endcan
                                                        
                                                                {{-- Botón para Registrar Planificación (anteriormente "Asignar Proyecto") --}}
                                                                {{-- Inicialmente oculto, el JS lo mostrará cuando la evaluación sea aprobada --}}
                                                                {{-- Quitamos el @if (!$evaluacion->yaAsignada) porque el JS lo controla --}}
                                                                @can('crear-asignacion') {{-- Mantén este can si aplica para la acción de planificar --}}
                                                                    <a class="btn btn-info btn-sm registrar-planificacion" style="margin: 0 3px; display: none;" title="Registrar Planificación" href="{{ route('asignacion.create', ['id' => $evaluacion->id]) }}" data-evaluacion-id='{{ $evaluacion->id }}'>
                                                                        {{-- Puedes cambiar el SVG si quieres un ícono más de "planificación" o "registro" --}}
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5"/>
                                                                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                                                            <path fill-rule="evenodd" d="M10 5.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H8a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5"/>
                                                                        </svg>
                                                                    </a>
                                                                @endcan
                                                        
                                                                {{-- Botón Editar Evaluación --}}
                                                                @can('editar-evaluacion')
                                                                    <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar la valuacion" href="{{ route('evaluacion.edit',$evaluacion->id) }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                                        </svg>
                                                                    </a>
                                                                @endcan
                                                        
                                                            </div>
                                                        </td>

                                                    {{-- @endcan --}}
                                                    
                                                    {{-- @can('editar-evaluacion')
                                                        <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar la valuacion" href="{{ route('evaluacion.edit',$evaluacion->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                            </svg>
                                                        </a>
                                                    @endcan --}}
                                                
                                                {{-- </div>
                                            </td> --}}
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

            {{-- ? FUNCION DE LOS BOTONES PARA APROBAR O PENDIENTE DE LA EVALUACION DEL PROYECTO --}}

            {{-- FUNCION DE LOS BOTONES PARA APROBAR O PENDIENTE DE LA EVALUACION DEL PROYECTO --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function ajustarBotones(estatus, evaluacionId) {
        const estatusActualTd = document.querySelector(`#estatus-${evaluacionId}`);
        // Asegúrate que el href del botón 'registrar-planificacion' contenga el evaluacionId
        const btnRegistrarPlanificacion = document.querySelector(`.registrar-planificacion[href*='${evaluacionId}']`);
        const btnAprobarSolicitud = document.querySelector(`.aprobar-solicitud[data-evaluacion-id='${evaluacionId}']`);

        if (estatusActualTd) {
            estatusActualTd.textContent = estatus;
        }

        if (btnRegistrarPlanificacion && btnAprobarSolicitud) {
            // *** CAMBIO CRUCIAL AQUÍ: Coincidir con "Aprobado" (masculino) ***
            if (estatus === "Aprobado") { // Si el estado es "Aprobado" (como en tu captura)
                btnRegistrarPlanificacion.style.display = "inline-block"; // Muestra el botón de Registro
                btnAprobarSolicitud.style.display = "none";             // Oculta el botón de Aprobar
            } else { // Si el estatus es "Pendiente" o cualquier otro valor
                btnRegistrarPlanificacion.style.display = "none";      // Oculta el botón de Registro
                btnAprobarSolicitud.style.display = "inline-block";    // Muestra el botón de Aprobar
            }
        } else {
            console.error('No se encontraron todos los botones necesarios para la evaluación ID:', evaluacionId);
            if (!btnRegistrarPlanificacion) console.error('Falta .registrar-planificacion para ID:', evaluacionId);
            if (!btnAprobarSolicitud) console.error('Falta .aprobar-solicitud para ID:', evaluacionId);
        }
    }

        // Función para actualizar el estatus en el servidor y ajustar los botones
        function actualizarEstatus(estatus, evaluacionId) {
            fetch(`/actualizar-estatus-evaluacion/${evaluacionId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ estado_evalu: estatus })
            })
            .then(response => {
                if (!response.ok) {
                    // Si la respuesta no es OK (ej. 404, 500), lanzamos un error
                    return response.json().then(err => { throw new Error(err.message || 'Error en la respuesta del servidor'); });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Muestra un mensaje de éxito con SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: `Evaluación ${estatus} correctamente.`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    ajustarBotones(estatus, evaluacionId); // Ajusta los botones en la interfaz de usuario
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: data.message || 'No se pudo actualizar el estatus.',
                    });
                    console.error('Error al actualizar el estatus:', data.message);
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: '¡Error de conexión!',
                    text: 'Hubo un problema al comunicarse con el servidor.',
                });
                console.error('Error en la solicitud Fetch:', error);
            });
        }

        // Añadir los escuchadores de eventos a cada botón de "Aprobar Solicitud"
        document.querySelectorAll(".aprobar-solicitud").forEach(btn => {
            btn.addEventListener("click", function (event) {
                event.preventDefault();
                const evaluacionId = this.getAttribute('data-evaluacion-id');
                // Confirmación con SweetAlert2 antes de aprobar
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Quieres aprobar esta solicitud?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, ¡aprobar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        actualizarEstatus("Aprobado", evaluacionId); // Llama a la función para actualizar el estatus a "Aprobado"
                    }
                });
            });
        });

    });
</script>

@endsection
