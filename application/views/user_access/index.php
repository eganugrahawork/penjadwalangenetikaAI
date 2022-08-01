<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Daftar Role</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#exampleModalCenter">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add Role</span>
                        </button>
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($role as $r) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $r['nama_role'] ?></td>
                                <td><button class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#editakses<?= $r['id_role'] ?>">
                                        <i class="fas fa-universal-access"></i>
                                    </button>
                                    <button class="btn btn-success btn-circle btn-sm" data-toggle="modal" data-target="#editrole<?= $r['id_role'] ?>">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('user_access/delete_role/') . $r['id_role'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>




                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="post" action="<?= base_url('user_access') ?>">
                    <div class="form-group">
                        <label>Nama Role</label>
                        <input type="text" class="form-control" name="nama_role">
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>



<?php $no = 1;
foreach ($role as $r) : $no++  ?>
    <div class="modal fade" id="editrole<?= $r['id_role'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('user_access/edit_role') ?>" method="post">
                        <input type="hidden" name="id_role" required class="form-control" value="<?= $r['id_role'] ?>">

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" name="nama_role" required class="form-control" value="<?= $r['nama_role'] ?>">
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php $no = 1;
foreach ($role as $r) : $no++  ?>
    <div class="modal fade bd-example-modal-lg" id="editakses<?= $r['id_role'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ml-auto">Akses <?= $r['nama_role'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Access</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($menu as $m) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $m['nama_menu'] ?></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input user-akses" type="checkbox" <?= check_access($r['id_role'], $m['id_menu']); ?> data-role='<?= $r['id_role']; ?>' data-menu='<?= $m['id_menu'] ?>'>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- End of Main Content -->