<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BerkasModel;

class BerkasController extends BaseController
{
    public function __construct()
    {
        $this->berkas = new BerkasModel();
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('berkas');
    }
    public function index($id = null)
    {
        $this->builder->join('cuaca', 'cuaca.id_cuaca = berkas.cuaca_id');
        $this->builder->where('cuaca_id', $id);
        $query = $this->builder->get();
        $data['berkas'] = $query->getResult();
        $data['title'] = 'Details Lampiran';
        if (empty($data['berkas'])) {
            return redirect()->to(site_url('/cuaca'))->with('error', 'Belum ada yang diupload');
        }
        return view('berkas/index', $data);
    }

    public function upload()
    {
        if (!$this->validate([
            'berkas' => [
                'rules' => 'uploaded[berkas]|max_size[berkas,1024]|ext_in[berkas,jpg,jpeg,png,pdf]',
                'error' => [
                    'uploaded' => 'Harus ada file yang diupload',
                    'max_size' => 'Ukuran file maksimal 1 MB',
                    'ext_in' => 'File harus berupa jpg,jpeg,png,pdf',
                ]
            ],
            'keterangan' => [
                'rules' => 'required[keterangan]',
                'error' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $dataBerkas = $this->request->getFile('berkas');
        $fileName = $dataBerkas->getRandomName();
        $keterangan = $this->request->getPost('keterangan');
        $id_cuaca = $this->request->getPost('id_cuaca');
        $data = [
            'berkas' => $fileName,
            'keterangan' => $keterangan,
            'cuaca_id' => $id_cuaca,
        ];
        $this->berkas->insert($data);
        $dataBerkas->move(WRITEPATH . 'uploads/berkas', $fileName);

        session()->setFlashdata('success', 'Berkas berhasil diupload');
        return redirect()->to(base_url('cuaca'));
    }

    public function delete($id = null)
    {
        $data = $this->berkas->where('id_berkas', $id)->first();
        $fileName = $data->berkas;

        if (isset($fileName)) {
            if (file_exists(WRITEPATH . "uploads/berkas/" . $fileName)) {
                unlink(WRITEPATH . "uploads/berkas/" . $fileName);
            }
            $this->berkas->delete($id);
            return redirect()->back()->with('success', 'Lampiran berhasil dihapus');
        } else {
            return redirect()->to(site_url('cuaca'))->with('error', 'Belum ada file yang diupload');
        }
    }

    public function downloads($id = null)
    {
        $data = $this->berkas->where('id_berkas', $id)->first();
        if (isset($data->id_berkas)) {
            return $this->response->download(WRITEPATH . 'uploads/berkas/' . $data->berkas, null);
        } else {
            return redirect()->to(site_url('cuaca'))->with('error', 'Belum ada file yang diupload');
        }
    }
}
