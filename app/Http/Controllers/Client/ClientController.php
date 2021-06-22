<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    ////////////////////////////////////////////////////////////////////////////////////

    public function getclients(Request $request)
    {
        if ($request->q) {
            return  DB::table('clients')->where([['name', 'LIKE', '%' . $request->q . '%'], ['isArch', '0']])->get();
        } else if ($request->status === 7) {

            return  DB::table('clients')->where('isArch', '1')->get();
        }

        return  DB::table('clients')->where('isArch', '0')->get();
    }

    ////////////////////////////////////////////////////////////////////////////////////
    public function arsiv(Request $request)
    {

        DB::table('clients')->where('id', $request->id)->update([

            'isArch' => '1'
        ]);
    } ////////////////////////////////////////////////////////////////////////////////////
    public function delete(Request $request)
    {

        DB::table('clients')->where('id', $request->id)->delete();
    }
    ////////////////////////////////////////////////////////////////////////////////////
    function client(Request $request)
    {


        $a = DB::table('clients')->where('id', $request->id)->first();

        return response()->json($a);
    }

    ////////////////////////////////////////////////////////////////////////////////////

    public function getnace()
    {


        //$a = DB::table('nace')->where('kod', '910202')->delete();
        $a = DB::table('nace')->get();


        return response($a);
    }
    ////////////////////////////////////////////////////////////////////////////////////

    public function addclient(Request $request)
    {
        try {
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'Firma',
                'telefon' => $request->telefon,
                'email_verified_at' => now(),
                'created_at' => now(),
                'password' => bcrypt($request->password),
                'status' => '1',
            ]);

            $a = DB::table('clients')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'telefon' => $request->telefon,
                'vergino' => $request->vergino,
                'vergiad' => $request->vergiad,
                'firma_yetkilisi' => $request->firma_yetkilisi,
                'sgk' => $request->sgk,


            ]);

            return $a;
        } catch (Exception $exception) {
            return $exception;
        }
    }
    public function firmaduzenle(Request $request)
    {
        try {


            $a = DB::table('clients')->where('email', $request->email)->update([
                'name' => $request->name,
                'email' => $request->email,
                'telefon' => $request->telefon,
                'vergino' => $request->vergino,
                'vergiad' => $request->vergiad,
                'firma_yetkilisi' => $request->firma_yetkilisi,
                'sgk' => $request->sgk,


            ]);

            return $a;
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }





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
            DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'Firma',
                'telefon' => $request->telefon,
                'email_verified_at' => now(),
                'created_at' => now(),
                'status' => '1',
            ]);

            $a = DB::table('individual')->where('id', $request->id)->insert([
                'name' => $request->name,
                'email' => $request->email,
                'telefon' => $request->telefon,



            ]);

            return $a;
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }
    public function getindividual()
    {
        return  DB::table('individual')->get();
    }


    function individual(Request $request)
    {

        $a = DB::table('individual')->where('id', $request->id)->first();

        return response()->json($a);
    }
    public function notlar(Request $request)
    {
        return DB::table('notes')->where('firma_id', $request->id)->orderBy("id", "desc")->get();
    }
    public function notekle(Request $request)
    {
        DB::table('notes')->insert([

            'firma_id' => $request->id,
            'not' => $request->not


        ]);
    }
    public function notsil(Request $request)
    {
        DB::table('notes')->where('id', $request->id)->delete();
    }
    public function notdüzenle(Request $request)
    {
        DB::table('notes')->where('id', $request->id)->update([
            'not' => $request->not

        ]);
    }
}
////////////////////////////////////////////////////////////////////////////////////
