<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientFile extends Controller

{

    public function yukle($request, $rapor, $id, $isim, $firma_id, $tür)
    {

        $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();

        DB::table('files')->insert(['rapor' => $rapor, 'calisan_id' => $id, 'dosya_ad' => $name, $tür => "1", 'name' => $isim, 'firma_id' => $firma_id]);

        $request->file('file')->storeas('Dosyalar/Firma', $name, ['disk' => 'dosyalar']);
    }




    public function dosyacek2($firma_id, $calisan_id, $tür)
    {

        return  DB::table('files')->where([['firma_id', $firma_id], [$tür, '1'], ['isArch', '1']])->orwhere('calisan_id', $calisan_id)->get();
    }


    public function dosyacek($firma_id, $calisan_id, $tür)
    {

        return  DB::table('files')->where([['firma_id', $firma_id], [$tür, '1'], ['isArch', '0']])->orwhere('calisan_id', $calisan_id)->get();
    }





    public function upload(Request $request)
    {

        /////////////////////////////////////////////////////////////////   ÖLÇÜM DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        if ($request->status === "1") {

            try {

                $this->yukle($request->file, $request->rapor, $request->id, $request->name, $request->firma_id, 'isMeasure');
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }

        /////////////////////////////////////////////////////////////////   iLK YARDIM DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////

        else if ($request->status === "2") {
            try {

                $this->yukle($request, $request->rapor, $request->id, $request->name, $request->firma_id, 'isYardim');
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
        /////////////////////////////////////////////////////////////////   PERİYODİK DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        else if ($request->status === '3') {
            try {
                $this->yukle($request, $request->rapor, $request->id, $request->name, $request->firma_id, 'isPeriyodik');
            } catch (Exception $exception) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
        /////////////////////////////////////////////////////////////////   PERİYODİK DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        else if ($request->status === "4") {
            try {

                $this->yukle($request, $request->rapor, $request->id, $request->name, $request->firma_id, 'isEgitim');
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
        /////////////////////////////////////////////////////////////////   ASANSOR DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        else if ($request->status === "5") {
            try {

                $this->yukle($request, $request->rapor, $request->id, $request->name, $request->firma_id, 'isAsansor');
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }


            /////////////////////////////////////////////////////////////////   DATABASE ÖZEL DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////

        } else if ($request->status === "6") {

            try {

                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();

                DB::table($request->db)->insert(['dosya_ad' => $name,  'name' => $request->db, 'firma_id' => $request->firma_id]);

                $request->file('file')->storeas('Dosyalar/Firma/' . $request->db,  $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        } else {
            /////////////////////////////////////////////////////////////////   LABORATUVAR DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////

            try {
                $this->yukle($request, $request->rapor, $request->id, $request->name, $request->firma_id, 'isLab');
            } catch (Exception $exception) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    public function getfile(Request $request)
    {
        /////////////////////////////////////////////////////////////////   ÖLÇÜM DOSYA GETİRME     /////////////////////////////////////////////////////////////////
        if ($request->status === 1) {

            return $this->dosyacek($request->firma_id, $request->calisan_id, 'isMeasure');
        }
        /////////////////////////////////////////////////////////////////   İLK YARDIM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 2) {

            return $this->dosyacek($request->firma_id, $request->calisan_id, 'isYardim');
        }
        /////////////////////////////////////////////////////////////////   PERİYODİK DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 3) {
            return $this->dosyacek($request->firma_id, $request->calisan_id, 'isPeriyodik');
        }
        /////////////////////////////////////////////////////////////////   EĞİTİM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 4) {

            return $this->dosyacek($request->firma_id, $request->calisan_id, 'isEgitim');
        }
        /////////////////////////////////////////////////////////////////  ASANSOR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 5) {

            return $this->dosyacek($request->firma_id, $request->calisan_id, 'isAsansor');
        }

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 7) {
            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isArch', '1']])->get();
        }

        /////////////////////////////////////////////////////////////////  ARŞİVLENMEMİŞ DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 8) {
            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isArch', '0']])->get();
        }
        /////////////////////////////////////////////////////////////////  ARŞİVLENMEMİŞ ÇALIŞAN DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 9) {
            return  DB::table('files')->where([['calisan_id', $request->calisan_id], ['isArch', '0']])->get();
        } else {
            /////////////////////////////////////////////////////////////////   LABORATUVAR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

            try {



                return $this->dosyacek($request->firma_id, $request->calisan_id, 'isLab');
            } catch (Exception $ex) {
                return $ex;
            }
        }
    }


    public function getfile2(Request $request)
    {

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ ÖLÇÜM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        if ($request->status === 1) {

            return  $this->dosyacek2($request->firma_id, $request->calisan_id, 'isMeasure');
        }

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ İL YARDIM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 2) {

            return $this->dosyacek2($request->firma_id, $request->calisan_id, 'isYardim');
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ PERİYODİK DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 3) {

            $this->dosyacek2($request->firma_id, $request->calisan_id, 'isPeriyodik');
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ EĞİTİM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 4) {

            return  $this->dosyacek2($request->firma_id, $request->calisan_id, 'isEgitim');
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ ASANSOR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 5) {

            return  $this->dosyacek2($request->firma_id, $request->calisan_id, 'isAsansor');
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ  DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 7) {
            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isArch', '1']])->get();
        }

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ LABORATUVAR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else {

            try {
                $this->dosyacek2($request->firma_id, $request->calisan_id, 'isLab');
            } catch (Exception $ex) {
                return $ex;
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function deletefile(Request $request)
    {
        try {


            DB::table('files')->where('id', $request->id)->delete();

            $file = public_path("Dosyalar/Firma/" . $request->dosya);


            return unlink($file);
        } catch (Exception $ex) {
            return $ex;
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function download(Request $request)
    {
        if ($request->db) {


            $file = public_path("Dosyalar/Firma/" . $request->db . '/' . $request->dosya);


            return response()->download($file);
        } else {

            $file = public_path("Dosyalar/Firma/" . $request->dosya);


            return response()->download($file);
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function arsiv(Request $request)
    {

        DB::table('files')->where('id', $request->id)->update([
            'isArch' => '1'
        ]);
    }
}
