<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/toastr/toastr.min.css">
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
                    <a href="<?= site_url('admin/add_category') ?>" class="btn btn-primary"><i
                            class="fas fa-plus mr-2"></i>Add Data</a>
                    <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#upload_excel_category">
                        <i class="fas fa-upload mr-2"></i>Upload Excel </button> -->

                    <!-- Modal -->
                    <div class="modal fade" id="upload_excel_category" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Upload Excel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?= form_open_multipart('admin/upload_category', array('id' => 'form_upload_excel_category')) ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="upload_category">Excel</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="upload_category"
                                                    name="upload_category">
                                                <label class="custom-file-label" for="upload_category">Choose
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
                <table id="tbl_category" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">CODE CATEGORY</th>
                            <th>NAME CATEGORY</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($category as $value) : ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $value->code_category ?></td>
                            <td><?= $value->name_category ?></td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#updatecategory<?= $value->id_category; ?>">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </button>
                                <button type="button" class="btn btn-danger" id="delete_category"
                                    data-id-category="<?= $value->id_category; ?>"
                                    data-code-category="<?= $value->code_category; ?>"><i
                                        class="fas fa-trash mr-2"></i>Delete</button>
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

<?php foreach ($category as $value) : ?>
<div class="modal fade" id="updatecategory<?= $value->id_category; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Update <?= $value->code_category; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('admin/update_category', array('id' => 'form-update-category' . $value->id_category)); ?>
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" name="id_category" class="form-control"
                        id="id_category<?= $value->id_category; ?>" value="<?= $value->id_category; ?>" readonly>
                </div>
                <label for="code_category">Code Category</label>
                <div class="form-group">
                    <input type="text" name="code_category" class="form-control"
                        id="code_category<?= $value->id_category; ?>" value="<?= $value->code_category; ?>">
                </div>
                <label for="name_category">Name Category</label>
                <div class="form-group">
                    <input type="text" name="name_category" class="form-control"
                        id="name_category<?= $value->id_category; ?>" value="<?= $value->name_category; ?>">
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

        $("#tbl_category").DataTable({
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
        }).buttons().container().appendTo('#tbl_category_wrapper .col-md-6:eq(0)');
    });

    //-------------------------------------------------- Update --------------------------------------------------\\
    <?php foreach ($category as $value) { ?>
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
                    // Tanggapan dari server jika terjadi kesalahan
                    console.log('AJAX Error:', textStatus);
                },
            });
        }
    });
    $('#form-update-category<?= $value->id_category ?>').validate({
        rules: {
            code_category: {
                required: true,
                remote: {
                    url: "<?= site_url('admin/check_code_category') ?>",
                    type: "POST",
                    data: {
                        code_category: function() {
                            return $("#code_category<?= $value->id_category; ?>").val();
                        },
                        id_category: "<?= $value->id_category ?>",
                        original_code_category: "<?= $value->code_category ?>"
                    }
                }
            },
            name_category: {
                required: true,
            },
        },
        messages: {
            code_category: {
                required: "Please enter a code category",
                remote: "Code category already exists"
            },
            name_category: {
                required: "Please enter a name category",
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
    $(document).on('click', 'button[data-id-category]', function() {
        var id_category = $(this).data('id-category');

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
                    url: '<?= site_url('admin/delete_category') ?>',
                    data: {
                        id_category: id_category
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: response.message,
                                icon: "success"
                            }).then(() => {
                                // Redirect to desired page after successful deletion
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
    $('#form_upload_excel_category').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '<?= base_url('admin/upload_category') ?>',
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
                        window.location.href =
                            "<?= site_url('admin/category') ?>";
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
    //-------------------------------------------------- Upload Excel --------------------------------------------------\\

});
</script>