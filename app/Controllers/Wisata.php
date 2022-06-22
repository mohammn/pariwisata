<?php

namespace App\Controllers;

use App\Models\WisataModel;

class Wisata extends BaseController
{
    public function __construct()
    {
        $this->wisataModel = new WisataModel();
    }
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/");
        } else if (session()->get('rule') == 2) {
            return redirect()->to(base_url() . "/pengunjung");
        }

        $data = ["wisata" => $this->wisataModel->findAll()];

        return view('wisata', $data);
    }
    public function muatData()
    {
        echo json_encode($this->wisataModel->findAll());
    }

    public function detail()
    {
        echo json_encode($this->userModel->where(["id" => $this->request->getPost("id")])->first());
    }

    public function tambah()
    {
        $data = [
            "nama" => $this->request->getPost("nama"),
            "alamat" => $this->request->getPost("alamat"),
            "latitude" =>  $this->request->getPost("latitude"),
            "longitude" => $this->request->getPost("longitude"),
            "deskripsi" => $this->request->getPost("deskripsi"),
            "foto" => "default.jpg"
        ];

        $this->wisataModel->save($data);

        echo json_encode("");
    }

    public function edit()
    {
        $data = [
            "nama" => $this->request->getPost("nama"),
            "alamat" => $this->request->getPost("alamat"),
            "latitude" =>  $this->request->getPost("latitude"),
            "longitude" => $this->request->getPost("longitude"),
            "deskripsi" => $this->request->getPost("deskripsi")
        ];

        $this->wisataModel->update($this->request->getPost("id"), $data);

        echo json_encode("");
    }

    public function hapus()
    {
        $id = $this->request->getPost("id");
        if ($id) {
            $this->wisataModel->delete($id);
            echo json_encode("");
        } else {
            echo json_encode("id kosong");
        }
    }

    public function upload()
    {
        $data = array();

        $validation = \Config\Services::validation();

        $validation->setRules([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,jpg,jpeg,gif,png,webp],'
        ]);

        if ($validation->withRequest($this->request)->run() == FALSE) {
            $data['success'] = 0;

            $data['error'] = $validation->getError('file'); // Error response
        } else {
            if ($file = $this->request->getFile('file')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    $newName = $file->getRandomName();

                    $nama = $this->request->getPost("nama");
                    $id = $this->request->getPost("id");

                    $nama = str_replace(" ", "", strtolower($nama) . "." . $ext);

                    $file->move('./public/img', $nama, true);

                    $this->wisataModel->update($id, ["foto" => $nama]);

                    $data['success'] = 1;
                    $data['message'] = 'Foto Berhasil diupload :)';
                } else {
                    $data['success'] = 2;
                    $data['message'] = 'Foto gagal diupload.';
                }
            } else {
                $data['success'] = 2;
                $data['message'] = 'Foto gagal diupload.';
            }
        }
        return $this->response->setJSON($data);
    }
}
