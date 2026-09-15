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
        if ($id === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $dataPelabuhan = $this->pelabuhan->getWhere(['id_pelabuhan' => $id]);

        if ($dataPelabuhan->resultID->num_rows === 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $linkApi = $dataPelabuhan->getRow('link_api');

        // 1. Inisialisasi cURL dengan User-Agent & SSL Bypass agar tidak diganggu firewall/SSL BMKG
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $linkApi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // set timeout 10 detik
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // cegah error sertifikat SSL
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

        $content = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        // 2. Decode JSON
        $cuacaData = json_decode($content, true);

        // 3. Validasi jika cURL error / JSON null / struktur data tidak valid
        if ($content === false || !is_array($cuacaData)) {
            // Beri fallback array default agar View tidak error (Trying to access array offset on value of type null)
            $cuacaData = [
                'name' => $dataPelabuhan->getRow('nama_pelabuhan') ?? 'Pelabuhan (Data API BMKG Gagal Dimuat)',
                'data' => []
            ];
        }

        $data['title'] = 'Prakiraan Cuaca';
        $data['cuaca'] = $cuacaData;

        return view('weather/get_cuaca', $data);
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
        $view = view('weather/generate-pdf', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan-cuaca', array("Attachment" => false));
    }

    public function reportBulanan()
    {
        $report = $this->request->getGet('reportBulanan');
        $waktu = date('F Y', strtotime($report));
        $data['reports'] = $this->cuaca->like('issued', $report)->findAll();
        if ($data['reports'] == null) {
            return redirect()->to(site_url('cuaca'))->with('error', 'Tidak ada data pada bulan ' . $waktu);
        }
        $view = view('weather/report', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Laporan Cuaca Pelabuhan dari BMKG ' . $waktu, array("Attachment" => false));
    }

    public function reportPeriode()
    {
        $reportd = $this->request->getGet('reportPeriodedari');
        $reportk = $this->request->getGet('reportPeriodesampai');
    }
}
