<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_access extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = "User Akses";
        if ($this->session->userdata('role_id') == 2) {
            $data['user'] = $this->db->get_where('dosen', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else if ($this->session->userdata('role_id') == 3) {
            $data['user'] = $this->db->get_where('mahasiswa', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else {
            $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata['id_user']])->row_array();
        }

        $data['role'] = $this->db->get('role')->result_array();
        $data['menu'] = $this->db->get('menu')->result_array();

        $this->form_validation->set_rules('nama_role', 'Nama Role', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user_access/index', $data);
            $this->load->view('templates/footer');
        } else {
            $tambah_role = ['nama_role' => $this->input->post('nama_role')];
            $this->db->insert('role', $tambah_role);
            $this->session->set_flashdata('message', 'Role Ditambahkan');
            redirect('user_access');
        }
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'menu_id' => $menu_id,
            'role_id' => $role_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', 'Access Changed');
    }

    public function edit_role()
    {
        $id_role = $this->input->post('id_role');
        $edit_role = $this->input->post('nama_role');
        $this->db->where('id_role', $id_role);
        $this->db->update('role', ['nama_role' => $edit_role]);
        $this->session->set_flashdata('message', 'Nama role telah diedit');
        redirect('user_access');
    }

    public function delete_role()
    {
        $id_role = $this->uri->segment(3);
        $this->db->where('id_role', $id_role);
        $this->db->delete('role');
        $this->session->set_flashdata('message', 'Role telah dihapus');
        redirect('user_access');
    }
}
