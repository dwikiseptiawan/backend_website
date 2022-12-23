<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MUser extends CI_Model
{

    // buat fungsi "get_data"
    function get_data()
    {
        $this->db->select("*");
        $this->db->from("tbl_user");

        $this->db->order_by("nama", "ASC");
        $query = $this->db->get()->result();

        return $query;
    }

    // buat fungsi untuk save data
    function save_data($nama, $username, $password, $type)
    {
        // isi nilai untuk masing" filed
        $data = array(
            "nama" => $nama,
            "username" => $username,
            "password" => $password,
            "type" => $type,
        );

        return $this->db->insert("tbl_user", $data);
    }

    // buat fungsi untuk delete data
    function delete_data($id)
    {
        // hapus data user
        $this->db->where("id = '$id'");
        return $this->db->delete("tbl_user");
    }
}
