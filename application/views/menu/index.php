<div class="container-fluid">

    <!-- Page Heading -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Daftar Menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#add_menu">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Menu</span>
                        </button>
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $m['nama_menu'] ?></td>
                                <td><?= $m['url'] ?></td>
                                <td><i class=" <?= $m['icon'] ?>"></i></td>
                                <td><button class="btn btn-success btn-circle btn-sm" data-target="#editmenu<?= $m['id_menu'] ?>" data-toggle="modal">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('menu/menu_delete/') . $m['id_menu'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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

    <div class="modal fade" id="add_menu" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_menu">Tambahkan Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form method="post" action="<?= base_url('menu') ?>">
                        <div class="form-group">
                            <label>Nama Menu</label>
                            <input type="text" class="form-control" name="nama_menu" placeholder="Nama Menu">
                            <?= form_error('nama_menu', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>

                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" class="form-control" name="url" placeholder="url">
                            <?= form_error('url', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control" name="icon" placeholder="icon">
                            <?= form_error('icon', '<small class="text-danger pl-3">', '</small>') ?>
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
    foreach ($menu as $m) : $no++ ?>
        <div class="modal fade" id="editmenu<?= $m['id_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-auto">Edit Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('menu/edit_menu') ?>" method="post">
                            <input type="hidden" name="id_menu" required class="form-control" value="<?= $m['id_menu'] ?>">

                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input type="text" name="nama_menu" required class="form-control" value="<?= $m['nama_menu'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Url</label>
                                <input type="text" name="url" required class="form-control" value="<?= $m['url'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Icon</label>
                                <div class="input-group">
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="<?= $m['icon'] ?>"></i></div>
                                        <input type="text" name="icon" required class="form-control" id="inlineFormInputGroup" value="<?= $m['icon'] ?>">
                                    </div>
                                </div>
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


</div>