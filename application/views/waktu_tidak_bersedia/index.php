<div class="container-fluid">

    <!-- Page Heading -->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Waktu Tidak Bersedia Dosen</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('waktu_tidak_bersedia') ?>" method="post">
                <div class="form-group">
                    <select class="form-control" name="id_dosen">
                        <?php foreach ($dosen as $dsn) : ?>
                            <option value="<?= $dsn['id_dosen'] ?>"><?= $dsn['nama_dosen'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="id_hari">
                        <?php foreach ($hari as $h) : ?>
                            <option value="<?= $h['id_hari'] ?>"><?= $h['nama_hari'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="id_waktu">
                        <?php foreach ($waktu as $w) : ?>
                            <option value="<?= $w['id_jam_belajar'] ?>"><?= $w['jam_belajar'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-secondary ml-auto" type="submit" name="submit">Proses</button>
                </div>
            </form>




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
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($wtd as $d) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $d['nama_dosen'] ?></td>
                                <td><?= $d['nama_hari'] ?></td>
                                <td><?= $d['jam_belajar'] ?></td>
                                <td><a href="<?= base_url('waktu_tidak_bersedia/hapus_wtb/') . $d['id_waktu_tidak_bersedia'] ?>" class="btn btn-danger btn-circle btn-sm button-delete">
                                        <i class="fas fa-trash"></i>
                                    </a></td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>