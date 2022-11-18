<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
    }
    public function index()
    {
        $data['title'] = 'Daftar Users';
        $data['users'] = $this->users->orderBy('created_at', 'DESC')->findAll();
        return view('admin/index', $data);
    }
}
