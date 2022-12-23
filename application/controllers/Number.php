<?php
defined('BASEPATH') or exit('No direct script access allowed');

// panggil file "Server.php"
require APPPATH . "libraries/Server.php";
// require APPPATH."libraries/Server.php";

class Number extends Server
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

        // panggil model "User"
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

    // buat service "POST"
    function index_post()
    {
        $number = $this->post('number');
        $hasil = $this->phone->update_data($number);

        // jika berhasil update
        if ($hasil == 1) {
            $this->response(
                [
                    'message' => "Number Redirect Whatsapp Berhasil di Update"
                ],
                200
            );
        }

        // jika gagal update
        else {
            $this->response(
                [
                    'message' => "Number Redirect Whatsapp Gagal di Update"
                ],
                200
            );
        }
    }
}
