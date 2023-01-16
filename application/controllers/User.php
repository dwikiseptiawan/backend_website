<?php
defined('BASEPATH') or exit('No direct script access allowed');

// panggil file "Server.php"
require APPPATH . "libraries/Server.php";
// require APPPATH."libraries/Server.php";

class User extends Server
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

        // panggil model "User"
        $this->load->model("MUser", "user", TRUE);
    }

    // buat service "POST"
    function index_get()
    {
        $this->response(['user' => $this->user->get_data(), 'user_all' => $this->user->get_data_r(), 'user_today' => $this->user->get_data_r2()], 200);
    }

    // buat service "POST"
    function index_post()
    {
        $token = $this->post("token");
        $nama = $this->post("nama");
        $username = $this->post("username");
        $password = $this->post("password");
        $type = $this->post("type");
        $check = false;

        // $hasil = $this->user->get_data();

        // foreach ($hasil as $user) {
        //     if (strcmp(base64_encode($user->id), $token) == 0) {
                $check = true;
            // }
        // }

        if ($check) $hasil = $this->user->save_data($nama, $username, $password, $type);
        else $hasil = 0;

        // jika hasil == 1
        if ($hasil == 1) {
            $this->response(array("status" => "Data User Berhasil Disimpan"), 200);
        }
        // jika hasil == 0
        else {
            $this->response(array("status" => "Data User Gagal Disimpan"), 200);
        }
    }

    // buat service "DELETE"
    function index_delete()
    {
        $id = $this->delete("id");

        $hasil = $this->user->delete_data($id);

        if ($hasil == 1) {
            $this->response(array("status" => "Data User Berhasil Dihapus"), 200);
        }
        // jika proses delete gagal
        else {
            $this->response(array("status" => "Data User Gagal Dihapus"), 200);
        }
    }
}
