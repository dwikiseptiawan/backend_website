<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Server.php";

class User extends Server
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("MUser", "user", TRUE);
    }

    function index_get()
    {
        $this->response(['user' => $this->user->get_data(), 'user_all' => $this->user->get_data_r(), 'user_today' => $this->user->get_data_r2()], 200);
    }

    function index_post()
    {
        $token = $this->post("token");
        $nama = $this->post("nama");
        $username = $this->post("username");
        $password = $this->post("password");
        $type = $this->post("type");
        $check = false;
        $hasil = $this->user->get_data();

        foreach ($hasil as $user) {
            if (strcmp(base64_encode($user->id), $token) == 0) {
                $check = true;
            }
        }

        if ($check) $hasil = $this->user->save_data($nama, $username, $password, $type);
        else $hasil = 0;

        if ($hasil == 1) {
            $this->response(array("status" => "Data User Berhasil Disimpan"), 200);
        } else {
            $this->response(array("status" => "Data User Gagal Disimpan"), 200);
        }
    }

    function index_delete()
    {
        $id = $this->delete("id");

        $hasil = $this->user->delete_data($id);

        if ($hasil == 1) {
            $this->response(array("status" => "Data User Berhasil Dihapus"), 200);
        } else {
            $this->response(array("status" => "Data User Gagal Dihapus"), 200);
        }
    }
}
