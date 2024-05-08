<style type="text/css">
    input[type="text"] {
        text-transform: uppercase;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title_page; ?></h1>
                </div>
                
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <a href="<?= site_url('users/add_uom') ?>" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add Data</a>
                </h2>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tbl_uom" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>CODE UOM</th>
                            <th>NAME UOM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($uom as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->code_uom ?></td>
                                <td><?= $value->name_uom ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- jquery-validation -->
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $("#tbl_uom").DataTable({
                "scrollX": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                // select: {
                //     selected: true,
                //     style: 'multi'
                // },
                // "buttons": [{
                //         extend: "excel",
                //         text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                //         className: 'btn-success',
                //         title: '',
                //         exportOptions: {
                //             stripHtml: false,
                //             columns: [0, 1, 2], // Indeks kolom yang ingin dicetak
                //         },
                //     },
                //     {
                //         extend: "print",
                //         text: '<i class="fas fa-print mr-2"></i> PRINT',
                //         className: 'btn-info',
                //         title: '',
                //         autoPrint: false,
                //         exportOptions: {
                //             stripHtml: false,
                //             columns: [0, 1, 2], // Indeks kolom yang ingin dicetak
                //         },
                //     },
                //     {
                //         extend: 'selectAll',
                //         text: '<i class="fas fa-tasks mr-2"></i> Select All',
                //         className: 'btn'
                //     },
                //     {
                //         extend: 'selectNone',
                //         text: '<i class="fas fa-times mr-2"></i> Cancel',
                //         className: 'btn-danger'
                //     }
                // ]
            }).buttons().container().appendTo('#tbl_uom_wrapper .col-md-6:eq(0)');
        });
    });
</script>