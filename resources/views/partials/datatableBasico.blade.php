<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<!-- jQuery (necesario para DataTables) -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- DataTables y Bootstrap 5 -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.3.7/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.7/js/buttons.bootstrap5.min.js"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        $('#datatableBasico').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json"
            },
            responsive: true,
            autoWidth: false,
            processing: true,
            pagingType: 'simple_numbers',
            lengthMenu: [25, 50, 75, 100],
            pageLength: 25
        });
    });
</script>