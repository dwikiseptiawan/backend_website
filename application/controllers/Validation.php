<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Server.php";

class Validation extends Server
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("MUser", "user", TRUE);
    }

    function index_post()
    {
        $username = $this->post("username");
        $password = $this->post("password");
        $check = false;
        $id = "EMPTY";
        $type = "EMPTY";

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
            'token' => base64_encode($id),
            'type' => $type
        ], 200);
    }
}
