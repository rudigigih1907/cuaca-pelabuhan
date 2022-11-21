<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Libraries\Hash;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
        $this->users = new UsersModel();
    }

    public function index()
    {
        //
    }

    public function login()
    {
        $data['title'] = 'Login';
        return view('auth/login', $data);
    }

    public function register()
    {
        $data['title'] = 'Register';
        return view('auth/register', $data);
    }

    public function create()
    {
        $validation = $this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah terdaftar',
                ],
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi',
                ]
            ],
            'nik' => [
                'rules' => 'required|is_unique[users.nik]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'NIK sudah terdaftar',
                ],
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role harus diisi'
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 8 karakter'
                ]
            ],
            'cpassword' => [
                'rules' => 'required|min_length[8]|matches[password]',
                'errors' => [
                    'required' => 'Confirm password harus diisi',
                    'min_length' => 'Confirm password minimal 8 karakter',
                    'matches' => 'Password tidak sama'
                ]
            ]

        ]);

        if (!$validation) {
            return view('auth/register', ['validation' => $this->validator]);
        } else {

            $username = $this->request->getPost('username');
            $fullname = $this->request->getPost('fullname');
            $nik = $this->request->getPost('nik');
            $role = $this->request->getPost('role');
            $password = $this->request->getPost('password');
            $user = [
                'username' => $username,
                'fullname' => $fullname,
                'nik'      => $nik,
                'role'     => $role,
                'password' => Hash::make($password),
            ];

            $query = $this->users->insert($user);
            if (!$query) {
                return redirect()->back()->with('error', 'Gagal registrasi');
            } else {
                return redirect()->to(site_url('register'))->with('success', 'Registrasi berhasil');
            }
        }
    }

    public function check()
    {
        $validation = $this->validate([
            'username' => [
                'rules' => 'required|is_not_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_not_unique' => 'Username tidak terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 8 Karakter'
                ]
            ]
        ]);

        if (!$validation) {
            return view('auth/login', ['validation' => $this->validator]);
        } else {
            //cek user
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user_info = $this->users->where('username', $username)->first();
            $check_password = Hash::check($password, $user_info->password);

            if (!$check_password) {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to(site_url('/login'))->withInput();
            } else {
                $user_id = $user_info->id;
                $role = $user_info->role;
                session()->set('loggedUser', $user_id);
                session()->set('loggedRole', $role);
                return redirect()->to(site_url('/'));
            }
        }
    }

    function logout()
    {
        if (session()->has('loggedUser')) {
            session()->remove('loggedUser');
            return redirect()->to(site_url('/login'))->with('error', 'You are logged out!');
        }
    }
}
