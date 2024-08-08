<style type="text/css">
    input[type="text"] {
        text-transform: uppercase;
    }
</style>

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
                    <a href="<?= site_url('administrator/add_location') ?>" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add Data</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#upload_excel_location">
                        <i class="fas fa-file-excel mr-2"></i>Upload Excel
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="upload_excel_location" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Upload Excel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?= form_open_multipart('administrator/upload_location', array('id' => 'form_upload_excel_location')) ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="upload_location">Excel</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="upload_location" name="upload_location">
                                                <label class="custom-file-label" for="upload_location">Choose
                                                    file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="progress" class="progress" style="display: none;">
                                        <div id="progress_bar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
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
                <table id="tbl_location" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th>NAME LOCATION</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($location as $value) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $value->name_location ?></td>
                                <td class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updatelocation<?= $value->id_location; ?>">
                                        <i class="fas fa-edit mr-2"></i>Update
                                    </button>
                                    <button type="button" class="btn btn-danger" id="delete_location" data-id-location="<?= $value->id_location; ?>" data-code-location="<?= $value->code_location; ?>"><i class="fas fa-trash mr-2"></i>Delete</button>
                                </td>
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
<?php foreach ($location as $value) : ?>
    <div class="modal fade" id="updatelocation<?= $value->id_location; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Update <?= $value->code_location; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('administrator/update_location', array('id' => 'form-update-location' . $value->id_location)); ?>
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" name="id_location" class="form-control" id="id_location<?= $value->id_location; ?>" value="<?= $value->id_location; ?>" readonly>
                    </div>
                    <label for="code_location">Code location</label>
                    <div class="form-group">
                        <input type="text" name="code_location" class="form-control" id="code_location<?= $value->id_location; ?>" value="<?= $value->code_location; ?>">
                    </div>
                    <label for="name_location">Name location</label>
                    <div class="form-group">
                        <input type="text" name="name_location" class="form-control" id="name_location<?= $value->id_location; ?>" value="<?= $value->name_location; ?>">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Change</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- jquery-validation -->
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url('assets/template/') ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $("#tbl_location").DataTable({
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

                //         select: {
                //             style: 'multi'
                //         },
                buttons: [
                    // {
                    //         extend: "excel",
                    //         text: '<i class="fas fa-file-excel mr-2"></i> Excel',
                    //         className: 'btn-success',
                    //         title: '',
                    //         exportOptions: {
                    //             stripHtml: false,
                    //             columns: [0, 1,2
                    //             ], // Indeks kolom yang ingin dicetak
                    //         },
                    //         customizeData: function(excelData) {
                    //             // Menambahkan bintang di depan dan di belakang setiap nilai di kolom Barcode
                    //             for (var i = 0; i < excelData.body.length; i++) {
                    //                 // Kolom Barcode berada pada indeks 2 (diasumsikan indeks kolom Barcode adalah 2)
                    //                 // Kolom "MATERIAL CODE" berada pada indeks 1 (diasumsikan indeks kolom "MATERIAL CODE" adalah 1)
                    //                 excelData.body[i][2] = '*' + excelData.body[i][1] +
                    //                     '*'; // Menambahkan bintang di depan dan di belakang
                    //             }
                    //         }
                    //     },

                {
                    extend: "excel",
                    text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                    className: 'btn-success',
                    title: '',
                    exportOptions: {
                        columns: [0, 1,] // Kolom yang akan diekspor
                    }
                },

                    {
                        extend: 'selectAll',
                        text: '<i class="fas fa-tasks mr-2"></i> Select All',
                        className: 'btn'
                    },
                    {
                        text: '<i class="fas fa-trash mr-2"></i> Delete All',
                        className: 'btn-danger',
                        action: function(e, dt, node, config) {
                            // Mengambil data terpilih dari tabel
                            var selectedRows = dt.rows({
                                selected: true
                            }).data();

                            // Mengumpulkan semua nilai location_code dari setiap baris yang dipilih
                            var selectedLocationCodes = [];

                            selectedRows.each(function(row) {
                                selectedLocationCodes.push(row[1]);
                            });

                            if (selectedLocationCodes.length === 0) {
                                toastr.info('Tidak Ada Data Yang Dipilih');
                                return;
                            }

                            Swal.fire({
                                title: "Are you sure?",
                                text: "You want to delete selected data!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, delete it!"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= site_url('administrator/delete_location_batch') ?>",
                                        data: {
                                            location_codes: selectedLocationCodes
                                        },
                                        dataType: "json",
                                        success: function(response) {
                                            if (response.success) {
                                                Swal.fire({
                                                    title: "Deleted!",
                                                    text: response
                                                        .message,
                                                    icon: "success"
                                                }).then(() => {
                                                    window
                                                        .location
                                                        .reload();
                                                });
                                            } else {
                                                Swal.fire({
                                                    title: "Failed!",
                                                    text: response
                                                        .message,
                                                    icon: "error"
                                                });
                                            }
                                        },
                                        error: function(xhr, status,
                                            error) {
                                            Swal.fire({
                                                title: "Error!",
                                                text: "An error occurred while processing your request.",
                                                icon: "error"
                                            });
                                            console.error(xhr
                                                .responseText);
                                        }
                                    });
                                }
                            });
                        }
                    },
                    {
                        extend: 'selectNone',
                        text: '<i class="fas fa-times mr-2"></i> Cancel',
                        className: 'btn-danger'
                    }
                ]
            }).buttons().container().appendTo('#tbl_location_wrapper .col-md-6:eq(0)');
        });

        //-------------------------------------------------- Update --------------------------------------------------\\
        <?php foreach ($location as $value) { ?>
            $.validator.setDefaults({
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: $(form).attr('method'),
                        data: $(form).serialize(),
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success == true) {
                                toastr.success(response.message);
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500); // Penundaan selama 2000 milidetik (2 detik)
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log('AJAX Error:', textStatus);
                        },
                    });
                }
            });
            $('#form-update-location<?= $value->id_location ?>').validate({
                rules: {
                    code_location: {
                        required: true,
                        remote: {
                            url: "<?= site_url('administrator/check_code_location') ?>",
                            type: "POST",
                            data: {
                                code_location: function() {
                                    return $("#code_location<?= $value->id_location; ?>").val();
                                },
                                id_location: "<?= $value->id_location ?>",
                                original_code_location: "<?= $value->code_location ?>"
                            }
                        }
                    },
                    name_location: {
                        required: true,
                    },
                },
                messages: {
                    code_location: {
                        required: "Please enter a code area",
                        remote: "Code category already exists"
                    },
                    name_location: {
                        required: "Please enter a name area",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        <?php } ?>
        //-------------------------------------------------- Update --------------------------------------------------\\


        //-------------------------------------------------- Delete --------------------------------------------------\\
        $(document).on('click', 'button[data-id-location]', function() {
            var id_location = $(this).data('id-location');

            Swal.fire({
                title: "Are you sure?",
                text: "You want delete this data!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('administrator/delete_location') ?>',
                        data: {
                            id_location: id_location
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Failed!",
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                title: "Error!",
                                text: "An error occurred while processing your request.",
                                icon: "error"
                            });
                            console.error('AJAX Error:', textStatus, errorThrown);
                        }
                    });
                }
            });
        });
        //-------------------------------------------------- Delete --------------------------------------------------\\


        //-------------------------------------------------- Upload Excel --------------------------------------------------\\
        bsCustomFileInput.init();
        $('#form_upload_excel_location').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '<?= base_url('administrator/upload_location') ?>',
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
                                " data is not uploaded, because the location code already exists";
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
                            window.location.href =
                                "<?= site_url('administrator/location') ?>";
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                },
                complete: function() {
                    $('#progress').fadeOut(5000);
                }
            });
        });
        //-------------------------------------------------- Upload Excel --------------------------------------------------\\
    });
</script>