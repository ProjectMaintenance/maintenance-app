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
                        <li class="breadcrumb-item"><a href="<?= site_url('administrator/dashboard') ?>">Dashboard</a>
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
            <div class="card-header">
                <h2 class="card-title">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-form-add-new-users">
                        <i class="fas fa-plus mr-2"></i>Add Data</a>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-form-add-new-users" data-backdrop="static" data-keyboard="false"
                        aria-labelledby="modal-form-add-usersLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <?php echo form_open('administrator/save_data_users', array('id' => 'form-add-new-users')); ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-form-add-usersLabel">FORM ADD NEW USERS</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="ENTER FULL NAME">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control" id="username"
                                            placeholder="ENTER USERNAME">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control select2" name="role" id="role">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="ENTER PASSWORD">
                                    </div>
                                    <div class="form-group">
                                        <label for="retype_password">Retype Password</label>
                                        <input type="password" name="retype_password" class="form-control"
                                            id="retype_password" placeholder="ENTER RETYPE PASSWORD">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
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
                <table id="tbl_users" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                        <tr>
                            <th>NO</th>
                            <th>NAME</th>
                            <th>USERNAME</th>
                            <th>ROLE</th>
                            <th>IS ACTIVE</th>
                            <th>DATE CREATED</th>
                            <th>LAST LOGIN</th>
                            <th class="text-center">ACTION</th>
                            <th class="text-center">RESET PASSWORD</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($users as $value) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value->name ?></td>
                            <td><?= $value->username ?></td>
                            <td><?= $value->name_role ?></td>
                            <td><?= $value->is_active == 1 ? "Active" : "Non Active" ?></td>
                            <td><?= $value->date_created ?></td>
                            <td><?= $value->last_login ?></td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#update-data-users<?= $value->id_users ?>">
                                    <i class="fas fa-edit mr-2"></i>Update
                                </button>

                                <button type="button" class="btn btn-danger btn-delete-user"
                                    data-id-users="<?= $value->id_users ?>" data-username="<?= $value->username ?>">
                                    <i class="fa fa-trash mr-2"></i>Delete
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-secondary btn-reset-password"
                                    data-id-users="<?= $value->id_users ?>" data-username="<?= $value->username ?>">
                                    <i class="fas fa-key mr-2"></i></i>Reset</button>
                            </td>
                        </tr>
                        <?php endforeach ?>
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

<?php foreach ($users as $value) : ?>
<!-- Modal -->
<div class="modal fade" id="update-data-users<?= $value->id_users ?>" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Update Data Users <?= $value->name; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('administrator/update_data_users', array('id' => 'form-update-area' . $value->id_users)); ?>
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" name="id_users" class="form-control" id="id_users"
                        value="<?= $value->id_users; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="name<?= $value->id_users ?>">Name</label>
                    <input type="text" name="name" class="form-control" id="name<?= $value->id_users; ?>"
                        placeholder="Enter NAME" value="<?= $value->name; ?>">
                </div>
                <div class="form-group">
                    <label for="username<?= $value->id_users ?>">Username</label>
                    <input type="text" name="username" class="form-control" id="username<?= $value->id_users; ?>"
                        placeholder="Enter USERNAME" value="<?= $value->username; ?>">
                </div>
                <div class="form-group">
                    <label for="role<?= $value->id_users ?>">Role</label>
                    <select class="form-control select2" name="role" id="role<?= $value->id_users ?>">
                    </select>
                    <input type="text" name="id_role" class="form-control" id="id_role<?= $value->id_users; ?>"
                        placeholder="ID ROLE" value="<?= $value->id_role; ?>" readonly>
                    <input type="text" name="name_role" class="form-control" id="name_role<?= $value->id_users; ?>"
                        placeholder="SELECT ROLE" value="<?= $value->name_role; ?>" readonly>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Change</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>

        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- jquery-validation -->
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
<script>
$('#modal-form-add-new-users').on('shown.bs.modal', function() {
    $('#name').focus();
    $('.select2').select2({
        theme: 'bootstrap4'
    });
    $.ajax({
        type: "GET",
        url: "<?= site_url('administrator/manage_user') ?>",
        dataType: "JSON",
        success: function(response) {
            $('#role').empty();
            $('#role').append('<option seleceted="selected" value="">- Select Role -</option>');
            $.each(response.role, function(key, value) {
                $('#role').append('<option value="' + value.id_role + '">' + value
                    .name_role + '</option>');
            });
        }
    });

    $('#role').change(function(e) {
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
                        }, 2000); // Penundaan selama 2000 milidetik (2 detik)
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
    $('#form-add-new-users').validate({
        rules: {
            name: {
                required: true
            },
            username: {
                required: true,
                remote: {
                    url: "<?= site_url('administrator/check_username') ?>",
                    type: "POST",
                    data: {
                        'username': function() {
                            return $("#username").val();
                        },
                    }
                }
            },
            role: {
                required: true
            },
            password: {
                required: true,
                minlength: 8
            },
            retype_password: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
        },
        messages: {
            name: {
                required: "Please enter a full name"
            },
            username: {
                required: "Please enter a username",
                remote: "Username is already exist"
            },
            role: {
                required: "Please select a role"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            retype_password: {
                required: "Please retype a password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Password doesn't match"
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

$('#modal-form-add-new-users').on('hidden.bs.modal', function() {
    // Menghapus nilai dari semua input dalam form
    $(this).find('input, select').val('');
});
$(function() {
    $("#tbl_users").DataTable({
        "scrollX": true,
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        select: {
            selected: true,
            style: 'multi'
        },
        "buttons": [{
                extend: "excel",
                text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                className: 'btn-success',
                title: '',
                exportOptions: {
                    stripHtml: false,
                    columns: [0, 1, 2], // Indeks kolom yang ingin dicetak
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
                    columns: [0, 1, 2], // Indeks kolom yang ingin dicetak
                },
            },
            {
                extend: 'selectAll',
                text: '<i class="fas fa-tasks mr-2"></i> Select All',
                className: 'btn'
            },
            {
                extend: 'selectNone',
                text: '<i class="fas fa-times mr-2"></i> Cancel',
                className: 'btn-danger'
            }
        ]
    }).buttons().container().appendTo('#tbl_users_wrapper .col-md-6:eq(0)');
});
//-------------------------------------------------- Update --------------------------------------------------\\
<?php foreach ($users as $value) : ?>
$('.select2').select2({
    theme: 'bootstrap4'
});
$.ajax({
    type: "GET",
    url: "<?= site_url('administrator/manage_user') ?>",
    dataType: "JSON",
    success: function(response) {
        $('#role<?= $value->id_users ?>').empty();
        $('#role<?= $value->id_users ?>').append(
            '<option seleceted="selected" value="">- Select Role -</option>');
        $.each(response.role, function(key, value) {
            $('#role<?= $value->id_users ?>').append('<option value="' + value.id_role + '">' +
                value
                .name_role + '</option>');
        });
    }
});

$('#role<?= $value->id_users ?>').change(function(e) {
    e.preventDefault();

    var id_role = $(this).find('option:selected').val();
    var name_role = $(this).find('option:selected').text();

    if (id_role === null || id_role.trim() === '') {
        $('#id_role<?= $value->id_users; ?>').val('');
        $('#name_role<?= $value->id_users; ?>').val('');
    } else {

        $('#id_role<?= $value->id_users; ?>').val(id_role);
        $('#name_role<?= $value->id_users; ?>').val(name_role);
        $('#name_role<?= $value->id_users; ?>').valid();
    }
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
$('#form-update-area<?= $value->id_users ?>').validate({
    rules: {
        name: {
            required: true,
        },
        username: {
            required: true,
            remote: {
                url: "<?= site_url('administrator/check_username') ?>",
                type: "POST",
                data: {
                    username: function() {
                        return $("#username<?= $value->id_users; ?>").val();
                    },
                    id_users: "<?= $value->id_users ?>",
                    original_username: "<?= $value->username ?>"
                }
            }
        },
        name_role: {
            required: true,
        },
    },
    messages: {
        name: {
            required: "Please enter a full name",
        },
        username: {
            required: "Please enter a username",
            remote: "Username already exists"
        },
        name_role: {
            required: "Please select a role",
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

<?php endforeach ?>
//-------------------------------------------------- Update --------------------------------------------------\\


//-------------------------------------------------- Delete --------------------------------------------------\\
$('.btn-delete-user').click(function() {
    // Mendapatkan ID pengguna dari atribut data
    var id_users = $(this).data('id-users');
    var username = $(this).data('username');
    // Menampilkan peringatan SweetAlert2
    Swal.fire({
        title: 'Are you sure ?',
        html: "Do you want to delete the account for <b>" + username + ' </b>?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        // Jika pengguna menekan tombol "Yes, delete!"
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('administrator/delete_users'); ?>",
                data: {
                    id_users: id_users
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Deleted!',
                            'The user has been deleted.',
                            'success'
                        ).then(() => {
                            // Refresh halaman setelah pengguna dihapus
                            location.reload();
                        });
                    }
                }
            });
        }
    });
});
//-------------------------------------------------- Delete --------------------------------------------------\\

//-------------------------------------------------- Reset Password --------------------------------------------------\\
$('.btn-reset-password').click(function(e) {
    e.preventDefault();
    // Mendapatkan ID pengguna dari atribut data
    var id_users = $(this).data('id-users');
    var username = $(this).data('username');
    // Menampilkan peringatan SweetAlert2
    Swal.fire({
        title: 'Are you sure ?',
        html: "Do you want reset password for <b>" + username + ' </b>?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Reset!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        // Jika pengguna menekan tombol "Yes, delete!"
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('administrator/reset_password_users'); ?>",
                data: {
                    id_users: id_users
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        ).then(() => {
                            // Refresh halaman setelah pengguna dihapus
                            location.reload();
                        });
                    }
                }
            });
        }
    });
});
</script>