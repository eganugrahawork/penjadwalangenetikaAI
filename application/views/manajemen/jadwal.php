<div class="container-fluid">

    <!-- Page Heading -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Jadwal</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" class="">
                <div class="row">
                    <div class="col-xl-4 col-lg-4">
                        <label>Semester</label>
                        <select class="form-control" name="semester_aktif">
                            <?php foreach ($semesteraktif as $s_a) : ?>
                                <option value="<?= $s_a['id_semester_aktif'] ?>" <?php if ($s_a['is_active'] == 1) {
                                                                                        echo "selected";
                                                                                    } ?>><?= $s_a['nama_semester'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <label>Jumlah Populasi</label>
                        <input type="text" class="form-control" name="jumlah_populasi" value="10">
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <label>Probabilitas CrossOver</label>
                        <input type="text" class="form-control" name="probabilitas_crossover" value="0.70">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4">
                        <label>Probabilitas Mutasi</label>
                        <input type="text" class="form-control" name="probabilitas_mutasi" value="0.40">
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <label>Jumlah Generasi</label>
                        <input type="text" class="form-control" name="jumlah_generasi" value="1000">
                    </div>
                    <div class="col-xl-4 col-lg-4 mt-4 mr-auto">
                        <button type="submit" class="btn btn-secondary" onclick="ShowProgressAnimation();">Proses</button>
                    </div>
                </div>


            </form>

            <hr>
            <div class="h4 text-center">Hasil Generate Jadwal</div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableJadwalku" width="100%" cellspacing="0">
                    <thead>

                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Dosen</th>
                            <th>Kelas</th>
                            <th>Ruang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($matkul_haha as $haha) : ?>

                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $haha['nama_hari']; ?></td>
                                <td><?= $haha['jam_belajar']; ?></td>
                                <td><?= $haha['nama_matkul']; ?></td>
                                <td><?= $haha['jumlah_sks'] ?></td>
                                <td><?= $haha['nama_dosen']; ?></td>
                                <td><?= $haha['kelas']; ?></td>
                                <td><?= $haha['nama_ruangan']; ?></td>
                                <td><?php if ($haha['status'] == 1) {
                                        echo "AKTIF";
                                    } else {
                                        echo "-";
                                    } ?></td>
                            </tr>
                        <?php endforeach; ?>



                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>