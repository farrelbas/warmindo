<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function get_id_user(Request $request)
    {
        $id_user = $request->Session()->get('id_user');
        $user = DB::table('warmindo.tb_user')
            // ->leftJoin('tb_role', 'tb_role_id_user', 'tb_user_id_user')
            ->where('tb_user.id_user', $id_user)
            ->first();
        return $user;
    }

    public function dashboard(Request $request)
    {
        if ($request->Session()->get('logged_in') == true) {
            $data = [
                'user' => $this->get_id_user($request),
            ];

            return view('Dashboard.dashboard', $data, [
                'title' => 'Dashboard',
            ]);
        } else {
            return redirect('/');
        }
    }
}
