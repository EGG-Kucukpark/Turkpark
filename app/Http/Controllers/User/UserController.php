<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller

{

    public function status(Request $request)
    {
        DB::table('users')->where('email', $request->email)->update([

            'status' => "1"
        ]);
    }
    public function getuser()
    {

        return   DB::table('users')->get();
    }

    public function giris(Request $request)
    {

        return DB::table('users')->where('id', intval($request->id))->first();
    }

    public function adduser(Request $request)
    {


        $date = new DateTime("now", new DateTimeZone('Europe/Istanbul'));
        $date->format('d.m.Y, H:i');


        try {
            $add = DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'telefon' => $request->telefon,
                'password' => Hash::make($request->password),
                'status' => '2',
                'created_at' => $date,
                'email_verified_at' => $date
            ]);
            return $add;
        } catch (Exception $exception) {
            return $exception;
        }
    }



    public function updateuser(Request $request)
    {

        try {
            DB::table('users')->where('id', $request->userid)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'telefon' => $request->telefon,
                'status' => $request->status,
                'password' => Hash::make($request->password),
            ]);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }

    public function import(Request $request)
    {



        try {
            $data = $request->data;

            for ($i = 0; $i < count($data); $i++) {

                DB::table('users')->insert([
                    'name' => $data[$i]['name'],
                    'email' => $data[$i]['email'],
                    'role' =>  $data[$i]['role'],
                    'telefon' => $data[$i]['telefon'],
                    'status' => $data[$i]['status'],
                    'password' => Hash::make($data[$i]['password'])

                ]);
            }
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }


    function sifirla(Request $request)
    {
        $user = DB::table('users')->where('id', $request->id)->first();

        $sifre = Hash::check($request->password, $user->password);
        return dd($sifre);
        if ($sifre) {

            $user = DB::table('users')->where('id', $request->id)->update([
                'password' => Hash::make($request->newpass)

            ]);
        } else {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }
}
