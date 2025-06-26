<?php

namespace App\Http\Controllers;

use App\library\Authenticate;
use App\Models\Admin;
use App\library\GoogleClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showloginform(Request $request){
        return view('login');
    }
    public function showlogupform(Request $request){
        return view('register');
    }


    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }



        return back()->withErrors(['Usuario ou senha incorretos.']);

    }
    public function redirectToGoogle()
    {
        $googleClient = new GoogleClient();
        $googleClient->init();

        return redirect()->to($googleClient->generateLink());
    }

    public function handleGoogleCallback(Request $request)
    {
        $googleClient = new GoogleClient();
        $googleClient->init();

        if ($googleClient->authenticated()) {
            $auth = new \App\library\Authenticate();
            $user = $auth->authGoogle($googleClient->getData());

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect('/entrar')->withErrors(['Erro ao autenticar com o Google.']);
    }


    public  function logup(Request $request){
        $request->validate([
            'username' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'retype_password' => 'required|same:password',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        $username = $request->input('username');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Criar nome único para imagem
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Mover para public/dist/img
            $image->move(public_path('dist/img'), $imageName);

            $imagePath = 'dist/img/' . $imageName;
        } else {
            $imagePath = null;
        }
        $user = [
            'name' => $username,
            'email' => $email,
            'password' => $password,
            'image' => $imagePath
        ];
        try{
            $admin = Admin::insert($user);
            return redirect('/entrar');
        }catch (\Exception $e){
            return back()->withErrors(['Já existe um usuario com esse email.']);
        }

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/entrar');
    }
}
