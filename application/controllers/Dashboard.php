<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {

        // role id belum diperbaiki harusnya role id 1 adalah admin
        if ($this->session->userdata('role_id') == 2) {
            $data['user'] = $this->db->get_where('dosen', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else if ($this->session->userdata('role_id') == 3) {
            $data['user'] = $this->db->get_where('mahasiswa', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else {
            $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata['id_user']])->row_array();
        }

        $data['title'] = "Dashboard";
        $data['jml_dosen'] = $this->db->count_all('dosen');
        $data['jml_mhs'] = $this->db->count_all('mahasiswa');
        $data['jml_kls'] = $this->db->count_all('kelas');
        $data['semester_aktif'] = $this->db->get_where('semester_aktif', ['is_active' => 1])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_rfid()
    {

        $ambil_uid = $this->input->get('uid_rfid');
        $ada_data = $this->db->get_where('rfid', ['uid_rfid' => $ambil_uid])->row_array();

        if ($ada_data <= 0) {
            $this->db->insert('rfid', ['uid_rfid' => $ambil_uid]);
            $this->session->set_flashdata('message', 'UID ditambahkam');
            redirect('manajemen_data');
        } else {
            $this->session->set_flashdata('message', 'UID telah ada');
            redirect('manajemen_data');
        }
    }

    public function buka_pintu()
    {
        $hariInggris = date('l');
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
        }

        $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata['id_user']])->row_array();
        $ruangan_id = $_GET["ruangan_id"];
        $uid = $_GET["uid"];
        $hari_id = $this->db->get_where('hari', ['nama_hari' => $hariIndo])->row_array();
        // $data = [
        //     'ruangan_id' => $ruangan_id,
        //     'hari_id' => $hari_id['id_hari'],
        //     'uid' => $uid,
        //     'status' => 1
        // ];
        $query = "SELECT a.status, d.uid_rfid FROM jadwal_kuliah a LEFT JOIN pengampu b ON a.pengampu_id = b.id_pengampu LEFT JOIN dosen c ON b.dosen_id = c.id_dosen LEFT JOIN rfid d ON c.rfid_id = d.id_rfid WHERE a.ruangan_id = $ruangan_id AND a.hari_id = $hari_id[id_hari] AND d.uid_rfid = '$uid' AND a.status = 1";
        $sql = $this->db->query($query)->row_array();

        $query_master = "SELECT uid_rfid FROM rfid_master a LEFT JOIN rfid b ON a.rfid_id = b.id_rfid WHERE b.uid_rfid = '$uid'";
        $sql_master = $this->db->query($query_master)->row_array();
        if ($sql_master > 0 || $sql['status'] == 1) {
            echo "ON";
        } else {
            echo "OFF";
        }
        // if ($sql['status'] == 1) {
        //     echo "ON";
        // } else {
        //     echo "OFF";
        // }
    }
}
