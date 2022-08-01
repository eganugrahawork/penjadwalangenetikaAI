<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen_matkul extends CI_Controller
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
        $s_a = $this->db->get_where('semester_aktif', ['is_active' == 1])->row_array();
        $data['title'] = "Manajemen Mata Kuliah";
        $data['dosen'] = $this->db->get('dosen')->result_array();
        $mm = "SELECT * FROM mata_kuliah a WHERE a.semester_id %2 = $s_a[id_semester_aktif] AND NOT EXISTS (SELECT * FROM pengampu b WHERE b.matkul_id = a.id_matkul)";
        $data['mk'] = $this->db->query($mm)->result_array();

        $pngmp = "SELECT * FROM pengampu a LEFT JOIN dosen b ON a.dosen_id = b.id_dosen LEFT JOIN mata_kuliah c ON a.matkul_id = c.id_matkul LEFT JOIN jurusan d ON c.jurusan_id = d.id_jurusan";
        $data['pengampu'] = $this->db->query($pngmp)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manajemen/pengampu', $data);
        $this->load->view('templates/footer');
    }
    // public function changeAccess()
    // {
    //     $matkul_id = $this->input->post('matkulId');
    //     $dosen_id = $this->input->post('dosenId');

    //     $data = [
    //         'matkul_id' => $matkul_id,
    //         'dosen_id' => $dosen_id
    //     ];

    //     $result = $this->db->get_where('dosen_matkul', $data);

    //     if ($result->num_rows() < 1) {
    //         $this->db->insert('dosen_matkul', $data);
    //     } else {
    //         $this->db->delete('dosen_matkul', $data);
    //     }
    //     $this->session->set_flashdata('message', 'Access Changed');
    // }

    public function tambah_pengampu()
    {
        $matkul_id = $this->input->post('matkul_id');
        $dosen_id = $this->input->post('dosen_id');
        $mk = $this->db->get_where('mata_kuliah', ['id_matkul' => $matkul_id])->row_array();
        $semester = $this->db->get_where('semester', ['id_semester' => $mk['semester_id']])->row_array();

        $angkatan = $this->db->get_where('angkatan', ['status' == 1])->row_array();

        $kelas = $this->db->get_where('kelas', ['semester_id' => $semester['id_semester'], 'jurusan_id' => $mk['jurusan_id']])->result_array();
        $count = count($kelas);
        for ($x = 0; $x < $count; $x++) {
            $tambah = ['matkul_id' => $matkul_id, 'dosen_id' => $dosen_id, 'kelas' => $kelas[$x]['nama_kelas'], 'tahun_akademik' => $angkatan['nama_angkatan']];
            $this->db->insert('pengampu', $tambah);
        }
        $this->session->set_flashdata('message', 'Berhasil yah');
        redirect('manajemen_matkul');
    }
    public function truncate_pengampu()
    {
        $truncate = "TRUNCATE TABLE pengampu";
        $this->db->query($truncate);
        $this->session->set_flashdata('message', 'Berhasil yah');
        redirect('manajemen_matkul');
    }

    function get_dosen()
    {
        $matkul_id = $this->input->post('id', TRUE);
        $mk = $this->db->get_where('mata_kuliah', ['id_matkul' => $matkul_id])->row_array();
        $data = $this->db->get_where('dosen', ['jurusan_id' => $mk['jurusan_id']])->result_array();

        echo json_encode($data);
    }
}
