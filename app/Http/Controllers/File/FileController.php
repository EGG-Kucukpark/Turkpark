<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    public function upload(Request $request)
    {

        try {
            if ($request->status === "1") {

                $filename = $request->file('file')->getClientOriginalName();
                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['dosya' => $filename, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isMeasure' => "1", 'name' => $request->name, 'firma_email' => $request->firma_email]);

                $request->file('file')->storeas('Dosyalar', $name, ['disk' => 'dosyalar']);

                return $request;
            } else if ($request->status === "2") {

                $filename = $request->file('file')->getClientOriginalName();
                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['dosya' => $filename, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isYardim' => "1", 'name' => $request->name, 'firma_email' => $request->firma_email]);

                $request->file('file')->storeas('Dosyalar', $name, ['disk' => 'dosyalar']);

                return $request;
            } else if ($request->status === '3') {

                $filename = $request->file('file')->getClientOriginalName();
                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['dosya' => $filename, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isPeriyodik' => '1', 'name' => $request->name, 'firma_email' => $request->firma_email]);

                $request->file('file')->storeas('Dosyalar', $name, ['disk' => 'dosyalar']);

                return $request;
            } else if ($request->status === "4") {

                $filename = $request->file('file')->getClientOriginalName();
                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['dosya' => $filename, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isEgitim' => "1", 'name' => $request->name, 'firma_email' => $request->firma_email]);

                $request->file('file')->storeas('Dosyalar', $name, ['disk' => 'dosyalar']);

                return $request;
            } else if ($request->status === "5") {

                $filename = $request->file('file')->getClientOriginalName();
                $name =  rand(0, 1000) . "." . $request->file('file')->getClientOriginalName();



                DB::table('files')->insert(['dosya' => $filename, 'calisan_id' => $request->id, 'dosya_ad' => $name, 'isAsansor' => "1", 'name' => $request->name, 'firma_email' => $request->firma_email]);

                $request->file('file')->storeas('Dosyalar', $name, ['disk' => 'dosyalar']);

                return $request;
            } else {


                return  DB::table('files')->where([['firma_email', $request->firma_email], ['isMeasure', '0']])
                    ->orwhere('calisan_id', $request->calisan_id)->get();
            }
        } catch (Exception $exception) {

            return $exception;
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    public function download(Request $request)
    {
        $file = public_path("Dosyalar/" . $request->dosya);


        return response()->download($file);
    }
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    public function getfile(Request $request)
    {

        if ($request->status === 1) {

            return  DB::table('files')->where([['firma_email', $request->firma_email], ['isMeasure', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        } else if ($request->status === 2) {

            return  DB::table('files')->where([['firma_email', $request->firma_email], ['isYardim', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        } else if ($request->status === 3) {

            return  DB::table('files')->where([['firma_email', $request->firma_email], ['isPeriyodik', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        } else if ($request->status === 4) {

            return  DB::table('files')->where([['firma_email', $request->firma_email], ['isEgitim', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        } else if ($request->status === 5) {

            return  DB::table('files')->where([['firma_email', $request->firma_email], ['isAsansor', '1']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        } else {


            return  DB::table('files')->where([['firma_email', $request->firma_email], ['isMeasure', '0']])
                ->orwhere('calisan_id', $request->calisan_id)->get();
        }
    }



    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

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
}
