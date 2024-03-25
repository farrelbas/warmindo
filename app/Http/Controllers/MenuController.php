<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MenuModel;

class MenuController extends Controller
{
    public function get_id_user(Request $request)
    {
        $id_user = $request->Session()->get('id_user');
        $user = DB::table('warmindo.tb_user')
            ->where('id_user', $id_user)
            ->first();
        return $user;
    }

    public function show_menu(Request $request)
    {
        $emp = [
            'data_employee' => $this->get_id_user($request),
        ];

        $sortir = 10;

        if ($request->sortir) {
            $sortir = $request->sortir;
        }

        $menu = MenuModel::join('warmindo.tb_user', 'tb_user.id_user', 'tb_menu.inserted_by')
            ->select(
                'tb_menu.*',
                'tb_user.name'
            );

        return view('Master.Menu.menu', $emp, [
            'title' => 'Menu',
            'menu' => $menu->paginate($sortir),
        ]);
    }
}
