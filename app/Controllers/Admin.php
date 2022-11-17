<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Admin extends BaseController
{
    protected $db, $query;

    public function __construct()
    {
        $this->users = new UsersModel();
    }
    public function index()
    {
           
    }
}
