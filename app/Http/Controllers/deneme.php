<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class deneme extends Controller
{
    public function deneme(Request $request){

        $data=  User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => 'Client',
            'status' => '2'
        ]);

        return  $data;

    }
}
