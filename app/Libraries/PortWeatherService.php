<?php

namespace App\Libraries;

use App\Models\PortModel;
use App\Models\PortWeatherModel;
use Config\Database;
use Config\Services;

class PortWeatherService
{
    protected PortModel $portModel;
    protected PortWeatherModel $weatherModel;
    protected $db;

    public function __construct()
    {
        $this->portModel    = new PortModel();
        $this->weatherModel = new PortWeatherModel();
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

    /**
     * Mengambil data cuaca pelabuhan dari API BMKG dan menyimpannya ke database
     */
    public function fetchAndSaveWeather(string $code): int
    {
        $client = Services::curlrequest();
        $apiUrl = "https://maritim.bmkg.go.id/marine2026-data/pelabuhan/{$code}.json";

        $response = $client->request('GET', $apiUrl, [
            'headers'     => ['User-Agent' => 'Mozilla/5.0 (compatible; CI4Weather/1.0)'],
            'timeout'     => 15,
            'http_errors' => false,
        ]);

        if ($response->getStatusCode() !== 200) {
            log_message('error', "Gagal mengambil data cuaca untuk {$code}, status: " . $response->getStatusCode());
            return 0;
        }

        $json  = json_decode($response->getBody(), true);
        $day1  = $json['forecast_day1'] ?? [];
        $day24 = $json['forecast_day2-4'] ?? [];

        $allForecasts = array_merge($day1, $day24);
        if (empty($allForecasts)) {
            return 0;
        }

        // Deduplikasi waktu BMKG di memori PHP untuk mencegah duplicate key entry
        $uniqueForecasts = [];
        foreach ($allForecasts as $item) {
            $rawTime = $item['time'] ?? '';
            if (empty($rawTime)) {
                continue;
            }

            $cleanTime     = str_replace(' UTC', '', $rawTime);
            $formattedTime = date('Y-m-d H:i:s', strtotime($cleanTime));
            $uniqueForecasts[$formattedTime] = $item;
        }

        $now = date('Y-m-d H:i:s');
        $sql = "REPLACE INTO port_weathers (
                    port_code, forecast_time, weather, visibility,
                    temp_avg, rh_avg, wind_from, wind_speed, wind_gust,
                    wave_cat, wave_height, current_to, current_speed, tides,
                    created_at, updated_at
                ) VALUES (
                    ?, ?, ?, ?,
                    ?, ?, ?, ?, ?,
                    ?, ?, ?, ?, ?,
                    ?, ?
                )";

        $countInserted = 0;
        $this->db->transStart();

        foreach ($uniqueForecasts as $formattedTime => $item) {
            $this->db->query($sql, [
                $code,
                $formattedTime,
                $item['weather'] ?? null,
                isset($item['visibility']) ? (int) $item['visibility'] : null,
                isset($item['temp_avg']) ? (float) $item['temp_avg'] : null,
                isset($item['rh_avg']) ? (float) $item['rh_avg'] : null,
                $item['wind_from'] ?? null,
                isset($item['wind_speed']) ? (float) $item['wind_speed'] : null,
                isset($item['wind_gust']) ? (float) $item['wind_gust'] : null,
                $item['wave_cat'] ?? null,
                isset($item['wave_height']) ? (float) $item['wave_height'] : null,
                $item['current_to'] ?? null,
                isset($item['current_speed']) ? (float) $item['current_speed'] : null,
                isset($item['tides']) ? (float) $item['tides'] : null,
                $now,
                $now,
            ]);
            $countInserted++;
        }

        $this->db->transComplete();

        return $countInserted;
    }

    /**
     * Query data cuaca berdasarkan rentang tanggal
     */
    public function getWeatherForecast(string $code, ?string $startDate = null, ?string $endDate = null): array
    {
        $builder = $this->weatherModel->where('port_code', $code);

        if (!empty($startDate)) {
            $builder->where('forecast_time >=', $startDate . ' 00:00:00');
        }
        if (!empty($endDate)) {
            $builder->where('forecast_time <=', $endDate . ' 23:59:59');
        }

        if (empty($startDate) && empty($endDate)) {
            $builder->where('forecast_time >=', date('Y-m-d H:i:s'));
        }

        $weathers = $builder->orderBy('forecast_time', 'ASC')->findAll();

        // Fallback jika tidak ada data prakiraan masa depan
        if (empty($weathers) && empty($startDate) && empty($endDate)) {
            $weathers = $this->weatherModel
                ->where('port_code', $code)
                ->orderBy('forecast_time', 'DESC')
                ->findAll();
        }

        return $weathers;
    }

    /**
     * Sinkronisasi beberapa pelabuhan terpilih
     */
    public function syncMultiplePorts(array $codes): array
    {
        $successCount = 0;
        $totalRecords = 0;

        foreach ($codes as $code) {
            try {
                $saved = $this->fetchAndSaveWeather($code);
                if ($saved > 0) {
                    $successCount++;
                    $totalRecords += $saved;
                }
            } catch (\Throwable $e) {
                log_message('error', "Gagal sync cuaca pelabuhan {$code}: " . $e->getMessage());
            }
        }

        return [
            'success_ports' => $successCount,
            'total_records' => $totalRecords,
        ];
    }

    /**
     * Toggle status is_monitored
     */
    public function toggleMonitoringStatus(string $code, int $status): bool
    {
        return (bool) $this->portModel->where('code', $code)
            ->set(['is_monitored' => $status ? 1 : 0])
            ->update();
    }
}
