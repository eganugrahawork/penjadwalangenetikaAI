<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_mahasiswa extends CI_Controller
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

        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]', ['is_unique' => 'Email sudah ada']);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]', ['min_length' => 'password terlalu pendek']);
        $this->form_validation->set_rules('nama_mahasiswa', 'Nama Mahasiswa', 'required|trim');
        $this->form_validation->set_rules('nim', 'Nim', 'required|numeric|is_unique[mahasiswa.nim]', ['is_unique' => 'NIM Sudah Ada']);
        $this->form_validation->set_rules('angkatan_id', 'angkatan', 'required');
        $this->form_validation->set_rules('jurusan_id', 'Jurusan', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'required|trim');
        $this->form_validation->set_rules('tempat_tinggal', 'Tempat tinggal', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'Kontak', 'required|numeric|is_unique[mahasiswa.no_hp]', ['is_unique' => 'No kontak sudah digunakan']);
        if ($this->form_validation->run() == false) {

            $data['mahasiswa'] = $this->db->get('mahasiswa')->result_array();
            $data['jurusan'] = $this->db->get('jurusan')->result_array();
            $data['angkatan'] = $this->db->get('angkatan')->result_array();
            $data['title'] = "Data Mahasiswa";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/data_mahasiswa', $data);
            $this->load->view('templates/footer');
        } else {
            $tambah_user = [
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id')
            ];
            $tambah_mahasiswa = [
                'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
                'nim' => $this->input->post('nim'),
                'angkatan_id' => $this->input->post('angkatan_id'),
                'jurusan_id' => $this->input->post('jurusan_id'),
                'kelas_id' => $this->input->post('kelas_id'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'tempat_tinggal' => $this->input->post('tempat_tinggal'),
                'no_hp' => $this->input->post('no_hp')
            ];
            $this->db->insert('user', $tambah_user);
            $this->db->insert('mahasiswa', $tambah_mahasiswa);
            $this->_configadduser($this->input->post('email'), $this->input->post('nim'));
        }
    }

    public function _configadduser($email, $nim)
    {
        $x = $this->db->get_where('user', ['email' => $email])->row_array();
        $id_user = $x['id_user'];
        $this->db->where('nim', $nim);
        $this->db->update('mahasiswa', ['user_id' => $id_user]);
        $this->session->set_flashdata('message', 'Mahasiswa telah ditambah');
        redirect('data_mahasiswa');
    }

    public function edit_mahasiswa()
    {
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $id_user = $this->input->post('id_user');
        $edit_user = [
            'email' => $this->input->post('email')
        ];
        $edit_mahasiswa = [
            'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
            'nim' => $this->input->post('nim'),
            'angkatan_id' => $this->input->post('angkatan_id'),
            'jurusan_id' => $this->input->post('jurusan_id'),
            'kelas_id' => $this->input->post('kelas_id'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'tempat_tinggal' => $this->input->post('tempat_tinggal'),
            'no_hp' => $this->input->post('no_hp')
        ];
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->update('mahasiswa', $edit_mahasiswa);
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $edit_user);
        $this->session->set_flashdata('message', 'Mahasiswa telah diubah');
        redirect('data_mahasiswa');
    }

    public function reset_password()
    {
        $id_user = $this->uri->segment(3);
        $pw = password_hash('1234', PASSWORD_DEFAULT);
        $reset = ['password' => $pw];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $reset);
        $this->session->set_flashdata('message', 'Password Mahasiswa telah direset');
        redirect('data_mahasiswa');
    }

    public function delete_mahasiswa()
    {
        $id_mhs = $this->uri->segment(3);
        $id_user = $this->uri->segment(4);
        $this->db->where('id_mahasiswa', $id_mhs);
        $this->db->delete('mahasiswa');
        $this->db->where('id_user', $id_user);
        $this->db->delete('user');
        $this->session->set_flashdata('message', 'Mahasiswa telah dihapus');
        redirect('data_mahasiswa');
    }
    function get_kelas()
    {
        $this->load->model('manajemen_data_models', 'manajemen_data');
        $t_jurusan_id = $this->input->post('id', TRUE);
        $data = $this->manajemen_data->get_kelas($t_jurusan_id)->result();
        echo json_encode($data);
    }
}
