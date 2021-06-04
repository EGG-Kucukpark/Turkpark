<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EduController extends Controller
{
    public function get()
    {

        return DB::table('activity')->get();
    }

    public function view(Request $request)
    {
        $a = DB::table('activity')->where('id', $request->id)->first();

        return response()->json($a);
    }


    public function add(Request $request)
    {
        try {


            DB::table('activity')->insert([
                'time' => $request->date,
                'kota' => $request->kontenjan,
                'category' => $request->kategori,
                'location' => $request->etkinlik


            ]);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }

    public function update(Request $request)
    {
        try {


            DB::table('activity')->where('id', $request->id)->update([
                'time' => $request->date,
                'kota' => $request->kontenjan,
                'category' => $request->kategori,
                'location' => $request->etkinlik


            ]);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }
    //////////////////////
    //////////////////////
    //////////////////////
    //////////////////////
    //////////////////////
    //////////////////////

    public function getusers(Request $request)
    {

        return DB::table('activity_users')->where('etkinlik_id', $request->id)->get();
    }

    public function addusers(Request $req)
    {
        try {


            DB::table('activity_users')->insert([
                'Name' => $req->name,
                'email' => $req->email,
                'payed' => $req->payed,
                'telefon' => $req->telefon,
                'etkinlik_id' => $req->id

            ]);
        } catch (Exception $ex) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }


    public function updateuser(Request $req)
    {
        try {


            DB::table('activity_users')->where('id', $req->id)->update([
                'Name' => $req->name,
                'email' => $req->email,
                'payed' => $req->payed,
                'telefon' => $req->telefon,


            ]);
        } catch (Exception $ex) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }


    public function deleteuser()
    {
    }
}
