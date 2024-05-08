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

        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $title_card; ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?= form_open('admin/save_material', array('id' => 'form-add-material')); ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="code_material">Material Code</label>
                    <input type="text" class="form-control" id="code_material" name="code_material"
                        placeholder="Material Code" readonly>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group">
                    <label for="part_name">Part Name</label>
                    <input type="text" class="form-control" id="part_name" name="part_name"
                        placeholder="Enter Part Name">
                </div>
                <div class="form-group">
                    <label for="part_type">Model / Part Type</label>
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
                    <label for="life_time_part">Life Time Part</label>
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
                    <label>Location</label>
                    <select class="form-control select2" id="location" name="location" style="width: 100%;">
                        <option selected="selected" value="">- Select Location -</option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
            <a type="button" class="btn btn-danger" href="<?=base_url('admin/material_list')?>"" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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

    $.ajax({
        type: "GET",
        url: "<?= site_url('admin/add_material_list'); ?>",
        dataType: "JSON",
        success: function(response) {
            $('#category').empty();
            $('#category').append(
                '<option selected="selected" value="">- Select Category -</option>');
            $.each(response.category, function(key, value) {
                $('#category').append('<option value="' + value.code_category + '">' +
                    value.name_category + '</option>');
            });

            $('#category').change(function(e) {
                e.preventDefault();

                var code_category = $(this).find('option:selected').val();

                if (code_category === null || code_category.trim() === '') {
                    $('#code_material').val('');
                    return;
                }

                $(this).valid();

                $.ajax({
                    type: "POST",
                    url: "<?= site_url('admin/generate_material_code') ?>",
                    data: {
                        code_category: code_category
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#code_material').val(response.material_code);
                        $('#category').change(function(e) {
                            e.preventDefault();
                            $(this).valid();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        toastr.error(
                            'An error occurred while processing the request.'
                        );
                    }
                });
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
                    url: "<?php echo base_url('admin/add_material_list'); ?>",
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
                                url: "<?php echo base_url('admin/add_material_list'); ?>", // Perbaikan: Gunakan controller yang benar
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
    });

    $('#form-add-material').validate({
        rules: {
            category: {
                required: true,
            },
            part_name: {
                required: true,
            },
            part_type: {
                required: false,
            },
            part_number_maker: {
                required: false,
            },
            part_code_machine: {
                required: false,
            },
            part_drawing: {
                required: false,
            },
            maker: {
                required: false,
            },
            area: {
                required: false,
            },
            line: {
                required: false,
            },
            machine: {
                required: false,
            },
            life_time_part: {
                required: false,
            },
            quantity_on_machine: {
                required: false,
            },
            quantity_stock: {
                required: true,
            },
            uom: {
                required: true,
            },
            location: {
                required: true,
            },
        },
        messages: {
            category: {
                required: "Please select a category",
            },
            part_name: {
                required: "Please enter a part name",
            },
            part_type: {
                required: "Please enter a part type",
            },
            part_number_maker: {
                required: "Please enter a part number maker",
            },
            part_code_machine: {
                required: "Please enter a part code machine",
            },
            part_drawing: {
                required: "Please enter a part drawing",
            },
            maker: {
                required: "Please enter a maker",
            },
            area: {
                required: "Please select area",
            },
            line: {
                required: "Please select line",
            },
            machine: {
                required: "Please select machine",
            },
            life_time_part: {
                required: "Please enter a life time part",
            },
            quantity_on_machine: {
                required: "Please enter a quantity on machine",
            },
            quantity_stock: {
                required: "Please enter a quantity stock",
            },
            uom: {
                required: "Please select a uom",
            },
            location: {
                required: "Please select a location",
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