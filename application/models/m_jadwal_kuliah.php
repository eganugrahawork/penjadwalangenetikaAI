<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_jadwal_kuliah extends CI_Model
{

    function get_dosen_matkul($semester_aktif)
    {
        $a_mk = "SELECT * FROM dosen_matkul a LEFT JOIN mata_kuliah b ON a.matkul_id = b.id_matkul WHERE b.semester_id %2 = $semester_aktif ORDER BY rand()";
        $mk = $this->db->query($a_mk)->result_array();
        return $mk;
    }

    function get_kelas($matkul_id)
    {
        $query = "SELECT * FROM mata_kuliah a LEFT JOIN semester b ON a.semester_id = b.id_semester LEFT JOIN kelas c ON b.angkatan_id = c.angkatan_id WHERE a.id_matkul = $matkul_id AND a.jurusan_id = c.jurusan_id ORDER BY rand()";
        $kelas = $this->db->query($query)->result_array();
        return $kelas;
    }
}
