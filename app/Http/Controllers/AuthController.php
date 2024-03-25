<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function login(Request $request)
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function check_login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $account = DB::table('warmindo.tb_user')
            ->where('username', $username)
            ->where('password', $password)
            ->first();

        if ($account != null) {
            $check_level = DB::table('warmindo.tb_role')
                ->where('id_user', $account->id_user)
                ->first();
            if ($check_level != null) {
                session_start();
                $request->Session()->put('username', $username);
                $request->Session()->put('name', $account->name);
                $request->Session()->put('logged_in', true);
                // $request->Session()->put('id_user', $check_level->);
                $request->Session()->save();

                return redirect('dashboard');
            }
        } else {
            \Session::put('error', 'You are not registered in system!');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function dashboard(Request $request)
    {
        return view('template', [
            'title' => 'Dashboard',
        ]);
    }
}
