<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // if (session()->get('nama')) {
        //     return redirect()->to(base_url() . "/transaksi");
        // }

        echo view('login');
    }

    public function auth()
    {
        $usersModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username == "" or $password == "") {
            session()->setFlashdata('message', '<span class="badge badge-danger">Silahkanisi Username dan Password :(</span>');
            return redirect()->to(base_url() . "/login");
        }

        $user = $usersModel->where('username', $username)->first();

        if (empty($user)) {
            session()->setFlashdata('message', '<span class="badge badge-danger">Username Salah / tidak ditemukan :(</span>');
            return redirect()->to(base_url() . "/login");
        } else if (password_verify($password, $user['password'])) {
            session()->set('nama', $user["nama"]);
            session()->set('rule', $user["rule"]);
            session()->set('id', $user["id"]);
            if ($user["rule"] == 2) {
                return redirect()->to(base_url() . "/pengunjung");
            } else {
                return redirect()->to(base_url() . "/wisata");
            }
        } else {
            session()->setFlashdata('message', '<span class="badge badge-danger">Password Salah :(</span>');
            return redirect()->to(base_url() . "/login");
        }
    }

    public function ubahPassword()
    {
        if (!session()->get("id")) {
            return redirect()->to(base_url() . "/login");
        } else {
            $usersModel = new UserModel();

            $passwordLama = $this->request->getPost('passLama');
            $passwordBaru = $this->request->getPost('passBaru');

            $user = $usersModel->where('id', session()->get("id"))->first();

            if (password_verify($passwordLama, $user['password'])) {
                $data = [
                    "password" =>  password_hash($passwordBaru, PASSWORD_DEFAULT)
                ];

                $this->userModel->update(session()->get("id"), $data);
                echo json_encode(1);
            } else {
                echo json_encode(0);
            }
        }
    }

    public function logout()
    {
        session()->remove('nama');
        session()->remove('rule');
        return redirect()->to(base_url() . "/login");
    }
}
