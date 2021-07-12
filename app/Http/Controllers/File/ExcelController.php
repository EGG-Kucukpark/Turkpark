<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExcelController extends Controller
{
    public function import(Request $request)
    {



        try {
            $data = $request->data;

            for ($i = 0; $i < count($data); $i++) {

                DB::table('certificate')->insert([


                    'egitim_tur' => $data[$i]['Eğitim Türü'],
                    'gecerli_trh' => $data[$i]['İlkyardım Belge Geçerlilik Tarihi'],
                    'qr' => $data[$i]['Doğrulama Kodu'],
                    'name' => $data[$i]['Katılımcı Adı Soyadı'],
                    'tc' => $data[$i]['Katılımcı T.C. No']




                ]);
            }

            return true;
        } catch (Exception $exception) {
            return response()->json(['error' => 'Başarısız'], 404);
        }
    }
}
