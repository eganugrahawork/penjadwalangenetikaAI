<div class="container-fluid">

    <!-- Page Heading -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Tambah Pengampu</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('manajemen_matkul/tambah_pengampu') ?>" method="post">
                <div class="form-group">
                    <select class="form-control" name="matkul_id" id="p_matkul">
                        <option selected disabled>Pilih Mata Kuliah</option>
                        <?php foreach ($mk as $mk) : ?>
                            <option value="<?= $mk['id_matkul'] ?>"><?= $mk['nama_matkul'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="dosen_id" id="p_dosen">
                        <option selected disabled>Pilih Dosen</option>
                        <?php foreach($dosen as $d)  : ?>
                            <option value="<?= $d['id_dosen'] ?>"><?= $d['nama_dosen'] ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-secondary ml-auto" type="submit" name="submit">Proses</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTablePengampu" width="100%" cellspacing="0">
                    <thead>

                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <tr>
                            <th>No</th>
                            <th>Dosen</th>
                            <th>Jurusan</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Tahun Akademik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($pengampu as $p) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $p['nama_dosen'] ?></td>
                                <td><?= $p['nama_jurusan'] ?></td>
                                <td><?= $p['nama_matkul'] ?></td>
                                <td><?= $p['kelas'] ?></td>
                                <td><?= $p['tahun_akademik'] ?></td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>
            </div>

            <a class="btn btn-danger button-delete" href="<?= base_url('manajemen_matkul/truncate_pengampu') ?>">HAPUS</a>
        </div>
    </div>




</div>