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

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('msg_code_material' . $this->session->userdata('username'))) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="background-color: #d4edda; color: #155724; border-color: #c3e6cb">
            Code Material
            <strong><?= $this->session->flashdata('msg_code_material' . $this->session->userdata('username')); ?></strong>
            Saved
            Successfuly
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php } ?>
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $title_card; ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?= form_open('users/save_material', array('id' => 'form-add-material')); ?>
            <div class="card-body">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group">
                    <label for="part_name">Name</label>
                    <input type="text" class="form-control" id="part_name" name="part_name"
                        placeholder="Enter Part Name">
                </div>
                <div class="form-group">
                    <label for="part_type">Model / Type</label>
                    <input type="text" class="form-control" id="part_type" name="part_type"
                        placeholder="Enter Model / Part Type">
                </div>
                <div class="form-group">
                    <label for="part_number_maker">Part Number Maker</label>
                    <input type="text" class="form-control" id="part_number_maker" name="part_number_maker"
                        placeholder="Enter Part Number Maker">
                </div>
                <div class="form-group">
                    <label for="part_code_machine">Part Code Machine</label>
                    <input type="text" class="form-control" id="part_code_machine" name="part_code_machine"
                        placeholder="Enter Part Code Machine">
                </div>
                <div class="form-group">
                    <label for="part_drawing">Part Drawing</label>
                    <input type="text" class="form-control" id="part_drawing" name="part_drawing"
                        placeholder="Enter Part Drawing">
                </div>
                <div class="form-group">
                    <label for="maker">Maker</label>
                    <input type="text" class="form-control" id="maker" name="maker" placeholder="Enter Maker">
                </div>
                <div class="form-group">
                    <label for="additional_description">Additional Description</label>
                    <input type="text" class="form-control" id="additional_description" name="additional_description"
                        placeholder="Enter Additional Description">
                </div>
                <div class="form-group">
                    <label>Area</label>
                    <select class="form-control select2" id="area" name="area" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group">
                    <label>Line</label>
                    <select class="form-control select2" id="line" name="line" style="width: 100%;">
                        <option selected="selected" value="">- Select Line -</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Machine</label>
                    <select class="select2" id="machine" name="machine[]" multiple="multiple"
                        data-placeholder="Select Machine" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group">
                    <label for="life_time_part">Life Time Part (Month)</label>
                    <input type="text" class="form-control" id="life_time_part" name="life_time_part"
                        placeholder="Enter Life Time Part">
                </div>
                <div class="form-group">
                    <label for="quantity_on_machine">Quantity On Machine</label>
                    <input type="number" class="form-control" id="quantity_on_machine" name="quantity_on_machine"
                        placeholder="Enter Quantity On Machine">
                </div>
                <div class="form-group">
                    <label for="quantity_stock">Quantity Stock</label>
                    <input type="number" class="form-control" id="quantity_stock" name="quantity_stock"
                        placeholder="Enter Quantity Stock">
                </div>
                <div class="form-group">
                    <label>Uom</label>
                    <select class="form-control select2" id="uom" name="uom" style="width: 100%;">
                        <option selected="selected" value="">- Select Uom -</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Storage Location</label>
                    <select class="form-control select2" id="location" name="location" style="width: 100%;">
                        <option selected="selected" value="">- Select Location -</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="minimum_stock">Minimum stock</label>
                    <input type="number" class="form-control" id="minimum_stock" name="minimum_stock"
                        placeholder="Enter minimum stock">
                </div>
                <div class="form-group">
                    <label for="maximal_stock">Maximum Stock</label>
                    <input type="number" class="form-control" id="maximal_stock" name="maximal_stock"
                        placeholder="Enter maximal stock">
                </div>
                <div class="form-group">
                    <label for="safety_stock">Safety Stock</label>
                    <input type="number" class="form-control" id="safety_stock" name="safety_stock"
                        placeholder="Enter safety stock">
                </div>
                <div class="form-group">
                    <label for="rop">ROP(REORDER POINT)</label>
                    <input type="number" class="form-control" id="rop" name="rop"
                        placeholder="Enter ROP(REORDER POINT)">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a type="button" class="btn btn-danger" href="<?= site_url('users/add_req_order') ?>" name="
                    btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                <button type="submit" class="btn btn-primary">Save</button>
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
    $('#part_name').focus();
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    $('#category').change(function(e) {
        e.preventDefault();
        $(this).valid();
    });

    $.ajax({
        type: "GET",
        url: "<?= site_url('users/add_material_list'); ?>",
        dataType: "JSON",
        success: function(response) {
            $('#category').empty();
            $('#category').append(
                '<option selected="selected" value="">- Select Category -</option>');
            $.each(response.category, function(key, value) {
                $('#category').append('<option value="' + value.code_category + '">' +
                    value.name_category + '</option>');
            });

            $('#area').empty();
            $('#area').append('<option selected="selected" value="">- Select Area -</option>');
            $.each(response.area, function(key, value) {
                $('#area').append('<option value="' + value.code_area + '">' + value
                    .name_area + '</option>');
            });

            $('#area').change(function(e) {
                e.preventDefault();

                var code_area = $(this).find('option:selected').val();

                if (code_area === null || code_area.trim() === '') {
                    $('#code_area').val('');
                    return;
                }

                $.ajax({
                    url: "<?php echo base_url('users/add_material_list'); ?>",
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        code_area: code_area
                    },
                    success: function(response) {
                        $('#line').empty();
                        $('#line').append(
                            '<option selected="selected" value="">- Select Line -</option>'
                        );
                        $.each(response.line, function(key, value) {
                            $('#line').append('<option value="' + value
                                .code_line + '">' +
                                value.name_line + '</option>');
                        });

                        $('#line').change(function(e) {
                            e.preventDefault();

                            var code_line = $(this).find(
                                'option:selected').val();
                            $.ajax({
                                url: "<?php echo base_url('users/add_material_list'); ?>", // Perbaikan: Gunakan controller yang benar
                                type: "GET",
                                dataType: "JSON",
                                data: {
                                    code_line: code_line
                                },
                                success: function(response) {
                                    $('#machine').empty();
                                    $.each(response.machine,
                                        function(key,
                                            value) {
                                            $('#machine')
                                                .append(
                                                    '<option value="' +
                                                    value
                                                    .code_machine +
                                                    '">' +
                                                    value
                                                    .name_machine +
                                                    '</option>'
                                                );
                                        });
                                },
                                error: function(xhr, status,
                                    error) {
                                    console.error(xhr
                                        .responseText);
                                }
                            });
                        });


                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#uom').empty();
            $('#uom').append(
                '<option selected="selected" value="">- Select uom -</option>');
            $.each(response.uom, function(key, value) {
                $('#uom').append('<option value="' + value.code_uom + '">' +
                    value.name_uom + '</option>');
            });
            $('#uom').change(function(e) {
                e.preventDefault();
                $(this).valid();
            });

            $('#location').empty();
            $('#location').append('<option value="">- Select Location -</option>');
            $.each(response.location, function(key, value) {
                $('#location').append('<option value="' + value.code_location + '">' + value
                    .name_location + '</option>');
            });
            $('#location').change(function(e) {
                e.preventDefault();
                $(this).valid();
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });

    $.validator.setDefaults({
        submitHandler: function(form) {
            if ($('#part_name').val() == '' && $('#part_type').val() == '' && $(
                    '#part_number_maker').val() ==
                '' && $('#part_code_machine').val() == '' && $('#part_drawing').val() == '' && $(
                    '#maker').val() == '' && $('#additional_description').val() == '' && $('#area')
                .val() == '' && $('#line').val() == '' && $('#machine').val() == '' && $(
                    '#life_time_part').val() == '' && $('#quantity_on_machine').val() == '' && $(
                    '#quantity_stock').val() == '' && $('#uom').val() == '' && $('#location')
                .val() == '' && $('#minimum_stock').val() == '' && $('#maximal_stock').val() ==
                '' && $(
                    '#safety_stock').val() == '' && $('#rop').val() == '') {
                toastr.error('One must be filled in');
            } else {
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
                                    '<?= site_url('users/add_req_order'); ?>';
                            }, 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('AJAX Error:', textStatus);
                    },
                });
            }
        }
    });

    $('#form-add-material').validate({
        rules: {
            category: {
                required: true,
            },
        },
        messages: {
            category: {
                required: "Please select a category",
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