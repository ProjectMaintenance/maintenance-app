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
            <?= form_open('administrator/save_area', array('id' => 'form_add_area')) ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="code_area">Code Area</label>
                    <input type="text" class="form-control" id="code_area" name="code_area" +
                        placeholder="Enter Code Area" value="<?= set_value('code_area') ?>">
                </div>
                <div class="form-group">
                    <label for="name_area">Name Area</label>
                    <input type="text" class="form-control" id="name_area" name="name_area"
                        placeholder="Enter Name Area">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
            <a type="button" class="btn btn-danger" href="<?=base_url('administrator/area')?>"" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                <button type="submit" class="btn btn-primary">Save</button>
                
            </div>
            <?= form_close() ?>
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
    $('#code_area').focus();

    $('#reset_btn').click(function() {
        $('#code_area').focus();
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
                        }, 1000); // Penundaan selama 2000 milidetik (2 detik)
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
    $('#form_add_area').validate({
        rules: {
            code_area: {
                required: true,
                remote: {
                    url: "<?= site_url('administrator/check_code_area') ?>",
                    type: "POST",
                    data: {
                        'code_area': function() {
                            return $("#code_area").val();
                        }
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
                remote: "Code category already exist"
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
});
</script>