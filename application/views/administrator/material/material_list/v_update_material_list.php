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
            <?= form_open('administrator/save_update_material', array('id' => 'form-update-material')); ?>
            <div class="card-body">
                <?php foreach ($data_material as $material) : ?>
                <input type="hidden" class="form-control" id="id_material" name="id_material"
                    placeholder="Material Code" readonly value="<?= $material->id_material ?>">
                <div class="form-group">
                    <label for="code_material">Material Code</label>
                    <input type="text" class="form-control" id="code_material" name="code_material"
                        placeholder="Material Code" readonly value="<?= $material->code_material ?>">
                </div>
                <div class="form-group">
                    <label for="code_material">Category</label>
                    <input type="hidden" class="form-control" id="category" name="category" placeholder="Category"
                        readonly value="<?= $material->code_category ?>">
                    <input type="text" class="form-control" id="name_category" name="name_category"
                        placeholder="Category" readonly value="<?= $material->name_category ?>">
                </div>
                <div class="form-group">
                    <label for="part_name">Part Name</label>
                    <input type="text" class="form-control" id="part_name" name="part_name"
                        placeholder="Enter Part Name" value="<?= $material->part_name ?>">
                </div>
                <div class="form-group">
                    <label for="part_type">Model / Part Type</label>
                    <input type="text" class="form-control" id="part_type" name="part_type"
                        placeholder="Enter Model / Part Type" value="<?= $material->part_type ?>">
                </div>
                <div class="form-group">
                    <label for="part_number_maker">Part Number Maker</label>
                    <input type="text" class="form-control" id="part_number_maker" name="part_number_maker"
                        placeholder="Enter Part Number Maker" value="<?= $material->part_number_maker ?>">
                </div>
                <div class="form-group">
                    <label for="part_code_machine">Part Code Machine</label>
                    <input type="text" class="form-control" id="part_code_machine" name="part_code_machine"
                        placeholder="Enter Part Code Machine" value="<?= $material->part_code_machine ?>">
                </div>
                <div class="form-group">
                    <label for="part_drawing">Part Drawing</label>
                    <input type="text" class="form-control" id="part_drawing" name="part_drawing"
                        placeholder="Enter Part Drawing" value="<?= $material->part_drawing ?>">
                </div>
                <div class="form-group">
                    <label for="maker">Maker</label>
                    <input type="text" class="form-control" id="maker" name="maker" placeholder="Enter Maker"
                        value="<?= $material->maker ?>">
                </div>
                <div class="form-group">
                    <label for="additional_description">Additional Description</label>
                    <input type="text" class="form-control" id="additional_description" name="additional_description"
                        placeholder="Enter Additional Description" value="<?= $material->additional_description ?>">
                </div>
                <div class="form-group">
                    <label>Area</label>
                    <select class="form-control select2" id="area" name="area" style="width: 100%;">
                    </select>
                    <input type="hidden" class="form-control" id="code_area" name="code_area" placeholder="Code Area"
                        readonly value="<?= $material->code_area ?>">
                    <input type="text" class="form-control" id="name_area" name="name_area" placeholder="Name Area"
                        readonly value="<?= $material->name_area ?>">
                </div>
                <div class="form-group">
                    <label>Line</label>
                    <select class="form-control select2" id="line" name="line" style="width: 100%;">
                        <option selected="selected" value="">- Select Line -</option>
                    </select>
                    <input type="hidden" class="form-control" id="code_line" name="code_line" placeholder="Code Line"
                        readonly value="<?= $material->code_line ?>">
                    <input type="text" class="form-control" id="name_line" name="name_line" placeholder="Name Line"
                        readonly value="<?= $material->name_line ?>">
                </div>
                <div class="form-group">
                    <label>Machine</label>
                    <select class="select2" id="machine" name="machine[]" multiple="multiple"
                        data-placeholder="Select Machine" style="width: 100%;">
                    </select>
                    <input type="text" class="form-control" id="name_machine" name="name_machine"
                        placeholder="Name Machine" readonly value="<?= $material->code_machine ?>">
                </div>
                <div class="form-group">
                    <label for="life_time_part">Life Time Part</label>
                    <input type="text" class="form-control" id="life_time_part" name="life_time_part"
                        placeholder="Enter Life Time Part" value="<?= $material->life_time_part ?>">
                </div>
                <div class="form-group">
                    <label for="quantity_on_machine">Quantity On Machine</label>
                    <input type="number" class="form-control" id="quantity_on_machine" name="quantity_on_machine"
                        placeholder="Enter Quantity On Machine" value="<?= $material->qty_on_machine ?>">
                </div>
                <div class="form-group">
                    <label for="quantity_stock">Quantity Stock</label>
                    <input type="number" class="form-control" id="quantity_stock" name="quantity_stock"
                        placeholder="Enter Quantity Stock" value="<?= $material->qty_stock ?>">
                </div>
                <div class="form-group">
                    <label>Uom</label>
                    <select class="form-control select2" id="uom" name="uom" style="width: 100%;">
                        <option selected="selected" value="">- Select Uom -</option>
                    </select>
                    <input type="hidden" class="form-control" id="code_uom" name="code_uom" placeholder="Code Line"
                        readonly value="<?= $material->code_uom ?>">
                    <input type="text" class="form-control" id="name_uom" name="name_uom" placeholder="Name Line"
                        readonly value="<?= $material->name_uom ?>">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <select class="form-control select2" id="location" name="location" style="width: 100%;">
                        <option selected="selected" value="">- Select Location -</option>
                    </select>
                    <input type="hidden" class="form-control" id="code_location" name="code_location"
                        placeholder="Code Line" readonly value="<?= $material->code_location ?>">
                    <input type="text" class="form-control" id="name_location" name="name_location"
                        placeholder="Name Line" readonly value="<?= $material->name_location ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
            <a type="button" class="btn btn-danger" href="<?=base_url('administrator/material_list')?>"" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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

    var path = window.location.pathname;
    var id_material = path.split('/').pop();

    $.ajax({
        type: "GET",
        url: "<?= site_url('administrator/add_material_list'); ?>",
        dataType: "JSON",
        data: {
            id_material: id_material
        },
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
                    url: "<?= site_url('administrator/generate_material_code') ?>",
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
                var name_area = $(this).find('option:selected').text();

                $('#code_area').val(code_area);
                $('#name_area').val(name_area);

                if (code_area === null || code_area.trim() === '') {
                    $('#code_area').val('');
                    $('#name_area').val('');
                    $('#line').empty();
                    $('#line').append(
                        '<option selected="selected" value="">- Select Line -</option>'
                    );
                    return;
                }

                $.ajax({
                    url: "<?php echo base_url('administrator/add_material_list'); ?>", // Perbaikan: Gunakan controller yang benar
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
                            var name_line = $(this).find(
                                'option:selected').text();

                            $('#code_line').val(code_line);
                            $('#name_line').val(name_line);

                            if (code_line === null || code_line
                                .trim() === '') {
                                $('#code_line').val('');
                                $('#name_line').val('');
                                $('#machine').empty();
                                return;
                            }

                            $.ajax({
                                url: "<?php echo base_url('administrator/add_material_list'); ?>", // Perbaikan: Gunakan controller yang benar
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

                        $('#machine').change(function(e) {
                            e.preventDefault();

                            var selectedOptions = $(this)
                                .val(); // Mengambil nilai yang dipilih dalam array

                            // Mengubah nilai array menjadi string dengan koma di antara setiap nilai
                            var name_machine = selectedOptions ?
                                selectedOptions.join(', ') : '';

                            $('#name_machine').val(
                                name_machine
                            ); // Menetapkan nilai ke input name_machine
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

                var code_uom = $(this).find(
                    'option:selected').val();
                var name_uom = $(this).find(
                    'option:selected').text();

                $('#code_uom').val(code_uom);
                $('#name_uom').val(name_uom);

                if (code_uom === null || code_uom
                    .trim() === '') {
                    $('#code_uom').val('');
                    $('#name_uom').val('');
                    return;
                } else {
                    $('#name_uom').valid();
                }
            });

            $('#location').empty();
            $('#location').append('<option value="">- Select Location -</option>');
            $.each(response.location, function(key, value) {
                $('#location').append('<option value="' + value.code_location + '">' + value
                    .name_location + '</option>');
            });
            $('#location').change(function(e) {
                e.preventDefault();

                var code_location = $(this).find(
                    'option:selected').val();
                var name_location = $(this).find(
                    'option:selected').text();

                $('#code_location').val(code_location);
                $('#name_location').val(name_location);

                if (code_location === null || code_location
                    .trim() === '') {
                    $('#code_location').val('');
                    $('#name_location').val('');
                    return;
                } else {
                    $('#name_location').valid();
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
                data: $(form).serialize(), // Serialize data formulir
                dataType: 'JSON',
                success: function(response) {
                    if (response.success == true) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000); // Penundaan selama 2000 milidetik (2 detik)
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

    $('#form-update-material').validate({
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
            name_area: {
                required: false,
            },
            name_line: {
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
            name_uom: {
                required: true,
            },
            name_location: {
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
            name_area: {
                required: "Please select area",
            },
            name_line: {
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
            name_uom: {
                required: "Please select a uom",
            },
            name_location: {
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