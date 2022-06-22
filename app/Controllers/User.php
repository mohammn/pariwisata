<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\WisataModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->wisataModel = new WisataModel();
    }
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/");
        } else if (session()->get('rule') == 2) {
            return redirect()->to(base_url() . "/pengunjung");
        }

        echo view('user');
    }
    public function muatData()
    {
        echo json_encode($this->userModel->where(["rule" => 2])->findAll());
    }

    public function wisataKosong()
    {
        echo json_encode($this->wisataModel->where(["operator" => 0,])->orWhere(["operator" => $this->request->getPost("kecuali")])->findAll());
    }

    public function detail()
    {
        $user = $this->userModel->where(["id" => $this->request->getPost("id")])->first();
        $user["wisata"] = $this->wisataModel->where(["operator" => $user["id"]])->first()["id"];
        echo json_encode($user);
    }

    public function tambah()
    {
        $data = [
            "nama" => $this->request->getPost("nama"),
            "username" => $this->request->getPost("username"),
            "password" =>  password_hash($this->request->getPost("password"), PASSWORD_DEFAULT),
            "rule" => 2
        ];

        $this->userModel->save($data);
        $this->userModel->update($this->userModel->getInsertID(), ["username" => $this->request->getPost("username") . $this->userModel->getInsertID()]);
        $this->wisataModel->update($this->request->getPost('wisata'), ["operator" =>  $this->userModel->getInsertID()]);

        echo json_encode($this->request->getPost("nama"));
    }

    public function edit()
    {
        $data = [
            "nama" => $this->request->getPost("nama"),
            "username" => $this->request->getPost("username"),
            "wisata" => $this->request->getPost("wisata"),
            "rule" => 2
        ];

        if ($this->request->getPost("password") != "") {
            $data["password"] = $this->request->getPost("password");
        }

        $this->userModel->update($this->request->getPost("id"), $data);
        $this->wisataModel->update($this->request->getPost('wisata'), ["operator" =>  $this->request->getPost("id")]);
        $this->wisataModel->update($this->request->getPost('wisataLama'), ["operator" =>  0]);

        echo json_encode("");
    }

    public function hapus()
    {
        $id = $this->request->getPost("id");
        if ($id) {
            $idWisata = $this->wisataModel->where(["operator" => $id])->first()["id"];
            $this->userModel->delete($id);
            $this->wisataModel->update($idWisata, ["operator" =>  0]);
            echo json_encode("");
        } else {
            echo json_encode("id kosong");
        }
    }
}
