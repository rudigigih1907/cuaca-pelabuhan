<?php

namespace App\Commands;

use App\Libraries\PortWeatherService;
use App\Models\PortModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class SyncWeatherCommand extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Weather';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'weather:sync-all';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Sinkronisasi data prakiraan cuaca seluruh pelabuhan dari API BMKG.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'weather:sync-all [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [
        '--codes' => 'Daftar kode pelabuhan dipisah koma (contoh: --codes=AA001,XA001)',
        '--all'   => 'Paksa sinkronisasi seluruh pelabuhan tanpa filter',
    ];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        ini_set('memory_limit', '512M');
        set_time_limit(0);

        $portModel      = new PortModel();
        $weatherService = new PortWeatherService();

        // 1. Tangkap opsi CLI
        $inputCodes = CLI::getOption('codes');
        $isAll      = CLI::getOption('all');

        // Fallback jika pemisah '=' tidak langsung terbaca di beberapa versi CLI
        if (empty($inputCodes)) {
            foreach ($params as $param) {
                if (str_starts_with($param, '--codes=')) {
                    $inputCodes = substr($param, 8);
                } elseif ($param === '--all') {
                    $isAll = true;
                }
            }
        }

        if (!empty($inputCodes)) {
            $codeList = array_map('trim', explode(',', $inputCodes));
            $ports    = $portModel->whereIn('code', $codeList)->findAll();
        } elseif ($isAll) {
            $ports = $portModel->findAll();
        } else {
            $ports = $portModel->where('is_monitored', 1)->findAll();
        }

        if (empty($ports)) {
            CLI::error('Tidak ada pelabuhan yang cocok untuk disinkronkan.');
            return;
        }

        $totalPorts = count($ports);
        CLI::write("Memproses {$totalPorts} pelabuhan terpilih...", 'yellow');

        $totalSaved  = 0;
        $failedPorts = 0;

        foreach ($ports as $index => $port) {
            $code = trim($port['code']);
            CLI::print("[ " . ($index + 1) . "/{$totalPorts} ] Sync [{$code}] {$port['name']}... ");

            try {
                // Delegasikan proses fetch, deduplikasi, dan save ke Service
                $countInserted = $weatherService->fetchAndSaveWeather($code);

                if ($countInserted > 0) {
                    $totalSaved += $countInserted;
                    CLI::print("SUKSES ({$countInserted} record)\n", 'green');
                } else {
                    CLI::print("KOSONG / GAGAL\n", 'light_gray');
                }
            } catch (\Throwable $e) {
                CLI::print("ERROR: " . $e->getMessage() . "\n", 'red');
                $failedPorts++;
            }
        }

        CLI::newLine();
        CLI::write("=== Ringkasan Sinkronisasi ===", 'yellow');
        CLI::write("Total record tersimpan/diperbarui: {$totalSaved}", 'green');
        CLI::write("Pelabuhan gagal/tidak merespon: {$failedPorts}", $failedPorts > 0 ? 'red' : 'green');
    }
}
