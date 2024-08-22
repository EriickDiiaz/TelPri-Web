<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.3.7/css/buttons.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/3.1.0/css/buttons.bootstrap5.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.print.min.js"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        var table = $('#datatableMedio').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json"
            },
            pagingType: 'simple_numbers',
            lengthMenu: [
                [25, 50, 75, 100, -1],
                [25, 50, 75, 100, "Todos"]
            ],
            layout: {
                top2Start: 'buttons',
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            },
            pageLength: 25,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('lineas.getData') }}',
                data: function (d) {
                    d.plataforma = $('#filterPlataforma').val();
                }
            },
            columns: [
                { data: 'linea', name: 'linea' },
                { data: 'vip', name: 'vip', visible: false },
                { data: 'inventario', name: 'inventario' },
                { data: 'serial', name: 'serial', visible: false},
                { data: 'plataforma', name: 'plataforma' },
                { data: 'estado', name: 'estado' },
                { data: 'titular', name: 'titular' },
                { data: 'acceso', name: 'acceso', visible: false},
                { data: 'localidad_id', name: 'localidad_id', visible: false},
                { data: 'piso_id', name: 'piso_id', visible: false},                
                { data: 'mac', name: 'mac' },
                { data: 'campo_id', name: 'campo_id', visible: false},
                { data: 'par', name: 'par', visible: false},
                { data: 'directo', name: 'directo', visible: false},
                { data: 'observacion', name: 'observacion', visible: false},                
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var actions = `
                            <a href="{{ url('lineas/${data}')}}" target="_blank" class="btn btn-outline-light btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        `;
                        @can('Editar Lineas')
                        actions += `
                            <a href="{{ url('lineas/${data}/edit')}}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fa-solid fa-phone-volume"></i>
                            </a>
                        `;
                        @endcan
                        @can('Eliminar Lineas')
                        actions += `
                            <form action="{{ url('lineas/${data}')}}" id="form-eliminar-${data}" class="d-inline form-eliminar" method="post">
                                @method("DELETE")
                                @csrf
                                <button type="button" class="btn btn-outline-danger btn-sm btn-delete" data-id="${data}">
                                    <i class="fa-solid fa-phone-slash"></i>
                                </button>
                            </form>
                        `;
                        @endcan
                        return actions;
                    }
                }
            ],
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-outline-light',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14] // Índices de todas las columnas que deseas exportar
                    },
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('row c[r^="F"]', sheet).attr('s', '2');
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa-solid fa-file-pdf"></i>',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-outline-light',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14] // Índices de todas las columnas que deseas exportar
                    },
                    orientation: 'landscape', // Orientación horizontal
                    pageSize: 'A4', // Tamaño de página
                    customize: function(doc) {
                        doc.styles.tableHeader.alignment = 'left'; // Ajuste de alineación
                    }
                    
                },
                {
                    extend: 'print',
                    text: '<i class="fa-solid fa-print"></i>',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-outline-light',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14] // Índices de todas las columnas que deseas exportar
                    },
                    customize: function(win) {
                        $(win.document.body).find('table').addClass('display').css('font-size', '9px');
                        $(win.document.body).find('h1').css('text-align', 'center');
                    }
                }
            ],
            responsive: true
        });

        $('.filter-button').on('click', function() {
            var plataforma = $(this).data('plataforma');
            $('#filterPlataforma').val(plataforma);
            table.ajax.reload();
        });

        // Attach SweetAlert to dynamically created delete buttons
        $(document).on('click', '.btn-delete', function() {
            var formId = $(this).closest('form').attr('id');
            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar esta línea?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: '#333',  // Fondo oscuro
                color: '#fff',       // Texto blanco
                customClass: {
                    popup: 'swal2-dark',
                    title: 'swal2-title',
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        });
    });
</script>
