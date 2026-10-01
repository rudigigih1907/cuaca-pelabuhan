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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

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

        $builder = $this->db->table($this->table);

        foreach ($data as $row) {
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
