<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/toastr/toastr.min.css">
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
                <h2 class="card-title"><b>DETAIL MATERIAL LIST</b></h2>

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
                <table id="tbl_material_list" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">MATERIAL CODE</th>
                            <th class="text-center">BARCODE</th>
                            <th class="text-center">CODE CATEGORY</th>
                            <th class="text-center">CATEGORY</th>
                            <th>NAME</th>
                            <th class="text-center">MODEL / TYPE</th>
                            <th class="text-center">PART NUMBER MAKER</th>
                            <th class="text-center">PART CODE MACHINE</th>
                            <th class="text-center">PART DRAWING</th>
                            <th>PART MAKER</th>
                            <th>ADDITIONAL DESCRIPTION</th>
                            <th>DESCRIPTION</th>
                            <th>AREA</th>
                            <th class="text-center">LINE</th>
                            <th>MACHINE</th>
                            <th class="text-center">LIFE TIME PART(MONTH)</th>
                            <th class="text-center">QTY ON MACHINE</th>
                            <th class="text-center">QTY STOCK</th>
                            <th class="text-center">UOM</th>
                            <th class="text-center">STORAGE LOCATION</th>
                            <th class="text-center">MINIMUM STOCK</th>
                            <th class="text-center">MAXIMUM STOCK</th>
                            <th class="text-center">SAFETY STOCK</th>
                            <th class="text-center">ROP(REORDER POINT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($material as $value) : ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $value->code_material ?></td>
                            <td class="text-center">
                                <?php $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($value->code_material, $generator::TYPE_CODE_128)) . '">'; ?>
                            </td>
                            <td class="text-center"><?= $value->code_category ?></td>
                            <td class="text-center"><?= $value->name_category ?></td>
                            <td><?= $value->part_name ?></td>
                            <td class="text-center"><?= $value->part_type ?></td>
                            <td class="text-center"><?= $value->part_number_maker ?></td>
                            <td class="text-center"><?= $value->part_code_machine ?></td>
                            <td class="text-center"><?= $value->part_drawing ?></td>
                            <td><?= $value->maker ?></td>
                            <td><?= $value->additional_description ?></td>
                            <td><?= $value->specification_material ?></td>
                            <td><?= $value->name_area ?></td>
                            <td class="text-center"><?= $value->name_line ?></td>
                            <td><?= $value->code_machine ?></td>
                            <td class="text-center"><?= $value->life_time_part ?></td>
                            <td class="text-center"><?= $value->qty_on_machine ?></td>
                            <td class="text-center"><?= $value->qty_stock ?></td>
                            <td class="text-center"><?= $value->code_uom ?></td>
                            <td class="text-center"><?= $value->name_location ?></td>
                            <td class="text-center"><?= $value->minimum_stock ?></td>
                            <td class="text-center"><?= $value->maximal_stock ?></td>
                            <td class="text-center"><?= $value->safety_stock ?></td>
                            <td class="text-center"><?= $value->rop ?></td>
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

<script src="<?= base_url('assets/template/') ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(document).ready(function() {
    $(function() {
        $("#tbl_material_list").DataTable({
            "scrollX": true,
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            "bStateSave": true,
            paging: true,
            scrollCollapse: true,
            scrollY: '75vh',
            "fnStateSave": function(oSettings, oData) {
                localStorage.setItem('offersDataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function(oSettings) {
                return JSON.parse(localStorage.getItem('offersDataTables'));
            },
            //     selected: true,
            //     style: 'multi'
            // },
            "buttons": [{
                extend: "excel",
                text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                className: 'btn-success',
                title: '',
                exportOptions: {
                    stripHtml: false,
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
                        16, 17, 18, 19, 20, 21, 22, 23, 24
                    ], // Indeks kolom yang ingin dicetak
                },
                customizeData: function(excelData) {
                    // Menambahkan bintang di depan dan di belakang setiap nilai di kolom Barcode
                    for (var i = 0; i < excelData.body.length; i++) {
                        // Kolom Barcode berada pada indeks 2 (diasumsikan indeks kolom Barcode adalah 2)
                        // Kolom "MATERIAL CODE" berada pada indeks 1 (diasumsikan indeks kolom "MATERIAL CODE" adalah 1)
                        excelData.body[i][2] = '*' + excelData.body[i][1] +
                            '*'; // Menambahkan bintang di depan dan di belakang
                    }
                }
            }, ]
        }).buttons().container().appendTo('#tbl_material_list_wrapper .col-md-6:eq(0)');
    });
});
</script>