<?php

if (!function_exists('userLogin')) {
    function userLogin()
    {
        $userId = session('loggedUser');
        if (!$userId) {
            return null;
        }

        $db   = \Config\Database::connect();
        $user = $db->table('users')->where('id', $userId)->get()->getRow();

        if ($user) {
            // role dari session agar userLogin()->role selalu valid
            $user->role = session('loggedRole') ?? 'User';
        }

        return $user;
    }
}
