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
                    <form action="<?= site_url('admin/save_update_req_order'); ?>" id="form-add-req-order"
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="regist_no">Regist No</label>
                                        <input type="text" name="regist_no" id="regist_no" class="form-control"
                                            value="<?= $data_req_order->regist_no; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="register_no">Register No</label>
                                        <input type="text" class="form-control" id="register_no" name="register_no"
                                            placeholder="Enter Register No"
                                            value="<?= $data_req_order->register_no; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date Required</label>
                                        <input type="date" class="form-control" id="date_required" name="date_required"
                                            value="<?= $data_req_order->date_required; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <!-- <input type="text" class="form-control" id="department" name="department"
                                            value="<?= $data_req_order->department; ?>"> -->
                                        <select class="form-control" name="department" id="department">
                                            <option value="">- Select Department -</option>
                                            <?php
                                            $departments = [
                                                'MAINTENANCE'               => 'MAINTENANCE',
                                                'PRODUCTION ASM'            => 'PRODUCTION-ASM',
                                                'PRODUCTION MCH'            => 'PRODUCTION-MCH',
                                                'MANUFACTURING ENGINEERING' => 'MANUFACTURING ENGINEERING',
                                                'QUALITY CONTROL'           => 'QUALITY CONTROL',
                                                'PPC'                       => 'PPC',
                                                'GA'                        => 'GA'
                                            ];
                                            foreach ($departments as $key => $value) {
                                                $selected = ($data_req_order->department == $key) ? 'selected' : '';
                                                echo "<option value=\"$key\" $selected>$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_item_service">Category Item/Service</label>
                                        <input type="text" class="form-control" id="category_item_service"
                                            name="category_item_service" placeholder="Enter Category Item/Service"
                                            value="<?= $data_req_order->category_item_service; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="b3_product"> B3 Product</label>
                                        <select class="form-control" name="b3_product" id="b3_product">
                                            <option value="" <?= $data_req_order->b3_product == "" ? "selected" : "" ?>>
                                                - Select B3 Product -</option>
                                            <option value="YES"
                                                <?= $data_req_order->b3_product == "YES" ? "selected" : "" ?>>YES
                                            </option>
                                            <option value="NO"
                                                <?= $data_req_order->b3_product == "NO" ? "selected" : "" ?>>NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reason">Reason</label>
                                        <input type="text" class="form-control" id="reason" name="reason"
                                            placeholder="Enter Reason" value="<?= $data_req_order->reason; ?>">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="date_created">Date Created</label> -->
                                        <input type="hidden" class="form-control" name="date_created" id="date_created"
                                            value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="level_of_request">Level Of Request</label>
                                        <input type="text" class="form-control" id="level_of_request"
                                            name="level_of_request" placeholder="Enter Level Of Request"
                                            value="<?= $data_req_order->level_of_request; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="type_of_payment">Type Of Payment</label>
                                        <select class="form-control" name="type_of_payment" id="type_of_payment">
                                            <option value=""
                                                <?= $data_req_order->type_of_payment == "" ? "selected" : "" ?>>- Select
                                                Type Of Payment -</option>
                                            <option value="SUSPEND"
                                                <?= $data_req_order->type_of_payment == "SUSPEND" ? "selected" : "" ?>>
                                                SUSPEND</option>
                                            <option value="REIMBUES"
                                                <?= $data_req_order->type_of_payment == "REIMBUES" ? "selected" : "" ?>>
                                                REIMBUES</option>
                                            <option value="DUE PAYMENT"
                                                <?= $data_req_order->type_of_payment == "DUE PAYMENT" ? "selected" : "" ?>>
                                                DUE PAYMENT</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="order_type">Order Type</label>
                                        <select class="form-control" name="order_type" id="order_type">
                                            <option value="" <?= $data_req_order->order_type == "" ? "selected" : "" ?>>
                                                - Select Order Type -</option>
                                            <option value="FEASIBILITY STUDY"
                                                <?= $data_req_order->order_type == "FEASIBILITY STUDY" ? "selected" : "" ?>>
                                                FEASIBILITY STUDY</option>
                                            <option value="ORDER"
                                                <?= $data_req_order->order_type == "ORDER" ? "selected" : "" ?>>ORDER
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="attachment">Attachment</label>
                                        <select class="form-control select2" multiple="multiple" name="attachment[]"
                                            id="attachment" placeholder="Select Attachment">
                                            <?php
                                            $attachments = explode(', ', $data_req_order->attachment);
                                            $options = [
                                                "ESR", "DRAWING", "SAMPLE BARANG", "FORECAST / DATA STOCK",
                                                "BOM", "SERVICE REPORT", "PICTURE / PHOTOS OF ITEM",
                                                "CATALOG", "COPY OF LAST PO", "QUOTATION", "SCHEDULE (PROJECT)"
                                            ];
                                            foreach ($options as $option) {
                                                $selected = in_array($option, $attachments) ? "selected" : "";
                                                echo "<option value=\"$option\" $selected>$option</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noted">Noted (Alasan Pembelian)</label>
                                        <input class="form-control" type="text" name="noted" id="noted"
                                            placeholder="Masukan Alasan Pembelian"
                                            value="<?= $data_req_order->noted; ?>">
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="requester_name">Requester's Name</label>
                                        <input class="form-control" type="text" name="requester_name"
                                            id="requester_name" placeholder="Masukan Alasan Pembelian"
                                            value="<?= $data_req_order->requester_name; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_ppbj">NO PPBJ</label>
                                        <input class="form-control" type="text" name="no_ppbj" id="no_ppbj"
                                            placeholder="Masukan Alasan Pembelian"
                                            value="<?= $data_req_order->no_ppbj; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status_ppbj">Status PPBJ</label>
                                        <input class="form-control" type="text" name="status_ppbj" id="status_ppbj"
                                            placeholder="Masukan Alasan Pembelian"
                                            value="<?= $data_req_order->status_ppbj; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_sr">NO SR</label>
                                        <input class="form-control" type="text" name="no_sr" id="no_sr"
                                            placeholder="Masukan Alasan Pembelian"
                                            value="<?= $data_req_order->no_sr; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status_sr">Status SR</label>
                                        <input class="form-control" type="text" name="status_sr" id="status_sr"
                                            placeholder="Masukan Alasan Pembelian"
                                            value="<?= $data_req_order->status_sr; ?>">
                                    </div>
                                </div>
                            </div> -->
                            <hr>
                            <h3>Created And Approved</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pic_maintenance">Created By PIC</label>
                                        <input class="form-control" type="text" name="pic_maintenance"
                                            id="pic_maintenance" placeholder="PIC Maintenance"
                                            value="<?= $data_req_order->created_by_pic; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="manager_maintenance">Approved By Manager</label>
                                        <input class="form-control" type="text" name="manager_maintenance"
                                            id="manager_maintenance" placeholder="Manager Maintenance"
                                            value="<?= $data_req_order->approved_by_manager; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="g_manager_maintenance">Approved By G.Manager</label>
                                        <input class="form-control" type="text" name="g_manager_maintenance"
                                            id="g_manager_maintenance" placeholder="General Manager Maintenance"
                                            value="<?= $data_req_order->approved_by_general_manager; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="approved_by">Received By</label>
                                        <input class="form-control" type="text" name="approved_by" id="approved_by"
                                            placeholder="Approved By" value="<?= $data_req_order->approved_by; ?>">
                                    </div>
                                </div>
                            </div>
                            <hr>
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
                                        <th>No PPBJ</th>
                                        <th>Status PPBJ</th>
                                        <th>No SR</th>
                                        <th>Status SR</th>
                                        <th>No PR</th>
                                        <th>Status PR</th>
                                        <th>No PO</th>
                                        <th>Status PO</th>
                                        <th>Jugdment</th>
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
                            <a type="button" class="btn btn-danger" href="<?= base_url('admin/req_order') ?>"
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

    $('#department').change(function(e) {
        e.preventDefault();

        var department = $(this).val();

        if (department === "") {
            $('#register_no').val('');
            return;
        }

        $.ajax({
            url: '<?= site_url('admin/generate_no_ppbj'); ?>', // Replace with the URL to your PHP function
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

    });

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

    var selectedMaterialTable = $('#selected_material_table').DataTable({
        "scrollX": true,
        "responsive": false,
        "lengthChange": true,
        "autoWidth": false,
        "ajax": {
            "url": "<?= site_url('admin/get_list_material_req_order_by_regist_no'); ?>",
            "type": "POST",
            "data": function(d) {
                d.regist_no = <?= json_encode($data_req_order->regist_no); ?>;
            },
            "dataSrc": "data" // Menyesuaikan dengan struktur respons JSON dari server
        },
        "columns": [{
                "data": null,
                "title": "No",
                "render": function(data, type, row, meta) {
                    return meta.row + 1; // Index column, populated by DataTables
                }
            },
            {
                "data": "code_material",
                "title": "Code Material"
            },
            {
                "data": "item_description",
                "title": "Item Description",
                "render": function(data, type, row) {
                    if (row == null) {
                        return '<input type="text" class="form-control item_description" name="item_description[]" style="width: 200px;">';
                    } else {
                        return '<input type="text" class="form-control item_description" name="item_description[]" value="' +
                            row.item_description + '"style="width: 200px;">';
                    }
                }
            },
            {
                "data": "quantity",
                "title": "Quantity",
                "render": function(data, type, row) {
                    return '<input type="number" class="form-control quantity" name="quantity[]" value="' +
                        row.quantity + '" min="1" style="width: 75px;">';
                }
            },
            {
                "data": "uom",
                "title": "UOM",
                "render": function(data, type, row) {
                    if (row === null) {
                        return '<input type="text" class="form-control uom" name="uom[]" style="width: 80px;">';
                    } else {
                        return '<input type="text" class="form-control uom" name="uom[]" value="' +
                            row.uom + '"style="width: 80px;">';
                    }
                }
            },
            {
                "data": "eta",
                "title": "ETA",
                "render": function(data, type, row) {
                    return '<input type="date" class="form-control eta" name="eta[]" style="width: 150px;" value="' +
                        row.eta + '" placeholder="Enter ETA">';
                }
            },
            {
                "data": "category_req",
                "title": "Category Req (R.Order, New)",
                "render": function(data, type, row) {
                    return '<input type="text" class="form-control category_req" name="category_req[]" style="width: 200px;" value="' +
                        row.category_req + '" placeholder="Input RO">';
                }
            },
            {
                "data": null,
                "title": "Remark",
                "render": function(data, type, row) {
                    var userValue = row.remark_user ? row.remark_user : '';
                    var forValue = row.remark_for ? row.remark_for : '';

                    return '<input type="text" class="form-control user" name="user[]" style="width: 200px;" value="' +
                        userValue + '" placeholder="USER">' +
                        '<input type="text" class="form-control for" name="for[]" style="width: 200px;" value="' +
                        forValue + '" placeholder="FOR">';
                }
            },
            {
                "data": null,
                "title": "NO PPBJ",
                "render": function(data, type, row) {
                    var value = row.no_ppbj || '';
                    return '<input type="text" class="form-control noppbj" name="noppbj[]" style="width: 200px;" value="' +
                        value + '" placeholder="NO PPBJ" readonly>';
                }
            },
            {
                "data": null,
                "title": "Status PPBJ",
                "render": function(data, type, row) {
                    var value = row.status_ppbj || '';
                    return '<input type="text" class="form-control statusppbj" name="statusppbj[]" style="width: 200px;" value="' +
                        value + '" placeholder="STATUS PPBJ" readonly>';
                }
            },
            {
                "data": null,
                "title": "NO SR",
                "render": function(data, type, row) {
                    var value = row.no_sr || '';
                    return '<input type="text" class="form-control nosr" name="nosr[]" style="width: 200px;" value="' +
                        value + '" placeholder="NO SR" readonly>';
                }
            },
            {
                "data": null,
                "title": "Status SR",
                "render": function(data, type, row) {
                    var value = row.status_sr || '';
                    return '<input type="text" class="form-control statussr" name="statussr[]" style="width: 200px;" value="' +
                        value + '" placeholder="STATUS SR" readonly>';
                }
            },
            {
                "data": null,
                "title": "NO PR",
                "render": function(data, type, row) {
                    var value = row.no_pr || '';
                    return '<input type="text" class="form-control nopr" name="nopr[]" style="width: 200px;" value="' +
                        value + '" placeholder="NO PR" readonly>';
                }
            },
            {
                "data": null,
                "title": "Status PR",
                "render": function(data, type, row) {
                    var value = row.status_pr || '';
                    return '<input type="text" class="form-control statuspr" name="statuspr[]" style="width: 200px;" value="' +
                        value + '" placeholder="STATUS PR" readonly>';
                }
            },
            {
                "data": null,
                "title": "NO PO",
                "render": function(data, type, row) {
                    var value = row.no_po || '';
                    return '<input type="text" class="form-control nopo" name="nopo[]" style="width: 200px;" value="' +
                        value + '" placeholder="NO PO" readonly>';
                }
            },
            {
                "data": null,
                "title": "Status PO",
                "render": function(data, type, row) {
                    var value = row.status_po || '';
                    return '<input type="text" class="form-control statuspo" name="statuspo[]" style="width: 200px;" value="' +
                        value + '" placeholder="STATUS PO" readonly>';
                }
            },
            {
                "data": null,
                "title": "Status Jugdment",
                "render": function(data, type, row) {
                    var value = row.jugdment || '';
                    return '<input type="text" class="form-control jugdment" name="jugdment[]" style="width: 200px;" value="' +
                        value + '" placeholder="Jugdment" readonly>';
                }
            },
            {
                "data": null,
                "className": "text-center",
                "orderable": false,
                "render": function(data, type, row, meta) {
                    return '<button class="btn btn-danger btn-cancel-part btn-sm" data-row-id="' +
                        meta.row + '"><i class="fas fa-times"></i></button>';
                }
            }
        ],
        "order": [
            [0, 'asc']
        ], // Urutkan berdasarkan kolom pertama (code_material) secara default
    });



    $('#register_no').focus();

    $('#date_required').change(function(e) {
        var date = $(this).val();

        // Set nilai ETA di setiap baris tabel yang ada di #selected_material_table
        $('#selected_material_table').DataTable().rows().every(function() {
            var rowNode = this.node();
            $(rowNode).find('.eta').val(date);
        });
    });


    var rowNumber = 0;

    $(document).on('click', '#tbl_material_list .btn-select-part', function() {
        $(this).removeClass('btn-primary').addClass('btn-success');
        var row = $(this).closest('tr');
        var materialCode = row.find('td:nth-child(2)').text().trim();
        var specification = row.find('td:nth-child(3)').text().trim();
        var quantity = 1;
        var uom = row.find('td:nth-child(5)').text().trim();
        var date_required = $('#date_required').val();

        var no_ppbj = $('.noppbj').val();
        var status_ppbj = $('.statusppbj').val();

        var no_sr = $('.nosr').val();
        var status_sr = $('.statussr').val();

        var no_pr = $('.nopr').val();
        var status_pr = $('.statuspr').val();

        var no_po = $('.nopo').val();
        var status_po = $('.statuspo').val();

        var jugdment = $('.jugdment').val();

        // Dapatkan instance DataTable dari #selected_material_table
        var selectedMaterialTable = $('#selected_material_table').DataTable();

        // Cari apakah materialCode sudah ada di selected_material_table
        var existingRow = selectedMaterialTable.rows().nodes().toArray().find(function(node) {
            return $(node).find('td:nth-child(2)').text().trim() === materialCode;
        });

        // if (existingRow) {
        //     alert('Item already selected.');
        // } else {
        // Menambahkan baris ke tabel jika belum ada
        if (selectedMaterialTable.rows().count() < 10) {
            var newRowData = {
                "code_material": materialCode,
                "item_description": specification,
                "quantity": quantity,
                "uom": uom,
                "eta": date_required,
                "category_req": '',
                "remark": '',
                "no_ppbj": no_ppbj,
                "status_ppbj": status_ppbj,
                "no_sr": '',
                "status_sr": '',
                "no_pr": '',
                "status_pr": '',
                "no_po": '',
                "status_po": '',
                "jugdment": '',
                "cancel": '<center><button class="btn btn-danger btn-cancel-part btn-sm"><i class="fas fa-times"></i></button></center>'
            };

            // Tambahkan baris baru ke DataTable
            selectedMaterialTable.row.add(newRowData).draw();
        } else {
            alert('Maximum 10 rows reached.');
        }
        // }
    });


    $(".btn-add-row").click(function() {
        var selectedMaterialTable = $('#selected_material_table').DataTable();
        var date_required = $('#date_required').val()
        var no_ppbj = $('.noppbj').val();
        var status_ppbj = $('.statusppbj').val();
        rowNumber++; // Increment row number
        var newRow = {
            'code_material': 'JASA',
            'item_description': '',
            'quantity': 1,
            'uom': '',
            'eta': date_required,
            'category_req': '',
            'remark': '',
            "no_ppbj": no_ppbj,
            'status_ppbj': status_ppbj,
            'cancel': '<center><button class="btn btn-danger btn-cancel-part btn-sm"><i class="fas fa-times"></i></button></center>'
        };
        var addedRow = selectedMaterialTable.row.add(newRow).draw().node();
    });



    $('#selected_material_table').on('click', '.btn-cancel-part', function() {
        var selectedMaterialTable = $('#selected_material_table').DataTable();
        var row = $(this).closest('tr');
        selectedMaterialTable.row(row).remove().draw();

        // Update nomor urutan setelah penghapusan
        selectedMaterialTable.rows().every(function(idx) {
            $(this.node()).find('td:eq(0)').html(idx + 1);
        });

        // Cari tombol btn-select-part yang sesuai dengan materialCode yang dihapus
        var materialCode = row.find('td:nth-child(2)').text().trim();
        var btnSelectPart = $('#tbl_material_list').find('td:contains("' + materialCode + '")')
            .siblings('.text-center').find('.btn-select-part');

        // Ubah warna tombol kembali ke btn-primary
        btnSelectPart.removeClass('btn-success').addClass('btn-primary');
    });



    $('#date_required').change(function(e) {
        e.preventDefault();

        var date_created = new Date($('#date_created').val());
        var date_required = new Date($(this).val());

        var timeDiff = Math.abs(date_required.getTime() - date_created.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        if (diffDays <= 7) {
            $('#level_of_request').val('EMERGENCY');
        } else if (diffDays > 7 && diffDays <= 25) {
            $('#level_of_request').val('URGENT');
        } else {
            $('#level_of_request').val('NORMAL');
        }
    });

    $.ajax({
        url: "<?php echo base_url('admin/material_list'); ?>",
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
                //     url: "<?= site_url('admin/check_register_no') ?>",
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
                required: true
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

                var no_ppbj = $(rowNode).find('.noppbj').val().trim();
                var status_ppbj = $(rowNode).find('.statusppbj').val().trim();

                var no_sr = $(rowNode).find('.nosr').val().trim();
                var status_sr = $(rowNode).find('.statussr').val().trim();

                var no_pr = $(rowNode).find('.nopr').val().trim();
                var status_pr = $(rowNode).find('.statuspr').val().trim();

                var no_po = $(rowNode).find('.nopo').val().trim();
                var status_po = $(rowNode).find('.statuspo').val().trim();

                var jugdment = $(rowNode).find('.jugdment').val().trim();

                // Construct an object with materialCode, quantity, and categoryReq (User and For)
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
                    },
                    no_ppbj: no_ppbj,
                    status_ppbj: status_ppbj,
                    no_sr: no_sr,
                    status_sr: status_sr,
                    no_pr: no_pr,
                    status_pr: status_pr,
                    no_po: no_po,
                    status_po: status_po,
                    jugdment: jugdment
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
                            window.location.href =
                                "<?= site_url('admin/req_order'); ?>";
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