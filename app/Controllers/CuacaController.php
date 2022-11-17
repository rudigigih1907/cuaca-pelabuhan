<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\DateFormat;
use App\Models\PelabuhanModel;
use App\Models\CuacaModel;
use Dompdf\Dompdf;

class CuacaController extends BaseController
{
    public function __construct()
    {
        $this->pelabuhan = new PelabuhanModel();
        $this->cuaca = new CuacaModel();
    }
    public function index()
    {
        $data['title'] = 'Data Cuaca';
        $data['cuaca'] = $this->cuaca->orderBy('created_at', 'DESC')->findAll();
        return view('weather/index', $data);
    }

    public function get_cuaca($id = null)
    {
        if ($id != null) {
            $dataPelabuhan = $this->pelabuhan->getWhere(['id_pelabuhan' => $id]);
            if ($dataPelabuhan->resultID->num_rows > 0) {
                $cuaca = $dataPelabuhan->getRow('link_api');

                //inisialisasi fungsi curl
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $cuaca);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $content = curl_exec($ch);
                curl_close($ch);
                
                $data['title'] = 'Prakiraan Cuaca';

                //mengubah data json menjadi data array asosiatif
                $data['cuaca'] = json_decode($content, true);
                return view('weather/get_cuaca', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create()
    {
        $data = $this->request->getPost();
        $this->cuaca->insert($data);
        return redirect()->to(site_url('cuaca'))->with('success', 'Data berhasil disimpan....!');
    }

    public function manual()
    {
        $pelabuhan = $this->request->getPost('name');
        $issued = $this->request->getPost('issued');
        $valid_from = $this->request->getPost('valid_from');
        $valid_to = $this->request->getPost('valid_to');
        $weather = $this->request->getPost('weather');
        $temp_min = $this->request->getPost('temp_min');
        $temp_max = $this->request->getPost('temp_max');
        $rh_min = $this->request->getPost('rh_min');
        $rh_max = $this->request->getPost('rh_max');
        $ket_tambahan = $this->request->getPost('ket_tambahan');

        $rilis = DateFormat::ganti($issued);
        $vdari = DateFormat::ganti($valid_from);
        $vke = DateFormat::ganti($valid_to);
        $data = [
            'name' => $pelabuhan,
            'issued' => DateFormat::gantiFormat($rilis),
            'valid_from' => DateFormat::gantiFormat($vdari),
            'valid_to' => DateFormat::gantiFormat($vke),
            'weather' => $weather,
            'temp_min' => $temp_min,
            'temp_max' => $temp_max,
            'rh_min' => $rh_min,
            'rh_max' => $rh_max,
            'ket_tambahan' => $ket_tambahan
        ];
        $this->cuaca->insert($data);
        return redirect()->to(site_url('cuaca'))->with('success', 'Data berhasil disimpan....!');
    }

    public function edit($id = null)
    {
        $data['title'] = 'Edit Cuaca';
        $data['cuaca'] = $this->cuaca->where('id_cuaca', $id)->first();

        if ($id != null) {
            return view('/weather/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        unset($data['_method']);
        $this->cuaca->where('id_cuaca', $id)->set($data)->update();
        return redirect()->to(site_url('cuaca'))->with('success', 'Data berhasil diupdate....!');
    }

    public function delete($id = null)
    {
        $this->cuaca->delete($id);
        return redirect()->to(site_url('cuaca'))->with('success', 'Data berhasil dihapus');
    }

    public function generate_pdf($id = null)
    {
        $data['cuaca'] = $this->cuaca->where('id_cuaca', $id)->first();
        $data['user'] = session()->get('loggedUser');
        $view = view('weather/generate-pdf', $data);
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('laporan-cuaca', array("Attachment" => false));
    }
}
