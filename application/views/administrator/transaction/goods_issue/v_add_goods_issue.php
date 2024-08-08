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
            <?= form_open('administrator/save_good_issue', ['id' => 'form-add-goods-issue']) ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="code_material">Material Code</label>
                    <select class="form-control select2" id="code_material" name="code_material" style="width: 100%;">
                        <option selected="selected" value="">- Select Material -</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity Goods Issue (Barang Keluar)</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="0" min="0">
                </div>
                <div class="form-group">
                    <label for="uom">UOM</label>
                    <input type="text" class="form-control" id="uom" name="uom" readonly>
                </div>
                <div class="form-group">
                    <label>Area</label>
                    <select class="form-control select2" id="area" name="area" style="width: 100%;">
                        <option selected="selected" value="">- Select Area -</option>
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
                <!-- <div class="form-group">
                    <label for="identity_pic">Identity PIC</label>
                    <input type="text" class="form-control" id="identity_pic" name="identity_pic"
                        placeholder="Enter Identity PIC">
                </div> -->
                <?php
                $identity = ['Diana', 'Mentari'];
                ?>
                <div class="form-group">
                    <label for="identity_pic">Name Of Requester</label>
                    <select class="form-control select2" name="identity_pic" id="identity_pic">
                        <option value="" selected>- Select Name Of Requester -</option>
                        <?php foreach ($identity as $idnty) : ?>
                        <option value="<?= $idnty ?>"><?= $idnty; ?></option>
                        <?php endforeach; ?>
                        <option value="0">Other</option>
                    </select>
                </div>
                <div class="form-group" id="other_identity_pic_group" style="display: none;">
                    <label for="other_identity_pic">Enter Other Name Requester</label>
                    <input type="text" class="form-control" name="other_identity_pic" id="other_identity_pic">
                </div>
                <div class="form-group">
                    <label for="description">Note(Alasan pengambilan)</label>
                    <input type="text" class="form-control" id="description" name="description"
                        placeholder="Enter Note">
                </div>
                <div class="form-group">
                    <?php
                    // Set the default timezone if necessary
                    date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan timezone Anda

                    // Format date as 'dd-mm-yyyy' for display
                    $formattedDate = date('d/m/Y');

                    // Format date as 'Y-m-d' for the hidden input
                    $hiddenDate = date('Y/m/d');
                    ?>
                    <!-- <label for="date_time">Date And Time</label> -->
                    <input type="hidden" class="form-control" id="date_display" name="date_display"
                        value="<?= $formattedDate; ?>" readonly>
                    <input type="hidden" id="date" name="date" value="<?= $hiddenDate; ?>">
                    <input type="hidden" id="datetime" name="datetime">
                </div>
                <div class="form-group">
                    <label for="id_transaction">GI Code</label>
                    <input type="text" class="form-control" value="<?= $id_transaction; ?>" id="id_transaction"
                        name="id_transaction" placeholder="Goods Receive Code" readonly>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a type="button" class="btn btn-danger" href="<?= base_url('administrator/goods_issue') ?>"" name="
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
    $('#quantity').focus();
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    $('.select2').change(function(e) {
        e.preventDefault();
        $(this).valid();
        var selectedValue = $(this).val();
        var selectedText = $(this).find('Option:selected').text();
        // Tampilkan nilai yang dipilih di konsol
        console.log("Material Code: " + selectedValue);
        console.log("Part Name: " + selectedText);
    });

    // Fungsi untuk mendapatkan waktu saat ini dalam format yang sesuai
    function getCurrentTime() {
        var now = new Date();
        var hours = ('0' + now.getHours()).slice(-2);
        var minutes = ('0' + now.getMinutes()).slice(-2);
        var seconds = ('0' + now.getSeconds()).slice(-2);
        var time = hours + ':' + minutes + ':' + seconds;
        return time;
    }

    // Tambahkan event listener untuk input tanggal
    document.getElementById('date').addEventListener('change', function() {
        // Ambil tanggal yang dipilih oleh pengguna
        var selectedDate = this.value;

        // Jika tanggal dipilih, tambahkan waktu saat ini
        if (selectedDate) {
            var currentTime = getCurrentTime();
            var datetime = selectedDate + ' ' + currentTime;
            // Setel nilai input datetime
            document.getElementById('datetime').value = datetime;
        }
    });

    $.ajax({
        type: "GET",
        url: "<?= site_url('administrator/get_area'); ?>",
        dataType: "JSON",
        success: function(response) {
            $('#area').empty();
            $('#area').append(
                '<option selected="selected" value="">- Select Area -</option>');
            $.each(response.area, function(key, value) {
                $('#area').append('<option value="' + value.code_area + '">' +
                    value.name_area + '</option>');
            });
        }
    });

    $('#area').change(function(e) {
        e.preventDefault();

        var code_area = $('#area').val();

        if (code_area == null) {
            $('#line').empty();
            $('#line').append(
                '<option selected="selected" value="">- Select Line -</option>');
        }

        $.ajax({
            type: "POST",
            url: "<?= site_url('administrator/get_line_by_area'); ?>",
            data: {
                code_area: code_area
            },
            dataType: "JSON",
            success: function(response) {
                $('#line').empty();
                $('#line').append(
                    '<option selected="selected" value="">- Select Line -</option>');
                $.each(response.line, function(key, value) {
                    $('#line').append('<option value="' + value.code_line + '">' +
                        value.name_line + '</option>');
                });
            }
        });
    });

    $('#line').change(function(e) {
        e.preventDefault();

        var code_line = $('#line').val();

        if (code_line == null) {
            $('#machine').empty();
        }
        $.ajax({
            type: "GET",
            url: "<?= site_url('administrator/get_machine_by_line'); ?>",
            data: {
                code_line: code_line
            },
            dataType: "JSON",
            success: function(response) {
                var machineSelect = $('#machine');
                machineSelect.empty();
                machineSelect.append('<option value="ALL MACHINE">ALL MACHINE</option>');
                $.each(response.machine, function(key, value) {
                    machineSelect.append('<option value="' + value.code_machine +
                        '">' + value.name_machine + '</option>');
                });

                $('#machine').change(function() {
                    if ($(this).val() == 'ALL MACHINE') {
                        $(this).prop('multiple', false);
                    } else {
                        $(this).prop('multiple', true);
                    }
                });

                // Hapus hanya "ALL MACHINE" saat menghapus seleksi
                machineSelect.on('select2:unselect', function(e) {
                    var removedValue = e.params.data.id;

                    if (removedValue == 'ALL MACHINE') {
                        var currentValue = machineSelect.val();
                        var index = currentValue.indexOf('ALL MACHINE');
                        if (index !== -1) {
                            currentValue.splice(index, 1);
                            machineSelect.val(currentValue).trigger('change');
                        }
                    }
                });
            }
        });
    });

    $.ajax({
        url: "<?php echo base_url('administrator/material_list'); ?>",
        type: "GET",
        dataType: "json",
        success: function(response) {
            // Bersihkan pilihan lama jika ada
            $('#code_material').empty();
            // Tambahkan opsi default
            $('#code_material').append(
                '<option selected="selected" value="">- Select Material -</option>');
            // Loop melalui data material dan tambahkan ke Select2
            $.each(response.material, function(key, value) {
                $('#code_material').append('<option value="' + value.code_material + '">' +
                    value.code_material + ' ' +
                    '&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;' +
                    value.specification_material + ' ' +
                    '&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;' +
                    value.name_location + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });

    $('#code_material').change(function(e) {
        e.preventDefault();

        var code_material = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?= site_url('administrator/get_material_by_code_material'); ?>",
            data: {
                code_material: code_material
            },
            dataType: "JSON",
            success: function(response) {
                $('#uom').val(response.code_uom);
            }
        });
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
    $('#form-add-goods-issue').validate({
        rules: {
            date: {
                required: true,
            },
            code_material: {
                required: true,
            },
            area: {
                required: true,
            },
            line: {
                required: true,
            },
            'machine[]': {
                required: true,
            },
            quantity: {
                required: true,
                min: 1
            },
            identity_pic: {
                required: true,
            },
            description: {
                required: false,
            },
        },
        messages: {
            date: {
                required: "Please select date",
            },
            code_material: {
                required: "Please select a material",
            },
            quantity: {
                required: "Please enter a quantity",
                min: 'Please enter a quantity'
            },
            area: {
                required: "Please enter a area",
                min: 'Please enter a area'
            },
            line: {
                required: "Please enter a line",
                min: 'Please enter a line'
            },
            'machine[]': {
                required: "Please enter a machine",
                min: 'Please enter a machine'
            },
            
            identity_pic: {
                required: "Please enter a name of requester",
            },
            description: {
                required: "Please enter a description",
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

    $('#identity_pic').change(function(e) {
        e.preventDefault();
        var value = $(this).val();

        if (value == "0") {
            $('#other_identity_pic_group').show();
            setTimeout(function() {
                $('#other_identity_pic')
                    .focus();
            }, 100);
        } else {
            $('#other_identity_pic_group').hide();
        }
    });
});
</script>