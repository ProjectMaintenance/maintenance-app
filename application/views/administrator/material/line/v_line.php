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
                    <a href="<?= site_url('administrator/add_line') ?>" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add Data</a>
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
                <table id="tbl_line" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAME AREA</th>
                            <th>CODE LINE</th>
                            <th>NAME LINE</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($line as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->name_area; ?></td>
                                <td><?= $value->code_line; ?></td>
                                <td><?= $value->name_line; ?></td>
                                <td class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#update_line_<?= $value->id_line; ?>">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" id="delete_line" data-id-line="<?= $value->id_line; ?>" data-code-line="<?= $value->code_line; ?>"><i class="fas fa-trash mr-2"></i>Delete</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>NAME AREA</th>
                            <th>CODE LINE</th>
                            <th>NAME LINE</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php foreach ($line as $value) : ?>
    <div class="modal fade" id="update_line_<?= $value->id_line; ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Update <?= $value->code_line; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('administrator/update_line', array('id' => 'form-update-line' . $value->id_line)); ?>
                <div class="card-body">
                    <input type="hidden" class="form-control" id="id_line<?= $value->id_line; ?>" name="id_line" placeholder="Enter Code Line" value="<?= $value->id_line; ?>">
                    <div class="form-group">
                        <label>Area</label>
                        <select class="form-control select2" id="area_<?= $value->id_line; ?>" name="area" style="width: 100%;">
                        </select>
                        <input type="hidden" class="form-control code_area" id="code_area<?= $value->id_line; ?>" name="code_area" placeholder="Enter Code Line" value="<?= $value->code_area; ?>" readonly>
                        <input type="text" class="form-control name_area" id="name_area<?= $value->id_line; ?>" name="name_area" placeholder="Enter Code Line" value="<?= $value->name_area; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="code_line<?= $value->id_line; ?>">Code Line</label>
                        <input type="text" class="form-control" id="code_line<?= $value->id_line; ?>" name="code_line" placeholder="Enter Code Line" value="<?= $value->code_line; ?>">
                    </div>
                    <div class="form-group">
                        <label for="name_line<?= $value->id_line; ?>">Name Line</label>
                        <input type="text" class="form-control" id="name_line<?= $value->id_line; ?>" value="<?= $value->name_line ?>" name="name_line" placeholder="Enter Name Line">
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
    $(document).ready(function() {

        $("#tbl_line").DataTable({
            "scrollX": true,
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        // select: {
        //     selected: false,
        //     style: 'multi'
        // },
        
    }).buttons().container().appendTo('#tbl_category_wrapper .col-md-6:eq(0)');
            

        //-------------------------------------------------- Update --------------------------------------------------\\

        $('.select2').select2({
            theme: 'bootstrap4'
        });

        <?php foreach ($line as $value) : ?>
            $.ajax({
                url: "<?= site_url('administrator/add_line'); ?>",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // Bersihkan pilihan lama jika ada
                    $('#area_<?= $value->id_line; ?>').empty();
                    // Tambahkan opsi default
                    $('#area_<?= $value->id_line; ?>').append(
                        '<option selected="selected" value="">- Select Area -</option>');
                    // Loop melalui data area dan tambahkan ke Select2
                    $.each(response.area, function(key, value) {
                        $('#area_<?= $value->id_line; ?>').append('<option value="' + value
                            .code_area + '">' +
                            value.name_area + '</option>');
                    });
                    // Inisialisasi kembali Select2 setelah memperbarui opsi

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#area_<?= $value->id_line; ?>').change(function(e) {
                e.preventDefault();

                var code_area = $(this).find('option:selected').val();
                var name_area = $(this).find('option:selected').text();

                if (code_area === null || code_area.trim() === '') {
                    $('#code_area<?= $value->id_line; ?>').val('');
                    $('#name_area<?= $value->id_line; ?>').val('');
                } else {

                    $('#code_area<?= $value->id_line; ?>').val(code_area);
                    $('#name_area<?= $value->id_line; ?>').val(name_area);
                    $('#name_area<?= $value->id_line; ?>').valid();
                }
            });

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
            $('#form-update-line<?= $value->id_line ?>').validate({
                rules: {
                    name_area: {
                        required: true,
                    },
                    code_line: {
                        required: true,
                        remote: {
                            url: "<?= site_url('administrator/check_code_line') ?>",
                            type: "POST",
                            data: {
                                code_line: function() {
                                    return $("#code_line<?= $value->id_line ?>").val();
                                },
                                id_line: "<?= $value->id_line ?>",
                                original_code_line: "<?= $value->code_line ?>"
                            }
                        }
                    },
                    name_line: {
                        required: true,
                    },
                },
                messages: {
                    name_area: {
                        required: "Please select area",
                    },
                    code_line: {
                        required: "Please enter a code line",
                        remote: "Code category already exist"
                    },
                    name_line: {
                        required: "Please enter a name line",
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





        //-------------------------------------------------- Update --------------------------------------------------\\


        //-------------------------------------------------- Delete --------------------------------------------------\\
        $(document).on('click', 'button[data-id-line]', function() {
            var id_line = $(this).data('id-line');

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
                        url: '<?= site_url('administrator/delete_line') ?>',
                        data: {
                            id_line: id_line
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
                                    window.location.href =
                                        "<?= site_url('administrator/line') ?>";
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