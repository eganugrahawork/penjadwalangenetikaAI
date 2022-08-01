<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_dosen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


    public function index()
    {

        $data['title'] = "Data Dosen";
        $data['dosen'] = $this->db->get('dosen')->result_array();
        $data['jurusan'] = $this->db->get('jurusan')->result_array();


        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]', ['is_unique' => 'Email sudah ada']);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]', ['min_length' => 'password terlalu pendek']);
        $this->form_validation->set_rules('nama_dosen', 'Nama Dosen', 'required|trim');
        $this->form_validation->set_rules('nidn', 'NIDN', 'required|numeric|is_unique[dosen.nidn]', ['is_unique' => 'NIDN Sudah Ada']);
        $this->form_validation->set_rules('jurusan_id', 'jurusan_id', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/daftar_dosen', $data);
            $this->load->view('templates/footer');
        } else {
            $tambah_user = [
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id')
            ];
            $tambah_dosen = [
                'nama_dosen' => $this->input->post('nama_dosen'),
                'nidn' => $this->input->post('nidn'),
                'jurusan_id' => $this->input->post('jurusan_id'),
                'rfid_id' => 0
            ];
            $this->db->insert('user', $tambah_user);
            $this->db->insert('dosen', $tambah_dosen);
            $this->_configuserid($this->input->post('email'), $this->input->post('nidn'));
        }
    }

    private function _configuserid($email, $nidn)
    {
        $x = $this->db->get_where('user', ['email' => $email])->row_array();
        $id_user = $x['id_user'];
        $this->db->where('nidn', $nidn);
        $this->db->update('dosen', ['user_id' => $id_user]);
        $this->session->set_flashdata('message', 'Dosen telah ditambah');
        redirect('daftar_dosen');
    }

    public function edit_dosen()
    {

        $id_dosen = $this->input->post('id_dosen');
        $id_user = $this->input->post('id_user');
        $edit_user = [
            'email' => $this->input->post('email')
        ];
        $edit_dosen = [
            'nama_dosen' => $this->input->post('nama_dosen'),
            'nidn' => $this->input->post('nidn'),
            'jurusan_id' => $this->input->post('jurusan_id')
        ];
        $this->db->where('id_dosen', $id_dosen);
        $this->db->update('dosen', $edit_dosen);
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $edit_user);
        $this->session->set_flashdata('message', 'Dosen telah diubah');
        redirect('daftar_dosen');
    }

    public function dosen_delete()
    {
        $id_dosen = $this->uri->segment(3);
        $px = $this->db->get_where('dosen', ['id_dosen' => $id_dosen])->row_array();
        $usr = $this->db->get_where('user', ['id_user' => $px['user_id']])->row_array();

        $this->db->where('id_dosen', $id_dosen);
        $this->db->delete('dosen');
        $this->db->delete('user', ['id_user' => $usr['id_user']]);
        $this->session->set_flashdata('message', 'Dosen telah dihapus');
        redirect('daftar_dosen');
    }
    public function reset_password()
    {
        $id_user = $this->uri->segment(3);
        $pw = password_hash('1234', PASSWORD_DEFAULT);
        $reset = ['password' => $pw];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $reset);
        $this->session->set_flashdata('message', 'Password dosen telah direset');
        redirect('daftar_dosen');
    }

    public function edit_kartu_dosen()
    {

        $id_dosen = $this->input->post('id_dosen');

        $edit_dosen = [
            'rfid_id' => $this->input->post('rfid_id'),
        ];

        $cek_rfid = $this->db->get_where('dosen', $edit_dosen)->row_array();
        if ($cek_rfid > 0) {
            $this->session->set_flashdata('message', 'Nomor Kartu telah digunakan');
            redirect('daftar_dosen');
        } else {


            $this->db->where('id_dosen', $id_dosen);

            $this->db->update('dosen', $edit_dosen);
            $this->session->set_flashdata('message', 'Kartu Dosen telah diubah');
            redirect('daftar_dosen');
        }
    }

    public function delete_akses_rfid()
    {
        $id_dosen = $this->uri->segment(3);
        $reset_rfid = ['rfid_id' => 0];

        $this->db->where('id_dosen', $id_dosen);
        $this->db->update('dosen', $reset_rfid);
        $this->session->set_flashdata('message', 'Nomor Kartu telah dihapus');
        redirect('daftar_dosen');
    }
}
