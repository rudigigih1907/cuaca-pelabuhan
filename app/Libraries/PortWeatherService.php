<?php

namespace App\Libraries;

use App\Models\PortModel;
use App\Models\PortWeatherModel;
use Config\Database;
use Config\Services;

class PortWeatherService
{
    protected PortModel $portModel;
    protected $db;

    public function __construct()
    {
        $this->portModel    = new PortModel();
        $this->db           = Database::connect();
    }

    /**
     * Sinkronisasi data master pelabuhan dari API BMKG
     */
    public function syncPortMaster(): int
    {
        $client = Services::curlrequest();
        $apiUrl = 'https://maritim.bmkg.go.id/marine2026-data/meta/pelabuhan.json';

        $response = $client->request('GET', $apiUrl, [
            'headers' => [
                'User-Agent' => 'CodeIgniter 4 App',
                'Accept'     => 'application/json',
            ],
            'timeout' => 30,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException('Gagal mengambil data master dari API BMKG (HTTP ' . $response->getStatusCode() . ').');
        }

        $json = json_decode($response->getBody(), true);
        if (!isset($json['features']) || !is_array($json['features'])) {
            throw new \UnexpectedValueException('Format data GeoJSON dari API BMKG tidak sesuai.');
        }

        $countSaved = 0;
        foreach ($json['features'] as $feature) {
            $props = $feature['properties'] ?? null;
            if (!$props) {
                continue;
            }

            $code     = $props['code'] ?? null;
            $name     = $props['name'] ?? null;
            $province = $props['province'] ?? null;

            if ($code && $name) {
                $existing = $this->portModel->where('code', $code)->first();
                $data = [
                    'code'     => $code,
                    'name'     => $name,
                    'province' => $province,
                ];

                if ($existing) {
                    $this->portModel->update($existing['id'], $data);
                } else {
                    $this->portModel->insert($data);
                }
                $countSaved++;
            }
        }

        return $countSaved;
    }
}
