<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\PortModel;
use App\Models\PortWeatherModel;

class DashboardController extends BaseController
{
    protected UsersModel $userModel;
    protected PortModel $portModel;
    protected PortWeatherModel $weatherModel;

    public function __construct()
    {
        $this->userModel    = new UsersModel();
        $this->portModel    = new PortModel();
        $this->weatherModel = new PortWeatherModel();
        helper('breadcrumb');
    }

    public function index()
    {
        $now = date('Y-m-d H:i:s');

        // 1. Statistik Angka (Counters)
        $totalUsers     = $this->userModel->countAllResults();
        $totalPorts     = $this->portModel->countAllResults();
        $monitoredPorts = $this->portModel->where('is_monitored', 1)->countAllResults();
        $totalWeathers  = $this->weatherModel->countAllResults();

        // 2. 5 User Terdaftar Paling Baru
        $latestUsers = $this->userModel
            ->select('id, username, fullname, nik, created_at')
            ->orderBy('created_at', 'DESC')
            ->findAll(5);

        // 3. Cuaca Terkini dari Pelabuhan yang Sedang Dipantau (is_monitored = 1)
        // Ambil daftar pelabuhan yang dipantau (maksimal 8 untuk dashboard)
        $ports = $this->portModel
            ->where('is_monitored', 1)
            ->orderBy('name', 'ASC')
            ->findAll(8);

        $monitoredWeather = [];

        foreach ($ports as $port) {
            // Cari prakiraan terdekat (jam >= sekarang)
            $weather = $this->weatherModel
                ->where('port_code', $port['code'])
                ->where('forecast_time >=', $now)
                ->orderBy('forecast_time', 'ASC')
                ->first();

            // Jika belum ada jadwal masa depan, ambil rekaman paling akhir yang tersimpan
            if (!$weather) {
                $weather = $this->weatherModel
                    ->where('port_code', $port['code'])
                    ->orderBy('forecast_time', 'DESC')
                    ->first();
            }

            $monitoredWeather[] = [
                'code'          => $port['code'],
                'name'          => $port['name'],
                'province'      => $port['province'],
                'weather'       => $weather['weather'] ?? null,
                'temp_avg'      => $weather['temp_avg'] ?? null,
                'wind_speed'    => $weather['wind_speed'] ?? null,
                'wave_height'   => $weather['wave_height'] ?? null,
                'forecast_time' => $weather['forecast_time'] ?? null,
            ];
        }

        $data = [
            'title'            => 'Dashboard Monitoring Pelabuhan & Cuaca',
            'totalUsers'       => $totalUsers,
            'totalPorts'       => $totalPorts,
            'monitoredPorts'   => $monitoredPorts,
            'totalWeathers'    => $totalWeathers,
            'latestUsers'      => $latestUsers,
            'monitoredWeather' => $monitoredWeather,
        ];

        return view('dashboard/index', $data);
    }
}
