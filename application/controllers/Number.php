<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Server.php";

class Number extends Server
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("MNumber", "phone", TRUE);
    }

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

    function index_post()
    {
        $number = $this->post('number');
        $hasil = $this->phone->update_data($number);

        if ($hasil == 1) {
            $this->response(
                [
                    'message' => "Number Redirect Whatsapp Berhasil di Update"
                ],
                200
            );
        } else {
            $this->response(
                [
                    'message' => "Number Redirect Whatsapp Gagal di Update"
                ],
                200
            );
        }
    }
}
