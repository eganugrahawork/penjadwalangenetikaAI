<div class="container-fluid">

    <!-- Page Heading -->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Daftar Mahasiswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#tambah_mahasiswa">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Mahasiswa</span>
                        </button>
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= form_error('nama_mahasiswa', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= form_error('nim', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= form_error('angkatan_id', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= form_error('kelas_id', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= form_error('tempat_tinggal', '<small class="text-danger pl-3">', '</small>') ?>
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>') ?>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Angkatan</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Tinggal</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Angkatan</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Tinggal</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mahasiswa as $m) : ?>
                            <?php $usr = $this->db->get_where('user', ['id_user' => $m['user_id']])->row_array(); ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $m['nama_mahasiswa'] ?></td>
                                <td><?= $m['nim'] ?></td>
                                <td><?php $angkatann = $this->db->get_where('angkatan', ['id_angkatan' => $m['angkatan_id']])->row_array();
                                    echo $angkatann['nama_angkatan'] ?></td>
                                <td><?php $jrsn = $this->db->get_where('jurusan', ['id_jurusan' => $m['jurusan_id']])->row_array();
                                    echo $jrsn['nama_jurusan']  ?></td>
                                <td><?php $kelas = $this->db->get_where('kelas', ['id_kelas' =>  $m['kelas_id']])->row_array();
                                    echo $kelas['nama_kelas']; ?></td>
                                <td><?= $m['tanggal_lahir'] ?></td>
                                <td><?= $m['tempat_tinggal'] ?></td>
                                <td><?= $usr['email'] ?></td>
                                <td><?= $m['no_hp'] ?></td>
                                <td><button class="btn btn-success btn-circle btn-sm" data-target="#editmahasiswa<?= $m['id_mahasiswa'] ?>" data-toggle="modal">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('data_mahasiswa/reset_password/') . $usr['id_user'] ?>" class="btn btn-warning btn-circle btn-sm button-reset-password">
                                        <i class="fas fa-key"></i>
                                    </a>
                                    <a href="<?= base_url('data_mahasiswa/delete_mahasiswa/') . $m['id_mahasiswa'] . "/" . $usr['id_user'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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

<div class="modal fade" id="tambah_mahasiswa" tabindex="-1" role="dialog" aria-labelledby="tambah_mahasiswa" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_mahasiswa">Tambahkan mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="post" action="<?= base_url('data_mahasiswa') ?>">
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

                    <?php $role = $this->db->get_where('role', ['nama_role' => "mahasiswa"])->row_array(); ?>
                    <input type="hidden" class="form-control" name="role_id" value="<?= $role['id_role'] ?>">

                    <div class="form-group">
                        <label>Nama mahasiswa</label>
                        <input type="text" class="form-control" name="nama_mahasiswa" placeholder="Nama mahasiswa">
                        <?= form_error('nama_mahasiswa', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" placeholder="NIM">
                        <?= form_error('nim', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="inputState">angkatan</label>
                        <select class="form-control" name="angkatan_id" id="t_angkatan_id">
                            <option selected>Pilih angkatan</option>
                            <?php foreach ($angkatan as $jrs) : ?>
                                <option value="<?= $jrs['id_angkatan'] ?>"><?= $jrs['nama_angkatan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('jurusan_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Jurusan</label>
                        <select class="form-control" name="jurusan_id" id="t_jurusan_id">
                            <option selected>Pilih Jurusan</option>
                            <?php foreach ($jurusan as $jrs) : ?>
                                <option value="<?= $jrs['id_jurusan'] ?>"><?= $jrs['nama_jurusan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('jurusan_id', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas_id">
                            <option>Pilih Kelas</option>
                            <?= form_error('kelas_id', '<small class="text-danger pl-3">', '</small>') ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="text" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
                        <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Tempat Tinggal</label>
                        <input type="text" class="form-control" name="tempat_tinggal" placeholder="Tempat Tinggal">
                        <?= form_error('tempat_tinggal', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Kontak</label>
                        <input type="text" class="form-control" name="no_hp" placeholder="No. Handphone">
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>') ?>
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
foreach ($mahasiswa as $m) : $no++ ?>
    <?php $usr = $this->db->get_where('user', ['id_user' => $m['user_id']])->row_array(); ?>
    <div class="modal fade" id="editmahasiswa<?= $m['id_mahasiswa'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ml-auto">Edit Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('data_mahasiswa/edit_mahasiswa') ?>" method="post">
                        <input type="hidden" name="id_mahasiswa" required class="form-control" value="<?= $m['id_mahasiswa'] ?>">
                        <input type="hidden" name="id_user" required class="form-control" value="<?= $usr['id_user'] ?>">

                        <div class="form-group">
                            <label>Nama mahasiswa</label>
                            <input type="text" name="nama_mahasiswa" required class="form-control" value="<?= $m['nama_mahasiswa'] ?>">
                            <?= form_error('nama_mahasiswa', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" required class="form-control" value="<?= $m['nim'] ?>">
                            <?= form_error('nim', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputState">angkatan</label>
                            <select class="form-control" name="angkatan_id" id="e_angkatan_id">
                                <?php foreach ($angkatan as $jrs) : ?>
                                    <option value="<?= $jrs['id_angkatan'] ?>" <?php if ($m['angkatan_id'] == $jrs['id_angkatan']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $jrs['nama_angkatan'] ?></option>

                                <?php endforeach; ?>
                            </select>
                            <?= form_error('jurusan_id', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Jurusan</label>
                            <select class="form-control" name="jurusan_id" id="e_jurusan_id">
                                <?php foreach ($jurusan as $jrs) : ?>
                                    <option value="<?= $jrs['id_jurusan'] ?>" <?php if ($m['jurusan_id'] == $jrs['id_jurusan']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $jrs['nama_jurusan'] ?></option>

                                <?php endforeach; ?>
                            </select>
                            <?= form_error('jurusan_id', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Kelas</label>
                            <select class="form-control" name="kelas_id">
                                <?php $kelas = $this->db->get_where('kelas', ['jurusan_id' => $m['jurusan_id']])->result_array();
                                foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['id_kelas'] ?>" <?php if ($k['id_kelas'] == $m['kelas_id']) {
                                                                                echo "selected";
                                                                            } ?>><?= $k['nama_kelas'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('kelas_id', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" name="tanggal_lahir" required class="form-control" value="<?= $m['tanggal_lahir'] ?>">
                            <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_tinggal" required class="form-control" value="<?= $m['tempat_tinggal'] ?>">
                            <?= form_error('tempat_tinggal', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required class="form-control" value="<?= $usr['email'] ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="no_hp" required class="form-control" value="<?= $m['no_hp'] ?>">
                            <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>') ?>
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