<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Waktu_tidak_bersedia extends CI_Controller
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

        $data['title'] = "Waktu Tidak Bersedia";
        $h = "SELECT * FROM waktu_tidak_bersedia a LEFT JOIN dosen b ON a.dosen_id = b.id_dosen LEFT JOIN hari c ON a.hari_id = c.id_hari LEFT JOIN jam_belajar d ON a.jam_belajar_id = d.id_jam_belajar";
        $data['wtd'] = $this->db->query($h)->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();
        $data['hari'] = $this->db->get('hari')->result_array();
        $data['waktu'] = $this->db->get('jam_belajar')->result_array();

        $this->form_validation->set_rules('id_dosen', 'Dosen', 'required');
        $this->form_validation->set_rules('id_hari', 'Hari', 'required');
        $this->form_validation->set_rules('id_waktu', 'Waktu', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('waktu_tidak_bersedia/index', $data);
            $this->load->view('templates/footer');
        } else {
            $tambah_waktu = ['dosen_id' => $this->input->post('id_dosen'), 'hari_id' => $this->input->post('id_hari'), 'jam_belajar_id' => $this->input->post('id_waktu')];

            $this->db->insert('waktu_tidak_bersedia', $tambah_waktu);
            $this->session->set_flashdata('message', 'Waktu Tidak Bersedia Ditambahkan');
            redirect('waktu_tidak_bersedia');
        }
    }

    public function hapus_wtb()
    {
        $idw = $this->uri->segment(3);

        $this->db->where('id_waktu_tidak_bersedia', $idw);
        $this->db->delete('waktu_tidak_bersedia');
        $this->session->set_flashdata('message', 'Waktu Tidak Bersedia dihapus');
        redirect('waktu_tidak_bersedia');
    }
}
