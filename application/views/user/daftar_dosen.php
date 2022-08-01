<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Daftar Dosen</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#tambah_dosen">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah Dosen</span>
                            </button>
                            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>


                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                            <?= form_error('nama_dosen', '<small class="text-danger pl-3">', '</small>') ?>
                            <?= form_error('nidn', '<small class="text-danger pl-3">', '</small>') ?>
                            <?= form_error('jurusan_id', '<small class="text-danger pl-3">', '</small>') ?>
                            <tr>
                                <th>No</th>
                                <th>Dosen</th>
                                <th>NIDN</th>
                                <th>Jurusan</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Dosen</th>
                                <th>NIDN</th>
                                <th>Jurusan</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dosen as $d) : ?>
                                <?php $usr = $this->db->get_where('user', ['id_user' => $d['user_id']])->row_array(); ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $d['nama_dosen'] ?></td>
                                    <td><?= $d['nidn'] ?></td>
                                    <td><?php $xas = $this->db->get_where('jurusan', ['id_jurusan' => $d['jurusan_id']])->row_array();
                                        echo $xas['nama_jurusan']; ?></td>
                                    <td><?= $usr['email'] ?></td>
                                    <td><button class="btn btn-success btn-circle btn-sm" data-target="#editdosen<?= $d['id_dosen'] ?>" data-toggle="modal">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="<?= base_url('daftar_dosen/reset_password/') . $usr['id_user'] ?>" class="btn btn-warning btn-circle btn-sm button-reset-password">
                                            <i class="fas fa-key"></i>
                                        </a>
                                        <a href="<?= base_url('daftar_dosen/dosen_delete/') . $d['id_dosen'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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

    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Dosen Kartu Akses</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableD_KartuAkses" width="100%" cellspacing="0">
                        <thead>

                            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>


                            <tr>
                                <th>No</th>
                                <th>Dosen</th>
                                <th>No Kartu RFID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Dosen</th>
                                <th>No Kartu RFID</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dosen as $d) : ?>
                                <?php $usr = $this->db->get_where('user', ['id_user' => $d['user_id']])->row_array(); ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $d['nama_dosen'] ?></td>
                                    <td><?php $x = $this->db->get_where('rfid', ['id_rfid' => $d['rfid_id']])->row_array();
                                        if (!$x) {
                                            echo "Tidak ada";
                                        } else {
                                            echo $x['uid_rfid'];
                                        }
                                        ?></td>

                                    <td>

                                        <button class="btn btn-primary btn-circle btn-sm" data-target="#edit_kartu_dosen<?= $d['id_dosen'] ?>" data-toggle="modal">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                        <a href="<?= base_url('daftar_dosen/delete_akses_rfid/') . $d['id_dosen'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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
</div>



<div class="modal fade" id="tambah_dosen" tabindex="-1" role="dialog" aria-labelledby="tambah_dosen" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_dosen">Tambahkan Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="post" action="<?= base_url('daftar_dosen') ?>">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>

                    <?php $role = $this->db->get_where('role', ['nama_role' => "dosen"])->row_array(); ?>
                    <input type="hidden" class="form-control" name="role_id" value="<?= $role['id_role'] ?>">

                    <div class="form-group">
                        <label>Nama Dosen</label>
                        <input type="text" class="form-control" name="nama_dosen" placeholder="Nama Dosen">
                        <?= form_error('nama_dosen', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>NIDN</label>
                        <input type="text" class="form-control" name="nidn" placeholder="NIDN">
                        <?= form_error('nidn', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Jurusan</label>
                        <select class="form-control" name="jurusan_id">
                            <option selected>Pilih Jurusan</option>
                            <?php foreach ($jurusan as $j) : ?>
                                <option value="<?= $j['id_jurusan'] ?>"><?= $j['nama_jurusan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('jurusan_id', '<small class="text-danger pl-3">', '</small>') ?>
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
foreach ($dosen as $d) : $no++ ?>
    <?php $usr = $this->db->get_where('user', ['id_user' => $d['user_id']])->row_array(); ?>
    <div class="modal fade" id="editdosen<?= $d['id_dosen'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ml-auto">Edit Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('daftar_dosen/edit_dosen') ?>" method="post">
                        <input type="hidden" name="id_dosen" required class="form-control" value="<?= $d['id_dosen'] ?>">
                        <input type="hidden" name="id_user" required class="form-control" value="<?= $usr['id_user'] ?>">

                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="text" name="nama_dosen" required class="form-control" value="<?= $d['nama_dosen'] ?>">
                            <?= form_error('nama_dosen', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>NIDN</label>
                            <input type="text" name="nidn" required class="form-control" value="<?= $d['nidn'] ?>">
                            <?= form_error('nidn', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Jurusan</label>
                            <select class="form-control" name="jurusan_id">
                                <?php foreach ($jurusan as $j) : ?>
                                    <option value="<?= $j['id_jurusan'] ?>" <?php if ($d['jurusan_id'] == $j['id_jurusan']) {
                                                                                echo 'selected';
                                                                            } ?>><?= $j['nama_jurusan'] ?></option>
                                <?php endforeach; ?>

                            </select>
                            <?= form_error('jurusan_id', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required class="form-control" value="<?= $usr['email'] ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
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
foreach ($dosen as $d) : $no++ ?>
    <div class="modal fade" id="edit_kartu_dosen<?= $d['id_dosen'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ml-auto">Edit Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('daftar_dosen/edit_kartu_dosen') ?>" method="post">
                        <input type="hidden" name="id_dosen" required class="form-control" value="<?= $d['id_dosen'] ?>">

                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control" value="<?= $d['nama_dosen'] ?>" readonly>

                        </div>

                        <div class="form-group">
                            <label for="inputState">No Kartu RFID</label>
                            <select class="form-control" name="rfid_id">

                                <?php $_rfid = "SELECT * FROM rfid WHERE NOT EXISTS ( SELECT rfid_id FROM dosen WHERE rfid.id_rfid = dosen.rfid_id) AND NOT EXISTS (SELECT rfid_id FROM rfid_master WHERE rfid.id_rfid = rfid_master.rfid_id)";
                                $rfid_kosong = $this->db->query($_rfid)->result_array();
                                $get_kartu = $this->db->get_where('rfid', ['id_rfid' => $d['rfid_id']])->row_array();
                                if ($d['rfid_id'] == 0) {
                                    foreach ($rfid_kosong as $rf) { ?>
                                        <option value="<?= $rf['id_rfid'] ?>"><?= $rf['uid_rfid'] ?></option>
                                    <?php }
                                } else { ?>
                                    <option value="<?= $get_kartu['id_rfid'] ?>"><?= $get_kartu['uid_rfid'] ?></option>
                                    <?php foreach ($rfid_kosong as $rf) { ?>
                                        <option value="<?= $rf['id_rfid'] ?>"><?= $rf['uid_rfid'] ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>