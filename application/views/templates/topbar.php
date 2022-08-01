<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <h3 style="font-family:sans-serif; font-size : 13pt;"><?php $hariInggris = date('l');
                                                                    if ($hariInggris == "Sunday") {
                                                                        $hariIndo = "Minggu";
                                                                    } elseif ($hariInggris == "Monday") {
                                                                        $hariIndo = "Senin";
                                                                    } elseif ($hariInggris == "Tuesday") {
                                                                        $hariIndo = "Selasa";
                                                                    } elseif ($hariInggris == "Wednesday") {
                                                                        $hariIndo = "Rabu";
                                                                    } elseif ($hariInggris == "Thursday") {
                                                                        $hariIndo = "Kamis";
                                                                    } elseif ($hariInggris == "Friday") {
                                                                        $hariIndo = "Jumat";
                                                                    } elseif ($hariInggris == "Saturday") {
                                                                        $hariIndo = "Sabtu";
                                                                    } elseif ($hariInggris == "Sunday") {
                                                                        $hariIndo = "Minggu";
                                                                    }
                                                                    date_default_timezone_set('Asia/Jakarta');
                                                                    echo $hariIndo . ', ' . date('H.i');
                                                                    // query ubah status jadwal

                                                                    ?></h3>
            <?php $jam_sekarang = date('H.i');
            $hari_id = $this->db->get_where('hari', ['nama_hari' => $hariIndo])->row_array();
            if ($hariIndo !== "Minggu") {

                $qku = "SELECT * FROM jadwal_kuliah a LEFT JOIN jam_belajar b ON a.jam_belajar_id = b.id_jam_belajar WHERE a.hari_id = $hari_id[id_hari] ";
                $ambil_jm = $this->db->query($qku)->result_array();
                foreach ($ambil_jm as $a_j) {
                    $explode = explode('-', $a_j['jam_belajar']);
                    $jam_mulai = date_create($explode[0]);
                    $jam_selesai = date_create($explode[1]);
                    if ($jam_sekarang >= date_format($jam_mulai, 'H.i') && $jam_sekarang <= date_format($jam_selesai, 'H.i')) {
                        $update = ['status' => 1];
                        $this->db->where('id_jadwal_kuliah', $a_j['id_jadwal_kuliah']);
                        $this->db->update('jadwal_kuliah', $update);
                    } else {
                        $update = ['status' => 0];
                        $this->db->where('id_jadwal_kuliah', $a_j['id_jadwal_kuliah']);
                        $this->db->update('jadwal_kuliah', $update);
                    }
                }
            } ?>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>



                <!-- Nav Item - Messages -->


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if ($this->session->userdata['role_id'] == 2) {
                                                                                        echo $user['nama_dosen'];
                                                                                    } else if ($this->session->userdata['role_id'] == 3) {
                                                                                        echo $user['nama_mahasiswa'];
                                                                                    } else {
                                                                                        echo "ADMIN";
                                                                                    }  ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/image/') . "xlogo2.png" ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                        <?php if ($this->session->userdata['role_id'] == 1) : ?>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Mode RFID
                            </a>
                        <?php endif; ?>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>