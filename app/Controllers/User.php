<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class User extends BaseController
{
    protected UsersModel $user;

    public function __construct()
    {
        $this->user = new UsersModel();
        helper(['form', 'url']);
    }

    /**
     * Tampilan profil pengguna
     */
    public function index()
    {
        $loggedUserID = session()->get('loggedUser');
        $userInfo     = $this->user->find($loggedUserID);

        if (!$userInfo) {
            return redirect()->to('/login')->with('error', 'Sesi tidak valid, silakan login kembali.');
        }

        // Pasang role dari session jika belum ada di atribut model
        if (!isset($userInfo->role)) {
            $userInfo->role = session()->get('loggedRole') ?? 'User';
        }

        $data = [
            'title'    => 'My Profile',
            'userInfo' => $userInfo,
        ];

        return view('user/index', $data);
    }

    /**
     * Update data dasar profil (Fullname & NIK)
     */
    public function updateProfile()
    {
        $loggedUserID = session()->get('loggedUser');

        $rules = [
            'fullname' => 'required|min_length[3]|max_length[100]',
            'nik'      => 'permit_empty|numeric|min_length[6]|max_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->user->update($loggedUserID, [
            'fullname' => $this->request->getPost('fullname'),
            'nik'      => $this->request->getPost('nik') ?: null,
        ]);

        return redirect()->to('/user')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Ubah kata sandi
     */
    public function changePassword()
    {
        $loggedUserID = session()->get('loggedUser');
        $userInfo     = $this->user->find($loggedUserID);

        $rules = [
            'current_password' => 'required',
            'new_password'     => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $currentPassword = $this->request->getPost('current_password');

        // Verifikasi kecocokan password lama
        if (!password_verify($currentPassword, $userInfo->password)) {
            return redirect()->back()->with('error', 'Kata sandi saat ini tidak cocok.');
        }

        // Simpan password baru terenkripsi
        $this->user->update($loggedUserID, [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/user')->with('success', 'Kata sandi berhasil diganti.');
    }
}
