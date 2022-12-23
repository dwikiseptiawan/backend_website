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

        // panggil method "get_data"
        $hasil = $this->user->get_data();

        foreach ($hasil as $user) {
            if (strcmp($user['username'], $username) == 0 && strcmp($user['password'], $password) == 0) {
                $check = true;
                $id = $user['id'];
            }
        }

        // hasil respon
        $hasil = [
            'check' => $check,
            'id' => $id
        ];

        $this->response(array("login" => $hasil), 200);
    }

    // buat service "POST"
    function service_post()
    {
        // // panggil model "Mmahasiswa"
        // $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil parameter data yang akan di isi
        $data = array(
            "npm" => $this->post("npm"), //array $data[0]
            "nama" => $this->post("nama"), //array $data[1]
            "telepon" => $this->post("telepon"), //array $data[2]
            "jurusan" => $this->post("jurusan"), //array $data[3]
            "token" => base64_encode($this->post("npm")),
        );
        // panggil method "save data"
        $hasil = $this->mdl->save_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);
        // jika hasil = 0
        if ($hasil == 0) {
            $this->response(array("status" => "Data Mahasiswa Berhasil Disimpan"), 200);
        }
        // jika hasil !=0
        else {
            $this->response(array("status" => "Data Mahasiswa Gagal Disimpan"), 200);
        }
    }

    // buat service "PUT"
    function service_put()
    {
        // // panggil model "Mmahasiswa"
        // $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil parameter data yang akan di isi
        $data = array(
            "npm" => $this->put("npm"), //array $data[0]
            "nama" => $this->put("nama"), //array $data[1]
            "telepon" => $this->put("telepon"), //array $data[2]
            "jurusan" => $this->put("jurusan"), //array $data[3]
            "token" => base64_encode($this->put("token")),
        );
        // panggil method "save data"
        $hasil = $this->mdl->update_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);

        // jika hasil = 0
        if ($hasil == 0) {
            $this->response(array("status" => "Data Mahasiswa Berhasil Di Update"), 200);
        }
        // jika hasil !=0
        else {
            $this->response(array("status" => "Data Mahasiswa Gagal Di Update"), 200);
        }
    }

    // buat service "DELETE"
    function service_delete()
    {
        // // panggil model "Mmahasiswa"
        // $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil parameter token "npm"
        $token = $this->delete("npm");
        //    panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        if ($hasil == 1) {
            $this->response(array("status" => "Data Mahasiswa Berhasil Dihapus"), 200);
        }
        // jika proses delete gagal
        else {
            $this->response(array("status" => "Data Mahasiswa Gagal Dihapus"), 200);
        }
    }
}
