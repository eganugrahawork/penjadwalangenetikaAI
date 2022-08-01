<?php

function is_logged_in()
{
    // $ci = get_instance(); // << ini untuk memanggil $this karena $this tidak bisa digunakan di helpers
    // if (!$ci->session->userdata('id_user')) {
    //     redirect('auth');
    // } else {
    //     $role_id = $ci->session->userdata('role_id');
    //     $menu = $ci->uri->segment(1);

    //     $queryMenu = $ci->db->get_where('menu', ['url' => $menu])->row_array();
    //     $menu_id = $queryMenu['id_menu'];

    //     $userAccess = $ci->db->get_where('user_access_menu', [
    //         'menu_id' => $menu_id,
    //         'role_id' => $role_id
    //     ]);
    //     // MASIH ERROR
    //     if ($userAccess->num_rows() < 1) {
    //         redirect('auth/blocked');
    //     }
    // }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
function check_access_dosen($dosen_id, $matkul_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('dosen_matkul', [
        'dosen_id' => $dosen_id,
        'matkul_id' => $matkul_id
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
