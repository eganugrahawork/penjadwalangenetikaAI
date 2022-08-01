<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen_jadwal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // include_once("genetik.php");
    }
    public function index()
    {
        $this->load->model("m_jadwal_kuliah");

        // role id belum diperbaiki harusnya role id 1 adalah admin
        if ($this->session->userdata('role_id') == 2) {
            $data['user'] = $this->db->get_where('dosen', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else if ($this->session->userdata('role_id') == 3) {
            $data['user'] = $this->db->get_where('mahasiswa', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else {
            $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata['id_user']])->row_array();
        }

        $data['semesteraktif'] = $this->db->get('semester_aktif')->result_array();

        $this->form_validation->set_rules('semester_aktif', 'semester_aktif', 'required');
        $this->form_validation->set_rules('jumlah_populasi', 'Jumlah Populiasi', 'xss_clean|required');
        $this->form_validation->set_rules('probabilitas_crossover', 'Probabilitas CrossOver', 'xss_clean|required');
        $this->form_validation->set_rules('probabilitas_mutasi', 'Probabilitas Mutasi', 'xss_clean|required');
        $this->form_validation->set_rules('jumlah_generasi', 'Jumlah Generasi', 'xss_clean|required');
        if ($this->form_validation->run() == false) {

            $matkulkuu = "SELECT b.nama_hari, c.jam_belajar, d.nama_ruangan, g.nama_dosen, e.kelas, f.nama_matkul, f.jumlah_sks, a.status FROM jadwal_kuliah a LEFT JOIN hari b ON a.hari_id = b.id_hari LEFT JOIN jam_belajar c ON a.jam_belajar_id = c.id_jam_belajar LEFT JOIN ruangan d ON a.ruangan_id = d.id_ruangan LEFT JOIN pengampu e ON a.pengampu_id = id_pengampu LEFT JOIN mata_kuliah f ON e.matkul_id = f.id_matkul LEFT JOIN dosen g ON e.dosen_id = g.id_dosen ORDER BY b.id_hari, c.id_jam_belajar";
            $data['matkul_haha'] = $this->db->query($matkulkuu)->result_array();
            $data['title'] = "Manajemen Jadwal";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen/jadwal', $data);
            $this->load->view('templates/footer');
        } else {
            $semester_aktif = $this->input->post('semester_aktif');
            $jumlah_populasi = $this->input->post('jumlah_populasi');
            $crossOver = $this->input->post('probabilitas_crossover');
            $mutasi = $this->input->post('probabilitas_mutasi');
            $jumlah_generasi = $this->input->post('jumlah_generasi');

            $rs_data = $this->db->query("SELECT a.id_pengampu, b.jumlah_sks, a.dosen_id, b.jenis FROM pengampu a LEFT JOIN mata_kuliah b ON a.matkul_id = b.id_matkul WHERE b.semester_id %2 = $semester_aktif")->result_array();


            $this->genetik($semester_aktif, $jumlah_populasi, $crossOver, $mutasi, 5, '4-5-6', 6);
            $this->AmbilData();
            $this->Inisialisasi();

            $found = false;
            for ($i = 0; $i < $jumlah_generasi; $i++) {
                $fitness = $this->HitungFitness();
                // if ($i == 100) {
                //     var_dump($fitness);
                //     exit();
                // }
                $this->Seleksi($fitness);
                $this->StartCrossOver();
                $fitnessAfterMutation = $this->Mutasi();
                for ($j = 0; $j < count($fitnessAfterMutation); $j++) {
                    if ($fitnessAfterMutation[$j] == 1) {
                        $this->db->query("TRUNCATE TABLE jadwal_kuliah");
                        $jadwal_kuliah = array(array());
                        $jadwal_kuliah = $this->GetIndividu($j);
                        for ($k = 0; $k < count($jadwal_kuliah); $k++) {
                            $kode_pengampu = intval($jadwal_kuliah[$k][0]);
                            $kode_jam = intval($jadwal_kuliah[$k][1]);
                            $kode_hari = intval($jadwal_kuliah[$k][2]);
                            $kode_ruang = intval($jadwal_kuliah[$k][3]);
                            $this->db->query("INSERT INTO jadwal_kuliah(pengampu_id,jam_belajar_id, hari_id, ruangan_id) VALUES ($kode_pengampu, $kode_jam, $kode_hari, $kode_ruang)");
                        }
                        // var_dump($jadwal_kuliah);
                        // exit;
                        $found = true;
                    }
                    if ($found) {
                        $this->session->set_flashdata('message', 'Jadwal Baru Selesai dibuat');
                        redirect('manajemen_jadwal');
                        break;
                    }
                }
                if ($found) {
                    $this->session->set_flashdata('message', 'Jadwal Baru Selesai dibuat');
                    redirect('manajemen_jadwal');
                    break;
                }
            }
            if (!$found) {
                $this->session->set_flashdata('message', "tidak ditemukan solusi");
                redirect('manajemen_jadwal');
            }
        }
    }

    private $PRAKTIKUM = 'Praktikum';
    private $TEORI = 'Teori';
    private $LABORATORIUM = 'Praktikum';

    private $semester_aktif;
    private $populasi;
    private $crossOver;
    private $mutasi;

    private $pengampu = array();
    private $individu = array(array(array()));
    private $sks = array();
    private $dosen = array();

    private $jam = array();
    private $hari = array();
    private $idosen = array();

    //waktu keinginan dosen
    private $waktu_dosen = array(array());
    private $jenis_mk = array(); //reguler or praktikum

    private $ruangLaboratorium = array();
    private $ruangReguler = array();
    private $logAmbilData;
    private $logInisialisasi;

    // private $log; //ini apaaaaaaaa??
    private $induk = array();

    //jumat
    private $kode_jumat;
    private $range_jumat = array();
    private $kode_dzuhur;
    private $is_waktu_dosen_tidak_bersedia_empty;

    public function genetik($semester_aktif, $populasi, $crossOver, $mutasi, $kode_jumat, $range_jumat, $kode_dzuhur)
    {
        $this->jenis_semester = $semester_aktif;
        $this->populasi = intval($populasi);
        $this->crossOver = $crossOver;
        $this->mutasi = $mutasi;
        $this->kode_jumat = intval($kode_jumat);
        $this->range_jumat = explode('-', $range_jumat);
        $this->kode_dzuhur = intval($kode_dzuhur);
    }
    public function AmbilData()
    {
        $rs_data = $this->db->query("SELECT a.id_pengampu, b.jumlah_sks, a.dosen_id, b.jenis FROM pengampu a LEFT JOIN mata_kuliah b ON a.matkul_id = b.id_matkul WHERE b.semester_id %2 = $this->jenis_semester");
        $i = 0;
        foreach ($rs_data->result() as $data) {
            $this->pengampu[$i] = intval($data->id_pengampu);
            $this->sks[$i] = intval($data->jumlah_sks);
            $this->dosen[$i] = intval($data->dosen_id);
            $this->jenis_mk[$i] = $data->jenis;
            $i++;
        }

        // jadikan array  jam variabel
        $rs_jam = $this->db->query("SELECT id_jam_belajar FROM jam_belajar");
        $i = 0;
        foreach ($rs_jam->result() as $data) {
            $this->jam[$i] = intval($data->id_jam_belajar);
            $i++;
        }
        // jadikan array  hari variabel
        $rs_hari = $this->db->query("SELECT id_hari FROM hari");
        $i = 0;
        foreach ($rs_hari->result() as $data) {
            $this->hari[$i] = intval($data->id_hari);
            $i++;
        }

        // jadikan array ruangan
        $rs_RuangReguler = $this->db->query("SELECT id_ruangan FROM ruangan WHERE jenis = '$this->TEORI'");
        $i = 0;
        foreach ($rs_RuangReguler->result() as $data) {
            $this->ruangReguler[$i] = intval($data->id_ruangan);
            $i++;
        }

        $rs_RuangLaboratorium = $this->db->query("SELECT id_ruangan FROM ruangan Where jenis = '$this->LABORATORIUM'");
        $i = 0;
        foreach ($rs_RuangLaboratorium->result() as $data) {
            $this->ruangLaboratorium[$i] = intval($data->id_ruangan);
            $i++;
        }

        $rs_WaktuDosen = $this->db->query("SELECT dosen_id, CONCAT_WS(':',hari_id,jam_belajar_id) as id_hari_jam FROM waktu_tidak_bersedia");
        $i = 0;
        foreach ($rs_WaktuDosen->result() as $data) {
            $this->idosen[$i] = intval($data->dosen_id);
            $this->waktu_dosen[$i][0] = intval($data->dosen_id);
            $this->waktu_dosen[$i][1] = $data->id_hari_jam;
            $i++;
        }
    }

    public function Inisialisasi()
    {
        $jumlah_pengampu = count($this->pengampu);
        $jumlah_jam = count($this->jam);
        $jumlah_hari = count($this->hari);
        $jumlah_ruang_reguler = count($this->ruangReguler);
        $jumlah_ruang_lab = count($this->ruangLaboratorium);

        for ($i = 0; $i < $this->populasi; $i++) {
            for ($j = 0; $j < $jumlah_pengampu; $j++) {
                $sks = $this->sks[$j];

                $this->individu[$i][$j][0] = $j;
                // penentuan jam secara acak ketika 1 sks
                if ($sks == 1) {
                    $this->individu[$i][$j][1] = mt_rand(0, $jumlah_jam - 1);
                }
                // penentuan jam secara acak ketika 2 sks
                if ($sks == 2) {
                    $this->individu[$i][$j][1] = mt_rand(0, ($jumlah_jam - 1) - 1);
                }
                // penentuan jam secara acak ketika 3 sks
                if ($sks == 3) {
                    $this->individu[$i][$j][1] = mt_rand(0, ($jumlah_jam - 1) - 2);
                }
                // penentuan jam secara acak ketika 4 sks
                if ($sks == 4) {
                    $this->individu[$i][$j][1] = mt_rand(0, ($jumlah_jam - 1) - 3);
                }
                $this->individu[$i][$j][2] = mt_rand(0, $jumlah_hari - 1); //penentuan hari secara acak
                if ($this->jenis_mk[$j] === $this->TEORI) {
                    $this->individu[$i][$j][3] = intval($this->ruangReguler[mt_rand(0, $jumlah_ruang_reguler - 1)]);
                } else {
                    $this->individu[$i][$j][3] = intval($this->ruangLaboratorium[mt_rand(0, $jumlah_ruang_lab - 1)]);
                }
            }
        }
    }

    public function CekFitness($indv)
    {
        $penalty = 0;
        $hari_jumat = intval($this->kode_jumat);
        $jumat_0 = intval($this->range_jumat[0]);
        $jumat_1 = intval($this->range_jumat[1]);
        $jumat_2 = intval($this->range_jumat[2]);

        $jumlah_pengampu = count($this->pengampu);

        for ($i = 0; $i < $jumlah_pengampu; $i++) {
            $sks = intval($this->sks[$i]);

            $jam_a = intval($this->individu[$indv][$i][1]);
            $hari_a = intval($this->individu[$indv][$i][2]);
            $ruang_a = intval($this->individu[$indv][$i][3]);
            $dosen_a = intval($this->dosen[$i]);
            for ($j = 0; $j < $jumlah_pengampu; $j++) {
                $jam_b = intval($this->individu[$indv][$j][1]);
                $hari_b = intval($this->individu[$indv][$j][2]);
                $ruang_b = intval($this->individu[$indv][$j][3]);
                $dosen_b = intval($this->dosen[$j]);

                if ($i == $j)
                    continue;

                if ($jam_a == $jam_b && $hari_a == $hari_b && $ruang_a == $ruang_b) {
                    $penalty += 1;
                }

                //Ketika sks  = 2, 
                //hari dan ruang sama, dan 
                //jam kedua sama dengan jam pertama matakuliah yang lain, maka penalty + 1
                if ($sks >= 2) {
                    if (
                        $jam_a + 1 == $jam_b &&
                        $hari_a == $hari_b &&
                        $ruang_a == $ruang_b
                    ) {
                        $penalty += 1;
                    }
                }
                //Ketika sks  = 3, 
                //hari dan ruang sama dan 
                //jam ketiga sama dengan jam pertama matakuliah yang lain, maka penalty + 1
                if ($sks >= 3) {
                    if (
                        $jam_a + 2 == $jam_b &&
                        $hari_a == $hari_b &&
                        $ruang_a == $ruang_b
                    ) {
                        $penalty += 1;
                    }
                }

                //Ketika sks  = 4, 
                //hari dan ruang sama dan 
                //jam ketiga sama dengan jam pertama matakuliah yang lain, maka penalty + 1
                if ($sks >= 4) {
                    if (
                        $jam_a + 3 == $jam_b &&
                        $hari_a == $hari_b &&
                        $ruang_a == $ruang_b
                    ) {
                        $penalty += 1;
                    }
                }

                //______________________BENTROK DOSEN
                if (
                    //ketika jam sama
                    $jam_a == $jam_b &&
                    //dan hari sama
                    $hari_a == $hari_b &&
                    //dan dosennya sama
                    $dosen_a == $dosen_b
                ) {
                    //maka...
                    $penalty += 1;
                }


                if ($sks >= 2) {
                    if (
                        //ketika jam sama
                        ($jam_a + 1) == $jam_b &&
                        //dan hari sama
                        $hari_a == $hari_b &&
                        //dan dosennya sama
                        $dosen_a == $dosen_b
                    ) {
                        //maka...
                        $penalty += 1;
                    }
                }

                if ($sks >= 3) {
                    if (
                        //ketika jam sama
                        ($jam_a + 2) == $jam_b &&
                        //dan hari sama
                        $hari_a == $hari_b &&
                        //dan dosennya sama
                        $dosen_a == $dosen_b
                    ) {
                        //maka...
                        $penalty += 1;
                    }
                }

                if ($sks >= 4) {
                    if (
                        //ketika jam sama
                        ($jam_a + 3) == $jam_b &&
                        //dan hari sama
                        $hari_a == $hari_b &&
                        //dan dosennya sama
                        $dosen_a == $dosen_b
                    ) {
                        //maka...
                        $penalty += 1;
                    }
                }
            }
            //
            // #region Bentrok sholat Jumat
            if (($hari_a  + 1) == $hari_jumat) //2.bentrok sholat jumat
            {

                if ($sks == 1) {
                    if (

                        ($jam_a == ($jumat_0 - 1)) ||
                        ($jam_a == ($jumat_1 - 1)) ||
                        ($jam_a == ($jumat_2 - 1))

                    ) {

                        $penalty += 1;
                    }
                }


                if ($sks == 2) {
                    if (
                        ($jam_a == ($jumat_0 - 2)) ||
                        ($jam_a == ($jumat_0 - 1)) ||
                        ($jam_a == ($jumat_1 - 1)) ||
                        ($jam_a == ($jumat_2 - 1))
                    ) {
                        /*
                        echo '$sks = ' . $sks. '<br>';
                        echo '$jam_a = ' . $jam_a. '<br>';
                        echo '($jumat_0 - 2) = ' . ($jumat_0 - 2) . '<br>';
                        echo '($jumat_0 - 1) = ' . ($jumat_0 - 1). '<br>';
                        echo '($jumat_1 - 1) = ' . ($jumat_1 - 1). '<br>';
                        echo '($jumat_2 - 1) = ' . ($jumat_2- 1). '<br>';
                        exit();
                        */

                        $penalty += 1;
                    }
                }

                if ($sks == 3) {
                    if (
                        ($jam_a == ($jumat_0 - 3)) ||
                        ($jam_a == ($jumat_0 - 2)) ||
                        ($jam_a == ($jumat_0 - 1)) ||
                        ($jam_a == ($jumat_1 - 1)) ||
                        ($jam_a == ($jumat_2 - 1))
                    ) {
                        $penalty += 1;
                    }
                }

                if ($sks == 4) {
                    if (
                        ($jam_a == ($jumat_0 - 4)) ||
                        ($jam_a == ($jumat_0 - 3)) ||
                        ($jam_a == ($jumat_0 - 2)) ||
                        ($jam_a == ($jumat_0 - 1)) ||
                        ($jam_a == ($jumat_1 - 1)) ||
                        ($jam_a == ($jumat_2 - 1))
                    ) {
                        $penalty += 1;
                    }
                }
            }
            //#endregion

            //#region Bentrok dengan Waktu Keinginan Dosen
            //Boolean penaltyForKeinginanDosen = false;
            $jumlah_waktu_tidak_bersedia = count($this->idosen);

            for ($j = 0; $j < $jumlah_waktu_tidak_bersedia; $j++) {
                if ($dosen_a == $this->idosen[$j]) {
                    $hari_jam = explode(':', $this->waktu_dosen[$j][1]);

                    if (
                        $this->jam[$jam_a] == $hari_jam[1] &&
                        $this->hari[$hari_a] == $hari_jam[0]
                    ) {
                        $penalty += 1;
                    }
                }
            }


            //#endregion

            //#region Bentrok waktu dhuhur
            /*
            if ($jam_a == ($this->kode_dhuhur - 1))
            {                
                $penalty += 1;
            }
            */
        }

        $fitness = floatval(1 / (1 + $penalty));

        return $fitness;
    }

    public function HitungFitness()
    {
        for ($indv = 0; $indv < $this->populasi; $indv++) {
            $fitness[$indv] = $this->CekFitness($indv);
        }
        return $fitness;
    }

    public function Seleksi($fitness)
    {
        $jumlah = 0;
        $rank = array();
        for ($i = 0; $i < $this->populasi; $i++) {
            $rank[$i] = 1;
            for ($j = 0; $j < $this->populasi; $j++) {
                $fitnessA = floatval($fitness[$i]);
                $fitnessB = floatval($fitness[$j]);
                if ($fitnessA > $fitnessB) {
                    $rank[$i] += 1;
                }
            }
            $jumlah += $rank[$i];
        }
        $jumlah_rank = count($rank);
        for ($i = 0; $i < $this->populasi; $i++) {
            $target = mt_rand(0, $jumlah - 1);
            $cek = 0;
            for ($j = 0; $j < $jumlah_rank; $j++) {
                $cek += $rank[$j];
                if (intval($cek) >= intval($target)) {
                    $this->induk[$i] = $j;
                    break;
                }
            }
        }
    }
    // Koding jam 22.40 mulai tidak benar
    public function StartCrossOver()
    {
        $individu_baru = array(array(array()));
        $jumlah_pengampu = count($this->pengampu);

        for ($i = 0; $i < $this->populasi; $i += 2) {
            $b = 0;

            $cr = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
            if (floatval($cr) < floatval($this->crossOver)) {
                $a = mt_rand(0, $jumlah_pengampu - 2);
                while ($b <= $a) {
                    $b = mt_rand(0, $jumlah_pengampu - 1);
                }

                // var_dump($this->induk);
                // exit;

                // Penentuan jadwal baru dari awal sampai titik pertama
                for ($j = 0; $j < $a; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k] = $this->individu[$this->induk[$i]][$j][$k];
                        $individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
                    }
                }

                for ($j = $a; $j < $b; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
                        $individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i]][$j][$k];
                    }
                }

                for ($j = $b; $j < $jumlah_pengampu; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k] = $this->individu[$this->induk[$i]][$j][$k];
                        $individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
                    }
                }
            } else {
                for ($j = 0; $j < $jumlah_pengampu; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k] = $this->individu[$this->induk[$i]][$j][$k];
                        $individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
                    }
                }
            }
        }
        $jumlah_pengampu = count($this->pengampu);
        for ($i = 0; $i < $this->populasi; $i += 2) {
            for ($j = 0; $j < $jumlah_pengampu; $j++) {
                for ($k = 0; $k < 4; $k++) {
                    $this->individu[$i][$j][$k] = $individu_baru[$i][$j][$k];
                    $this->individu[$i + 1][$j][$k] = $individu_baru[$i + 1][$j][$k];
                }
            }
        }
    }

    public function Mutasi()
    {
        $fitness = array();
        $r = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
        $jumlah_pengampu = count($this->pengampu);
        $jumlah_jam = count($this->jam);
        $jumlah_hari = count($this->hari);
        $jumlah_ruang_reguler = count($this->ruangReguler);
        $jumlah_ruang_lab = count($this->ruangLaboratorium);

        for ($i = 0; $i < $this->populasi; $i++) {
            if ($r < $this->mutasi) {
                $krom = mt_rand(0, $jumlah_pengampu - 1);
                $j = intval($this->sks[$krom]);

                switch ($j) {
                    case 1:
                        $this->individu[$i][$krom][1] = mt_rand(0, $jumlah_jam - 1);
                        break;
                    case 2:
                        $this->individu[$i][$krom][1] = mt_rand(0, ($jumlah_jam - 1) - 1);
                        break;
                    case 3:
                        $this->individu[$i][$krom][1] = mt_rand(0, ($jumlah_jam - 1) - 2);
                        break;
                    case 4:
                        $this->individu[$i][$krom][1] = mt_rand(0, ($jumlah_jam - 1) - 3);
                        break;
                }
                $this->individu[$i][$krom][2] = mt_rand(0, $jumlah_hari - 1);

                if ($this->jenis_mk[$krom] === $this->TEORI) {
                    $this->individu[$i][$krom][3] = $this->ruangReguler[mt_rand(0, $jumlah_ruang_reguler - 1)];
                } else {
                    $this->individu[$i][$krom][3] = $this->ruangLaboratorium[mt_rand(0, $jumlah_ruang_lab - 1)];
                }
            }
            $fitness[$i] = $this->CekFitness($i);
        }
        return $fitness;
    }

    public function GetIndividu($indv)
    {

        $individu_solusi = array(array());
        for ($j = 0; $j < count($this->pengampu); $j++) {
            $individu_solusi[$j][0] = intval($this->pengampu[$this->individu[$indv][$j][0]]);
            $individu_solusi[$j][1] = intval($this->jam[$this->individu[$indv][$j][1]]);
            $individu_solusi[$j][2] = intval($this->hari[$this->individu[$indv][$j][2]]);
            $individu_solusi[$j][3] = intval($this->individu[$indv][$j][3]);
        }
        return $individu_solusi;
    }
}
