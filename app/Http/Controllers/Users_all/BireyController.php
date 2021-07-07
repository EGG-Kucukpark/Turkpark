<?php

namespace App\Http\Controllers\Users_all;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BireyController extends Controller
{
    public function addindividual(Request $request)
    {
        try {
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt("test"),
                'role' => 'Client',
                'telefon' => $request->telefon,
                'email_verified_at' => now(),
                'status' => '2',
            ]);

            $a = DB::table('individual')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'telefon' => $request->telefon,
            ]);

            return $a;
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }

    public function editindividual(Request $request)
    {
        try {

            DB::table('users')->where('user_id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'telefon' => $request->telefon,


            ]);

            $a = DB::table('individual')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'telefon' => $request->telefon,
                'tc' => $request->tc,
                'adres' => $request->adres



            ]);

            return $a;
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }



    public function getindividual(Request $request)
    {
        if ($request->status === 1) {

            return  DB::table('individual')->where('isArch', '1')->get();
        } else {
            return  DB::table('individual')->where('isArch', '0')->get();
        }
    }


    function indarsiv(Request $request)
    {

        try {
            DB::table('individual')->where('id', $request->id)->update(['isArch' => '1',]);
            DB::table('users')->where('user_id', $request->id)->update(['isArch' => '1','status' => '2']);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }

    function arsivckr(Request $request)
    {

        try {
            DB::table('individual')->where('id', $request->id)->update(['isArch' => '0',]);
            DB::table('users')->where('user_id', $request->id)->update(['isArch' => '0','status' => '1']);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }


    function individual(Request $request)
    {

        $a = DB::table('individual')->where('id', $request->id)->first();

        return response()->json($a);
    }
}
