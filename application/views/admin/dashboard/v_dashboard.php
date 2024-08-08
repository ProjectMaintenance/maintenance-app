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

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <b style="font-size:20px"><?= $title_card; ?></b>
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
                <!-- <img src="<?= base_url('/assets/image/') ?>logo/Isuzu.svg.png" alt="Logo-Isuzu.png" width="250"> -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3><?= $count_material; ?></h3>

                                <b>
                                    <p>Material List</p>
                                </b>
                            </div>
                            <div class="icon">
                                <i class="ion ion-grid"></i>
                            </div>
                            <a href="<?= site_url('admin/material_list') ?>" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <!-- <sup style="font-size: 20px">%</sup> -->
                                <h3><?= $count_goods_receive; ?></h3>

                                <b>
                                    <p>Goods Receive (Barang Masuk)</p>
                                </b>
                            </div>
                            <div class="icon">
                                <i class="ion ion-arrow-graph-up-right"></i>
                            </div>
                            <a href="<?= site_url('admin/goods_receive') ?>" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $count_goods_issue; ?></h3>

                                <b>
                                    <p>Goods Issue(Barang Keluar)</p>
                                </b>
                            </div>
                            <div class="icon">
                                <i class="ion ion-arrow-graph-down-right"></i>
                            </div>
                            <a href="<?= site_url('admin/goods_issue') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: burlywood">
                            <div class="inner">
                                <h3><?= $count_transaction; ?></h3>

                                <b>
                                    <p>History Transaction</p>
                                </b>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="<?= site_url('admin/history_transaction') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12 col-12">
                        <hr>
                        <!-- small box -->
                        <div class="small-box" style="background-color: #ffeb84">
                            <div class="inner">
                                <h4>Request Order Status</h4>
                                <hr>
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Status PPBJ</th>
                                            <th>Status SR</th>
                                            <th>Status PR</th>
                                            <th>Status PO</th>
                                            <th>Overall Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!-- Status PPBJ -->
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            ON PROGRESS
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_ppbj_on_progress; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <!-- Status SR -->
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            ON PROGRESS
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_sr_on_progress; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <!-- Status PR -->
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            ON PROGRESS
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_pr_on_progress; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <!-- Status PO -->
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            ON PROGRESS
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_po_on_progress; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <!-- Jugdment Atau Overall Status -->
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            ON PROGRESS
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_jugdment_on_progress; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <!-- Status PPBJ -->
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            DONE
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_ppbj_done; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            DONE
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_sr_done; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            DONE
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_pr_done; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            DONE
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_po_done; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            PROCESS DELIVERY MATERIAL
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_jugdment_process_delivery_material; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <!-- Status PPBJ -->
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            DELAY
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_ppbj_delay; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            DELAY
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_sr_delay; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            DELAY
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_pr_delay; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            DELAY
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_po_delay; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            RECEIVED
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_jugdment_received; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <!-- Status PPBJ -->
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            CANCEL
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_ppbj_cancel; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td><button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            CANCEL
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_sr_cancel; ?></span>
                                                        </div>
                                                    </div>
                                                </button></td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            CANCEL
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_pr_cancel; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            CANCEL
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_status_po_cancel; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            DELAY
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_jugdment_delay; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button type="button" class="btn btn-light btn-block">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            CANCEL
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="badge badge-light"><?= $count_jugdment_cancel; ?></span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cube"></i>
                            </div>
                            <a href="<?= site_url('admin/req_order') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <b style="font-size: 20px;">Department Maintenance | PT. Mesin Isuzu Indonesia</b>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->