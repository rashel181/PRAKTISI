<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    //
    public function card()
    {
        return view("member/card");
    }

    public function list()
    {
        // $users = User::all();

        $users = DB::table('users')->get();

        return view("member/list", [
            'users' => $users
        ]);
    }
}
