<?php

namespace App\Models;

use CodeIgniter\Model;

class PelabuhanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pelabuhan';
    protected $primaryKey       = 'id_pelabuhan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_pelabuhan','link_api'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
