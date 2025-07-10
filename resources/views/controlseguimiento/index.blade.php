@extends('layouts.index')

<title>@yield('title')Control De Seguimientos</title>

@section('css-datatable')
        <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                    <h2 class="font-weight-bold text-dark">Control De Seguimientos</h2>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th class="font-weight-bold text-dark">Fecha y Hora de Seguimiento</th>
                                <th class="font-weight-bold text-dark">Responsable del Seguimiento</th>
                                <th class="font-weight-bold text-dark">Detalles del Seguimiento</th>
                                <th class="font-weight-bold text-dark">Estado</th>
                                <th class="font-weight-bold text-dark">Gasto</th>
                                {{-- <th class="font-weight-bold text-dark">Estatus del Proyecto</th>
                                <th class="font-weight-bold text-dark">Estatus de Aprobacion</th> --}}
                                <th class="font-weight-bold text-dark"><center>Acciones</center></th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($seguimientos as $seguimiento)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ date('d/m/Y H:i', strtotime($seguimiento->fecha_hor)) }}</td>
                                        <td class="font-weight-bold text-dark">{{ $seguimiento->responsable_segui }}</td>
                                        <td class="font-weight-bold text-dark">{{ $seguimiento->detalle_segui }}</td>
                                        <td>
                                            <span class="badge badge-{{ 
                                                $seguimiento->estado_actual == 'Completado' ? 'success' : 
                                                ($seguimiento->estado_actual == 'Retrasado' ? 'danger' : 
                                                ($seguimiento->estado_actual == 'En riesgo' ? 'warning' : 'info'))
                                            }}">
                                                {{ $seguimiento->estado_actual }}
                                            </span>
                                        </td>
                                        
                                        <td class="font-weight-bold text-dark">{{ $seguimiento->gasto }}</td>
 
                                        {{-- <td class="font-weight-bold text-dark">{{ $seguimiento->estatus }}</td>
                                        <td class="font-weight-bold text-dark">{{ $seguimiento->estatus_res }}</td> --}}
                                        <td>
                                            {{-- <div style="display: flex; justify-content: center;">
                                                <a class="btn btn-success btn-sm aprobar-solicitud" style="margin: 0 3px;" title="Aprobar Solicitud" data-seguimiento-id='{{ $seguimiento->id }}'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                                    </svg>
                                                </a>
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <a class="btn btn-danger btn-sm negar-solicitud" style="margin: 0 1px;" title="Negar Solicitud" data-seguimiento-id='{{ $seguimiento->id }}'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                                        <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
                                                    </svg>
                                                </a> --}}

                                                @can('editar-seguimiento')
                                                    <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar el Seguimiento" href="{{ route('seguimiento.edit', $seguimiento->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                        </svg>
                                                    </a>
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
    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function (error) {
                Swal.fire({
                    title: 'Seguimiento',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif
{{-- 

    <script>
                        
            document.addEventListener("DOMContentLoaded", function () { // Espera a que el DOM esté completamente cargado
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtiene el token CSRF para las solicitudes

            // Función para ajustar el estatus y botones en la interfaz de usuario
            function ajustarBotones(estatus, seguimientoId) {
                const estatusActualTd = document.querySelector(`#estatus-${seguimientoId}`); // Selecciona el td correspondiente al estatus actual
                const btnRegistrarComprobante = document.querySelector(`.registrar-comprobante[href*='${seguimientoId}']`); // Selecciona el botón de "Registrar Comprobante"
                const btnAprobarSolicitud = document.querySelector(`.aprobar-solicitud[data-seguimiento-id='${seguimientoId}']`); // Selecciona el botón de "Aprobar Solicitud"
                const btnNegarSolicitud = document.querySelector(`.negar-solicitud[data-seguimiento-id='${seguimientoId}']`); // Selecciona el botón de "Negar Solicitud"

                // Verifica si los elementos existen antes de intentar acceder a sus propiedades
                if (estatusActualTd) {
                    estatusActualTd.textContent = estatus; // Actualiza el contenido del td con el estatus actual
                }

                if (btnRegistrarComprobante && btnAprobarSolicitud && btnNegarSolicitud) {
                    if (estatus === "Aprobado") { // Si el estatus es "Aprobado"
                        btnRegistrarComprobante.style.display = "inline-block"; // Muestra el botón de "Registrar Comprobante"
                        btnAprobarSolicitud.style.display = "none"; // Oculta el botón de "Aprobar Solicitud"
                        btnNegarSolicitud.style.display = "none"; // Oculta el botón de "Negar Solicitud"
                    } else if (estatus === "Negado") { // Si el estatus es "Negado"
                        btnRegistrarComprobante.style.display = "none"; // Oculta el botón de "Registrar Comprobante"
                        btnAprobarSolicitud.style.display = "none"; // Oculta el botón de "Aprobar Solicitud"
                        btnNegarSolicitud.style.display = "none"; // Oculta el botón de "Negar Solicitud"
                    } else { // Si el estatus es "Pendiente" o cualquier otro valor inicial
                        btnRegistrarComprobante.style.display = "none"; // Oculta el botón de "Registrar Comprobante"
                        btnAprobarSolicitud.style.display = "inline-block"; // Muestra el botón de "Aprobar Solicitud"
                        btnNegarSolicitud.style.display = "inline-block"; // Muestra el botón de "Negar Solicitud"
                    }
                } else {
                    console.error('No se encontraron los botones para la inspección ID:', seguimientoId);
                }
            }

            // Función para actualizar el estatus en el servidor y ajustar los botones
            function actualizarEstatus(estatus, seguimientoId) {
                fetch(`/actualizar-estatus-seguimiento/${seguimientoId}`, { // Hace una solicitud fetch a la URL para actualizar el estatus
                    method: 'POST', // Método HTTP POST
                    headers: {
                        'Content-Type': 'application/json', // Tipo de contenido JSON
                        'X-CSRF-TOKEN': csrfToken // Añade el token CSRF a la cabecera
                    },
                    body: JSON.stringify({ estatus_res: estatus }) // Convierte el estatus a una cadena JSON y la envía en el cuerpo de la solicitud
                })
                .then(response => response.json()) // Convierte la respuesta a JSON
                .then(data => { // Maneja la respuesta del servidor
                    if (data.success) { // Si la actualización fue exitosa
                        ajustarBotones(estatus, seguimientoId); // Ajusta los botones en la interfaz de usuario
                    } else {
                        console.error('Error al actualizar el estatus:', data.message); // Muestra un error en la consola si la actualización falla
                    }
                })
                .catch(error => console.error('Error:', error)); // Muestra un error en la consola si la solicitud falla
            }

            // Añadir los escuchadores de eventos a cada botón de "Aprobar Solicitud"
            document.querySelectorAll(".aprobar-solicitud").forEach(btn => {
                btn.addEventListener("click", function (event) {
                    event.preventDefault(); // Previene la acción por defecto del clic
                    const seguimientoId = this.getAttribute('data-seguimiento-id'); // Obtiene el ID de la inspección del atributo data-seguimiento-id
                    actualizarEstatus("Aprobado", seguimientoId); // Llama a la función para actualizar el estatus a "Aprobado"
                });
            });

            // Añadir los escuchadores de eventos a cada botón de "Negar Solicitud"
            document.querySelectorAll(".negar-solicitud").forEach(btn => {
                btn.addEventListener("click", function (event) {
                    event.preventDefault(); // Previene la acción por defecto del clic
                    const seguimientoId = this.getAttribute('data-seguimiento-id'); // Obtiene el ID de la inspección del atributo data-seguimiento-id
                    actualizarEstatus("Negado", seguimientoId); // Llama a la función para actualizar el estatus a "Negado"
                });
            });

            // Ajustar los botones según el estatus actual cuando la página se carga
            document.querySelectorAll("tr[data-seguimiento-id]").forEach(row => {
                const seguimientoId = row.getAttribute('data-seguimiento-id'); // Obtiene el ID de la inspección de la fila
                const estatus = document.querySelector(`#estatus-${seguimientoId}`).textContent.trim(); // Obtiene el estatus actual del td correspondiente
                ajustarBotones(estatus, seguimientoId); // Llama a la función para ajustar los botones según el estatus actual
            });
        });
        
    </script> --}}

    {{-- <script>
document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Función para mostrar confirmación con SweetAlert
    function confirmarAccion(accion, seguimientoId) {
        Swal.fire({
            title: `¿${accion} seguimiento?`,
            text: `Estás por ${accion.toLowerCase()} este seguimiento`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Sí, ${accion}`,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const estatus = accion === 'Aprobar' ? 'Aprobado' : 'Negado';
                actualizarEstatus(seguimientoId, estatus);
            }
        });
    }

    // Función para actualizar el estado via AJAX
    function actualizarEstatus(seguimientoId, estatus) {
        fetch(`/seguimientos/${seguimientoId}/actualizar-estatus`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ estatus_res: estatus })
        })
        
        .then(data => {
            if (data.success) {
                // Actualizar la interfaz
                const celdaEstatus = document.querySelector(`#estatus-aprobacion-${seguimientoId}`);
                if (celdaEstatus) {
                    celdaEstatus.textContent = estatus;
                }
                
                // Mostrar notificación de éxito
                Swal.fire(
                    '¡Éxito!',
                    `El seguimiento ha sido ${estatus.toLowerCase()}.`,
                    'success'
                );
                
            }   
           
        })
        
    }

    // Event listeners para los botones
    document.querySelectorAll('.aprobar-solicitud').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const seguimientoId = this.getAttribute('data-seguimiento-id');
            confirmarAccion('Aprobar', seguimientoId);
        });
    });

    document.querySelectorAll('.negar-solicitud').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const seguimientoId = this.getAttribute('data-seguimiento-id');
            confirmarAccion('Negar', seguimientoId);
        });
    });
});
</script> --}}