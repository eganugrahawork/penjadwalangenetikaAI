<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = "Menu";
        if ($this->session->userdata('role_id') == 2) {
            $data['user'] = $this->db->get_where('dosen', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else if ($this->session->userdata('role_id') == 3) {
            $data['user'] = $this->db->get_where('mahasiswa', ['user_id' => $this->session->userdata['id_user']])->row_array();
        } else {
            $data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata['id_user']])->row_array();
        }

        $data['menu'] = $this->db->get('menu')->result_array();
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $addmenu = [
                'nama_menu' => $this->input->post('nama_menu'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon')
            ];
            $this->db->insert('menu', $addmenu);
            $this->session->set_flashdata('message', 'Menu ditambahkan');
            redirect('menu');
        }
    }

    public function edit_menu()
    {
        $id_menu = $this->input->post('id_menu');
        $edit_menu = [
            'nama_menu' => $this->input->post('nama_menu'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon')
        ];
        $this->db->where('id_menu', $id_menu);
        $this->db->update('menu', $edit_menu);
        $this->session->set_flashdata('message', 'Menu telah diubah');
        redirect('menu');
    }
    public function menu_delete()
    {
        $id_menu = $this->uri->segment(3);

        $this->db->delete('menu', ['id_menu' => $id_menu]);
        $this->session->set_flashdata('message', 'Menu Dihapus');
        redirect('menu');
    }
}
