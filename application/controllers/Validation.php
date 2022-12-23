<?php
defined('BASEPATH') or exit('No direct script access allowed');

// panggil file "Server.php"
require APPPATH . "libraries/Server.php";
// require APPPATH."libraries/Server.php";

class Validation extends Server
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

        // panggil model "User"
        $this->load->model("MUser", "user", TRUE);
        $this->load->model("MNumber", "phone", TRUE);
    }

    // buat service "GET"
    function index_get()
    {
        $hasil = $this->phone->get_data();
        $phone = "";
        foreach ($hasil as $p) {
            $phone = $p->number;
        }

        $this->response(
            [
                'number' => $phone
            ],
            200
        );
    }

    // buat service "UPDATE"
    function index_update()
    {
        $number = $this->put('number');
    }

    // buat service "POST"
    function index_post()
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

        $this->response([
            'check' => $check,
            'id' => base64_encode($id),
            'type' => $type
        ], 200);
    }
}
