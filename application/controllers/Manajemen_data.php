<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen_data extends CI_Controller
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

        $data['title'] = "Manajemen Data";

        $data['kelas'] = $this->db->get('kelas')->result_array();
        $data['matkul'] = $this->db->get('mata_kuliah')->result_array();
        $data['ruangan'] = $this->db->get('ruangan')->result_array();
        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['rfid'] = $this->db->get('rfid')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['angkatan'] = $this->db->get('angkatan')->result_array();
        $data['semester'] = $this->db->get('semester')->result_array();
        $data['semester_aktif'] = $this->db->get('semester_aktif')->result_array();
        $data['rfid_master'] = $this->db->get('rfid_master')->result_array();
        $this->form_validation->set_rules(
            'nama_kelas',
            'Nama Kelas',
            'required|is_unique[kelas.nama_kelas]',
            ['is_unique' => 'Nama Kelas sudah ada']
        );
        if ($this->form_validation->run() == false) {



            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manajemen/index', $data);
            $this->load->view('templates/footer');
        } else {
            $tambah_kelas = [
                'nama_kelas' => $this->input->post('nama_kelas'),
                'jurusan_id' => $this->input->post('jurusan_id'),
                'semester_id' => $this->input->post('semester_id')
            ];
            $this->db->insert('kelas', $tambah_kelas);
            $this->session->set_flashdata('message', 'Kelas ditambahkan');
            redirect('manajemen_data');
        }
    }
    public function edit_kelas()
    {
        $id_kelas = $this->input->post('id_kelas');
        $edit_kelas = [
            'nama_kelas' => $this->input->post('nama_kelas'),
            'jurusan_id' => $this->input->post('jurusan_id'),
            'semester_id' => $this->input->post('semester_id')
        ];
        $this->db->where('id_kelas', $id_kelas);
        $this->db->update('kelas', $edit_kelas);
        $this->session->set_flashdata('message', 'Kelas berhasil diubah');
        redirect('manajemen_data');
    }

    public function delete_kelas()
    {
        $id_kelas = $this->uri->segment(3);
        $this->db->where('id_kelas', $id_kelas);
        $this->db->delete('kelas');
        $this->session->set_flashdata('message', 'Kelas dihapus');
        redirect('manajemen_data');
    }
    public function tambah_matkul()
    {
        $tambah_matkul = [
            'nama_matkul' => $this->input->post('nama_matkul'),
            'jumlah_sks' => $this->input->post('jumlah_sks'),
            'jurusan_id' => $this->input->post('jurusan_id'),
            'semester_id' => $this->input->post('semester_id'),
            'jenis' => $this->input->post('jenis')
        ];
        $this->db->insert('mata_kuliah', $tambah_matkul);
        $this->session->set_flashdata('message', 'Mata kuliah ditambahkan');
        redirect('manajemen_data');
    }
    public function edit_matkul()
    {
        $id_matkul = $this->input->post('id_matkul');
        $edit_matkul = [
            'nama_matkul' => $this->input->post('nama_matkul'),
            'jumlah_sks' => $this->input->post('jumlah_sks'),
            'jurusan_id' => $this->input->post('jurusan_id'),
            'semester_id' => $this->input->post('semester_id'),
            'jenis' => $this->input->post('jenis')
        ];
        $this->db->where('id_matkul', $id_matkul);
        $this->db->update('mata_kuliah', $edit_matkul);
        $this->session->set_flashdata('message', 'Mata Kuliah diubah');
        redirect('manajemen_data');
    }

    public function delete_matkul()
    {
        $id_matkul = $this->uri->segment(3);
        $this->db->where('id_matkul', $id_matkul);
        $this->db->delete('mata_kuliah');
        $this->session->set_flashdata('message', 'Mata Kuliah dihapus');
        redirect('manajemen_data');
    }



    public function tambah_ruangan()
    {
        $tambah_ruangan = [
            'nama_ruangan' => $this->input->post('nama_ruangan'),
            'kapasitas' => $this->input->post('kapasitas'),
            'jenis' => $this->input->post('jenis')
        ];
        $this->db->insert('ruangan', $tambah_ruangan);
        $this->session->set_flashdata('message', 'Ruangan ditambahkan');
        redirect('manajemen_data');
    }

    public function edit_ruangan()
    {
        $id_ruangan = $this->input->post('id_ruangan');
        $edit_ruangan = [
            'nama_ruangan' => $this->input->post('nama_ruangan'),
            'kapasitas' => $this->input->post('kapasitas'),
            'jenis' => $this->input->post('jenis')
        ];
        $this->db->where('id_ruangan', $id_ruangan);
        $this->db->update('ruangan', $edit_ruangan);
        $this->session->set_flashdata('message', 'Ruangan diubah');
        redirect('manajemen_data');
    }
    public function delete_ruangan()
    {
        $id_ruangan = $this->uri->segment(3);
        $this->db->where('id_ruangan', $id_ruangan);
        $this->db->delete('ruangan');
        $this->session->set_flashdata('message', 'Ruangan telah dihapus');
        redirect('manajemen_data');
    }
    public function delete_rfid()
    {
        $id_rfid = $this->uri->segment(3);
        $this->db->where('id_rfid', $id_rfid);
        $this->db->delete('rfid');
        $this->session->set_flashdata('message', 'RFID telah dihapus');
        redirect('manajemen_data');
    }

    public function tambah_jurusan()
    {
        $tambah_jurusan = [
            'nama_jurusan' => $this->input->post('nama_jurusan'),
            'prodi_id' => $this->input->post('prodi_id')
        ];
        $this->db->insert('jurusan', $tambah_jurusan);
        $this->session->set_flashdata('message', 'Jurusan ditambahkan');
        redirect('manajemen_data');
    }
    public function edit_jurusan()
    {
        $id_jurusan = $this->input->post('id_jurusan');
        $edit_jurusan = [
            'nama_jurusan' => $this->input->post('nama_jurusan'),
            'prodi_id' => $this->input->post('prodi_id')
        ];
        $this->db->where('id_jurusan', $id_jurusan);
        $this->db->update('jurusan', $edit_jurusan);
        $this->session->set_flashdata('message', 'Jurusan diubah');
        redirect('manajemen_data');
    }

    public function delete_jurusan()
    {
        $id_jurusan = $this->uri->segment(3);
        $this->db->where('id_jurusan', $id_jurusan);
        $this->db->delete('jurusan');
        $this->session->set_flashdata('message', 'Jurusan telah dihapus');
        redirect('manajemen_data');
    }


    public function tambah_prodi()
    {

        $tambah_prodi = ['nama_prodi' => $this->input->post('nama_prodi')];
        $this->db->insert('prodi', $tambah_prodi);
        $this->session->set_flashdata('message', 'Program Studi ditambahkan');
        redirect('manajemen_data');
    }
    public function edit_prodi()
    {
        $id_prodi = $this->input->post('id_prodi');
        $edit_prodi = ['nama_prodi' => $this->input->post('nama_prodi')];
        $this->db->where('id_prodi', $id_prodi);
        $this->db->update('prodi', $edit_prodi);
        $this->session->set_flashdata('message', 'Program Studi diedit');
        redirect('manajemen_data');
    }
    public function delete_prodi()
    {
        $id_prodi = $this->uri->segment(3);
        $this->db->delete('prodi', ['id_prodi' => $id_prodi]);
        $this->session->set_flashdata('message', 'Program Studi dihapus');
        redirect('manajemen_data');
    }

    public function tambah_angkatan()
    {

        $tambah_angkatan = ['nama_angkatan' => $this->input->post('nama_angkatan')];
        $this->db->insert('angkatan', $tambah_angkatan);
        $this->session->set_flashdata('message', 'Angkatan ditambahkan');
        redirect('manajemen_data');
    }

    public function edit_angkatan()
    {
        $id_angkatan = $this->input->post('id_angkatan');
        $edit_angkatan = ['nama_angkatan' => $this->input->post('nama_angkatan'), 'status' => $this->input->post('status')];
        $this->db->where('id_angkatan', $id_angkatan);
        $this->db->update('angkatan', $edit_angkatan);
        $this->session->set_flashdata('message', 'Angkatan diedit');
        redirect('manajemen_data');
    }

    public function delete_angkatan()
    {
        $id_angkatan = $this->uri->segment(3);
        $this->db->delete('angkatan', ['id_angkatan' => $id_angkatan]);
        $this->session->set_flashdata('message', 'Angkatan dihapus');
        redirect('manajemen_data');
    }

    public function tambah_semester()
    {

        $tambah_semester = [
            'nama_semester' => $this->input->post('nama_semester'),
            'angkatan_id' => $this->input->post('angkatan_id')
        ];
        $this->db->insert('semester', $tambah_semester);
        $this->session->set_flashdata('message', 'Semester ditambahkan');
        redirect('manajemen_data');
    }

    public function edit_semester()
    {
        $id_semester = $this->input->post('id_semester');
        $edit_semester = [
            'nama_semester' => $this->input->post('nama_semester'),
            'angkatan_id' => $this->input->post('angkatan_id')
        ];
        $this->db->where('id_semester', $id_semester);
        $this->db->update('semester', $edit_semester);
        $this->session->set_flashdata('message', 'Semester diedit');
        redirect('manajemen_data');
    }
    public function delete_semester()
    {
        $id_semester = $this->uri->segment(3);
        $this->db->delete('semester', ['id_semester' => $id_semester]);
        $this->session->set_flashdata('message', 'Semester dihapus');
        redirect('manajemen_data');
    }

    public function edit_semester_aktif()
    {
        $id_semester_aktif = $this->input->post('semester_aktif');
        $this->db->where('id_semester_aktif', $id_semester_aktif);
        $this->db->update('semester_aktif', ['is_active' => 1]);
        $array = ['id_semester_aktif !=' => $id_semester_aktif];
        $this->db->where($array);
        $this->db->update('semester_aktif', ['is_active' => '0']);
        $this->session->set_flashdata('message', 'Semester Aktif diperbarui');
        redirect('manajemen_data');
    }

    public function tambah_master()
    {

        $tambah_master = [
            'nama_master' => $this->input->post('nama_master'),
            'jabatan' => $this->input->post('jabatan'),
            'rfid_id' => $this->input->post('rfid_id')
        ];
        $this->db->insert('rfid_master', $tambah_master);
        $this->session->set_flashdata('message', 'master ditambahkan');
        redirect('manajemen_data');
    }
    public function delete_master()
    {
        $id_master = $this->uri->segment(3);
        $this->db->delete('rfid_master', ['id_rfid_master' => $id_master]);
        $this->session->set_flashdata('message', 'master dihapus');
        redirect('manajemen_data');
    }
}
