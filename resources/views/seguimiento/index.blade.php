@extends('layouts.index')

<title>@yield('title') Seguimiento</title>

@section('css-datatable')
        <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                             <a href="{{ url('seguimiento/pdf') }}" class="btn btn-sm btn-danger" target="_blank" id="pdfButton">
                                {{ ('ACTA') }}
                            </a>

                         <h2 class="font-weight-bold text-dark" style="margin-right: 43%;">Seguimiento</h2>     
                       </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th class="font-weight-bold text-dark">Descripción del Alcance</th>
                                {{-- <th class="font-weight-bold text-dark">Moneda</th> --}}
                                <th class="font-weight-bold text-dark">Presupuesto y Moneda</th>
                                <th class="font-weight-bold text-dark">Dirección / Lugar</th>
                                <th class="font-weight-bold text-dark">Fecha Inicio</th>
                                <th class="font-weight-bold text-dark">Duración Estimada</th>
                                <th class="font-weight-bold text-dark"><center>Acciones</center></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($asignaciones as $asignacion)
                                <tr>
                                    <td class="font-weight-bold text-dark">{{ $asignacion->descri_alcance }}</td>
                                     {{-- <td class="font-weight-bold text-dark">{{ $asignacion->moneda_presu }}</td>  --}}
                                    <td class="font-weight-bold text-dark">{{ $asignacion->presupuesto }} {{ $asignacion->moneda_presu }}</td>
                                    <td class="font-weight-bold text-dark">{{ $asignacion->direccion }}</td>
                                    <td class="font-weight-bold text-dark">{{ date('d/m/Y', strtotime($asignacion->fecha_inicio)) }}</td>
                                    <td class="font-weight-bold text-dark">{{ date('d/m/Y', strtotime($asignacion->duracion_estimada)) }}</td>

                                    <td>
                                        <div style="display: flex; justify-content: center;">

                                            @can('crear-seguimiento')
                                               {{--  @if (!$asignacion->yaSeguimiento) --}}
                                                    <a class="btn btn-primary btn-sm" title="Desea Crear el Seguimiento" href="{{ route('seguimiento.create', ['id' => $asignacion->id]) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                                        </svg>
                                                    </a>
                                                {{-- @endif --}}
                                            @endcan
                                            
                                            @can('editar-asignacion')
                                                <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar la asignacion" href="{{ route('asignacion.edit',$asignacion->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                    </svg>
                                                </a>
                                            @endcan

                                            <a class="btn btn-info btn-sm" style="margin: 0 1px;" title="Ver Detalles" data-asignacion-id='{{ $asignacion->id }}' class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16"  style="color: #ffff; cursor: pointer;">
                                                <path d="M13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                                                <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM2 1a1 1 0 0 0-1 1v1h14V2a1 1 0 0 0-1-1zM1 4v10a1 1 0 0 0 1 1h2V4zm4 0v11h9a1 1 0 0 0 1-1V4z"/>
                                            </svg></a>

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

      <!-- MODAL PARA VER DETALLES -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}

                <div class="modal-body" id="modal-body-content">

                    {{-- ! DATOS CARGADOS POR JS/AJAX --}}
            
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cerrar</button>
                </div> --}}

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
                    title: 'Asingnacion',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

    {{-- ! FUNCION PARA MOSTRAR ERRORES --}}

    @if ($errors->any())
        <script>
            // ... (Tu código de SweetAlert para errores)
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Guardado Exitoso!',
                text: '{{ session('success') }}',
                icon: 'success', // Icono de éxito
                timer: 5000, // Opcional: la alerta se cierra automáticamente después de 3 segundos
                timerProgressBar: true,
                showConfirmButton: false // No mostramos el botón si usamos timer
            });
        </script>
    @endif

    {{-- FUNCIÓN DEL MODAL PARA VER DETALLES DEL SEGUIMIENTO --}}
    
    <script>
        $(document).ready(function() {
            $('#dataTable').on('click', '.btn-info', function(event) {
                event.preventDefault();
                var asignacionId = $(this).data('asignacion-id');
    
                $.ajax({
                    url: '/seguimiento/detalles/' + asignacionId,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
    
                        let asignacionsHtml = `
                            <h5 class="font-weight-bold text-primary" style="text-align: center">Detalles de la Asignación</h5>
                            
                            <p><b>ID</b>: ${data.id_evaluacion}</p>
                            <p><b>Nombre de la Ayuda Social</b>: ${data.nombre_ayuda}</p>
                            <p><b>Tipo de Ayuda Social</b>: ${data.tipo_ayuda}</p>
                
                        `;

                        // Verifica si existen imágenes y agrégalas
                        if (data.imagenes && data.imagenes.length > 0) {
                           asignacionsHtml += `<p><b>Fotos:</b></p><div style="display: flex; flex-wrap: wrap; gap: 10px;">`;
                            let imagenes = JSON.parse(data.imagenes);
                            imagenes.forEach(function(foto) {
                               asignacionsHtml += `<img src="/imagenes/${foto}" width="60%" style="width: calc(50% - 10px); margin-bottom: 10px;">`;
                            });
                           asignacionsHtml += '</div>';
                        }

                        $('#exampleModalScrollable .modal-body').html(asignacionsHtml);
    
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