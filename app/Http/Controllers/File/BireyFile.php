<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BireyFile extends Controller
{


    public function upload(Request $request)
    {

        /////////////////////////////////////////////////////////////////   ÖLÇÜM DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        if ($request->status === "1") {

            try {
                $user = DB::table('individual')->where('id', $request->id)->first();

                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('birey_files')->insert(['rapor' => $request->rapor,  'dosya_ad' => $name, 'isMeasure' => "1", 'name' => $user->name, 'user_id' => $request->user_id]);

                $request->file('file')->storeas('Dosyalar/Birey/', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }

        /////////////////////////////////////////////////////////////////   iLK YARDIM DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////

        else if ($request->status === "2") {
            try {

                $user = DB::table('individual')->where('id', $request->id)->first();
                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('birey_files')->insert(['rapor' => $request->rapor,  'dosya_ad' => $name, 'isYardim' => "1", 'name' => $user->name, 'user_id' => $request->user_id]);

                $request->file('file')->storeas('Dosyalar/Birey/', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
        /////////////////////////////////////////////////////////////////   PERİYODİK DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        else if ($request->status === '3') {
            try {

                $user = DB::table('individual')->where('id', $request->id)->first();



                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('birey_files')->insert(['rapor' => $request->rapor,  'dosya_ad' => $name, 'isPeriyodik' => '1', 'name' => $user->name, 'user_id' => $request->user_id]);

                $request->file('file')->storeas('Dosyalar/Birey/', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $exception) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
        /////////////////////////////////////////////////////////////////   EĞİTİM DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        else if ($request->status === "4") {
            try {
                $user = DB::table('individual')->where('id', $request->id)->first();

                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('birey_files')->insert(['rapor' => $request->rapor,  'dosya_ad' => $name, 'isEgitim' => "1", 'name' => $user->name, 'user_id' => $request->user_id]);

                $request->file('file')->storeas('Dosyalar/Birey/', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
        /////////////////////////////////////////////////////////////////   ASANSOR DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        else if ($request->status === "5") {
            try {

                $user = DB::table('individual')->where('id', $request->id)->first();
                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('birey_files')->insert(['rapor' => $request->rapor,  'dosya_ad' => $name, 'isAsansor' => "1", 'name' => $user->name, 'user_id' => $request->user_id]);

                $request->file('file')->storeas('Dosyalar/Birey/', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        } else {
            /////////////////////////////////////////////////////////////////   LABORATUVAR DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////

            try {
                $user = DB::table('individual')->where('id', $request->id)->first();


                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('birey_files')->insert(['rapor' => $request->rapor,  'dosya_ad' => $name, 'isLab' => "1", 'name' => $user->name, 'user_id' => $request->user_id]);

                $request->file('file')->storeas('Dosyalar/Birey/', $name, ['disk' => 'dosyalar']);


                return $request;
            } catch (Exception $exception) {
                return response()->json(['error' => $request->file('file')->getClientOriginalName()], 404);
            }
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getfile(Request $request)
    {
        /////////////////////////////////////////////////////////////////   ÖLÇÜM DOSYA GETİRME     /////////////////////////////////////////////////////////////////
        if ($request->status === 1) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isMeasure', '1'], ['isArch', '0']])
                ->get();
        }
        /////////////////////////////////////////////////////////////////   İLK YARDIM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 2) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isYardim', '1'], ['isArch', '0']])
                ->get();
        }
        /////////////////////////////////////////////////////////////////   PERİYODİK DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 3) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isPeriyodik', '1'], ['isArch', '0']])
                ->get();
        }
        /////////////////////////////////////////////////////////////////   EĞİTİM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 4) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isEgitim', '1'], ['isArch', '0']])
                ->get();
        }
        /////////////////////////////////////////////////////////////////  ASANSOR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 5) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isAsansor', '1'], ['isArch', '0']])
                ->get();
        }

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 7) {
            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isArch', '1']])->get();
        }

        /////////////////////////////////////////////////////////////////  ARŞİVLENMEMİŞ DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 8) {
            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isArch', '0']])->get();
        }
        /////////////////////////////////////////////////////////////////  ARŞİVLENMEMİŞ ÇALIŞAN DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 9) {
            return  DB::table('birey_files')->where([['calisan_id', $request->calisan_id], ['isArch', '0']])->get();
        } else {
            /////////////////////////////////////////////////////////////////   LABORATUVAR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

            try {
                return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isLab', '1'], ['isArch', '0']])
                    ->get();
            } catch (Exception $ex) {
                return $ex;
            }
        }
    }

    public function getfile2(Request $request)
    {

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ ÖLÇÜM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        if ($request->status === 1) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isMeasure', '1'], ['isArch', '1']])
                ->get();
        }

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ İL YARDIM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 2) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isYardim', '1'], ['isArch', '1']])
                ->get();
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ PERİYODİK DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 3) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isPeriyodik', '1'], ['isArch', '1']])
                ->get();
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ EĞİTİM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 4) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isEgitim', '1'], ['isArch', '1']])
                ->get();
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ ASANSOR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 5) {

            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isAsansor', '1'], ['isArch', '1']])
                ->get();
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ  DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 7) {
            return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isArch', '1']])->get();
        }

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ LABORATUVAR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else {

            try {
                return  DB::table('birey_files')->where([['user_id', $request->user_id], ['isLab', '1'], ['isArch', '1']])
                    ->get();
            } catch (Exception $ex) {
                return $ex;
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function deletefile(Request $request)
    {
        try {


            DB::table('birey_files')->where('id', $request->id)->delete();

            $file = public_path("Dosyalar/Birey//" . $request->dosya);


            return unlink($file);
        } catch (Exception $ex) {
            return $ex;
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function download(Request $request)
    {
        $file = public_path("Dosyalar/Birey//" . $request->dosya);


        return response()->download($file);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function arsiv(Request $request)
    {

        DB::table('birey_files')->where('id', $request->id)->update([
            'isArch' => '1'
        ]);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
