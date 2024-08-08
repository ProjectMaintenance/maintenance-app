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
<!-- Modal Update PPBJ -->
<div class="modal fade" id="modal-update-ppbj<?= $value->regist_no; ?>" data-backdrop="static" data-keyboard="false"
    aria-labelledby="modal-update-ppbj<?= $value->regist_no; ?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <?= form_open('administrator/update_ppbj', ['id' => 'form-update-ppbj' . $value->regist_no]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-update-ppbj<?= $value->regist_no; ?>Label">Update PPBJ | ID Req
                    Order <?= $value->id_req_order; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="regist_no<?= $value->regist_no; ?>" name="regist_no"
                    value="<?= $value->regist_no; ?>" readonly>

                <div class="form-group">
                    <label for="no_ppbj">No PPBJ</label>
                    <input type="text" class="form-control" id="no_ppbj<?= $value->regist_no; ?>" name="no_ppbj"
                        value="<?= $value->register_no; ?>">
                </div>

                <?php $status_ppbj = ['ON PROGRESS', 'DELAY', 'DONE', 'CANCEL']; ?>
                <div class="form-group">
                    <label for="status_ppbj">Status PPBJ</label>
                    <select class="form-control select2" name="status_ppbj" id="status_ppbj<?= $value->regist_no; ?>">
                        <option value="" selected>- Select Status -</option>
                        <?php foreach ($status_ppbj as $sts_ppbj) : ?>
                        <option value="<?= $sts_ppbj; ?>" <?= $value->status_ppbj == $sts_ppbj ? 'selected' : '' ?>>
                            <?= $sts_ppbj; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <hr>

                <h5>Update SR</h5>
                <div class="form-group">
                    <label for="no_sr">No SR</label>
                    <input type="text" class="form-control" id="no_sr<?= $value->regist_no; ?>" name="no_sr"
                        value="<?= $value->no_sr; ?>">
                </div>

                <?php $status_sr = ['ON PROGRESS', 'DELAY', 'DONE', 'CANCEL']; ?>
                <div class="form-group">
                    <label for="status_sr">Status SR</label>
                    <select class="form-control select2" name="status_sr" id="status_sr<?= $value->regist_no; ?>">
                        <option value="" selected>- Select Status -</option>
                        <?php foreach ($status_sr as $sts_sr) : ?>
                        <option value="<?= $sts_sr; ?>" <?= $value->status_sr == $sts_sr ? 'selected' : '' ?>>
                            <?= $sts_sr; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <hr>

                <h5>Update PR</h5>
                <div class="form-group">
                    <label for="no_pr">No PR</label>
                    <input type="text" class="form-control" id="no_pr<?= $value->regist_no; ?>" name="no_pr"
                        value="<?= $value->no_pr; ?>">
                </div>

                <?php $status_pr = ['ON PROGRESS', 'DELAY', 'DONE', 'CANCEL']; ?>
                <div class="form-group">
                    <label for="status_pr">Status PR</label>
                    <select class="form-control select2" name="status_pr" id="status_pr<?= $value->regist_no; ?>">
                        <option value="" selected>- Select -</option>
                        <?php foreach ($status_pr as $sts_pr) : ?>
                        <option value="<?= $sts_pr; ?>" <?= $value->status_pr == $sts_pr ? 'selected' : '' ?>>
                            <?= $sts_pr; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <hr>

                <h5>Update PO</h5>
                <div class="form-group">
                    <label for="no_po">No PO</label>
                    <input type="text" class="form-control" id="no_po<?= $value->id_req_order; ?>" name="no_po"
                        value="<?= $value->no_po; ?>">
                </div>

                <?php $status_po = ['ON PROGRESS', 'DELAY', 'DONE', 'CANCEL']; ?>
                <div class="form-group">
                    <label for="status_po">Status PO</label>
                    <select class="form-control select2" name="status_po" id="status_po<?= $value->id_req_order; ?>">
                        <option value="" selected>- Select -</option>
                        <?php foreach ($status_po as $sts_po) : ?>
                        <option value="<?= $sts_po; ?>" <?= $value->status_po == $sts_po ? 'selected' : '' ?>>
                            <?= $sts_po; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <hr>

                <h5>Update Judgment</h5>
                <?php $status_judgment = ['ON PROGRESS', 'DELAY', 'DONE', 'CANCEL']; ?>
                <div class="form-group">
                    <label for="status_judgment">Status Judgment</label>
                    <select class="form-control select2" name="status_judgment"
                        id="status_judgment<?= $value->id_req_order; ?>">
                        <option value="" selected>- Select -</option>
                        <?php foreach ($status_judgment as $sts_judgment) : ?>
                        <option value="<?= $sts_judgment; ?>"
                            <?= $value->judgment == $sts_judgment ? 'selected' : '' ?>>
                            <?= $sts_judgment; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update PPBJ</button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>


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
                                            <?= (!empty($value->attachment) && in_array('ESR', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DRAWING</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]" value="DRAWING"
                                            <?= (!empty($value->attachment) && in_array('DRAWING', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SAMPLE BARANG</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="SAMPLE BARANG"
                                            <?= (!empty($value->attachment) && in_array('SAMPLE BARANG', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>FORECAST / DATA STOCK</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="FORECAST / DATA STOCK"
                                            <?= (!empty($value->attachment) && in_array('FORECAST / DATA STOCK', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BOM</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]" value="BOM"
                                            <?= (!empty($value->attachment) && in_array('BOM', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
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
                                            <?= (!empty($value->attachment) && in_array('SERVICE REPORT', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PICTURE / PHOTOS OF ITEM</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="PICTURE / PHOTOS OF ITEM"
                                            <?= (!empty($value->attachment) && in_array('PICTURE / PHOTOS OF ITEM', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CATALOG</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]" value="CATALOG"
                                            <?= (!empty($value->attachment) && in_array('CATALOG', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>COPY OF LAST PO</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="COPY OF LAST PO"
                                            <?= (!empty($value->attachment) && in_array('COPY OF LAST PO', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
                                            disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>QUOTATION</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="checkbox" name="attachment[]"
                                            value="QUOTATION"
                                            <?= (!empty($value->attachment) && in_array('QUOTATION', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
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
                                            <?= (!empty($value->attachment) && in_array('SCHEDULE (PROJECT)', explode(', ', $value->attachment))) ? 'checked' : ''; ?>
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
                <a target="_blank" href="<?= site_url('administrator/print_req_order/' . $value->regist_no); ?>"
                    class="btn btn-info"><i class="fas fa-print mr-2"></i> Print Req Order</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>