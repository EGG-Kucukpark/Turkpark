<?php

namespace App\Http\Controllers\Apps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CerfController extends Controller
{
    function kursiyer_sayi()
    {

        $a = DB::select("SELECT firma_id, COUNT(*) AS sayi FROM `certificate` GROUP BY firma_id;");
        return $a;
    }
    public function get(Request $request)
    {
        if ($request->status) {
            return  DB::table('certificate')->where([['firma_id', $request->id], ['isArch', '1']])->get();
        } else {
            return  DB::table('certificate')->where([['firma_id', $request->id], ['isArch', '0']])->get();
        }
    }


    public function add(Request $request)
    {
        return  DB::table('certificate')->insert([
            'firma_id' => $request->id,
            'egitim_tur' => $request->egitim,
            'gecerli_trh' => $request->tarih,
            'qr' => $request->qr,
            'name' => $request->name,
            'sonuc' => $request->sonuc,
            'tc' => $request->tc

        ]);
    }
    public function update(Request $request)
    {
        return  DB::table('certificate')->where('id', $request->id)->update([

            'egitim_tur' => $request->egitim,
            'gecerli_trh' => $request->tarih,
            'qr' => $request->qr,
            'sonuc' => $request->sonuc,
            'name' => $request->name,
            'tc' => $request->tc

        ]);
    }


    public function archive(Request $request)
    {
        return  DB::table('certificate')->where('id', $request->id)->update([

            'isArch' => "1"

        ]);
    }

    public function archiveout(Request $request)
    {
        return  DB::table('certificate')->where('id', $request->id)->update([

            'isArch' => "0"

        ]);
    }
    public function sertifika(Request $request)
    {
        $a = DB::table('certificate')->where('id', $request->id)->first();

        return response()->json($a);
    }
}
