<?php

namespace App\Http\Controllers\Apps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CerfController extends Controller
{
    public function get(Request $request)
    {
        return  DB::table('certificate')->where('firma_id',$request->id)->get();
    }


    public function add(Request $request)
    {
        return  DB::table('certificate')->insert([

            'egitim_tur' => $request->egitim,
            'gecerli_trh' => $request->tarih,
            'qr' => $request->qr,
            'name' => $request->name,
            'sonuc'=> $request->sonuc,
            'tc' => $request->tc

        ]);
    }
    public function update(Request $request)
    {
        return  DB::table('certificate')->where('id', $request->id)->update([

            'egitim_tur' => $request->egitim,
            'gecerli_trh' => $request->tarih,
            'qr' => $request->qr,
            'sonuc'=> $request->sonuc,
            'name' => $request->name,
            'tc' => $request->tc

        ]);
    }
    public function sertifika(Request $request)
    {
        $a = DB::table('certificate')->where('id', $request->id)->first();

        return response()->json($a);
    }
}
