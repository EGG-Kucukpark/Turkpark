<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function arsivckr(Request $request)
    {

        DB::table('clients')->where('id', $request->id)->update([

            'isArch' => '0'
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

    public function addclient(Request $request)
    {
        try {


            DB::table('clients')->insert([

                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefon' => $request->telefon,
                'vergino' => $request->vergino,
                'vergiad' => $request->vergiad,
                'firma_yetkilisi' => $request->firma_yetkilisi,
                'sgk' => $request->sgk,


            ]);
          /*  $user = DB::table('clients')->where('name', $request->name)->first();

            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'Firma',
                'telefon' => $request->telefon,
                'email_verified_at' => now(),
                'created_at' => now(),
                'password' => Hash::make($request->password),
                'status' => '1',
                'user_id' => $user->id

            ]);
            */
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }
    public function firmaduzenle(Request $request)
    {
        try {


            DB::table('clients')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'telefon' => $request->telefon,
                'vergino' => $request->vergino,
                'vergiad' => $request->vergiad,
                'firma_yetkilisi' => $request->firma_yetkilisi,
                'sgk' => $request->sgk,
                'adres' => $request->adres,
                'muhasebe' => $request->muhasebe


            ]);

            /* DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'Firma',
                'telefon' => $request->telefon,
                'email_verified_at' => now(),
                'created_at' => now(),
                'password' => bcrypt($request->password),
                'status' => '1',
            ]);
            */
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }





    public function addindividual(Request $request)
    {
        try {
            /*DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt("test"),
                'role' => 'Client',
                'telefon' => $request->telefon,
                'email_verified_at' => now(),
                'status' => '2',
            ]);*/

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
            /*DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'Firma',
                'telefon' => $request->telefon,
                'email_verified_at' => now(),
                'created_at' => now(),
                'status' => '1',
            ]);*/

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
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
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
