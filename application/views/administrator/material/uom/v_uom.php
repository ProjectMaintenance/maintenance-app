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
                    <a href="<?= site_url('administrator/add_uom') ?>" class="btn btn-primary"><i
                            class="fas fa-plus mr-2"></i>Add Data</a>
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
                            <th class="text-center">NO</th>
                            <th class="text-center">CODE UOM</th>
                            <th>NAME UOM</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($uom as $value) : ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $value->code_uom ?></td>
                            <td><?= $value->name_uom ?></td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#update_uom_<?= $value->id_uom; ?>">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </button>
                                <button type="button" class="btn btn-danger" id="delete_uom"
                                    data-id-uom="<?= $value->id_uom; ?>" data-code-uom="<?= $value->code_uom; ?>"><i
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

<?php foreach ($uom as $value) : ?>
<div class="modal fade" id="update_uom_<?= $value->id_uom; ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Update <?= $value->code_uom; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('administrator/update_uom', array('id' => 'form-update-uom' . $value->id_uom)); ?>
            <div class="card-body">
                <input type="hidden" class="form-control" id="id_uom<?= $value->id_uom; ?>" name="id_uom"
                    placeholder="Enter Code Uom" value="<?= $value->id_uom; ?>">
                <div class="form-group">
                    <label for="code_uom">Code Uom</label>
                    <input type="text" class="form-control" id="code_uom<?= $value->id_uom; ?>" name="code_uom"
                        placeholder="Enter Code Uom" value="<?= $value->code_uom; ?>">
                </div>
                <div class="form-group">
                    <label for="name_uom">Name Uom</label>
                    <input type="text" class="form-control" id="name_uom<?= $value->id_uom; ?>" name="name_uom"
                        placeholder="Enter Name Uom" value="<?= $value->name_uom; ?>">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
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
$(document).ready(function() {
    $("#tbl_uom").DataTable({
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
        //     selected: true,
        //     style: 'multi'
        // },

        "buttons": [
                {
                    extend: "excel",
                    text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                    className: 'btn-success',
                    title: '',
                    exportOptions: {
                        columns: [0, 1, 2] // Kolom yang akan diekspor
                    }
                }
            ]
    }).buttons().container().appendTo('#tbl_uom_wrapper .col-md-6:eq(0)');

    <?php foreach ($uom as $value) : ?>
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
    $('#form-update-uom<?= $value->id_uom ?>').validate({
        rules: {
            code_uom: {
                required: true,
                remote: {
                    url: "<?= site_url('administrator/check_code_uom') ?>",
                    type: "POST",
                    data: {
                        code_uom: function() {
                            return $("#code_uom<?= $value->id_uom; ?>").val();
                        },
                        id_uom: "<?= $value->id_uom ?>",
                        original_code_uom: "<?= $value->code_uom ?>"
                    }
                }
            },
            name_uom: {
                required: true,
            },
        },
        messages: {
            code_uom: {
                required: "Please enter a code area",
                remote: "Code category already exists"
            },
            name_uom: {
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
    <?php endforeach; ?>


    //-------------------------------------------------- Delete --------------------------------------------------\\
    $(document).on('click', 'button[data-id-uom]', function() {
        var id_uom = $(this).data('id-uom');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('administrator/delete_uom') ?>',
                    data: {
                        id_uom: id_uom
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
});
</script>