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
    function validation_user()
    {
        // ambil parameter username dan password
        $username = $this->post("username");
        $password = $this->post("password");
        $check = false;
        $id = "EMPTY";
        $type = "EMPTY";

        // panggil method "get_data"
        $hasil = $this->user->get_data();

        foreach ($hasil as $user) {
            if (strcmp($user->username, $username) == 0 && strcmp($user->password, $password) == 0) {
                $check = true;
                $id = $user->id;
                $type = $user->type;
            }
        }

        // hasil respon
        $hasil = [
            'check' => $check,
            'id' => base64_encode($id),
            'type' => $type
        ];

        // $this->response(array("jos" => "jadi"), 200);
    }

    // buat service "POST"
    function input_user()
    {
        $token = $this->post("token");
        $nama = $this->post("nama");
        $username = $this->post("username");
        $password = $this->post("password");
        $type = 2;
        $check = false;

        $hasil = $this->user->get_data();

        foreach ($hasil as $user) {
            if (strcmp(base64_encode($user->id), $token) == 0) {
                $check = true;
            }
        }

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

    // buat service "POST"
    function input_user_admin()
    {
        $token = $this->post("token");
        $nama = $this->post("nama");
        $username = $this->post("username");
        $password = $this->post("password");
        $type = 1;
        $check = false;

        $hasil = $this->user->get_data();

        foreach ($hasil as $user) {
            if (strcmp(base64_encode($user->id), $token) == 0) {
                $check = true;
            }
        }

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
    function service_delete()
    {
        $id = $this->post("id");

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
