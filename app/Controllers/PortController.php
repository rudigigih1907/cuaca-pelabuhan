<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PortModel;
use App\Libraries\PortWeatherService;
use App\Libraries\WeatherExportService;
use CodeIgniter\HTTP\ResponseInterface;

class PortController extends BaseController
{
    protected PortModel $portModel;
    protected PortWeatherService $weatherService;
    protected WeatherExportService $exportService;

    public function __construct()
    {
        $this->portModel      = new PortModel();
        $this->weatherService = new PortWeatherService();
        $this->exportService  = new WeatherExportService();
        helper('breadcrumb');
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pelabuhan',
            'ports' => $this->portModel->findAll(),
        ];

        return view('ports/index', $data);
    }

    public function sync()
    {
        try {
            $countSaved = $this->weatherService->syncPortMaster();
            return redirect()->to('/ports')->with('success', "Berhasil sinkronisasi {$countSaved} data master pelabuhan.");
        } catch (\Throwable $e) {
            return redirect()->to('/ports')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function syncWeather(string $code)
    {
        ini_set('memory_limit', '256M');
        set_time_limit(120);

        try {
            $saved = $this->weatherService->fetchAndSaveWeather($code);
            if ($saved === 0) {
                return redirect()->to('/ports')->with('error', "Tidak ada data cuaca yang dapat disimpan untuk pelabuhan {$code}.");
            }

            return redirect()->to('/ports')->with('success', "Berhasil menyimpan {$saved} data cuaca untuk pelabuhan {$code}.");
        } catch (\Throwable $e) {
            return redirect()->to('/ports')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function showWeather(string $code)
    {
        $port = $this->portModel->where('code', $code)->first();
        if (!$port) {
            return redirect()->to('/ports')->with('error', "Pelabuhan dengan kode {$code} tidak ditemukan.");
        }

        $startDate = $this->request->getGet('start_date');
        $endDate   = $this->request->getGet('end_date');

        $weathers = $this->weatherService->getWeatherForecast($code, $startDate, $endDate);

        $data = [
            'title'       => 'Prakiraan Cuaca Pelabuhan ' . ($port['name'] ?? $code),
            'port'        => $port,
            'weathers'    => $weathers,
            'startDate'   => $startDate ?? '',
            'endDate'     => $endDate ?? '',
            'breadcrumbs' => [
                'Daftar Pelabuhan' => site_url('ports'),
                'Laporan Cuaca ' . esc($port['name']) => '',
            ],
        ];

        return view('ports/weather', $data);
    }

    public function syncSelected()
    {
        $selectedCodes = $this->request->getPost('codes');

        if (empty($selectedCodes) || !is_array($selectedCodes)) {
            return redirect()->to('/ports')->with('error', 'Pilih minimal satu pelabuhan terlebih dahulu.');
        }

        $result = $this->weatherService->syncMultiplePorts($selectedCodes);

        return redirect()->to('/ports')->with(
            'success',
            "Berhasil sinkronisasi {$result['success_ports']} pelabuhan ({$result['total_records']} baris cuaca diperbarui)."
        );
    }

    public function toggleMonitored(): ResponseInterface
    {
        $json   = $this->request->getJSON(true);
        $code   = $json['code'] ?? $this->request->getPost('code');
        $status = isset($json['status']) ? (int) $json['status'] : (int) $this->request->getPost('status');

        if (empty($code)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kode pelabuhan tidak ditemukan.',
            ])->setStatusCode(400);
        }

        $updated = $this->weatherService->toggleMonitoringStatus($code, $status);

        if ($updated) {
            return $this->response->setJSON([
                'success'  => true,
                'message'  => 'Status berhasil diperbarui.',
                'csrfHash' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal mengubah status di database.',
        ])->setStatusCode(500);
    }

    public function exportWeatherExcel(string $code)
    {
        $port = $this->portModel->where('code', $code)->first();
        if (!$port) {
            return redirect()->to('/ports')->with('error', "Pelabuhan dengan kode {$code} tidak ditemukan.");
        }

        $startDate = $this->request->getGet('start_date');
        $endDate   = $this->request->getGet('end_date');

        $weathers = $this->weatherService->getWeatherForecast($code, $startDate, $endDate);
        if (empty($weathers)) {
            return redirect()->back()->with('error', 'Tidak ada data cuaca untuk diekspor.');
        }

        $this->exportService->exportExcel($port, $weathers, $startDate, $endDate);
    }

    public function exportWeatherPdf(string $code)
    {
        $port = $this->portModel->where('code', $code)->first();
        if (!$port) {
            return redirect()->to('/ports')->with('error', "Pelabuhan dengan kode {$code} tidak ditemukan.");
        }

        $startDate = $this->request->getGet('start_date');
        $endDate   = $this->request->getGet('end_date');

        $weathers = $this->weatherService->getWeatherForecast($code, $startDate, $endDate);
        if (empty($weathers)) {
            return redirect()->back()->with('error', 'Tidak ada data cuaca untuk diekspor.');
        }

        $this->exportService->exportPdf($port, $weathers, $startDate, $endDate);
    }
}
