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
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <form action="<?= site_url('administrator/save_req_order'); ?>" id="form-add-req-order"
                        method="POST">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title_card; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <h3>Proposal Permintaan Barang & Jasa</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="register_no">Register No</label>
                                        <input type="text" class="form-control" id="register_no" name="register_no"
                                            placeholder="Enter Register No">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date Required</label>
                                        <input type="date" class="form-control" id="date_required" name="date_required"
                                            value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" name="department" id="department">
                                            <option value="">- Select Department -</option>
                                            <?php
                                            $departments = [
                                                'MAINTENANCE' => 'MAINTENANCE',
                                                'PRODUCTION ASM' => 'PRODUCTION-ASM',
                                                'PRODUCTION MCH' => 'PRODUCTION-MCH',
                                                'MANUFACTURING ENGINEERING' => 'MANUFACTURING ENGINEERING',
                                                'QUALITY CONTROL' => 'QUALITY CONTROL',
                                                'PPC' => 'PPC',
                                                'GA' => 'GA'
                                            ];
                                            $selected = '';
                                            foreach ($departments as $key => $value) {
                                                if ($key == 'MAINTENANCE') {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                                echo "<option value=\"$key\" $selected>$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_item_service">Category Item/Service</label>
                                        <input type="text" class="form-control" id="category_item_service"
                                            name="category_item_service" placeholder="Enter Category Item/Service">
                                    </div>
                                    <div class="form-group">
                                        <label for="b3_product"> B3 Product</label>
                                        <select class="form-control" name="b3_product" id="b3_product">
                                            <option value="" selected>- Select B3 Product -</option>
                                            <option value="YES">YES</option>
                                            <option value="NO" selected>NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reason">Reason</label>
                                        <input type="text" class="form-control" id="reason" name="reason"
                                            placeholder="Enter Reason">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="date_created">Date Created</label> -->
                                        <input type="hidden" class="form-control" name="date_created" id="date_created"
                                            value="<?= date('Y-m-d'); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="level_of_request">Level Of Request</label>
                                        <input type="text" class="form-control" id="level_of_request"
                                            name="level_of_request" placeholder="Enter Level Of Request">
                                    </div>
                                    <div class="form-group">
                                        <label for="type_of_payment">Type Of Payment</label>
                                        <select class="form-control" name="type_of_payment" id="type_of_payment">
                                            <option value="" selected>- Select Type Of Payment -</option>
                                            <option value="SUSPEND">SUSPEND</option>
                                            <option value="REIMBUES">REIMBUES</option>
                                            <option value="DUE PAYMENT">DUE PAYMENT</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="order_type">Order Type</label>
                                        <select class="form-control" name="order_type" id="order_type">
                                            <option value="" selected>- Select Order Type -</option>
                                            <option value="FEASIBILITY STUDY">FEASIBILITY STUDY</option>
                                            <option value="ORDER" selected>ORDER</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="attachment">Attachment</label>
                                        <select class="form-control select2" multiple="multiple" name="attachment[]"
                                            id="attachment" placeholder="Select Attachment">
                                            <option value="ESR">ESR</option>
                                            <option value="DRAWING">DRAWING</option>
                                            <option value="SAMPLE BARANG">SAMPLE BARANG</option>
                                            <option value="FORECAST / DATA STOCK">FORECAST / DATA STOCK</option>
                                            <option value="BOM">BOM</option>
                                            <option value="SERVICE REPORT">SERVICE REPORT</option>
                                            <option value="PICTURE / PHOTOS OF ITEM">PICTURE / PHOTOS OF ITEM</option>
                                            <option value="CATALOG">CATALOG</option>
                                            <option value="COPY OF LAST PO" selected>COPY OF LAST PO</option>
                                            <option value="QUOTATION">QUOTATION</option>
                                            <option value="SCHEDULE (PROJECT)">SCHEDULE (PROJECT)</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form group">
                                        <label for="noted">Noted (Alasan Pembelian)</label>
                                        <input class="form-control" type="text" name="noted" id="noted"
                                            placeholder="Masukan Alasan Pembelian">
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form group">
                                        <label for="requester_name">Requester's Name</label>
                                        <input class="form-control" type="text" name="requester_name"
                                            id="requester_name" placeholder="Masukan Requester name">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h3>Created And Approved</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form group">
                                        <label for="pic_maintenance">Created By PIC</label>
                                        <input class="form-control" type="text" name="pic_maintenance"
                                            id="pic_maintenance" placeholder="PIC Maintenance">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form group">
                                        <label for="manager_maintenance">Approved By Manager</label>
                                        <input class="form-control" type="text" name="manager_maintenance"
                                            id="manager_maintenance" placeholder="Manager Maintenance"
                                            value="AZWAR R.W.N">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form group">
                                        <label for="g_manager_maintenance">Approved By G.Manager</label>
                                        <input class="form-control" type="text" name="g_manager_maintenance"
                                            id="g_manager_maintenance" placeholder="General Manager Maintenance"
                                            value="FAHMI ARIEF">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form group">
                                        <label for="approved_by">Received By</label>
                                        <input class="form-control" type="text" name="approved_by" id="approved_by"
                                            placeholder="Received By">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a class="btn btn-primary mb-3"
                                href="<?= site_url('administrator/add_material_for_req_order');  ?>"><i
                                    class="fas fa-plus mr-2"></i>Add Material
                                List</a>
                            <table id="tbl_material_list" class="table table-bordered table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Material Code</th>
                                        <th>Specification</th>
                                        <th>Quantity</th>
                                        <th>Uom</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($material as $value) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value->code_material ?></td>
                                        <td><?= $value->specification_material ?></td>
                                        <td><?= $value->qty_stock ?></td>
                                        <td><?= $value->code_uom ?></td>
                                        <td class="text-center">
                                            <!-- Tombol untuk memilih bagian -->
                                            <button type="button" class="btn btn-primary btn-select-part btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <br>
                            <hr>
                            <button type="button" class="btn btn-primary btn-add-row mb-3"><i
                                    class="fas fa-plus mr-2"></i>Add Jasa</button>
                            <table id="selected_material_table" class="table table-bordered table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code Material</th>
                                        <th>Item Description</th>
                                        <th>Quantity</th>
                                        <th>Uom</th>
                                        <th>ETA</th>
                                        <th>Category Req (R.Order, New)</th>
                                        <th>Remark</th>
                                        <th class="text-center">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Baris-baris data akan ditambahkan di sini -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a type="button" class="btn btn-danger" href="<?= base_url('administrator/req_order') ?>"
                                name=" btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
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

    // Trigger the generate_no_ppbj function on page load
    generateRegisterNo();

    $('#department').change(function(e) {
        e.preventDefault();

        var department = $(this).val();

        generateRegisterNo();
    });

    function generateRegisterNo() {
        var department = $('#department').val();

        if (department === "") {
            $('#register_no').val('');
            return;
        }

        $.ajax({
            url: '<?= site_url('administrator/generate_no_ppbj'); ?>',
            type: 'POST',
            data: {
                department: department
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#register_no').val(response.no_ppbj);
                } else {
                    alert('Failed to generate register number');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while generating the register number');
            }
        });
    }

    $('#attachment').select2({
        placeholder: 'Select Attachment',
        theme: 'bootstrap4'
    });

    $('#tbl_material_list').show().DataTable({
        "scrollX": true,
        "responsive": false,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 5,
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ]
    });

    $('#selected_material_table').DataTable({
        "scrollX": true,
        "responsive": false,
        "lengthChange": true,
        "autoWidth": false,
    });

    setTimeout(function() {
        var input = $('#register_no');
        input.val(input.val());
        input.focus().get(0).setSelectionRange(input.val().length, input.val().length);
    }, 0);

    $('#register_no').focus();

    $('#date_required').change(function(e) {
        var date = $(this).val();

        // Set nilai ETA di setiap baris tabel yang ada di #selected_material_table
        $('#selected_material_table').DataTable().rows().every(function() {
            var rowNode = this.node();
            $(rowNode).find('.eta').val(date);
        });
    });


    // Initialize row number
    var rowNumber = 0;

    $(document).on('click', '#tbl_material_list .btn-select-part', function() {
        $(this).removeClass('btn-primary').addClass('btn-success');
        var row = $(this).closest('tr');
        var materialCode = row.find('td:nth-child(2)').text().trim();
        var specification = row.find('td:nth-child(3)').text().trim();
        var quantity = 1;
        var uom = row.find('td:nth-child(5)').text().trim();

        var selectedMaterialTable = $('#selected_material_table').DataTable();

        // Cari apakah materialCode sudah ada di selected_material_table
        // var existingRow = selectedMaterialTable.rows().nodes().toArray().find(function(node) {
        //     return $(node).find('td:nth-child(2)').text().trim() === materialCode;
        // });

        // if (existingRow) {
        //     alert('Item already selected.');
        // } else {
        // Menambahkan baris ke tabel
        if (selectedMaterialTable.rows().count() < 10) {
            var date_required = $('#date_required').val()
            var newRow = [
                selectedMaterialTable.rows().count() + 1, // Nomor urutan baris
                materialCode,
                specification,
                '<input type="number" class="form-control quantity" name="quantity[]" value="' +
                quantity +
                '" min="1" style="width: 75px;">',
                uom,
                '<input type="date" class="form-control eta" name="eta[]" style="width: 150px;" value="' +
                date_required + '" placeholder="Enter ETA">',
                '<input type="text" class="form-control category_req" name="category_req[]" style="200px;" placeholder="Input RO"">',
                '<input type="text" class="form-control user" name="user[]" style="width: 200px;" placeholder="USER"><input type="text" class="form-control for" name="for[]" style="width: 200px;" placeholder="FOR">',
                '<center><button class="btn btn-danger btn-cancel-part btn-sm"><i class="fas fa-times"></i></button></center>'
            ];
            var addedRow = selectedMaterialTable.row.add(newRow).draw().node();
        } else {
            alert('Maximum 10 rows reached.');
        }
        // }
    });



    $(".btn-add-row").click(function() {
        var selectedMaterialTable = $('#selected_material_table').DataTable();
        var date_required = $('#date_required').val()

        rowNumber++; // Increment row number
        var newRow = [
            selectedMaterialTable.rows().count() + 1,
            '<input type="text" class="form-control code_material" name="code_material[]" style="200px;" value="JASA" placeholder="Enter Code Material"">', // Material code (empty for new row)
            '<input type="text" class="form-control item_description" name="item_description[]" style="200px;" placeholder="Enter Description"">', // Specification (empty for new row)
            '<input type="number" class="form-control quantity" name="quantity[]" value="1" min="1" style="width: 75px;">',
            '<input type="text" class="form-control uom" name="uom[]" style="300px;" placeholder="Uom"">', // UOM (empty for new row)
            '<input type="date" class="form-control eta" name="eta[]" style="width: 150px;" value="' +
            date_required + '" placeholder="Enter ETA">',
            '<input type="text" class="form-control category_req" name="category_req[]" style="200px;" placeholder="Input RO"">',
            '<input type="text" class="form-control user" name="user[]" style="width: 200px;" placeholder="USER"><input type="text" class="form-control for" name="for[]" style="width: 200px;" placeholder="FOR">',
            '<center><button class="btn btn-danger btn-cancel-part btn-sm"><i class="fas fa-times"></i></button></center>'
        ];
        var addedRow = selectedMaterialTable.row.add(newRow).draw().node();
    });




    // Menangani penghapusan item dari tabel selected_material_table
    $('#selected_material_table').on('click', '.btn-cancel-part', function() {
        var selectedMaterialTable = $('#selected_material_table').DataTable();
        var row = $(this).closest('tr');
        var deletedIndex = selectedMaterialTable.row(row).index() +
            1; // Ambil indeks baris yang akan dihapus

        selectedMaterialTable.row(row).remove().draw(); // Hapus baris dari DataTable

        // Update nomor urutan setelah penghapusan
        selectedMaterialTable.rows().every(function(idx) {
            var newData = [
                idx + 1, // Update nomor urutan baris
                this.data()[1], // Materi kode tetap sama
                this.data()[2], // Spesifikasi tetap sama
                this.data()[3], // Quantity tetap sama
                this.data()[4], // UOM tetap sama
                this.data()[5], // Kolom input 1 tetap sama
                this.data()[6], // Kolom input 2 tetap sama
                this.data()[7], // Tombol hapus tetap sama
                this.data()[8] // Tombol hapus tetap sama
            ];
            this.data(newData); // Setel data baru untuk baris ini
        });

        // Cari tombol btn-select-part yang sesuai dengan materialCode yang dihapus
        var materialCode = row.find('td:nth-child(2)').text().trim();
        var btnSelectPart = $('#tbl_material_list').find('td:contains("' + materialCode + '")')
            .siblings('.text-center').find('.btn-select-part');

        // Ubah warna tombol kembali ke btn-primary
        btnSelectPart.removeClass('btn-success').addClass('btn-primary');
    });

    // Set standar tanggal
    $('#date_required').val(new Date().toISOString().split('T')[0]);

    function updateLevelOfRequest() {
        var date_created = new Date($('#date_created').val());
        var date_required = new Date($('#date_required').val());

        var timeDiff = Math.abs(date_required.getTime() - date_created.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        if (diffDays <= 7) {
            $('#level_of_request').val('EMERGENCY');
        } else if (diffDays > 7 && diffDays <= 25) {
            $('#level_of_request').val('URGENT');
        } else {
            $('#level_of_request').val('NORMAL');
        }
    }

    // Call the function on page load
    updateLevelOfRequest();

    // Update level of request on date change
    $('#date_required').change(function(e) {
        e.preventDefault();
        updateLevelOfRequest();
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

    $('#form-add-req-order').validate({
        rules: {
            register_no: {
                required: true,
                // remote: {
                //     url: "<?= site_url('administrator/check_register_no') ?>",
                //     type: "POST",
                //     data: {
                //         'register_no': function() {
                //             return $("#register_no").val();
                //         }
                //     }
                // }
            },
            date_required: {
                required: true,
            },
            quantity: {
                required: true,
                min: 1
            },
            category_item_service: {
                required: true
            },
            b3_product: {
                required: false
            },
            reason: {
                required: true
            },
            type_of_payment: {
                required: false
            },
            order_type: {
                required: true
            },
            'attachment[]': {
                required: true
            },
            pic_maintenance: {
                required: true
            },
            manager_maintenance: {
                required: true
            },
            g_manager_maintenance: {
                required: true
            },
            approved_by: {
                required: false
            },
            department: {
                required: true
            }
        },
        messages: {
            register_no: {
                required: "Please enter a register no",
                remote: "Register No already exist"
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
        },
        submitHandler: function(form) {
            var selectedMaterialTable = $('#selected_material_table').DataTable();

            // Check if the selected_material_table is empty
            if (selectedMaterialTable.rows().count() === 0) {
                alert('List material cannot be empty. Please select at least one item.');
                return;
            }

            var formData = $(form).serializeArray();

            var material_data = [];

            // Loop through each row in the DataTable
            selectedMaterialTable.rows().every(function() {
                var rowNode = this.node();

                var materialCode = $(rowNode).find('td:nth-child(2) input, .code_material')
                    .length ?
                    $(rowNode).find('td:nth-child(2) input').val().trim() :
                    $(rowNode).find('td:nth-child(2)').text().trim();

                var itemDescription = $(rowNode).find(
                        'td:nth-child(3) input, .item_description').length ?
                    $(rowNode).find('td:nth-child(3) input').val().trim() :
                    $(rowNode).find('td:nth-child(3)').text().trim();

                var quantity = $(rowNode).find('.quantity').val().trim();

                var uom = $(rowNode).find(
                        'td:nth-child(3) input, .uom').length ?
                    $(rowNode).find('td:nth-child(5) input').val().trim() :
                    $(rowNode).find('td:nth-child(5)').text().trim();

                var eta = $(rowNode).find('.eta').val().trim();
                var category_req = $(rowNode).find('.category_req').val().trim();

                // Get User and For values
                var user = $(rowNode).find('.user').val().trim();
                var forValue = $(rowNode).find('.for').val().trim();

                // Construct an object with the collected data
                var material = {
                    material_code: materialCode,
                    item_description: itemDescription,
                    quantity: quantity,
                    uom: uom,
                    eta: eta,
                    category_req: category_req,
                    remark: {
                        user: user,
                        for: forValue
                    }
                };

                // Push the material object into material_data array
                material_data.push(material);
            });




            // Add material_data to formData
            formData.push({
                name: 'material_data',
                value: JSON.stringify(material_data) // Convert to JSON string
            });

            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: formData,
                dataType: 'json',
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
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    toastr.error(error);
                }
            });
        }
    });
});
</script>