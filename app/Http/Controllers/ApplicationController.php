<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('application');
    }
    public function register(Request $request)
    {
        $kayit= DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
            'role' => 'Client',
            'status' => '2',


        ]);

        return response()->json($request);


    }

}
