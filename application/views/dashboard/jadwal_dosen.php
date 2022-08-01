<div class="container-fluid">

    <!-- Page Heading -->
    <h1><?php date_default_timezone_set('Asia/Jakarta');
        echo date('H:i'); ?></h1>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Jadwal</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableJadwalku" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Mata Kuliah</th>
                            <th>Sks</th>
                            <th>Kelas</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        foreach ($jadwal as $j) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $j['nama_hari'] ?></td>
                                <td><?= $j['jam_belajar'] ?></td>
                                <td><?= $j['nama_matkul'] ?></td>
                                <td><?= $j['jumlah_sks'] ?></td>
                                <td><?= $j['kelas'] ?></td>
                                <td><?= $j['nama_ruangan'] ?></td>
                            </tr>
                        <?php endforeach; ?>



                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>