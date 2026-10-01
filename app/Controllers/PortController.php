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
            'title' => 'Data Pelabuhan BMKG',
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
}
