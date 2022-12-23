<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MGambar extends CI_Model
{

    // buat fungsi "get_data"
    function get_data()
    {
        $this->db->select("*");
        $this->db->from("tbl_gambar");
        return $this->db->get()->result();
    }
    // buat fungsi untuk delete data
    function delete_data($id)
    {
        // cek apakah npm ada atau tidak
        $this->db->select("*");
        $this->db->from("tbl_gambar");
        $this->db->where("id = '$id'");
        $this->db->delete("tbl_gambar");

        return $this->db->get()->result();
    }

    // buat fungsi untuk save data
    function save_data($npm, $nama, $telepon, $jurusan, $token)
    {
        // cek apakah npm ada atau tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");
        //  $this->db->where("npm = '$npm'");
        // eksekusi query
        $query = $this->db->get()->result();
        // jika npm tidak ditemukan
        if (count($query) == 0) {
            // isi nilai untuk masing" filed
            $data = array(
                "npm" => $npm,
                "nama" => $nama,
                "telepon" => $telepon,
                "jurusan" => $jurusan,
            );

            // simmoan data
            $this->db->insert("tb_mahasiswa", $data);
            $hasil = 0;
        }
        //  jika npm ditemukan 
        else {
            $hasil = 1;
        }
        return $hasil;
    }
}
