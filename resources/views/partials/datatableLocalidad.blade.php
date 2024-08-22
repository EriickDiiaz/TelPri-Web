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
        var table = $('#datatableLocalidad').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json"
            },
            pagingType: 'simple_numbers',
            lengthMenu: [
                [25, 50, 75, 100, -1],
                [25, 50, 75, 100, "Todos"]
            ],
            layout: {                
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            },
            pageLength: 25,
            responsive: true,
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-outline-light',
                    exportOptions: {
                        columns: ':visible' // Exportar todas las columnas visibles
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa-solid fa-file-pdf"></i>',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-outline-light',
                    exportOptions: {
                        columns: ':visible' // Exportar todas las columnas visibles
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa-solid fa-print"></i>',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-outline-light',
                    exportOptions: {
                        columns: ':visible' // Exportar todas las columnas visibles
                    }
                }
            ]
        });

        // Attach SweetAlert to dynamically created delete buttons
        $(document).on('click', '.btn-delete', function(event) {
            event.preventDefault();
            var formId = $(this).closest('form').attr('id');
            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar esta entrada?',
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
