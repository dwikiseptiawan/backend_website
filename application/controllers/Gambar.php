<?php
defined('BASEPATH') or exit('No direct script access allowed');

// panggil file "Server.php"
require APPPATH . "libraries/Server.php";
// require APPPATH."libraries/Server.php";

class Gambar extends Server
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

        // // panggil model "Mmahasiswa"
        $this->load->model("MGambar", "image", TRUE);
    }

    // buat service "GET"
    function index_get()
    {
        // hasil respon
        $this->response(array("gambar" => $this->gambar->get_data()), 200);
    }

    // buat service "POST"
    function index_post()
    {
        // // panggil model "Mmahasiswa"
        // $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil parameter data yang akan di isi
        // $data = array(
        //     "npm" => $this->post("npm"), //array $data[0]
        //     "nama" => $this->post("nama"), //array $data[1]
        //     "telepon" => $this->post("telepon"), //array $data[2]
        //     "jurusan" => $this->post("jurusan"), //array $data[3]
        //     "token" => base64_encode($this->post("npm")),
        // );
        // // panggil method "save data"
        // $hasil = $this->mdl->save_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);
        // // jika hasil = 0
        // if ($hasil == 0) {
        //     $this->response(array("status" => "Data Mahasiswa Berhasil Disimpan"), 200);
        // }
        // // jika hasil !=0
        // else {
        //     $this->response(array("status" => "Data Mahasiswa Gagal Disimpan"), 200);
        // }
    }

    // buat service "DELETE"
    function index_delete()
    {
        $id = $this->delete("id");
        $hasil = $this->image->delete_data($id);

        if ($hasil == 1) {
            $this->response(array("status" => "Data Mahasiswa Berhasil Dihapus"), 200);
        }
        // jika proses delete gagal
        else {
            $this->response(array("status" => "Data Mahasiswa Gagal Dihapus"), 200);
        }
    }
}
