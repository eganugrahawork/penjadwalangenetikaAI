<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_kelas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {


        if ($this->session->userdata('role_id') == 2) {
            $data['user'] = $this->db->get_where('dosen', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else if ($this->session->userdata('role_id') == 3) {
            $data['user'] = $this->db->get_where('mahasiswa', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else {
            $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata['id_user']])->row_array();
        }

        $id__ = $data['user']['kelas_id'];
        $kelas = $this->db->get_where('kelas', ['id_kelas' => $id__])->row_array();
        $data['title'] = "Jadwal Kuliah";
        $jad = "SELECT * FROM jadwal_kuliah a LEFT JOIN pengampu b ON a.pengampu_id = b.id_pengampu LEFT JOIN mata_kuliah c ON b.matkul_id = c.id_matkul LEFT JOIN hari d ON a.hari_id = d.id_hari LEFT JOIN ruangan e ON a.ruangan_id = e.id_ruangan LEFT JOIN jam_belajar f ON a.jam_belajar_id = f.id_jam_belajar LEFT JOIN dosen g ON b.dosen_id = g.id_dosen WHERE  b.kelas = '$kelas[nama_kelas]' ORDER BY d.id_hari, f.id_jam_belajar";
        $data['jadwal'] = $this->db->query($jad)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/jadwal_kelas', $data);
        $this->load->view('templates/footer');
    }
}
