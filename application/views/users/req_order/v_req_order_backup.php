<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/toastr/toastr.min.css">
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
        <style>
        .status-on-progress {
            background-color: #007bff;
            color: white;
            /* padding: 5px 10px;
        border-radius: 5px;
        display: inline-block; */
        }

        .status-cancel {
            background-color: red;
            color: white;
        }

        .status-delay {
            background-color: yellow;
            color: black;
        }

        .status-done {
            background-color: green;
            color: white;
        }
        </style>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <a href="<?= site_url('users/add_req_order') ?>" class="btn btn-primary"><i
                            class="fas fa-plus mr-2"></i>Add Request Order Material</a>
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
                <table id="tbl_req_order" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>REGISTER NO</th>
                            <th>MATERIAL CODE</th>
                            <th>DESCRIPTION</th>
                            <th>QUANTITY ORDER</th>
                            <th>UOM</th>
                            <th>DATE CREATED</th>
                            <th>DATE REQUIRED</th>
                            <th>ORDER CLASSIFICATION</th>
                            <th>NAME OF REQUESTER</th>
                            <th>NOTE (ALASAN PEMBELIAN)</th>
                            <th>NO PPBJ</th>
                            <th>STATUS PPBJ</th>
                            <th>NO SR</th>
                            <th>STATUS SR</th>
                            <th>NO PR</th>
                            <th>STATUS PR</th>
                            <th>NO PO</th>
                            <th>STATUS PO</th>
                            <th>JUGDMENT</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($req_order as $value) :
                            $status_ppbj_class = ($value->status_ppbj == 'ON PROGRESS') ? 'status-on-progress' : (($value->status_ppbj == 'CANCEL') ? 'status-cancel' : (($value->status_ppbj == 'DELAY') ? 'status-delay' : (($value->status_ppbj == 'DONE') ? 'status-done' : '')));

                            $status_sr_class = ($value->status_sr == 'ON PROGRESS') ? 'status-on-progress' : (($value->status_sr == 'CANCEL') ? 'status-cancel' : (($value->status_sr == 'DELAY') ? 'status-delay' : (($value->status_sr == 'DONE') ? 'status-done' : '')));

                            $status_pr_class = ($value->status_pr == 'ON PROGRESS') ? 'status-on-progress' : (($value->status_pr == 'CANCEL') ? 'status-cancel' : (($value->status_pr == 'DELAY') ? 'status-delay' : (($value->status_pr == 'DONE') ? 'status-done' : '')));

                            $status_po_class = ($value->status_po == 'ON PROGRESS') ? 'status-on-progress' : (($value->status_po == 'CANCEL') ? 'status-cancel' : (($value->status_po == 'DELAY') ? 'status-delay' : (($value->status_po == 'DONE') ? 'status-done' : '')));

                            $status_jugdment_class = ($value->jugdment == 'ON PROGRESS') ? 'status-on-progress' : (($value->jugdment == 'CANCEL') ? 'status-cancel' : (($value->jugdment == 'DELAY') ? 'status-delay' : (($value->jugdment == 'DONE') ? 'status-done' : '')));
                        ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $value->register_no; ?></td>
                            <td><?= $value->code_material ?></td>
                            <td><?= $value->item_description ?></td>
                            <td><?= $value->quantity ?></td>
                            <td><?= $value->uom ?></td>
                            <td><?= $value->date_created ?></td>
                            <td><?= $value->date_required ?></td>
                            <td><?= $value->level_of_request ?></td>
                            <td><?= $value->requester_name ?></td>
                            <td><?= $value->noted ?></td>
                            <td><?= $value->no_ppbj ?></td>
                            <td class="<?= $status_ppbj_class ?>"><?= $value->status_ppbj ?></td>
                            <td><?= $value->no_sr ?></td>
                            <td class="<?= $status_sr_class ?>"><?= $value->status_sr ?></td>
                            <td><?= $value->no_pr ?></td>
                            <td class="<?= $status_pr_class ?>"><?= $value->status_pr ?></td>
                            <td><?= $value->no_po ?></td>
                            <td class="<?= $status_po_class ?>"><?= $value->status_po ?></td>
                            <td class="<?= $status_jugdment_class ?>"><?= $value->jugdment ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary btn-view" data-toggle="modal"
                                    data-target="#view-detail<?= $value->regist_no; ?>"
                                    data-register-no="<?= $value->register_no; ?>"
                                    data-regist-no="<?= $value->regist_no; ?>">
                                    <i class="fas fa-eye mr-2"></i>View
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php foreach ($req_order as $value) : ?>
<style>
/* CSS untuk menghilangkan spinner pada input type number */
input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}
</style>

<!-- Modal View Detail Request Order -->
<div class="modal fade" id="view-detail<?= $value->regist_no; ?>" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="view-detail<?= $value->regist_no; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="view-detail<?= $value->regist_no; ?>Label">Request Order Register No :
                    <?= $value->register_no; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <table class="table-1">
                            <tr>
                                <td>Register No</td>
                                <td>:</td>
                                <td><?= $value->register_no; ?></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>:</td>
                                <td><?= $value->date_required; ?></td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>:</td>
                                <td>MAINTENANCE</td>
                            </tr>
                            <tr>
                                <td>Category Item/Service</td>
                                <td>:</td>
                                <td><?= $value->category_item_service; ?></td>
                            </tr>
                            <tr>
                                <td>Reason</td>
                                <td>:</td>
                                <td><?= $value->reason; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="3">LEVEL OF REQUEST</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>EMERGENCY</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="level_of_request[]"
                                            value="ORDER"
                                            <?= ($value->level_of_request == 'EMERGENCY') ? 'checked' : ''; ?> disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>URGENT</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="level_of_request[]"
                                            value="ORDER"
                                            <?= ($value->level_of_request == 'URGENT') ? 'checked' : ''; ?> disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>NORMAL</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="level_of_request[]"
                                            value="ORDER"
                                            <?= ($value->level_of_request == 'NORMAL') ? 'checked' : ''; ?> disabled>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="3">TYPE OF PAYMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SUSPEND</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="type_of_payment[]"
                                            value="ORDER"
                                            <?= ($value->type_of_payment == 'SUSPEND') ? 'checked' : ''; ?> disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>REIMBUES</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="type_of_payment[]"
                                            value="ORDER"
                                            <?= ($value->type_of_payment == 'REIMBUES') ? 'checked' : ''; ?> disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DUE PAYMENT</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="type_of_payment[]"
                                            value="ORDER"
                                            <?= ($value->type_of_payment == 'DUE PAYMENT') ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="3">ORDER TYPE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>FEASIBILITY STUDY</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="order_type[]" value="ORDER"
                                            <?= ($value->order_type == 'FEASIBILITY STUDY') ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ORDER</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="order_type[]" value="ORDER"
                                            <?= ($value->order_type == 'ORDER') ? 'checked' : ''; ?> disabled>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered nowrap table-striped"
                        id="table-detail-req-order<?= $value->regist_no; ?>">
                        <thead style="font-size:15px">
                            <tr>
                                <th>NO</th>
                                <th>CODE MATERIAL</th>
                                <th>ITEM DESCRIPTION</th>
                                <th>QTY</th>
                                <th>UOM</th>
                                <th>ETA</th>
                                <th>CATEGORY REQ</th>
                                <th>REMARK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data rows will be added dynamically -->
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="3">B3 Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>YES</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="b3_product[]" value="ORDER"
                                            <?= ($value->b3_product == 'YES') ? 'checked' : ''; ?> disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>NO</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="b3_product[]" value="ORDER"
                                            <?= ($value->b3_product == 'NO') ? 'checked' : ''; ?> disabled>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="3">Attachment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ESR</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]" value="ESR"
                                            <?= (in_array('ESR', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DRAWING</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]" value="DRAWING"
                                            <?= (in_array('DRAWING', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SAMPLE BARANG</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="SAMPLE BARANG"
                                            <?= (in_array('SAMPLE BARANG', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>FORECAST / DATA STOCK</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="FORECAST / DATA STOCK"
                                            <?= (in_array('FORECAST / DATA STOCK', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BOM</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]" value="BOM"
                                            <?= (in_array('BOM', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="3">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SERVICE REPORT</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="SERVICE REPORT"
                                            <?= (in_array('SERVICE REPORT', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PICTURE / PHOTOS OF ITEM</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="PICTURE / PHOTOS OF ITEM"
                                            <?= (in_array('PICTURE / PHOTOS OF ITEM', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CATALOG</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]" value="CATALOG"
                                            <?= (in_array('CATALOG', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>COPY OF LAST PO</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="COPY OF LAST PO"
                                            <?= (in_array('COPY OF LAST PO', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>QUOTATION</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="QUOTATION"
                                            <?= (in_array('QUOTATION', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="3">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SCHEDULE (PROJECT)</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="SCHEDULE (PROJECT)"
                                            <?= (in_array('SCHEDULE (PROJECT)', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="width: 15rem; margin: 5px;">
                            <div class="card-body">
                                <h5 class="card-title">Created By</h5>
                                <p class="card-text">
                                    Date : <?= $value->date_created; ?>
                                </p>
                                <br>
                                <span class="card-link"><?= $value->created_by_pic; ?></span>
                                <br>
                                <span class="card-link">User Maintenance</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 15rem; margin: 5px;">
                            <div class="card-body">
                                <h5 class="card-title">Approved By</h5>
                                <p class="card-text">
                                    Date : <?= $value->date_created; ?>
                                </p>
                                <br>
                                <span class="card-link"><?= $value->approved_by_manager; ?></span>
                                <br>
                                <span class="card-link">Manager Dept MTN</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 15rem; margin: 5px;">
                            <div class="card-body">
                                <h5 class="card-title">Approved By</h5>
                                <p class="card-text">
                                    Date : <?= $value->date_created; ?>
                                </p>
                                <br>
                                <span class="card-link"><?= $value->approved_by_general_manager; ?></span>
                                <br>
                                <span class="card-link">General Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="width: 15rem; margin: 5px;">
                            <div class="card-body">
                                <h5 class="card-title">Received By</h5>
                                <p class="card-text">
                                    Date : <?= $value->date_created; ?>
                                </p>
                                <br>
                                <span class="card-link"><?= $value->approved_by; ?></span>
                                <br>
                                <span class="card-link">&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a target="_blank" href="<?= site_url('users/print_req_order/' . $value->regist_no); ?>"
                    class="btn btn-info"><i class="fas fa-print mr-2"></i> Print Req Order</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- jquery-validation -->
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/additional-methods.min.js"></script>

<script src="<?= base_url('assets/template/') ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    $('.btn-print-view').click(function(e) {
        e.preventDefault();

        var register_no = $(this).data('register-no');

        $.ajax({
            type: "POST",
            url: "<?= site_url('users/print_req_order/'); ?>" + register_no,
            success: function(response) {
                // Lakukan sesuatu dengan respons dari server
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan jika terjadi
            }
        });

    });

    $("#tbl_req_order").DataTable({
        "scrollX": true,
        "responsive": false,
        "lengthChange": true,
        "autoWidth": false,
        "bStateSave": true,
        paging:true,
        scrollCollapse:true,
        scrollY: '86vh',
        "fnStateSave": function(oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function(oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        },
        // select: {
        //     selected: false,
        //     style: 'multi'
        // },
        "buttons": [{
                extend: "excel",
                text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                className: 'btn-success',
                title: '',
                exportOptions: {
                    stripHtml: false,
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                        18, 19
                    ], // Indeks kolom yang ingin dicetak
                },
            },
            {
                extend: "print",
                text: '<i class="fas fa-print mr-2"></i> PRINT',
                className: 'btn-info',
                title: '',
                autoPrint: false,
                exportOptions: {
                    stripHtml: false,
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                        18, 19
                    ], // Indeks kolom yang ingin dicetak
                },
            },
            // {
            //     text: '<i class="fas fa-print mr-2"></i> Print Req Order',
            //     className: 'btn-info',
            //     action: function(e, dt, node, config) {
            //         $('.swalDefaultWarning').click(function() {
            //             Toast.fire({
            //                 icon: 'warning',
            //                 title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //             });
            //         });

            //         // Mengambil data terpilih dari tabel
            //         var selectedRows = dt.rows({
            //             selected: true
            //         }).data();

            //         // Mengumpulkan semua nilai id_req_order dari setiap baris yang dipilih
            //         var selectedReqOrders = [];

            //         selectedRows.each(function(row) {
            //             selectedReqOrders.push(row[
            //                 1]); // Pastikan ini adalah kolom yang berisi id_req_order
            //         });

            //         if (selectedReqOrders.length === 0) {
            //             toastr.info('Tidak Ada Data Yang Dipilih');
            //             return;
            //         }

            //         $.ajax({
            //             type: "POST",
            //             url: "<?= site_url('users_controller/post_to_print_req_order') ?>",
            //             data: {
            //                 id_req_order: selectedReqOrders
            //             },
            //             dataType: "json",
            //             success: function(response) {
            //                 console.log(response); // Data respons dari server
            //                 if (response.success == true) {
            //                     var pdfUrl =
            //                         '<?= site_url('users_controller/print_req_order') ?>';
            //                     window.open(pdfUrl, '_blank');
            //                 } else {
            //                     console.log(response
            //                         .message); // Pesan kesalahan jika ada
            //                 }
            //             },
            //             error: function(xhr, status, error) {
            //                 console.error(xhr
            //                     .responseText); // Tangani kesalahan jika terjadi
            //             }
            //         });
            //     }
            // }

        ]
    }).buttons().container().appendTo('#tbl_req_order_wrapper .col-md-6:eq(0)');


    <?php foreach ($req_order as $value) : ?>

    //----------------------------------- Update PPBJ
    $('#modal-update-ppbj<?= $value->id_req_order ?>').on('shown.bs.modal', function() {
        $(this).find('#no_ppbj<?= $value->id_req_order ?>').focus();
        $('#status_ppbj<?= $value->id_req_order ?>').select2({
            theme: 'bootstrap4'
        });

        $('#status_ppbj<?= $value->id_req_order ?>').change(function(e) {
            e.preventDefault();
            $(this).valid();
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
                                },
                                1500
                            ); // Penundaan selama 2000 milidetik (2 detik)
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
        $('#form-update-ppbj<?= $value->id_req_order ?>').validate({
            rules: {
                no_ppbj: {
                    required: true,
                },
                status_ppbj: {
                    required: true,
                },
            },
            messages: {
                no_ppbj: {
                    required: "Please enter no ppbj",
                },
                status_ppbj: {
                    required: "Please select status ppbj",
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

    //----------------------------------- Update SR
    $('#modal-update-sr<?= $value->id_req_order ?>').on('shown.bs.modal', function() {
        $(this).find('#no_sr<?= $value->id_req_order ?>').focus();
        $('#status_sr<?= $value->id_req_order ?>').select2({
            theme: 'bootstrap4'
        });

        $('#status_sr<?= $value->id_req_order ?>').change(function(e) {
            e.preventDefault();
            $(this).valid();
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
                                },
                                1500
                            ); // Penundaan selama 2000 milidetik (2 detik)
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
        $('#form-update-sr<?= $value->id_req_order ?>').validate({
            rules: {
                no_sr: {
                    required: true,
                },
                status_sr: {
                    required: true,
                },
            },
            messages: {
                no_sr: {
                    required: "Please enter no sr",
                },
                status_sr: {
                    required: "Please select status sr",
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

    //----------------------------------- Update PR
    $('#modal-update-pr<?= $value->id_req_order ?>').on('shown.bs.modal', function() {
        $(this).find('#no_pr<?= $value->id_req_order ?>').focus();
        $('#status_pr<?= $value->id_req_order ?>').select2({
            theme: 'bootstrap4'
        });

        $('#status_pr<?= $value->id_req_order ?>').change(function(e) {
            e.preventDefault();
            $(this).valid();
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
                                },
                                1500
                            ); // Penundaan selama 2000 milidetik (2 detik)
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
        $('#form-update-pr<?= $value->id_req_order ?>').validate({
            rules: {
                no_pr: {
                    required: true,
                },
                status_pr: {
                    required: true,
                },
            },
            messages: {
                no_pr: {
                    required: "Please enter no pr",
                },
                status_pr: {
                    required: "Please select status pr",
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


    //----------------------------------- Update PO
    $('#modal-update-po<?= $value->id_req_order ?>').on('shown.bs.modal', function() {
        $(this).find('#no_po<?= $value->id_req_order ?>').focus();
        $('#status_po<?= $value->id_req_order ?>').select2({
            theme: 'bootstrap4'
        });

        $('#status_po<?= $value->id_req_order ?>').change(function(e) {
            e.preventDefault();
            $(this).valid();
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
                                },
                                1500
                            ); // Penundaan selama 2000 milidetik (2 detik)
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
        $('#form-update-po<?= $value->id_req_order ?>').validate({
            rules: {
                no_po: {
                    required: true,
                },
                status_po: {
                    required: true,
                },
            },
            messages: {
                no_po: {
                    required: "Please enter no po",
                },
                status_po: {
                    required: "Please select status po",
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

    //----------------------------------- Update Jugdment
    $('#modal-update-jugdment<?= $value->id_req_order ?>').on('shown.bs.modal', function() {
        $(this).find('#no_jugdment<?= $value->id_req_order ?>').focus();
        $('#status_jugdment<?= $value->id_req_order ?>').select2({
            theme: 'bootstrap4'
        });

        $('#status_jugdment<?= $value->id_req_order ?>').change(function(e) {
            e.preventDefault();
            $(this).valid();
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
                                },
                                1500
                            ); // Penundaan selama 2000 milidetik (2 detik)
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
        $('#form-update-jugdment<?= $value->id_req_order ?>').validate({
            rules: {
                status_jugdment: {
                    required: true,
                },
            },
            messages: {
                status_jugdment: {
                    required: "Please select status jugdment",
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

    <?php endforeach; ?>


    //-------------------------------------------------- Delete --------------------------------------------------\\
    $(document).on('click', 'button[data-id-req-order]', function() {
        var id_req_order = $(this).data('id-req-order');
        var regist_no = $(this).data('regist-no');

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
                    url: '<?= site_url('users/delete_req_order') ?>',
                    data: {
                        id_req_order: id_req_order,
                        regist_no: regist_no
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: response.message,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
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
    $('#tbl_req_order').on('draw.dt', function() {
        console.log('Tabel ditarik ulang');
        $('.btn-view').click(function(e) {
            e.preventDefault();

            var register_no = $(this).data('register-no');
            var regist_no = $(this).data('regist-no');

            $.ajax({
                type: "POST",
                url: "<?= site_url('users/get_req_order_by_register_no'); ?>",
                data: {
                    register_no: register_no,
                    regist_no: regist_no
                },
                dataType: "JSON",
                success: function(response) {
                    console.log(
                        response
                    ); // Tambahkan ini untuk memeriksa respons dari server di console browser
                    var tablebody = $('#table-detail-req-order' + regist_no +
                        ' tbody'); // Perbaiki selector untuk tbody
                    tablebody.empty();
                    $.each(response, function(index, item) {
                        tablebody.append('<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + item.code_material + '</td>' +
                            '<td>' + item.item_description + '</td>' +
                            '<td>' + item.quantity + '</td>' +
                            '<td>' + item.uom + '</td>' +
                            '<td>' + item.eta + '</td>' +
                            '<td>' + item.category_req + '</td>' +
                            '<td>' + item.remark_user +
                            '<br/>' +
                            item.remark_for + '</td>' +
                            // Tambahkan data lain sesuai kebutuhan
                            '</tr>');
                    });
                    $('#view-detail' + regist_no).modal(
                        'show'); // Perbaiki ID modal
                },
                error: function(xhr, status, error) {
                    console.error(xhr
                        .responseText); // Tambahkan error handling jika diperlukan
                }
            });
        });
    });
    // Fungsi untuk menampilkan detail saat tombol view diklik
    function showDetail(register_no, regist_no) {
        // Mencegah perilaku default dari tombol
        var pageInfo = $('#tbl_req_order').DataTable().page.info();
        var page = pageInfo.page; // Halaman saat ini (dimulai dari 0)

        $.ajax({
            type: "POST",
            url: "<?= site_url('users/get_req_order_by_register_no'); ?>",
            data: {
                register_no: register_no,
                regist_no: regist_no,
                page: page // Mengirim informasi halaman ke server
            },
            dataType: "JSON",
            success: function(response) {
                console.log(response);
                var tablebody = $('#table-detail-req-order' + regist_no + ' tbody');
                tablebody.empty();
                $.each(response, function(index, item) {
                    tablebody.append('<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + item.code_material + '</td>' +
                        '<td>' + item.item_description + '</td>' +
                        '<td>' + item.quantity + '</td>' +
                        '<td>' + item.uom + '</td>' +
                        '<td>' + item.eta + '</td>' +
                        '<td>' + item.category_req + '</td>' +
                        '<td>' + item.remark_user +
                        '<br/>' +
                        item.remark_for + '</td>' +
                        '</tr>');
                });
                $('#view-detail' + regist_no).modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle error jika diperlukan
            }
        });
    }

    // Event handler untuk setiap kali tabel ditarik ulang
    $('#tbl_req_order').on('draw.dt', function() {
        console.log('Tabel ditarik ulang');

        // Menghapus event listener sebelumnya untuk menghindari penambahan ganda
        $('.btn-view').off('click').on('click', function(e) {
            e.preventDefault(); // Mencegah perilaku default dari tombol
            var register_no = $(this).data('register-no');
            var regist_no = $(this).data('regist-no');

            // Memanggil fungsi untuk menampilkan detail
            showDetail(register_no, regist_no);
        });
    });

    // Memanggil fungsi untuk menampilkan detail saat halaman pertama kali dimuat
    $('.btn-view').click(function(e) {
        e.preventDefault(); // Mencegah perilaku default dari tombol
        var register_no = $(this).data('register-no');
        var regist_no = $(this).data('regist-no');

        // Memanggil fungsi untuk menampilkan detail
        showDetail(register_no, regist_no);
    });

});
</script>