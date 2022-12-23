<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MNumber extends CI_Model
{

    // buat fungsi "get_data"
    function get_data()
    {
        $this->db->select("*");
        $this->db->from("tbl_number");
        return $this->db->get()->result();
    }

    // buat fungsi untuk update data
    function update_data($number)
    {
        // cek apakah npm ada atau tidak
        $this->db->select("*");
        $this->db->from("tbl_number");
        // $this->db->where("TO_BASE64(npm) = '$token'");

        $data = array(
            "id" => "1",
            "number" => $number
        );

        return $this->db->update("tbl_number", $data);
    }
}
