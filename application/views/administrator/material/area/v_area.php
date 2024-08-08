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
                    <a href="<?= site_url('administrator/add_area') ?>" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add Data</a>
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
                <table id="tbl_area" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">CODE AREA</th>
                            <th>NAME AREA</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($area as $value) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $value->code_area; ?></td>
                                <td><?= $value->name_area; ?></td>
                                <td class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updatearea<?= $value->id_area; ?>">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" id="delete_area" data-id-area="<?= $value->id_area; ?>" data-code-area="<?= $value->code_area; ?>"><i class="fas fa-trash mr-2"></i>Delete</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
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

<?php foreach ($area as $value) : ?>
    <!-- Modal -->
    <div class="modal fade" id="updatearea<?= $value->id_area; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Update <?= $value->code_area; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('administrator/update_area', array('id' => 'form-update-area' . $value->id_area)); ?>
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" name="id_area" class="form-control" id="id_area" placeholder="Enter Code Category" value="<?= $value->id_area; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" name="code_area" class="form-control" id="code_area<?= $value->id_area; ?>" placeholder="Enter Code Category" value="<?= $value->code_area; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="name_area" class="form-control" id="name_area<?= $value->id_area; ?>" placeholder="Enter Name Category" value="<?= $value->name_area; ?>">
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
<script>
    $(function() {
        $("#tbl_area").DataTable({
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


        //-------------------------------------------------- Update --------------------------------------------------\\
        <?php foreach ($area as $value) : ?>
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
            $('#form-update-area<?= $value->id_area ?>').validate({
                rules: {
                    code_area: {
                        required: true,
                        remote: {
                            url: "<?= site_url('administrator/check_code_area') ?>",
                            type: "POST",
                            data: {
                                code_area: function() {
                                    return $("#code_area<?= $value->id_area; ?>").val();
                                },
                                id_area: "<?= $value->id_area ?>",
                                original_code_area: "<?= $value->code_area ?>"
                            }
                        }
                    },
                    name_area: {
                        required: true,
                    },
                },
                messages: {
                    code_area: {
                        required: "Please enter a code area",
                        remote: "Code category already exists"
                    },
                    name_area: {
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

        <?php endforeach ?>
        //-------------------------------------------------- Update --------------------------------------------------\\


        //-------------------------------------------------- Delete --------------------------------------------------\\
        $(document).on('click', 'button[data-id-area]', function() {
            var id_area = $(this).data('id-area');
            var code_area = $(this).data('code-area');

            Swal.fire({
                title: "Are you sure?",
                text: "You want delete this data!" + " " + code_area,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('administrator/delete_area') ?>',
                        data: {
                            id_area: id_area
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

    });
</script>