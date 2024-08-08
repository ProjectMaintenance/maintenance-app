<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title_pdf; ?></title>
    <style>
    @media print {
        @page {
            size: A4 portrait;
            margin: 5mm;
            /* Sesuaikan margin sesuai kebutuhan */
            border: 0.5mm solid black;
            /* Tambahkan border di sekitar halaman */
            height: 100%;
            width: 100%;
        }

        .page {
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
            height: 100%;
            width: 100%;
        }

        body {
            margin: 0;
            height: 100%;
            padding: 5mm;
            /* Sesuaikan padding agar konten tidak terlalu dekat dengan border */
            font-family: tahoma;
            box-sizing: border-box;
            border: 1mm solid black;
            /* Border di luar halaman */
        }

        table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            text-align: center;
        }

        td {
            padding: 5px;
        }

        h1 {
            margin: 0;
            margin-bottom: 10px;
            font-size: 28px;
            font-family: tahoma;
            text-transform: uppercase;
            font-weight: bold;
        }

        .left-table h3,
        .center-table h3,
        .min-table h3,
        .bot-table h3 {
            margin: 0;
            font-size: 13px;
            text-align: left;
            padding: 0;
            margin-left: 10px;
            margin-top: 0px;
            font-weight: normal;
            width: 100%;
            font-family: tahoma;
        }

        .table-baru h3 {
            margin: 0;
            font-size: 13px;
            text-align: left;
            padding: 0;
            margin-left: 10px;
            /* Sesuaikan margin kiri */
            margin-top: 0px;
            font-weight: normal;
            width: 100%;
            font-family: tahoma;
        }

        .yes_b3 {
            float: right;
            margin-top: 0px;
            clear: both;
            /* Membersihkan float untuk menghindari overlay dengan elemen sebelumnya */
            margin-right: 810px;
            /* Atur jarak dari tepi kanan */
            font-weight: normal;
            font-family: tahoma;
        }

        .no_b3 {
            float: right;
            margin-top: -20px;
            clear: both;
            /* Membersihkan float untuk menghindari overlay dengan elemen sebelumnya */
            margin-right: 750px;
            /* Atur jarak dari tepi kanan */
            font-weight: normal;
            font-family: tahoma;
        }

        .service-report {
            float: right;
            margin-top: -110px;
            clear: both;
            /* Membersihkan float untuk menghindari overlay dengan elemen sebelumnya */
            margin-right: 600px;
            /* Atur jarak dari tepi kanan */
            font-weight: normal;
        }

        .picture {
            float: right;
            margin-top: -87px;
            clear: both;
            /* Membersihkan float untuk menghindari overlay dengan elemen sebelumnya */
            margin-right: 544px;
            /* Atur jarak dari tepi kanan */
            font-weight: normal;
            font-family: tahoma;
        }

        .catalog {
            float: right;
            margin-top: -64px;
            clear: both;
            /* Membersihkan float untuk menghindari overlay dengan elemen sebelumnya */
            margin-right: 641px;
            /* Atur jarak dari tepi kanan */
            font-weight: normal;
            font-family: tahoma;
        }

        .copy {
            float: right;
            margin-top: -42px;
            clear: both;
            /* Membersihkan float untuk menghindari overlay dengan elemen sebelumnya */
            margin-right: 590px;
            /* Atur jarak dari tepi kanan */
            font-weight: normal;
            font-family: tahoma;
        }

        .quotation {
            float: right;
            margin-top: -20px;
            clear: both;
            /* Membersihkan float untuk menghindari overlay dengan elemen sebelumnya */
            margin-right: 627px;
            /* Atur jarak dari tepi kanan */
            font-weight: normal;
            font-family: tahoma;
        }

        .schedule-project {
            float: right;
            margin-top: -110px;
            clear: both;
            /* Membersihkan float untuk menghindari overlay dengan elemen sebelumnya */
            margin-right: 350px;
            /* Atur jarak dari tepi kanan */
            font-weight: normal;
            font-family: tahoma;
        }


        .table-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            box-sizing: border-box;
            font-family: tahoma;
        }

        .item-table {
            width: auto;
            border-collapse: collapse;
            margin-top: 0;
            width: 100%;
            height: 100%;
            font-family: tahoma;
        }

        .item-table th,
        .item-table td {
            border: 1px solid black;
            padding: 8px;
            font-size: 13px;
            text-align: center;
            font-weight: normal;
            font-family: tahoma;
        }

        .item-table th:first-child,
        .item-table td:first-child {
            width: 5%;
        }

        .box {
            width: 98%;
            margin-top: 5mm;
            border: 1mm;
            box-sizing: border-box;
        }

        .created-by-table,
        .approved-by-manager-dept-table,
        .approved-by-general-manager-table,
        .approved-by-name-table {
            width: 100%;
            max-width: 150mm;
            border: 0.5mm solid black;
            margin-top: 5mm;
            margin-bottom: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-weight: normal;
            text-align: left;
            font-family: tahoma;
        }

        .received-by-table {
            width: 100%;
            max-width: 58mm;
            border: 0.5mm solid black;
            margin-top: 5mm;
            margin-bottom: 11px;
            padding: 0px;
            box-sizing: border-box;
            font-weight: normal;
            font-family: tahoma;
        }

        .created-by-table {
            margin-left: 11px;
            margin-right: 11px;
            font-family: tahoma;
        }

        .approved-by-manager-dept-table {
            margin-left: auto;
            margin-right: auto;

        }

        .approved-by-general-manager-table {
            margin-left: 11px;
            margin-right: 0px;
        }

        .approved-by-name-table {
            margin-left: 11px;
            margin-right: 11px;
        }

        .received-by-table {
            margin-left: 11px;
            margin-right: 11px;
        }

        .bold h4 {
            margin-left: 11px;
            font-size: 13px;
            font-weight: bold;
        }

        label {
            display: block;
            /* Membuat label tampil berurutan ke bawah */
            font-size: 13px;
            /* Atur ukuran font label */
            margin-top: 5px;
            margin-bottom: 5px;
            /* Jarak antar label */
            font-weight: normal;
            font-family: tahoma;
        }

        input[type="checkbox"] {
            vertical-align: left;
            font-weight: normal;
            /* Menjaga konsistensi penempatan vertical */
            font-family: tahoma;
        }

        .level-type-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-weight: normal;
            font-family: tahoma;
        }

        .level-of-request,
        .type-of-payment {
            width: 100%;
            font-weight: normal;
            font-family: tahoma;
        }
    }

    @media screen {
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f0f0f0;
            font-family: tahoma;
        }

        .page {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: tahoma;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 30px;
            text-align: center;
            font-family: tahoma;
        }

        .table-container {
            margin-bottom: 20px;
            font-family: tahoma;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            font-family: tahoma;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ccc;
            font-family: tahoma;
        }

        table th {
            background-color: #f0f0f0;
        }

        .bold h4 {
            margin-left: 0;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            font-family: tahoma;

            /* Menyembunyikan elemen cetak pada tampilan layar */
            .print-only {
                display: none;
            }

            label {
                font-weight: normal;
                font-family: tahoma;
            }
        }
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <?php if (!empty($result_req_order)) : ?>
        <div class="page">
            <h1>PROPOSAL PERMINTAAN BARANG & JASA</h1>
            <div class="table-container">
                <table class="left-table">
                    <tr>
                        <td>
                            <h3>Register No</h3>
                        </td>
                        <td>
                            <h3>: <?= $row_req_order->register_no; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Date</h3>
                        </td>
                        <td>
                            <h3>: <?= date('m-d-Y', strtotime($row_req_order->date_required)); ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Department</h3>
                        </td>
                        <td>
                            <h3>: <?= $row_req_order->department; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Category Item/Service</h3>
                        </td>
                        <td>
                            <h3>: <?= $row_req_order->category_item_service; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Reason</h3>
                        </td>
                        <td>
                            <h3>: <?= $row_req_order->reason; ?></h3>
                        </td>
                    </tr>
                </table>
                <table class="center-table">
                    <tr>
                        <td>
                            <h3>Level of Request :

                                <label style="font-weight: normal;" for="emergency"><input type="checkbox"
                                        id="emergency" name="level_of_request[]" value="EMERGENCY"
                                        <?= (in_array('EMERGENCY', explode(', ', $row_req_order->level_of_request))) ? 'checked' : ''; ?>>
                                    Emergency</label>


                                <label style="font-weight: normal;" for="urgent"><input type="checkbox" id="urgent"
                                        name="level_of_request[]" value="URGENT"
                                        <?= (in_array('URGENT', explode(', ', $row_req_order->level_of_request))) ? 'checked' : ''; ?>>
                                    Urgent</label>


                                <label style="font-weight: normal;" for="normal"><input type="checkbox" id="normal"
                                        name="level_of_request[]" value="NORMAL"
                                        <?= (in_array('NORMAL', explode(', ', $row_req_order->level_of_request))) ? 'checked' : ''; ?>>
                                    Normal</label>

                            </h3>
                        </td>

                        <td>
                            <h3>Type of Payment : <br> (Filled by Purchasing) <br> *Only for emergency request
                                <label style="font-weight: normal;" for="suspend"><input type="checkbox" id="suspend"
                                        name="type_of_payment[]" value="SUSPEND"
                                        <?= (in_array('SUSPEND', explode(', ', $row_req_order->type_of_payment))) ? 'checked' : ''; ?>>
                                    Suspend</label>


                                <label style="font-weight: normal;" for="reimbues"><input type="checkbox" id="reimbues"
                                        name="type_of_payment[]" value="REIMBUES"
                                        <?= (in_array('REIMBUES', explode(', ', $row_req_order->type_of_payment))) ? 'checked' : ''; ?>>
                                    Reimbues</label>


                                <label style="font-weight: normal;" for="due_payment"><input type="checkbox"
                                        id="due_payment" name="type_of_payment[]" value="Due Payment"
                                        <?= (in_array('Due Payment', explode(', ', $row_req_order->type_of_payment))) ? 'checked' : ''; ?>>
                                    Due Payment</label>
                            </h3>
                        </td>
                        <td>
                            <h3>Order Type :
                                <label style="font-weight: normal;" for="feasibility_study"><input type="checkbox"
                                        id="feasibility_study" name="order_type[]" value="FEASIBILITY STUDY"
                                        <?= (in_array('FEASIBILITY STUDY', explode(', ', $row_req_order->order_type))) ? 'checked' : ''; ?>>
                                    Feasibility Study</label>


                                <label style="font-weight: normal;" for="order"><input type="checkbox" id="order"
                                        name="order_type[]" value="order_type"
                                        <?= (in_array('ORDER', explode(', ', $row_req_order->order_type))) ? 'checked' : ''; ?>>
                                    Order</label>
                            </h3>
                        </td>
                    </tr>
                </table>


            </div>
            <div class="box">
                <table class="item-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 15%;">Material Code</th>
                            <th style="width: 25%;">Item Description</th>
                            <th style="width: 6%;">Qty</th>
                            <th style="width: 6%;">Uom</th>
                            <th style="width: 11%;">ETA</th>
                            <th style="width: 13%;">Category Req</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $no = 1;
                                foreach ($result_req_order as $item) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $item->code_material; ?></td>
                            <td style="text-align: left;"><?= $item->item_description; ?></td>
                            <td><?= $item->quantity; ?></td>
                            <td><?= $item->uom; ?></td>
                            <td><?= date('d-m-Y', strtotime($item->eta)); ?></td>
                            <td style="text-align: left;"><?= $item->category_req; ?></td>
                            <td style="text-align: left;">
                                User : <?= $item->remark_user; ?>
                                <br>
                                For :<?= $item->remark_for; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="table-container">
                <table class="min-table">
                    <tr>
                        <td>
                            <h3>Budget Est :</h3>
                        </td>
                        <!-- <td>
                                <h3>: <?= $row_req_order->budget_est; ?></h3>
                            </td> -->
                    </tr>
                    <tr>
                        <td>
                            <h3>B3 Product :
                                <label class="yes_b3" style="font-weight: normal;" for="YES"><input type="checkbox"
                                        id="YES" name="b3_product[]" value="YES"
                                        <?= (in_array('YES', explode(', ', $row_req_order->b3_product))) ? 'checked' : ''; ?>>
                                    Yes</label>
                                <label class="no_b3" style="font-weight: normal;" for="NO"><input type="checkbox"
                                        id="NO" name="b3_product[]" value="NO"
                                        <?= (in_array('NO', explode(', ', $row_req_order->b3_product))) ? 'checked' : ''; ?>>
                                    No</label>
                            </h3>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Attachment :
                                <label style="font-weight: normal;" for="esr"><input type="checkbox" id="esr"
                                        name="attachment[]" value="ESR"
                                        <?= (in_array('ESR', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    ESR</label>

                                <label style="font-weight: normal;" for="drawing"><input type="checkbox" id="drawing"
                                        name="attachment[]" value="DRAWING"
                                        <?= (in_array('DRAWING', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    Drawing</label>

                                <label style="font-weight: normal;" for="sample_barang"><input type="checkbox"
                                        id="sample_barang" name="attachment[]" value="SAMPLE BARANG"
                                        <?= (in_array('SAMPLE BARANG', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    Sample Barang</label>

                                <label style="font-weight: normal;" for="forecast_data_stock"><input type="checkbox"
                                        id="forecast_data_stock" name="attachment[]" value="FORECAST / DATA STOCK"
                                        <?= (in_array('FORECAST / DATA STOCK', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    Forecast / Data Stock</label>

                                <label style="font-weight: normal;" for="bom"><input type="checkbox" id="bom"
                                        name="attachment[]" value="BOM"
                                        <?= (in_array('BOM', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    BoM</label>

                                <label class="service-report" style="font-weight: normal;"><input type="checkbox"
                                        id="service_report" name="attachment[]" value="SERVICE REPORT"
                                        <?= (in_array('SERVICE REPORT', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    Service Report</label>

                                <label class="picture" style="font-weight: normal;" for="picture_photos_of_item"><input
                                        type="checkbox" id="picture_photos_of_item" name="attachment[]"
                                        value="PICTURE / PHOTOS OF ITEM"
                                        <?= (in_array('PICTURE / PHOTOS OF ITEM', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    Picture / Photos Of Item</label>

                                <label class="catalog" style="font-weight: normal;" for="catalog"><input type="checkbox"
                                        id="catalog" name="attachment[]" value="CATALOG"
                                        <?= (in_array('CATALOG', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    Catalog</label>

                                <label class="copy" style="font-weight: normal;" for="copy_of_last_po"><input
                                        type="checkbox" id="copy_of_last_po" name="attachment[]" value="COPY OF LAST PO"
                                        <?= (in_array('COPY OF LAST PO', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    Copy Of Last PO</label>

                                <label class="quotation" style="font-weight: normal;" for="quotation"><input
                                        type="checkbox" id="quotation" name="attachment[]" value="QUOTATION"
                                        <?= (in_array('QUOTATION', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    Quotation</label>

                                <label class="schedule-project" style="font-weight: normal;" for="Schedule"><input
                                        type="checkbox" id="schedule" name="attachment[]" value="SCHEDULE (PROJECT)"
                                        <?= (in_array('SCHEDULE (PROJECT)', explode(', ', $row_req_order->attachment))) ? 'checked' : ''; ?>>
                                    Schedule (Project)</label>
                            </h3>
                        </td>

                    </tr>
                </table>
            </div>
            <div class="table-container">
                <div class="created-by-table">
                    <table class="table-baru ">
                        <tr>
                            <td>
                                <h3 style="margin-bottom: 30px;">
                                    Created by<br>
                                    Date : <?= date('d-m-Y', strtotime($row_req_order->date_created)); ?>
                                </h3>
                            </td>
                        </tr>
                        <!-- <tr>
                                    <td>
                                        
                                    </td>
                                </tr> -->
                        <tr>
                            <td>
                                <h3>Name : <?= $row_req_order->created_by_pic; ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>User Maintenance</h3>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="approved-by-manager-dept-table">
                    <table class="table-baru">
                        <tr>
                            <td>
                                <h3 style="margin-bottom: 30px;">
                                    Approved by <br>
                                    Date : </h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Name : <?= $row_req_order->approved_by_manager; ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Manager Dept MTN</h3>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="approved-by-general-manager-table">
                    <table class="center-table">
                        <tr>
                            <td>
                                <h3 style="margin-bottom: 30px;">
                                    Approved by<br>
                                    Date :
                                </h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Name : <?= $row_req_order->approved_by_general_manager; ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>General Manager</h3>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="approved-by-name-table">
                    <table class="table-baru">
                        <tr>
                            <td>
                                <h3 style="margin-bottom: 30px;">Received by<br>
                                    Date : </h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Name :</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Plant Manager</h3>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="table-container">
                <div class="received-by-table">
                    <table class="table-baru">
                        <tr>
                            <td>
                                <h3 style="margin-bottom: 30px;">Received by<br>
                                    Date : </h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!-- <h3>Date :</h3> -->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Name :</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Buyer Purchasing Dept</h3>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php else : ?>
        <p>No Req order available.</p>
        <?php endif; ?>
        <!-- Catatan footer -->
        <div class="bold">
            <h4> *For All request Form shall be approved by General Manager </h4>
        </div>
        <div class="bold">
            <h4> *For project request shall be approved by Plant Manager (Technical & Operational) </h4>
        </div>
    </div>

    </div>
</body>

</html>