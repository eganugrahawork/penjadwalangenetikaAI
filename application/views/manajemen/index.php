<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Mata Kuliah</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabelmatkul" width="100%" cellspacing="0">
                            <thead>
                                <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#tambah_matkul">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Mata Kuliah</span>
                                </button>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>Jumlah Sks</th>
                                    <th>Jurusan</th>
                                    <th>Semester</th>
                                    <th>Jenis</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($matkul as $mk) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $mk['nama_matkul'] ?></td>
                                        <td><?= $mk['jumlah_sks'] ?></td>
                                        <td><?php $xas = $this->db->get_where('jurusan', ['id_jurusan' => $mk['jurusan_id']])->row_array();
                                            echo $xas['nama_jurusan']  ?></td>
                                        <td><?php $sms = $this->db->get_where('semester', ['id_semester' => $mk['semester_id']])->row_array();
                                            echo $sms['nama_semester']  ?></td>

                                        <td><?= $mk['jenis'] ?></td>
                                        <td><button class="btn btn-success btn-circle btn-sm" data-target="#editmatkul<?= $mk['id_matkul'] ?>" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('manajemen_data/delete_matkul/') . $mk['id_matkul'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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

    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Jurusan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTablejurusan" width="100%" cellspacing="0">
                            <thead>
                                <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#tambah_jurusan">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Jurusan</span>
                                </button>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                                <?= form_error('nama_jurusan', '<small class="text-danger pl-3">', '</small>') ?>
                                <tr>
                                    <th>No</th>
                                    <th>Jurusan</th>
                                    <th>Prodi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($jurusan as $jrs) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $jrs['nama_jurusan'] ?></td>
                                        <td><?php $x = $this->db->get_where('prodi', ['id_prodi' => $jrs['prodi_id']])->row_array();
                                            echo $x['nama_prodi']; ?></td>
                                        <td><button class="btn btn-success btn-circle btn-sm" data-target="#editjurusan<?= $jrs['id_jurusan'] ?>" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('manajemen_data/delete_jurusan/') . $jrs['id_jurusan'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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

        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Prodi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableprodi" width="100%" cellspacing="0">
                            <thead>
                                <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#add_prodi">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Prodi</span>
                                </button>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                                <?= form_error('nama_prodi', '<small class="text-danger pl-3">', '</small>') ?>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Prodi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($prodi as $p) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $p['nama_prodi'] ?></td>
                                        <td><button class="btn btn-success btn-circle btn-sm" data-target="#editprodi<?= $p['id_prodi'] ?>" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('manajemen_data/delete_prodi/') . $p['id_prodi'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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

    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Tahun Akademik</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableAngkatan" width="100%" cellspacing="0">
                            <thead>
                                <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#add_angkatan">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Angkatan</span>
                                </button>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                                <?= form_error('nama_angkatan', '<small class="text-danger pl-3">', '</small>') ?>
                                <tr>
                                    <th>No</th>
                                    <th>Angkatan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($angkatan as $ak) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $ak['nama_angkatan'] ?></td>
                                        <td><?php if ($ak['status'] == 1) {
                                                echo "Aktif";
                                            } else {
                                                echo "Tidak";
                                            } ?></td>
                                        <td><button class="btn btn-success btn-circle btn-sm" data-target="#editangkatan<?= $ak['id_angkatan'] ?>" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('manajemen_data/delete_angkatan/') . $ak['id_angkatan'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Semester</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTablesemester" width="100%" cellspacing="0">
                            <thead>
                                <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#add_semester">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Semester</span>
                                </button>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                                <?= form_error('nama_semester', '<small class="text-danger pl-3">', '</small>') ?>
                                <tr>
                                    <th>No</th>
                                    <th>Semester</th>
                                    <th>Angkatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($semester as $smst) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $smst['nama_semester'] ?></td>
                                        <td><?php $h = $this->db->get_where('angkatan', ['id_angkatan' => $smst['angkatan_id']])->row_array();
                                            echo $h['nama_angkatan']; ?></td>
                                        <td>
                                            <button class="btn btn-success btn-circle btn-sm" data-target="#editsemester<?= $smst['id_semester'] ?>" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <!-- <a href="<?= base_url('manajemen_data/delete_semester/') . $smst['id_semester'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
                                                <i class="fas fa-trash"></i>
                                            </a> -->
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


    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Kelas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTablekelas" width="100%" cellspacing="0">
                            <thead>
                                <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#add_kelas">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Kelas</span>
                                </button>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                                <?= form_error('nama_kelas', '<small class="text-danger pl-3">', '</small>') ?>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($kelas as $k) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $k['nama_kelas'] ?></td>
                                        <td><?= $k['semester_id']; ?></td>
                                        <td><button class="btn btn-success btn-circle btn-sm" data-target="#editkelas<?= $k['id_kelas'] ?>" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('manajemen_data/delete_kelas/') . $k['id_kelas'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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



        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar RFID</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTablerfid" width="100%" cellspacing="0">
                            <thead>
                                <p type="button" class="btn btn-sm btn-secondary btn-icon-split mb-2">

                                    <span class="text">Dibawah merupakan Daftar seluruh RFID</span>
                                </p>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                                <tr>
                                    <th>No</th>
                                    <th>UID RFID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($rfid as $rfid) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $rfid['uid_rfid'] ?></td>
                                        <td>
                                            <a href="<?= base_url('manajemen_data/delete_rfid/') . $rfid['id_rfid'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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

    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Ruangan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableruangan" width="100%" cellspacing="0">
                            <thead>
                                <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#tambah_ruangan">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Ruangan</span>
                                </button>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                                <?= form_error('nama_ruangan', '<small class="text-danger pl-3">', '</small>') ?>
                                <tr>
                                    <th>No</th>
                                    <th>Ruangan</th>
                                    <th>Kapasitas</th>
                                    <th>Jenis</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($ruangan as $r) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $r['nama_ruangan'] ?></td>
                                        <td><?= $r['kapasitas'] ?></td>
                                        <td><?= $r['jenis'] ?></td>
                                        <td><button class="btn btn-success btn-circle btn-sm" data-target="#editruangan<?= $r['id_ruangan'] ?>" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="<?= base_url('manajemen_data/delete_ruangan/') . $r['id_ruangan'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar RFID Master</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableruangan" width="100%" cellspacing="0">
                            <thead>
                                <button type="button" class="btn btn-sm btn-success btn-icon-split mb-2" data-toggle="modal" data-target="#tambah_master">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Master</span>
                                </button>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                                <?= form_error('nama_master', '<small class="text-danger pl-3">', '</small>') ?>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($rfid_master as $rm) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $rm['nama_master'] ?></td>
                                        <td><?= $rm['jabatan'] ?></td>
                                        <td><?php if ($rm['rfid_id'] == 0) {
                                                echo "tidak ada";
                                            } else {
                                                $urf = $this->db->get_where('rfid', ['id_rfid' => $rm['rfid_id']])->row_array();
                                                echo $urf['uid_rfid'];
                                            } ?></td>
                                        <td>
                                            <a href="<?= base_url('manajemen_data/delete_master/') . $rm['id_rfid_master'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
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
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Semester Aktif</h6>
                </div>
                <div class="card-body">
                    <p>Semester Sekarang</p>
                    <form method="POST" action="<?= base_url('manajemen_data/edit_semester_aktif') ?>">
                        <div class="form-row align-items-center">
                            <div class="form-group">
                                <label>Semester Aktif</label>
                                <select class="form-control" name="semester_aktif">
                                    <?php foreach ($semester_aktif as $semester_aktif) : ?>
                                        <option value="<?= $semester_aktif['id_semester_aktif'] ?>" <?php if ($semester_aktif['is_active'] == 1) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?= $semester_aktif['nama_semester'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-auto mt-4 ">
                                <button type="submit" class="btn btn-dark mb-2">Perbarui</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="add_kelas" tabindex="-1" role="dialog" aria-labelledby="add_kelas" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_kelas">Tambahkan Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form method="post" action="<?= base_url('manajemen_data') ?>">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas" placeholder="Contoh : TI A 17">
                            <?= form_error('nama_kelas', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" name="jurusan_id">
                                <option selected>Pilih Jurusan</option>
                                <?php foreach ($jurusan as $jrs) : ?>
                                    <option value="<?= $jrs['id_jurusan'] ?>"><?= $jrs['nama_jurusan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control" name="semester id">
                                <option selected>Pilih Semester</option>
                                <?php foreach ($semester as $sms) : ?>
                                    <option value="<?= $sms['id_semester'] ?>"><?= $sms['nama_semester'] ?></option>
                                <?php endforeach; ?>
                            </select>
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
</div>
<?php foreach ($kelas as $k) : ?>
    <div class="modal fade" id="editkelas<?= $k['id_kelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="add_kelas" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editkelas<?= $k['id_kelas'] ?>">Edit kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form method="post" action="<?= base_url('manajemen_data/edit_kelas') ?>">
                        <input type="hidden" class="form-control" name="id_kelas" value="<?= $k['id_kelas'] ?>">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas" value="<?= $k['nama_kelas'] ?>">
                            <?= form_error('nama_kelas', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" name="jurusan_id">
                                <?php foreach ($jurusan as $jrs) : ?>
                                    <option value="<?= $jrs['id_jurusan'] ?>" <?php if ($jrs['id_jurusan'] == $k['jurusan_id']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $jrs['nama_jurusan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control" name="semester_id">
                                <?php foreach ($semester as $sms) : ?>
                                    <option value="<?= $sms['id_semester'] ?>" <?php if ($sms['id_semester'] == $k['semester_id']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $sms['nama_semester'] ?></option>
                                <?php endforeach; ?>
                            </select>
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
<?php endforeach; ?>

<div class="modal fade" id="tambah_matkul" tabindex="-1" role="dialog" aria-labelledby="tambah_matkul" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_matkul">Tambahkan Mata Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="post" action="<?= base_url('manajemen_data/tambah_matkul') ?>">
                    <div class="form-group">
                        <label>Nama Mata Kuliah</label>
                        <input type="text" class="form-control" name="nama_matkul" placeholder="Mata Kuliah">
                    </div>
                    <div class="form-group">
                        <label>Jumlah SKS</label>
                        <select class="form-control" name="jumlah_sks">
                            <option selected>Pilih Jumlah SKS</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select class="form-control" name="jurusan_id">
                            <option selected>Pilih Jurusan</option>
                            <?php foreach ($jurusan as $jrs) : ?>
                                <option value="<?= $jrs['id_jurusan'] ?>"><?= $jrs['nama_jurusan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select class="form-control" name="semester_id">
                            <option selected>Pilih Semester</option>
                            <?php foreach ($semester as $smstr) : ?>
                                <option value="<?= $smstr['id_semester'] ?>"><?= $smstr['nama_semester'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select class="form-control" name="jenis">
                            <option selected>Pilih Jenis</option>
                            <option value="Teori">Teori</option>
                            <option value="Praktikum">Praktikum</option>

                        </select>
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

<?php foreach ($matkul as $mk) : ?>
    <div class="modal fade" id="editmatkul<?= $mk['id_matkul'] ?>" tabindex="-1" role="dialog" aria-labelledby="editmatkul<?= $mk['id_matkul'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmatkul<?= $mk['id_matkul'] ?>">Edit Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form method="post" action="<?= base_url('manajemen_data/edit_matkul') ?>">
                        <input type="hidden" class="form-control" name="id_matkul" value="<?= $mk['id_matkul'] ?>">
                        <div class="form-group">
                            <label>Nama Mata Kuliah</label>
                            <input type="text" class="form-control" name="nama_matkul" value="<?= $mk['nama_matkul'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah SKS</label>
                            <select class="form-control" name="jumlah_sks">
                                <option value="1" <?php if ($mk['jumlah_sks'] == 1) {
                                                        echo "selected";
                                                    } ?>>1</option>
                                <option value="2" <?php if ($mk['jumlah_sks'] == 2) {
                                                        echo "selected";
                                                    } ?>>2</option>
                                <option value="3" <?php if ($mk['jumlah_sks'] == 3) {
                                                        echo "selected";
                                                    } ?>>3</option>
                                <option value="4" <?php if ($mk['jumlah_sks'] == 4) {
                                                        echo "selected";
                                                    } ?>>4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" name="jurusan_id">
                                <?php foreach ($jurusan as $jrs) : ?>
                                    <option value="<?= $jrs['id_jurusan'] ?>" <?php if ($jrs['id_jurusan'] == $mk['jurusan_id']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $jrs['nama_jurusan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control" name="semester_id">
                                <?php foreach ($semester as $jrs) : ?>
                                    <option value="<?= $jrs['id_semester'] ?>" <?php if ($jrs['id_semester'] == $mk['semester_id']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $jrs['nama_semester'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <select class="form-control" name="jenis">

                                <option value="Teori" <?php if ($mk['jenis'] == "Teori") {
                                                            echo "selected";
                                                        } ?>>Teori</option>
                                <option value="Praktikum" <?php if ($mk['jenis'] == "Praktikum") {
                                                                echo "selected";
                                                            } ?>>Praktikum</option>
                            </select>
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
<?php endforeach; ?>

<div class="modal fade" id="tambah_ruangan" tabindex="-1" role="dialog" aria-labelledby="tambah_ruangan" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_ruangan">Tambahkan Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('manajemen_data/tambah_ruangan') ?>">
                    <div class="form-group">
                        <label>Nama Ruangan</label>
                        <input type="text" class="form-control" name="nama_ruangan" placeholder="Contoh : A1 Gedung Solihin">
                        <?= form_error('nama_ruangan', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Kapasitas</label>
                        <input type="text" class="form-control" name="kapasitas" placeholder="Contoh : 30">
                        <?= form_error('kapasitas', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <label>Jenis</label>
                        <select class="form-control" name="jenis">
                            <option value="Teori">Teori</option>
                            <option value="Praktikum">Praktikum</option>
                        </select>
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

<?php foreach ($ruangan as $r) : ?>
    <div class="modal fade" id="editruangan<?= $r['id_ruangan'] ?>" tabindex="-1" role="dialog" aria-labelledby="editruangan<?= $r['id_ruangan'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editruangan<?= $r['id_ruangan'] ?>">Edit Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('manajemen_data/edit_ruangan') ?>">

                        <input type="hidden" name="id_ruangan" value="<?= $r['id_ruangan'] ?>">
                        <div class="form-group">
                            <label>Nama Ruangan</label>
                            <input type="text" class="form-control" name="nama_ruangan" value="<?= $r['nama_ruangan'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Kapasitas</label>
                            <input type="text" class="form-control" name="kapasitas" value="<?= $r['kapasitas'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah SKS</label>
                            <select class="form-control" name="jenis">
                                <option value="Teori" <?php if ($r['jenis'] == "Teori") {
                                                            echo "selected";
                                                        } ?>>Teori</option>
                                <option value="Praktikum" <?php if ($r['jenis'] == "Lab") {
                                                                echo "selected";
                                                            } ?>>Praktikum</option>
                            </select>
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
<?php endforeach; ?>


<div class="modal fade" id="tambah_jurusan" tabindex="-1" role="dialog" aria-labelledby="tambah_jurusan" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_jurusan">Tambahkan Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('manajemen_data/tambah_jurusan') ?>">
                    <div class="form-group">
                        <label>Nama Jurusan</label>
                        <input type="text" class="form-control" name="nama_jurusan" placeholder="Contoh : Teknik Informatika">
                        <?= form_error('nama_jurusan', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select class="form-control" name="prodi_id">
                            <?php foreach ($prodi as $p) : ?>
                                <option value="<?= $p['id_prodi'] ?>"><?= $p['nama_prodi'] ?></option>
                            <?php endforeach; ?>
                        </select>
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

<?php foreach ($jurusan as $jrs) : ?>
    <div class="modal fade" id="editjurusan<?= $jrs['id_jurusan'] ?>" tabindex="-1" role="dialog" aria-labelledby="editjurusan<?= $jrs['id_jurusan'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editjurusan<?= $jrs['id_jurusan'] ?>">Edit jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('manajemen_data/edit_jurusan') ?>">

                        <input type="hidden" name="id_jurusan" value="<?= $jrs['id_jurusan'] ?>">
                        <div class="form-group">
                            <label>Nama jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan" value="<?= $jrs['nama_jurusan'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" name="prodi_id">
                                <?php foreach ($prodi as $p) : ?>
                                    <option value="<?= $p['id_prodi'] ?>" <?php if ($p['id_prodi'] == $jrs['prodi_id']) {
                                                                                echo "selected";
                                                                            } ?>><?= $p['nama_prodi'] ?></option>
                                <?php endforeach; ?>
                            </select>
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
<?php endforeach; ?>


<div class="modal fade" id="add_prodi" tabindex="-1" role="dialog" aria-labelledby="add_prodi" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_prodi">Tambahkan Prodi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="post" action="<?= base_url('manajemen_data/tambah_prodi') ?>">
                    <div class="form-group">
                        <label>Nama prodi</label>
                        <input type="text" class="form-control" name="nama_prodi" placeholder="Contoh : Teknik">
                        <?= form_error('nama_prodi', '<small class="text-danger pl-3">', '</small>') ?>
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

<?php foreach ($prodi as $p) : ?>
    <div class="modal fade" id="editprodi<?= $p['id_prodi'] ?>" tabindex="-1" role="dialog" aria-labelledby="editprodi<?= $p['id_prodi'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editprodi<?= $p['id_prodi'] ?>">Edit Prodi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="<?= base_url('manajemen_data/edit_prodi') ?>">
                        <input type="hidden" name="id_prodi" value="<?= $p['id_prodi'] ?>">
                        <div class="form-group">
                            <label>Nama prodi</label>
                            <input type="text" class="form-control" name="nama_prodi" value="<?= $p['nama_prodi'] ?>">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="add_angkatan" tabindex="-1" role="dialog" aria-labelledby="add_angkatan" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_angkatan">Tambahkan angkatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="post" action="<?= base_url('manajemen_data/tambah_angkatan') ?>">
                    <div class="form-group">
                        <label>Nama angkatan</label>
                        <input type="text" class="form-control" name="nama_angkatan" placeholder="Contoh : 2017">
                        <?= form_error('nama_angkatan', '<small class="text-danger pl-3">', '</small>') ?>
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

<?php foreach ($angkatan as $ak) : ?>
    <div class="modal fade" id="editangkatan<?= $ak['id_angkatan'] ?>" tabindex="-1" role="dialog" aria-labelledby="editangkatan<?= $ak['id_angkatan'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editangkatan<?= $ak['id_angkatan'] ?>">Edit angkatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="<?= base_url('manajemen_data/edit_angkatan') ?>">
                        <input type="hidden" name="id_angkatan" value="<?= $ak['id_angkatan'] ?>">
                        <div class="form-group">
                            <label>Nama angkatan</label>
                            <input type="text" class="form-control" name="nama_angkatan" value="<?= $ak['nama_angkatan'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <?php if ($ak['status'] == 0) { ?>
                                    <option value="0" selected>Tidak</option>
                                    <option value="1">Aktif</option>
                                <?php } else { ?>
                                    <option value="0">Tidak</option>
                                    <option value="1" selected>Aktif</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="add_semester" tabindex="-1" role="dialog" aria-labelledby="add_semester" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_semester">Tambahkan semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form method="post" action="<?= base_url('manajemen_data/tambah_semester') ?>">
                    <div class="form-group">
                        <label>Nama Semester</label>
                        <input type="text" class="form-control" name="nama_semester" placeholder="Contoh : 1">
                        <?= form_error('nama_semester', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Angkatan</label>
                        <select class="form-control" name="angkatan_id">
                            <?php foreach ($angkatan as $p) : ?>
                                <option value="<?= $p['id_angkatan'] ?>"><?= $p['nama_angkatan'] ?></option>
                            <?php endforeach; ?>
                        </select>
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


<?php foreach ($semester as $smst) : ?>
    <div class="modal fade" id="editsemester<?= $smst['id_semester'] ?>" tabindex="-1" role="dialog" aria-labelledby="editsemester<?= $smst['id_semester'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editsemester<?= $smst['id_semester'] ?>">Edit semester</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="<?= base_url('manajemen_data/edit_semester') ?>">
                        <input type="hidden" name="id_semester" value="<?= $smst['id_semester'] ?>">
                        <div class="form-group">
                            <label>Nama semester</label>
                            <input type="text" class="form-control" name="nama_semester" value="<?= $smst['nama_semester'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Angkatan</label>
                            <select class="form-control" name="angkatan_id">
                                <?php foreach ($angkatan as $p) : ?>
                                    <option value="<?= $p['id_angkatan'] ?>" <?php if ($p['id_angkatan'] == $smst['angkatan_id']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $p['nama_angkatan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="tambah_master" tabindex="-1" role="dialog" aria-labelledby="tambah_master" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_master">Tambahkan Master</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="<?= base_url('manajemen_data/tambah_master') ?>">
                    <div class="form-group">
                        <label>Nama Master</label>
                        <input type="text" class="form-control" name="nama_master" placeholder="Petugas 1">
                        <?= form_error('nama_master', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" placeholder="Petugas Kebersihan">
                        <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="inputState">No Kartu RFID</label>
                        <select class="form-control" name="rfid_id">

                            <?php $_rfidku = "SELECT * FROM rfid WHERE NOT EXISTS ( SELECT rfid_id FROM dosen WHERE rfid.id_rfid = dosen.rfid_id) AND NOT EXISTS (SELECT rfid_id FROM rfid_master WHERE rfid.id_rfid = rfid_master.rfid_id)";
                            $rfid_kosong = $this->db->query($_rfidku)->result_array();
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>