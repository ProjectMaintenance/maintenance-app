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
                    <a href="<?= site_url('users/add_category') ?>" class="btn btn-primary"><i
                            class="fas fa-plus mr-2"></i>Add Data</a>
                    <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#upload_excel_category">
                        <i class="fas fa-upload mr-2"></i>Upload Excel
                    </button> -->

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
                                <?= form_open_multipart('users/upload_category', array('id' => 'form_upload_excel_category')) ?>
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
            // select: {
            //     selected: false,
            //     style: 'multi'
            // },

        }).buttons().container().appendTo('#tbl_category_wrapper .col-md-6:eq(0)');
    });



    //--------------------------------------------- UPLOAD EXCEL CATEGORY ---------------------------------------------\\
    bsCustomFileInput.init();
    $('#form_upload_excel_category').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '<?= base_url('users/upload_category') ?>',
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
                            "<?= site_url('users/category') ?>";
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
    //--------------------------------------------- UPLOAD EXCEL CATEGORY ---------------------------------------------\\
});
</script>