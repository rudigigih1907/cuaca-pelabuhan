<?php

namespace App\Models;

use CodeIgniter\Model;

class PortWeatherModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'port_weathers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'port_code',
        'forecast_time',
        'weather',
        'visibility',
        'temp_avg',
        'rh_avg',
        'wind_from',
        'wind_speed',
        'wind_gust',
        'wave_cat',
        'wave_height',
        'current_to',
        'current_speed',
        'tides',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['convertForecastTimeToLocal'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['convertForecastTimeToLocal'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Cache internal provinsi pelabuhan untuk mencegah query berulang
     */
    protected array $portProvinceCache = [];

    /**
     * Callback sebelum insert dan update untuk mengonversi forecast_time ke waktu lokal
     *
     * @param array $data
     * @return array
     */
    protected function convertForecastTimeToLocal(array $data): array
    {
        if (empty($data['data']) || !is_array($data['data'])) {
            return $data;
        }

        // Jika tidak ada forecast_time yang diubah/dimasukkan, lewati
        if (!isset($data['data']['forecast_time']) || empty($data['data']['forecast_time'])) {
            return $data;
        }

        helper('timezone');

        // Dapatkan kode pelabuhan
        $portCode = $data['data']['port_code'] ?? null;

        // Jika update tidak menyertakan port_code, ambil dari record database berdasarkan primary key
        if (empty($portCode) && !empty($data['id'])) {
            $existing = $this->select('port_code')->find(is_array($data['id']) ? $data['id'][0] : $data['id']);
            $portCode = is_array($existing) ? ($existing['port_code'] ?? null) : ($existing->port_code ?? null);
        }

        if (!empty($portCode)) {
            $province = $this->getPortProvince($portCode);
            $tzInfo   = get_province_timezone($province);

            try {
                // Sumber data BMKG adalah UTC, dikonversi ke zona target (Asia/Jakarta, Asia/Makassar, Asia/Jayapura)
                $dt = new \DateTime($data['data']['forecast_time'], new \DateTimeZone('UTC'));
                $dt->setTimezone(new \DateTimeZone($tzInfo['timezone']));

                $data['data']['forecast_time'] = $dt->format('Y-m-d H:i:s');
            } catch (\Throwable $e) {
                log_message('error', 'Gagal konversi timezone forecast_time: ' . $e->getMessage());
            }
        }

        return $data;
    }

    /**
     * Mengambil nama provinsi dari tabel ports berdasarkan kode pelabuhan
     */
    protected function getPortProvince(string $portCode): ?string
    {
        $portCode = strtoupper(trim($portCode));

        if (array_key_exists($portCode, $this->portProvinceCache)) {
            return $this->portProvinceCache[$portCode];
        }

        $port = $this->db->table('ports')
            ->select('province')
            ->where('code', $portCode)
            ->get()
            ->getRow();

        $this->portProvinceCache[$portCode] = $port ? $port->province : null;

        return $this->portProvinceCache[$portCode];
    }

    // Method untuk mengambil cuaca beserta detail nama pelabuhannya
    public function getWeatherWithPortName($portCode = null)
    {
        $builder = $this->select('port_weathers.*, ports.name as port_name, ports.province as province_name')
            ->join('ports', 'ports.code = port_weathers.port_code');

        if ($portCode) {
            $builder->where('port_weathers.port_code', $portCode);
        }

        return $builder->findAll();
    }

    public function upsertCustom(array $data)
    {
        if (empty($data)) {
            return false;
        }

        helper('timezone');
        $builder = $this->db->table($this->table);

        foreach ($data as $row) {
            // Terapkan penyesuaian zona waktu untuk upsert batch
            if (!empty($row['port_code']) && !empty($row['forecast_time'])) {
                $province = $this->getPortProvince($row['port_code']);
                $tzInfo   = get_province_timezone($province);

                try {
                    $dt = new \DateTime($row['forecast_time'], new \DateTimeZone('UTC'));
                    $dt->setTimezone(new \DateTimeZone($tzInfo['timezone']));
                    $row['forecast_time'] = $dt->format('Y-m-d H:i:s');
                } catch (\Throwable $e) {
                    log_message('error', 'Gagal konversi timezone upsertCustom: ' . $e->getMessage());
                }
            }

            $fields = array_keys($row);
            $updateFields = [];

            foreach ($fields as $field) {
                if ($field !== 'port_code' && $field !== 'forecast_time' && $field !== 'created_at') {
                    $updateFields[] = "`{$field}` = VALUES(`{$field}`)";
                }
            }

            $sql = $builder->set($row)->getCompiledInsert()
                . " ON DUPLICATE KEY UPDATE "
                . implode(', ', $updateFields);

            $this->db->query($sql);
        }

        return true;
    }
}
