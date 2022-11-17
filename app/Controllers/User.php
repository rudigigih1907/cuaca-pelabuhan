<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->user = new UsersModel();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $this->user->find($loggedUserID);
        $data = [
            'title' => 'My Profile',
            'userInfo' => $userInfo
        ];
        return view('user/index', $data);
    }
}
