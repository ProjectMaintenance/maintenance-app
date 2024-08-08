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
                    <a href="<?= site_url('users/add_goods_issue') ?>" class="btn btn-primary"><i
                            class="fas fa-plus mr-2"></i>Add Goods Issue</a>
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
                <table id="tbl_transaction" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th class="text-center">MATERIAL CODE</th>
                            <th>DESCRIPTION</th>
                            <th>AREA</th>
                            <th class="text-center">LINE</th>
                            <th>MACHINE</th>
                            <th class="text-center">GI QUANTITY</th>
                            <th class="text-center">UOM</th>
                            <th>NAME OF REQUESTER</th>
                            <th>NOTE (Alasan Pengambilan)</th>
                            <th class="text-center">GI CODE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($goods_issue as $value) : ?>
                        <tr>
                            <td><?= $value->date ?></td>
                            <td class="text-center"><?= $value->code_material ?></td>
                            <td><?= $value->specification_material ?></td>
                            <td><?= $value->name_area ?></td>
                            <td class="text-center"><?= $value->name_line ?></td>
                            <td><?= $value->name_machine ?></td>
                            <td class="text-center"><?= $value->quantity ?></td>
                            <td class="text-center"><?= $value->code_uom ?></td>
                            <td><?= $value->identity_pic ?></td>
                            <td><?= $value->description ?></td>
                            <td class="text-center"><?= $value->id_transaction ?></td>
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
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    $(function() {
        $("#tbl_transaction").DataTable({
            "scrollX": true,
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            "bStateSave": true,
            "scrollY": 400,
            "fnStateSave": function(oSettings, oData) {
                localStorage.setItem('offersDataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function(oSettings) {
                return JSON.parse(localStorage.getItem('offersDataTables'));
            },
            select: {
                selected: true,
                style: 'multi'
            },
            select: {
                selected: true,
                style: 'multi'
            },
            "buttons": [{
                    extend: "excel",
                    text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                    className: 'btn-success',
                    title: '',
                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
                        10], // Indeks kolom yang ingin dicetak
                    },
                },
                {
                    extend: "print",
                    text: '<i class="fas fa-print mr-2"></i> PRINT',
                    className: 'btn-info',
                    title: '',
                    autoPrint: false,
                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
                        10], // Indeks kolom yang ingin dicetak
                    },
                },
                {
                    extend: 'selectAll',
                    text: '<i class="fas fa-tasks mr-2"></i> Select All',
                    className: 'btn'
                },
                {
                    extend: 'selectNone',
                    text: '<i class="fas fa-times mr-2"></i> Cancel',
                    className: 'btn-danger'
                }
            ]
        }).buttons().container().appendTo('#tbl_transaction_wrapper .col-md-6:eq(0)');
    });
});
</script>