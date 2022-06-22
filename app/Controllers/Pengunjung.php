<?php

namespace App\Controllers;

use App\Models\PengunjungModel;
use App\Models\WisataModel;

class Pengunjung extends BaseController
{
    public function __construct()
    {
        $this->pengunjungModel = new PengunjungModel();
        $this->wisataModel = new WisataModel();
    }
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/");
        } else if (session()->get('rule') == 1) {
            return redirect()->to(base_url() . "/Wisata");
        }

        $data = ["wisata" => $this->wisataModel->where(["operator" => session()->get("id")])->first()];

        echo view('pengunjung', $data);
    }
    public function muatData()
    {
        $id = 0;
        if (session()->get("rule") == 2) {
            $id = $this->wisataModel->where(["operator" => session()->get("id")])->first()["id"];
        } else {
            $id = $this->request->getPost("id");
        }
        echo json_encode($this->pengunjungModel->where(["idWisata" => $id])->findAll());
    }

    public function tambah()
    {
        $idWisata = $this->wisataModel->where(["operator" => session()->get("id")])->first()["id"];
        $data = [
            "jumlah" => $this->request->getPost("jumlah"),
            "tanggal" => $this->request->getPost("tanggal"),
            "idWisata" => $idWisata
        ];

        $this->pengunjungModel->save($data);

        echo json_encode("");
    }

    public function edit()
    {
        $data = [
            "jumlah" => $this->request->getPost("jumlah"),
            "tanggal" => $this->request->getPost("tanggal")
        ];

        $this->pengunjungModel->update($this->request->getPost("id"), $data);

        echo json_encode("");
    }

    public function hapus()
    {
        $id = $this->request->getPost("id");
        if ($id) {
            $this->pengunjungModel->delete($id);
            echo json_encode("");
        } else {
            echo json_encode("id kosong");
        }
    }
}
