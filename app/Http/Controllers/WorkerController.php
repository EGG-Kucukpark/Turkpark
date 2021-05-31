<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    function workers(Request $request)
    {

        return DB::table('workers')->orwhere('firma_email', $request->firma_email)->get();
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
                'firma_email' => $request->firma_email,
                'name' => $request->name,
                'email' => $request->email,
                'telefon' => $request->telefon,

            ]);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////

    public function upload(Request $request)
    {
        try {

            $filename = $request->file('file')->getClientOriginalName();


            DB::table('files')->insert(['dosya' => $filename, 'calisan_id' => $request->id, 'isMeasure' => $request->status, 'name' => $request->name, 'firma_email' => $request->firma_email]);

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

            return  DB::table('files')->where([['firma_email', $request->firma_email], ['isMeasure', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        } else {


            return  DB::table('files')->where([['firma_email', $request->firma_email], ['isMeasure', '0']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
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
