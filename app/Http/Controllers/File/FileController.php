<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Laravel\Ui\Presets\React;

class FileController extends Controller
{

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


        Schema::create($request->name, function ($table) {


            $table->bigIncrements('id');
            $table->integer('firma_id');
            $table->string('name');
            $table->string('dosya_ad');
            $table->timestamp('created');
        });
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function dsya_sil(Request $request)
    {

        Schema::dropIfExists($request->data['name']);
        DB::table('dosya_tur')->where('id', $request->data['id'])->delete();
    }


    function getir(Request $request)
    {

        try {
            Schema::hasTable($request->name);
            return DB::table($request->name)->where('firma_id', $request->id)->get();
        } catch (Exception $ex) {
            return $ex;
        }
    }





}
