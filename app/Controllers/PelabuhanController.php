<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelabuhanModel;

class PelabuhanController extends BaseController
{
    public function __construct()
    {
        $this->pelabuhan = new PelabuhanModel();
    }

    public function index()
    {
        $data['title'] = 'Daftar Pelabuhan';
        $data['pelabuhans'] = $this->pelabuhan->findAll();
        return view('pelabuhan/index', $data);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $this->pelabuhan->insert($data);
        return redirect()->to(site_url('pelabuhan'))->with('success', 'Data Berhasil Tersimpan....!');
    }

    public function edit($id = null)
    {
        $data['title'] = 'Edit Data Pelabuhan';
        $data['pelabuhan'] = $this->pelabuhan->where('id_pelabuhan', $id)->first();
        if ($id != null) {
            return view('/pelabuhan/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        unset($data['_method']);
        $this->pelabuhan->where('id_pelabuhan', $id)->set($data)->update();

        return redirect()->to(site_url('pelabuhan'))->with('success', 'Data Berhasil diupdate...!');
    }

    public function delete($id = null)
    {
        $this->pelabuhan->delete($id);
        return redirect()->to(site_url('pelabuhan'))->with('success', 'Data berhasil dihapus');
    }
}
