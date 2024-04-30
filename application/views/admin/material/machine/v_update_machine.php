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
                    <h1><b><?= $title_page; ?></b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/material_list') ?>">Material
                                List</a>
                        </li>
                        <li class="breadcrumb-item active"><?= $bread_crumb; ?></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $title_card; ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?= form_open('admin/save_update_machine', array('id' => 'form-update-machine')); ?>
            <div class="card-body">
                <?php foreach ($data_machine as $value) : ?>
                <input type="hidden" class="form-control" id="id_machine<?= $value->id_machine ?>" name="id_machine"
                    value="<?= $value->id_machine ?>" readonly>
                <div class="form-group">
                    <label>Area</label>
                    <select class="form-control select2" id="area" name="area" style="width: 100%;">
                        <option selected="selected" value="">- Select Area -</option>
                    </select>
                    <input type="hidden" class="form-control" id="code_area" name="code_area"
                        value="<?= $value->code_area ?>" readonly placeholder="Code Area">
                    <input type="text" class="form-control" id="name_area" name="name_area"
                        value="<?= $value->name_area ?>" readonly placeholder="Name Area">
                </div>
                <div class="form-group">
                    <label>Line</label>
                    <select class="form-control select2" id="line" name="line" style="width: 100%;">
                        <option selected="selected" value="">- Select Line -</option>
                    </select>
                    <input type="hidden" class="form-control" id="code_line" name="code_line"
                        value="<?= $value->code_line ?>" readonly placeholder="Code Line">
                    <input type="text" class="form-control" id="name_line" name="name_line"
                        value="<?= $value->name_line ?>" readonly required placeholder="Name Line">
                </div>
                <div class="form-group">
                    <label for="code_machine">Code Machine</label>
                    <input type="text" class="form-control" id="code_machine" name="code_machine"
                        placeholder="Enter Code Machine" value="<?= $value->code_machine ?>">
                </div>
                <div class="form-group">
                    <label for="name_machine">Name Machine</label>
                    <input type="text" class="form-control" id="name_machine" name="name_machine"
                        placeholder="Enter Name Machine" value="<?= $value->name_machine ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
            <?= form_close(); ?>
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
    $('#code_machine').focus();

    $('.select2').select2({
        theme: 'bootstrap4',
    });

    $.ajax({
        type: "GET",
        url: "<?= site_url('admin/add_machine'); ?>",
        dataType: "JSON",
        success: function(response) {

            $('#area').empty();
            $('#area').append('<option selected="selected" value="">- Select Area -</option>');
            $.each(response.area, function(key, value) {
                $('#area').append('<option value="' + value.code_area + '">' + value
                    .name_area + '</option>');
            });

            $('#area').change(function(e) {
                e.preventDefault();

                var code_area = $(this).find('option:selected').val();
                var name_area = $(this).find('option:selected').text();

                if (code_area === null || code_area.trim() === '') {
                    $('#code_area').val('');
                    $('#name_area').val('');
                    $('#line').empty();
                    $('#line').append(
                        '<option selected="selected" value="">- Select Line -</option>'
                    );
                } else {
                    $('#code_area').val(code_area);
                    $('#name_area').val(name_area);
                    $('#code_line').val('');
                    $('#name_line').val('');
                    $('#name_area').valid();

                    // Ajax call to populate lines based on selected area
                    $.ajax({
                        url: "<?php echo base_url('admin/add_machine'); ?>",
                        type: "GET",
                        dataType: "JSON",
                        data: {
                            code_area: code_area
                        },
                        success: function(response) {
                            $('#line').empty().append(
                                '<option selected="selected" value="">- Select Line -</option>'
                            );
                            $.each(response.line, function(key, value) {
                                $('#line').append(
                                    '<option value="' + value
                                    .code_line + '">' + value
                                    .name_line + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            $('#line').change(function(e) {
                e.preventDefault();

                var code_line = $(this).find('option:selected').val();
                var name_line = $(this).find('option:selected').text();

                if (code_line === null || code_line.trim() === '') {
                    $('#code_line').val('');
                    $('#name_line').val('');
                } else {
                    $('#code_line').val(code_line);
                    $('#name_line').val(name_line);
                    $('#name_line').valid();

                    // Ajax call to populate machines based on selected line
                    $.ajax({
                        url: "<?php echo base_url('admin/add_machine'); ?>",
                        type: "GET",
                        dataType: "JSON",
                        data: {
                            code_line: code_line
                        },
                        success: function(response) {
                            $('#machine').empty();
                            $.each(response.machine, function(key, value) {
                                $('#machine').append('<option value="' +
                                    value
                                    .code_machine + '">' + value
                                    .name_machine +
                                    '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
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
                            window.location.href =
                                "<?= site_url('admin/machine') ?>";
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
    $('#form-update-machine').validate({
        rules: {
            name_area: {
                required: true,
            },
            name_line: {
                required: true,
            },
            code_machine: {
                required: true,
                remote: {
                    url: "<?= site_url('admin/check_code_machine') ?>",
                    type: "POST",
                    data: {
                        code_line: function() {
                            return $("#code_machine<?= $value->id_machine ?>").val();
                        },
                        id_machine: "<?= $value->id_machine ?>",
                        original_code_machine: "<?= $value->code_machine ?>"
                    }
                }
            },
            name_machine: {
                required: true,
            },
        },
        messages: {
            name_area: {
                required: "Please select area",
            },
            name_line: {
                required: "Please select line",
            },
            code_machine: {
                required: "Please enter a code machine",
                remote: "Code category already exist"
            },
            name_machine: {
                required: "Please enter a name machine",
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
});
</script>