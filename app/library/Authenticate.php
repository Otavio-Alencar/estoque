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
                'name' => $data->givenName ?? $data->name, // usa um fallback se `givenName` não existir
                'email' => $data->email,
                'password' => bcrypt(str()->random(16)), // senha aleatória segura, já que o login é via Google
            ]);
        }

        return $user; // importante: retornar o modelo Admin
    }


    public function logout()
    {
        unset($_SESSION['admin'], $_SESSION['logged']);
    }
}
