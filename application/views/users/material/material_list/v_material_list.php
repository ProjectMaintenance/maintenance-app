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
                <h2 class="card-title">
                    <a href="<?= site_url('users/add_material_list') ?>" class="btn btn-primary"><i
                            class="fas fa-plus mr-2"></i>Add Material List</a>
                    <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#upload_excel_material">
                        <i class="fas fa-upload mr-2"></i>Upload Excel
                    </button> -->

                    <!-- Modal -->
                    <div class="modal fade" id="upload_excel_material" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Upload Excel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?= form_open_multipart('users/upload_material', array('id' => 'form_upload_excel_material')) ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="upload_material">Excel</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="upload_material"
                                                    name="upload_material">
                                                <label class="custom-file-label" for="upload_material">Choose
                                                    file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="progress" class="progress" style="display: none;">
                                        <div id="progress_bar" class="progress-bar" role="progressbar" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                            0%
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
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
                <table id="tbl_material_list" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">MATERIAL CODE</th>
                            <th class="text-center">BARCODE</th>
                            <th class="text-center">CATEGORY</th>
                            <th>DESCRIPTION</th>
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
                            <td class="text-center"><?= $value->name_category ?></td>
                            <td><?= $value->specification_material ?></td>
                            <td class="text-center"
                                style="<?= ($value->qty_stock <= $value->minimum_stock) ? 'background-color: red;' : '' ?>">
                                <?= $value->qty_stock ?>
                            </td>
                            <td class="text-center"
                                style="<?= ($value->qty_stock <= $value->minimum_stock) ? 'background-color: red;' : '' ?>">
                                <?= $value->code_uom ?>
                            </td>
                            <td class="text-center"
                                style="<?= ($value->qty_stock <= $value->minimum_stock) ? 'background-color: red;' : '' ?>">
                                <?= $value->name_location ?>
                            </td>
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
            scrollY: '86vh',
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
            "buttons": [{
                    text: '<i class="fas fa-print mr-2"></i> Print Label',
                    className: 'btn-info',
                    action: function(e, dt, node, config) {
                        $('.swalDefaultWarning').click(function() {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                            })
                        });
                        // Mengambil data terpilih dari tabel
                        var selectedRows = dt.rows({
                            selected: true
                        }).data();

                        // Mengumpulkan semua nilai material_code dari setiap baris yang dipilih
                        var selectedMaterialCodes = [];

                        selectedRows.each(function(row) {
                            selectedMaterialCodes.push(row[1]);
                        });

                        if (selectedMaterialCodes.length === 0) {
                            toastr.info(
                                'Tidak Ada Data Yang Dipilih'
                            )
                        }

                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('users/posttopdf') ?>",
                            data: {
                                material_codes: selectedMaterialCodes
                            },
                            dataType: "json",
                            success: function(response) {
                                console.log(
                                    response); // Data respons dari server
                                if (response.success == true) {
                                    var pdfUrl =
                                        '<?= site_url('users/print_label_pdf/') ?>?' +
                                        $.param({
                                            material_code: response.data
                                        }); // Menggunakan $.param untuk mengkodekan nilai parameter
                                    window.open(pdfUrl, '_blank');
                                } else {
                                    console.log(response
                                        .message
                                    ); // Pesan kesalahan jika ada
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr
                                    .responseText
                                ); // Tangani kesalahan jika terjadi
                            }
                        });
                    }
                },
                {
                    extend: "excel",
                    text: '<i class="fas fa-file-excel mr-2"></i> Excel',
                    className: 'btn-success',
                    title: '',
                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
                        11], // Indeks kolom yang ingin dicetak
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
                },
                {
                    text: '<i class="fas fa-file-pdf mr-2"> </i> PDF',
                    className: 'btn-danger btn-sm',
                    action: function(e, dt, node, config) {
                        $('.swalDefaultWarning').click(function() {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                            })
                        });
                        // Mengambil data terpilih dari tabel
                        var selectedRows = dt.rows({
                            selected: true
                        }).data();

                        // Mengumpulkan semua nilai material_code dari setiap baris yang dipilih
                        var selectedMaterialCodes = [];

                        selectedRows.each(function(row) {
                            selectedMaterialCodes.push(row[1]);
                        });

                        if (selectedMaterialCodes.length === 0) {
                            toastr.info(
                                'Tidak Ada Data Yang Dipilih'
                            )
                        }

                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('users/posttopdf') ?>",
                            data: {
                                material_codes: selectedMaterialCodes
                            },
                            dataType: "json",
                            success: function(response) {
                                console.log(
                                    response); // Data respons dari server
                                if (response.success == true) {
                                    var pdfUrl =
                                        '<?= site_url('users/material_list_pdf/') ?>?' +
                                        $.param({
                                            material_code: response.data
                                        }); // Menggunakan $.param untuk mengkodekan nilai parameter
                                    window.open(pdfUrl, '_blank');
                                } else {
                                    console.log(response
                                        .message
                                    ); // Pesan kesalahan jika ada
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr
                                    .responseText
                                ); // Tangani kesalahan jika terjadi
                            }
                        });
                    }
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
        }).buttons().container().appendTo('#tbl_material_list_wrapper .col-md-6:eq(0)');
    });



    //--------------------------------------------- UPLOAD EXCEL MATERIAL ---------------------------------------------\\
    bsCustomFileInput.init();
    $('#form_upload_excel_material').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST", // Perbaikan: Menggunakan POST
            url: "<?= site_url('users/upload_material'); ?>",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total * 100;
                        $('#progress').show();
                        $('#progress_bar').width(percentComplete + '%');
                        $('#progress_bar').html(percentComplete.toFixed(2) + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                var successMessage = '';
                var errorMessage = '';

                if (response.success == true) {
                    successMessage = response.message.success + " out of " +
                        response.message.total + " data were successfully uploaded";
                    if (response.message.duplicate_count > 0) {
                        errorMessage = response.message.duplicate_count +
                            " data is not uploaded, because the category code already exists";
                    }
                } else {
                    errorMessage = response.message;
                }

                Swal.fire({
                    title: successMessage,
                    text: errorMessage,
                    icon: response.success ? "success" : "error"
                }).then(() => {
                    if (response.success) {
                        window.location.reload();
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error response
                console.error(textStatus, errorThrown);
            },
            complete: function() {
                // Hide progress bar when upload complete
                $('#progress').fadeOut(5000);
            }
        });
    });
    //--------------------------------------------- UPLOAD EXCEL MATERIAL ---------------------------------------------\\

});
</script>