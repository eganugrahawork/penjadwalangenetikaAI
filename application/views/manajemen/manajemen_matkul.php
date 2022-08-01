<div class="container-fluid">

    <!-- Page Heading -->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Daftar Dosen</h6>
        </div>
        <div class="card-body">
            <p>Status Semester : <?php $smstr_aktif = $this->db->get_where('semester_aktif', ['is_active' => 1])->row_array();
                                    echo $smstr_aktif['nama_semester']; ?></p>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>

                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <tr>
                            <th>No</th>
                            <th>Dosen</th>
                            <th>Jurusan</th>
                            <th>Akses Mata Kuliah</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Dosen</th>
                            <th>Jurusan</th>
                            <th>Akses Mata Kuliah</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($dosen as $d) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $d['nama_dosen'] ?></td>
                                <td><?php $xas = $this->db->get_where('jurusan', ['id_jurusan' => $d['jurusan_id']])->row_array();
                                    echo $xas['nama_jurusan']; ?></td>
                                <td><button class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#editaksesmatkul<?= $d['id_dosen'] ?>">
                                        <i class="fas fa-universal-access"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach; ?>




                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Tambah Pengampu</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('manajemen_matkul/tambah_pengampu') ?>" method="post">
                <div class="form-group">
                    <select class="form-control" name="matkul_id">
                        <?php foreach ($mk as $mk) : ?>
                            <option value="<?= $mk['id_matkul'] ?>"><?= $mk['nama_matkul'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="dosen_id">
                        <?php foreach ($dosen as $dd) : ?>
                            <option value="<?= $dd['id_dosen'] ?>"><?= $dd['nama_dosen'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-secondary ml-auto" type="submit" name="submit">Proses</button>
                </div>
            </form>




        </div>
    </div>




</div>




<?php $no = 1;
foreach ($dosen as $d) : $no++  ?>
    <div class="modal fade bd-example-modal-lg" id="editaksesmatkul<?= $d['id_dosen'] ?>" tabindex="-1" dosen="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ml-auto">Akses <?= $d['nama_dosen'] ?></h5>
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
                                        <th>Mata Kuliah</th>
                                        <th>Access</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1; ?>
                                    <?php $smstr_aktif = $this->db->get_where('semester_aktif', ['is_active' => 1])->row_array();
                                    $q = "SELECT * FROM dosen_matkul a LEFT JOIN mata_kuliah b ON a.matkul_id = b.id_matkul WHERE a.dosen_id = $d[id_dosen] AND b.semester_id %2 = $smstr_aktif[id_semester_aktif]";
                                    $cek_ada = $this->db->query($q)->result_array();
                                    foreach ($cek_ada as $ca) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $ca['nama_matkul'] ?></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input dosen-matkul" type="checkbox" <?= check_access_dosen($d['id_dosen'], $ca['id_matkul']); ?> data-dosen='<?= $d['id_dosen']; ?>' data-matkul='<?= $ca['id_matkul'] ?>'>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Kuliah</th>
                                        <th>Access</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>

                                    <?php
                                    if ($smstr_aktif['id_semester_aktif'] == 1) {
                                        $query = "SELECT * FROM mata_kuliah WHERE semester_id %2 <> 0 AND jurusan_id = $d[jurusan_id] AND NOT EXISTS (SELECT matkul_id FROM dosen_matkul WHERE mata_kuliah.id_matkul = dosen_matkul.matkul_id)";
                                        $matkul = $this->db->query($query)->result_array();
                                    } else {
                                        $query = "SELECT * FROM mata_kuliah WHERE  semester_id %2 = 0 AND jurusan_id = $d[jurusan_id] AND NOT EXISTS (SELECT matkul_id FROM dosen_matkul WHERE mata_kuliah.id_matkul = dosen_matkul.matkul_id)";
                                        $matkul = $this->db->query($query)->result_array();
                                    } ?>

                                    <?php foreach ($matkul as $mt) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $mt['nama_matkul'] ?></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input dosen-matkul" type="checkbox" <?= check_access_dosen($d['id_dosen'], $mt['id_matkul']); ?> data-dosen='<?= $d['id_dosen']; ?>' data-matkul='<?= $mt['id_matkul'] ?>'>

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