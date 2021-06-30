<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    function workers(Request $request)
    {
        if ($request->q) {

            return DB::table('workers')->where([['firma_id', $request->firma_id], ['name', 'LIKE', '%' . $request->q . '%']])->get();
        }



        return DB::table('workers')->orwhere('firma_id', $request->firma_id)->get();
    }

    ////////////////////////////////////////////////////////////////////////////////////

    function worker(Request $request)
    {

        $a = DB::table('workers')->where('id', $request->id)->first();

        return response()->json($a);
    }

    ////////////////////////////////////////////////////////////////////////////////////

    public function addworker(Request $request)
    {


        try {
            DB::table('workers')->insert([
                'firma_id' => $request->firma_id,
                'name' => $request->name,
                'email' => $request->email,
                'telefon' => $request->telefon,

            ]);
        } catch (Exception $exception) {
            return $exception;
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////

    public function upload(Request $request)
    {
        try {

            $filename = $request->file('file')->getClientOriginalName();


            DB::table('files')->insert(['dosya' => $filename, 'calisan_id' => $request->id, 'isMeasure' => $request->status, 'name' => $request->name, 'firma_id' => $request->firma_id]);

            $request->file('file')->storeas('Dosyalar', $filename, ['disk' => 'dosyalar']);

            return $request;
        } catch (Exception $exception) {

            return response()->json(['error' => 'Başarısız'], 404);
        }
    }




    ////////////////////////////////////////////////////////////////////////////////////
    public function download(Request $request)
    {
        $file = public_path("Dosyalar/" . $request->dosya);


        return response()->download($file);
    }
    ////////////////////////////////////////////////////////////////////////////////////
    public function getfile(Request $request)
    {

        if ($request->status === 1) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isMeasure', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        } else {


            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isMeasure', '0']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
    }


    function calisanduzenle(Request $request)
    {

        try {
            DB::table('workers')->where('id', $request->userid)->update([

                'name' => $request->name,
                'email' => $request->email,
                'telefon' => $request->telefon,

            ]);
        } catch (Exception $exception) {
            return $exception;
        }
    }

    function workersil(Request $request){
        try {
            DB::table('workers')->where('id', $request->id)->delete();
        } catch (Exception $exception) {
            return $exception;
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////
    public function showfile(Request $request)
    {
        $file = public_path("Dosyalar/" . $request->dosya);

        return response($file);
    }

    public function deletefile(Request $request)
    {
        try {

            DB::table('files')->where('dosya', $request->dosya)->delete();

            $file = public_path("Dosyalar/" . $request->dosya);


            return unlink($file);
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
