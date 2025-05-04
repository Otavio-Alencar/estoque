<?php

namespace App\library;

use App\Models\Admin;

class Authenticate
{
    public function authGoogle($data)
    {
        $user = Admin::where('email', $data->email)->first();

        if (!$user) {
            $user = Admin::create([
                'name' => $data->givenName ?? $data->name,
                'email' => $data->email,
                'password' => bcrypt(str()->random(16)),
                'image' => $data->picture,
            ]);
        } else {
            $user->update([
                'name' => $data->givenName ?? $data->name,
                'image' => $data->picture,
            ]);
        }

        return $user;
    }


    public function logout()
    {
        unset($_SESSION['admin'], $_SESSION['logged']);
    }
}
