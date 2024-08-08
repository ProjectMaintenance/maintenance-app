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
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $title_card; ?></h3>
            </div>
            <!-- form start -->
            <?= form_open('administrator/save_update_req_order', array('id' => 'form-update-req-order')); ?>
            <div class="card-body">
            <?php foreach ($data_req_order as $req_order) : ?>
                <input type="hidden" class="form-control" id="id_req_order" name="id_req_order" readonly value="<?= $req_order->id_req_order ?>">
                <div class="form-group">
                        <label for="code_material">Material Code</label>
                        <input type="text" class="form-control" id="code_material" name="code_material" placeholder="Material Code" readonly value="<?= $req_order->code_material ?>">
                    </div>
                <div class="form-group">
                    <label for="quantity_stock">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity Stock" value="<?= $req_order->quantity ?>">
                </div>
                <div class="form-group">
                        <label>Uom</label>
                        <input type="text" class="form-control" id="code_uom" name="code_uom" readonly value="<?= $req_order->code_uom ?>">
                    </div>
                <div class="form-group">
                    <label for="user">Name user</label>
                    <input type="text" class="form-control" id="user" name="user" value="<?= $req_order->user ?>">
                </div>
                <div class="form-group">
                    <label for="date_time">Date created</label>
                    <input type="text" class="form-control" id="date_display" name="date_display" value="<?= $req_order->date_created ?>"readonly>
                </div>
                <div class="form-group">
                    <label for="date_required">Date Required</label>
                    <input type="date" class="form-control" id="date_required" name="date_required" value="<?= $req_order->date_required ?>">
                </div>
                <div class="form-group">
                    <label for="klasifikasi_order">Order Classification</label>
                    <input type="text" class="form-control" id="klasifikasi_order" name="klasifikasi_order" value="<?= $req_order->klasifikasi_order?>">
                </div>
            <?php endforeach; ?>
            </div>

            <div class="card-footer">
                <a type="button" class="btn btn-danger" href="<?= base_url('administrator/req_order') ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?= form_close(); ?>
        </div>

    </section>
</div>

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
                $('#category').append('<option selected="selected" value="">- Select Category -</option>');
                $.each(response.category, function(key, value) {
                    $('#category').append('<option value="' + value.code_category + '">' + value.name_category + '</option>');
                });

                $('#category').change(function() {
                    var code_category = $(this).val();
                    $('#uom').empty();
                    $('#uom').append('<option selected="selected" value="">- Select Uom -</option>');
                    $.each(response.uom[code_category], function(key, value) {
                        $('#uom').append('<option value="' + value.code_uom + '">' + value.name_uom + '</option>');
                    });
                });
            }
        });

        $('#form-update-req-order').validate({
            rules: {
                quantity_stock: {
                    required: true,
                    digits: true
                },
                user: {
                    required: true
                },
                date_required: {
                    required: true,
                    date: true
                },
                no_ppbj: {
                    digits: true
                },
                no_sr: {
                    digits: true
                },
                no_pr: {
                    digits: true
                },
                no_po: {
                    digits: true
                }
            },
            messages: {
                quantity_stock: {
                    required: "Please enter the quantity stock",
                    digits: "Please enter only digits"
                },
                user: {
                    required: "Please enter the user name"
                },
                date_required: {
                    required: "Please enter the required date",
                    date: "Please enter a valid date"
                },
                no_ppbj: {
                    digits: "Please enter only digits"
                },
                no_sr: {
                    digits: "Please enter only digits"
                },
                no_pr: {
                    digits: "Please enter only digits"
                },
                no_po: {
                    digits: "Please enter only digits"
                }
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
