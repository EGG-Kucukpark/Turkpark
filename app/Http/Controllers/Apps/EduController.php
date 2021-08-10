<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EduController extends Controller
{
    function egitimkontenjan()
    {

        $a = DB::select("SELECT etkinlik_id, COUNT(*) AS sayi FROM `activity_users` GROUP BY etkinlik_id;  ");
        return $a;
    }
    public function get(Request $req)

    {

        if ($req->kategori || $req->sortdate || $req->yer) {

            return DB::table('activity')->orWhere('date', 'LIKE', '%' . $req->sortdate . '%')
                ->orWhere('title', $req->kategori)->orWhere('location', $req->yer)->get();
        } elseif ($req->user) {

            return DB::table('activity')->where('isOpen', "0")->get();
        }
        elseif ($req->loc) {

            return DB::table('activity')->where('location', 'LIKE', '%' . $req->loc . '%')->get();
        } else {

            return DB::table('activity')->get();
        }
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
                'date' => $request->date,
                'time' => $request->time,
                'kota' => $request->kontenjan,
                'title' => $request->title,
                'location' => $request->etkinlik,
                'isOpen' => $request->open,
                'tutar' => $request->tutar


            ]);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }

    public function update(Request $request)
    {
        try {


            DB::table('activity')->where('id', $request->id)->update([
                'date' => $request->date,
                'kota' => $request->kontenjan,
                'title' => $request->title,
                'location' => $request->etkinlik,
                'tutar' => $request->tutar,
                'isOpen' => $request->open


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
                'telefon' => $req->telefon,
                'payed' => $req->payed,
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
                'telefon' => $req->telefon,


            ]);
        } catch (Exception $ex) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }


    public function deleteuser()
    {
    }

    //////////////////////////////////////////////////////////////////////////////////
    // Kategorii

    public function getcategory()

    {


        return DB::table('activity_category')->get();
    }
    public function addcategory(Request $request)
    {
        try {


            DB::table('activity_category')->insert([
                'name' => $request->name,

            ]);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }

    public function delcategory(Request $req)
    {
        try {


            DB::table('activity_category')->where('id', $req->id)->delete();
        } catch (Exception $ex) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }

    public function getplace()

    {
        return DB::table('activity_place')->get();
    }
    public function addplace(Request $request)
    {
        try {


            DB::table('activity_place')->insert([
                'name' => $request->name,

            ]);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }

    public function delplace(Request $req)
    {
        try {


            DB::table('activity_place')->where('id', $req->id)->delete();
        } catch (Exception $ex) {
            return response()->json(['error' => 'Başarısız'], 404);;
        }
    }
}
