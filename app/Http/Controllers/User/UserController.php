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





    public function getuser(Request $request)
    {
        if ($request->status === 7) {

            return   DB::table('users')->where('isArch', '1')->get();
        }
        return   DB::table('users')->where('isArch', '0')->get();
    }




    function delete(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
    }





    public function arsiv(Request $request)

    {


        if ($request->role === "Bireysel") {

            DB::table('individual')->where('id', $request->user_id)->update([
                'isArch' => '1'
            ]);
        } else if ($request->role === "Firma") {


            DB::table('clients')->where('id',  $request->user_id)->update([

                'isArch' => '1'
            ]);
        }

        DB::table('users')->where('id',  $request->id)->update([
            'isArch' => '1',
            'status' => '2'

        ]);
    }
    public function arsivckr(Request $request)

    {
        DB::table('users')->where('id', $request->data['id'])->update([
            'isArch' => '0',
            'status' => '1'

        ]);
        $data = $request->data['role'];



        if ($data === "Bireysel") {

            DB::table('individual')->where('id', $request->data['user_id'])->update([
                'isArch' => '0'
            ]);
        } else if ($data  === "Firma") {

            DB::table('clients')->where('id',  $request->data['user_id'])->update([

                'isArch' => '0'
            ]);
        }
        DB::table('users')->where('id', $request->data['id'])->update([
            'isArch' => '0',
            'status' => '1'

        ]);
    }



    public function getuserinfo(Request $request)
    {


        return response()->json([DB::table('users')->where('id', $request->id)->first()]);
    }

    public function adduser(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email);

        $user->count();

        $date = new DateTime("now", new DateTimeZone('Europe/Istanbul'));
        $date->format('d.m.Y, H:i');


        try {

            if ($user->count()) {


                return response()->json(DB::table('users')->where('email', $request->email)->first());
            } else {

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

                return $request;
            }
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }


    public function register(Request $request)
    {



        $date = new DateTime("now", new DateTimeZone('Europe/Istanbul'));
        $date->format('d.m.Y, H:i');


        try {
            $user = DB::table('users')->where('email', $request->email)->first();
            if ($user) {
                return response()->json(['error' => 'Başarısız'], 400);
            } else {



                if ($request->role === "Firma") {
                    DB::table('clients')->insert([

                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->Şifre),
                        'telefon' => $request->telefon,
                        'vergino' => $request->vergino,
                        'vergiad' => $request->vergiad,
                        'firma_yetkilisi' => $request->firma_yetkilisi,
                        'sgk' => $request->sgk,


                    ]);
                    $user = DB::table('clients')->where('email', $request->email)->first();

                    DB::table('users')->insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role' => 'Firma',
                        'telefon' => $request->telefon,
                        'email_verified_at' => now(),
                        'created_at' => now(),
                        'password' => Hash::make($request->Şifre),
                        'status' => '1',
                        'user_id' => $user->id

                    ]);
                } else {
                    DB::table('individual')->insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'telefon' => $request->telefon,
                    ]);

                    $user = DB::table('individual')->where('email', $request->email)->first();

                    DB::table('users')->insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->Şifre),
                        'role' => 'Bireysel',
                        'telefon' => $request->telefon,
                        'email_verified_at' => now(),
                        'status' => '1',
                        'user_id' => $user->id
                    ]);
                }
            }
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }





    public function updateuser(Request $request)
    {

        if ($request->role === "Firma") {

            try {

                $a = DB::table('users')->where('id', $request->userid)->first();

                DB::table('users')->where('id', $request->userid)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'telefon' => $request->telefon,

                ]);

                DB::table('clients')->where('id', $a->user_id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'telefon' => $request->telefon,

                ]);
            } catch (Exception $exception) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        } else {

            try {
                return DB::table('users')->where('id', $request->userid)->update([
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



        if ($sifre) {

            $user = DB::table('users')->where('id', $request->id)->update([
                'password' => Hash::make($request->newpass)

            ]);
        } else {

            return response()->json(['error' => 'Başarısız'], 404);
        }
    }
}
