<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title_page; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('users/dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><?= $bread_crumb; ?></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <table id="tbl_history" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">CODE TRANSACTION</th>
                            <th class="text-center">TRANSACTION TYPE</th>
                            <th>DATE</th>
                            <th class="text-center">MATERIAL CODE</th>
                            <th>DESCRIPTION</th>
                            <th>AREA</th>
                            <th class="text-center">LINE</th>
                            <th>MACHINE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">UOM</th>
                            <th>IDENTITY PIC</th>
                            <th class="text-right">PRICE PER UNIT</th>
                            <th>NOTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($transaction_detail as $value) : ?>
                        <tr>
                            <td class="text-center"><?= $value->id_transaction ?></td>
                            <td class="text-center"><?= $value->transaction_type ?></td>
                            <td><?= $value->date ?></td>
                            <td class="text-center"><?= $value->code_material ?></td>
                            <td><?= $value->specification_material ?></td>
                            <td><?= $value->code_area ?></td>
                            <td class="text-center"><?= $value->code_line ?></td>
                            <td><?= $value->name_machine ?></td>
                            <td class="text-center"><?= $value->quantity ?></td>
                            <td class="text-center"><?= $value->code_uom ?></td>
                            <td><?= $value->identity_pic ?></td>
                            <td class="text-right">Rp<?= number_format($value->price, 0, ',', '.') ?></td>
                            <td><?= $value->description ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <b>Filter Data</b>
                    <hr>
                    <?= form_open('users/search_filter', ['id' => 'search_form']) ?>
                    <label for="start_filter">Start</label>
                    <input class="form-control" type="date" name="start_filter" id="start_filter">
                    <br>
                    <label for="end_filter">End</label>
                    <input class="form-control" type="date" name="end_filter" id="end_filter">
                    <br>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search mr-2"></i>Search</button>
                    <?= form_close(); ?>
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
                <table id="tbl_filter" class="table table-bordered table-striped nowrap" style="display:none">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>CODE TRANSACTION</th>
                            <th>TRANSACTION TYPE</th>
                            <th>DATE</th>
                            <th>MATERIAL CODE</th>
                            <th>DESCRIPTION</th>
                            <th>QUANTITY</th>
                            <th>UOM</th>
                            <th>IDENTITY PIC</th>
                            <th>PRICE PER UNIT</th>
                            <th>NOTED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated here by DataTables -->
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
<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.10.5"></script>
<script>
$(document).ready(function() {
    $("#tbl_history").DataTable({
        "scrollX": true,
        "responsive": false,
        "lengthChange": true,
        "autoWidth": false,
        "bStateSave": true,
        "scrollY": 400,
        "fnStateSave": function(oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function(oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        },
        select: {
            selected: true,
            style: 'multi'
        },
        "buttons": [{
                extend: "excel",
                text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                className: 'btn-success btn-sm',
                title: '',
                exportOptions: {
                    stripHtml: false,
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,
                        12
                    ], // Indeks kolom yang ingin dicetak
                },
            },
            {
                extend: "print",
                text: '<i class="fas fa-print mr-2"></i> PRINT',
                className: 'btn-info btn-sm',
                title: '',
                autoPrint: false,
                exportOptions: {
                    stripHtml: false,
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,
                        12
                    ], // Indeks kolom yang ingin dicetak
                },
            },
            {
                extend: 'selectAll',
                text: '<i class="fas fa-tasks mr-2"></i> Select All',
                className: 'btn-secondary btn-sm'
            },
            {
                extend: 'selectNone',
                text: '<i class="fas fa-times mr-2"></i> Cancel',
                className: 'btn-danger btn-sm'
            }
        ]
    }).buttons().container().appendTo('#tbl_history_wrapper .col-md-6:eq(0)');

    // Inisialisasi DataTables di tabel yang diperbarui

    $('#search_form').submit(function(e) {
        e.preventDefault(); // Menghentikan perilaku bawaan dari form
        var form = $(this);
        // Kirim form data menggunakan Ajax
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            dataType: "JSON",
            success: function(response) {
                if (response.success == true) {
                    if (response.data !== null) {
                        $('#tbl_filter').DataTable().destroy();
                        toastr.success(response.message);
                        $('#tbl_filter').show();
                        $('#tbl_filter').DataTable({
                            // Konfigurasi DataTables (seperti yang Anda terapkan sebelumnya)
                            // Konfigurasi DataTables
                            "paging": true,
                            "ordering": true,
                            "searching": true,
                            "scrollX": true,
                            "responsive": false,
                            "lengthChange": true,
                            "autoWidth": false,
                            "select": {
                                "selected": true,
                                "style": 'multi'
                            },
                            "buttons": [{
                                    extend: "excel",
                                    text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                                    className: 'btn-success btn-sm',
                                    title: '',
                                    exportOptions: {
                                        stripHtml: false,
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
                                            10, 11, 12
                                        ], // Indeks kolom yang ingin dicetak
                                    },
                                },
                                {
                                    extend: "print",
                                    text: '<i class="fas fa-print mr-2"></i> PRINT',
                                    className: 'btn-info btn-sm',
                                    title: '',
                                    autoPrint: false,
                                    exportOptions: {
                                        stripHtml: false,
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
                                            10, 11, 12
                                        ], // Indeks kolom yang ingin dicetak
                                    },
                                },
                                {
                                    extend: 'selectAll',
                                    text: '<i class="fas fa-tasks mr-2"></i> Select All',
                                    className: 'btn-secondary btn-sm'
                                },
                                {
                                    extend: 'selectNone',
                                    text: '<i class="fas fa-times mr-2"></i> Cancel',
                                    className: 'btn-danger btn-sm'
                                }
                            ],
                            data: response.data,
                            columns: [{
                                    data: 'no'
                                }, // Kolom nomor urutan
                                {
                                    data: 'id_transaction'
                                },
                                {
                                    data: 'transaction_type'
                                },
                                {
                                    data: 'date'
                                },
                                {
                                    data: 'code_material'
                                },
                                {
                                    data: 'specification_material'
                                },
                                {
                                    data: 'quantity'
                                },
                                {
                                    data: 'code_uom'
                                },
                                {
                                    data: 'identity_pic'
                                },
                                {
                                    data: 'price',
                                    render: function(data, type, row) {
                                        return 'Rp' + parseInt(data)
                                            .toLocaleString('id-ID');
                                    }
                                },
                                {
                                    data: 'description'
                                }
                            ],
                            // Tempatkan tombol-tombol di dalam container yang sesuai
                            "dom": "<'row'<'col-md-6'B><'col-md-6'f>>" +
                                "<'row'<'col-md-12'tr>>" +
                                "<'row'<'col-md-6'l><'col-md-6'p>>",
                            "columnDefs": [{
                                "width": "100%",
                                "targets": 0
                            }]
                        });
                    } else {
                        // Hancurkan DataTable sebelumnya jika ada
                        $('#tbl_filter').DataTable().destroy();
                        // Jika tidak ada data yang ditemukan, tetap tampilkan DataTables dengan pesan kosong
                        $('#tbl_filter').show();
                        toastr.info(response.message);
                        $('#tbl_filter').DataTable({
                            // Konfigurasi DataTables (seperti yang Anda terapkan sebelumnya)
                            // Konfigurasi DataTables
                            "paging": true,
                            "ordering": true,
                            "searching": true,
                            "scrollX": true,
                            "responsive": false,
                            "lengthChange": true,
                            "autoWidth": false,
                            "select": {
                                "selected": true,
                                "style": 'multi'
                            },
                            "buttons": [{
                                    extend: "excel",
                                    text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                                    className: 'btn-success btn-sm',
                                    title: '',
                                    exportOptions: {
                                        stripHtml: false,
                                        columns: [0, 1, 2, 3, 4, 5,
                                            6, 7
                                        ], // Indeks kolom yang ingin dicetak
                                    },
                                },
                                {
                                    extend: "print",
                                    text: '<i class="fas fa-print mr-2"></i> PRINT',
                                    className: 'btn-info btn-sm',
                                    title: '',
                                    autoPrint: false,
                                    exportOptions: {
                                        stripHtml: false,
                                        columns: [0, 1, 2, 3, 4, 5,
                                            6, 7
                                        ], // Indeks kolom yang ingin dicetak
                                    },
                                },
                                {
                                    extend: 'selectAll',
                                    text: '<i class="fas fa-tasks mr-2"></i> Select All',
                                    className: 'btn-secondary btn-sm'
                                },
                                {
                                    extend: 'selectNone',
                                    text: '<i class="fas fa-times mr-2"></i> Cancel',
                                    className: 'btn-danger btn-sm'
                                }
                            ],
                            data: [],
                            columns: [{
                                    data: 'no'
                                }, // Kolom nomor urutan
                                {
                                    data: 'id_transaction'
                                },
                                {
                                    data: 'transaction_type'
                                },
                                {
                                    data: 'date'
                                },
                                {
                                    data: 'code_material'
                                },
                                {
                                    data: 'specification_material'
                                },
                                {
                                    data: 'quantity'
                                },
                                {
                                    data: 'code_uom'
                                },
                                {
                                    data: 'identity_pic'
                                },
                                {
                                    data: 'price',
                                    render: function(data, type, row) {
                                        return 'Rp' + parseInt(data)
                                            .toLocaleString('id-ID');
                                    }
                                },
                                {
                                    data: 'description'
                                }
                            ],
                            // Tempatkan tombol-tombol di dalam container yang sesuai
                            "dom": "<'row'<'col-md-6'B><'col-md-6'f>>" +
                                "<'row'<'col-md-12'tr>>" +
                                "<'row'<'col-md-6'l><'col-md-6'p>>",
                            "columnDefs": [{
                                "width": "100%",
                                "targets": 0
                            }]
                        });
                    }
                } else {
                    // Handle jika success tidak bernilai true
                    toastr.error('Failed to retrieve data.');
                }
            },
            error: function(xhr, status, error) {
                // Tampilkan pesan error dengan Toastr
                toastr.error('Error occurred while processing the request.');
            }
        });
    });
});
</script>