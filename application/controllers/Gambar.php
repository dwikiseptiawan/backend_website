<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Server.php";

class Gambar extends Server
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("MGambar", "image", TRUE);
    }

    function index_get()
    {
        $this->response(array("gambar" => $this->gambar->get_data()), 200);
    }

    function index_delete()
    {
        $id = $this->delete("id");
        $hasil = $this->image->delete_data($id);

        if ($hasil == 1) {
            $this->response(array("status" => "Data Mahasiswa Berhasil Dihapus"), 200);
        } else {
            $this->response(array("status" => "Data Mahasiswa Gagal Dihapus"), 200);
        }
    }
}
