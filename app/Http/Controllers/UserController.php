<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function register()
    {
        return view("user/register");
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            "name"              => "required",
            "email"             => "required|unique:users",
            "password"          => "required|min:6",
            "reenter_password"  => "required|same:password",
        ]);

        $data = $request->all();

        $data['password'] = bcrypt($data['password']);
        $data['level'] = 0; //MEMBER

        // dump($data);

        $user = User::create($data);

        // dd($user);

        event(new Registered($user));

        return redirect("user/register-success/{$user->id}")->withSuccess("Pendaftaran Berhasil!");
    }

    public function login()
    {
        return view("user/login");
    }

    public function registerSuccess($userID)
    {
        return view("user/register_success", [
            "userID" => $userID,
        ]);
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // dd("berhasil login");

            if (Auth::user()->type == 0) { // UNTUK MEMBER
                return redirect('member');
            } else { // UNTUK ADMIN / 1
                return redirect('member/list');
            }

            return redirect()->intended('member');
        } else {
            return redirect('user/login')->withErrors("Login Gagal");
        }
    }

    public function processLogout()
    {
        Auth::logout();

        return redirect('/user/login');
    }
}
