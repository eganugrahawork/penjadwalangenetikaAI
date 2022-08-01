<?php
defined('BASEPATH') or exit('No direct script access allowed');

class manajemen_data_models extends CI_Model
{

    function get_kelas($t_jurusan_id)
    {
        $query = $this->db->get_where('kelas', array('jurusan_id' => $t_jurusan_id));
        return $query;
    }
}
