<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{




    public function upload(Request $request)
    {

        /////////////////////////////////////////////////////////////////   ÖLÇÜM DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        if ($request->status === "1") {

            try {

                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['rapor' => $request->rapor, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isMeasure' => "1", 'name' => $request->name, 'firma_id' => $request->firma_id]);

                $request->file('file')->storeas('Dosyalar/Firma', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }

        /////////////////////////////////////////////////////////////////   iLK YARDIM DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////

        else if ($request->status === "2") {
            try {

                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['rapor' => $request->rapor, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isYardim' => "1", 'name' => $request->name, 'firma_id' => $request->firma_id]);

                $request->file('file')->storeas('Dosyalar/Firma', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
        /////////////////////////////////////////////////////////////////   PERİYODİK DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        else if ($request->status === '3') {
            try {




                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['rapor' => $request->rapor, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isPeriyodik' => '1', 'name' => $request->name, 'firma_id' => $request->firma_id]);

                $request->file('file')->storeas('Dosyalar/Firma', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $exception) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
        /////////////////////////////////////////////////////////////////   PERİYODİK DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        else if ($request->status === "4") {
            try {

                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['rapor' => $request->rapor, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isEgitim' => "1", 'name' => $request->name, 'firma_id' => $request->firma_id]);

                $request->file('file')->storeas('Dosyalar/Firma', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        }
        /////////////////////////////////////////////////////////////////   ASANSOR DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////
        else if ($request->status === "5") {
            try {

                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['rapor' => $request->rapor, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isAsansor' => "1", 'name' => $request->name, 'firma_id' => $request->firma_id]);

                $request->file('file')->storeas('Dosyalar/Firma', $name, ['disk' => 'dosyalar']);

                return $request;
            } catch (Exception $ex) {
                return response()->json(['error' => 'Başarısız'], 404);
            }
        } else {
            /////////////////////////////////////////////////////////////////   LABORATUVAR DOSYA YÜKLEME     /////////////////////////////////////////////////////////////////

            try {



                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['rapor' => $request->rapor, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isLab' => "1", 'name' => $request->name, 'firma_id' => $request->firma_id]);

                $request->file('file')->storeas('Dosyalar/Firma', $name, ['disk' => 'dosyalar']);


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

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isMeasure', '1'], ['isArch', '0']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
        /////////////////////////////////////////////////////////////////   İLK YARDIM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 2) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isYardim', '1'], ['isArch', '0']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
        /////////////////////////////////////////////////////////////////   PERİYODİK DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 3) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isPeriyodik', '1'], ['isArch', '0']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
        /////////////////////////////////////////////////////////////////   EĞİTİM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 4) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isEgitim', '1'], ['isArch', '0']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
        /////////////////////////////////////////////////////////////////  ASANSOR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 5) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isAsansor', '1'], ['isArch', '0']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
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
                return  DB::table('files')->where([['firma_id', $request->firma_id], ['isLab', '1'], ['isArch', '0']])
                    ->orwhere('calisan_id', $request->calisan_id)->get();
            } catch (Exception $ex) {
                return $ex;
            }
        }
    }

    public function getfile2(Request $request)
    {

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ ÖLÇÜM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        if ($request->status === 1) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isMeasure', '1'], ['isArch', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ İL YARDIM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 2) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isYardim', '1'], ['isArch', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ PERİYODİK DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 3) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isPeriyodik', '1'], ['isArch', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ EĞİTİM DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 4) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isEgitim', '1'], ['isArch', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ ASANSOR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 5) {

            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isAsansor', '1'], ['isArch', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ  DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else if ($request->status === 7) {
            return  DB::table('files')->where([['firma_id', $request->firma_id], ['isArch', '1']])->get();
        }

        /////////////////////////////////////////////////////////////////   ARŞİVLENMİŞ LABORATUVAR DOSYA GETİRME     /////////////////////////////////////////////////////////////////

        else {

            try {
                return  DB::table('files')->where([['firma_id', $request->firma_id], ['isLab', '1'], ['isArch', '1']])
                    ->orwhere('calisan_id', $request->calisan_id)->get();
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
        $file = public_path("Dosyalar/Firma/" . $request->dosya);


        return response()->download($file);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function arsiv(Request $request)
    {

        DB::table('files')->where('id', $request->id)->update([
            'isArch' => '1'
        ]);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function importsertf(Request $request)
    {



        try {
            $data = $request->data;

            for ($i = 0; $i < count($data); $i++) {

                DB::table('certificate')->insert([
                    'kategori' => $data[$i]['Eğitim Türü'],
                    'bitis' => $data[$i]['Eğitim Bitiş'],
                    'baslama' =>  $data[$i]['Eğitim Başlama'],
                    'gecerlilik' => $data[$i]['İlkyardım Belge Geçerlilik Tarihi'],
                    'url' => $data[$i]['Doğrulama Kodu'],
                    'name' => $data[$i]['Katılımcı Adı Soyadı'],
                    'qr' => $data[$i]['Eğitim Bitiş'],
                    'tc' => $data[$i]['Katılımcı T.C. No'],
                    'belge_tarih' => $data[$i]['İlkyardım Belge Tarihi'],
                    'belge_no' => $data[$i]['İlkyardım Belge No'],



                ]);
            }
        } catch (Exception $exception) {
            return  $exception;
        }
    }





    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function raporlar()
    {
        return DB::table('reports')->get();
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function raporekle(Request $request)
    {
        DB::table('reports')->insert([
            'name' => $request->name
        ]);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function raporsil(Request $request)
    {
        DB::table('reports')->where('id', $request->id)->delete();
    }



    public function egtm()
    {
        return DB::table('egitimler')->get();
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function egtm_rpr(Request $request)
    {
        DB::table('egitimler')->insert([
            'name' => $request->name
        ]);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function egtm_sil(Request $request)
    {
        DB::table('egitimler')->where('id', $request->id)->delete();
    }
    public function dsya()
    {
        return DB::table('dosya_tur')->get();
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function dsya_rpr(Request $request)
    {
        DB::table('dosya_tur')->insert([
            'name' => $request->name
        ]);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function dsya_sil(Request $request)
    {
        DB::table('dosya_tur')->where('id', $request->id)->delete();
    }
}
