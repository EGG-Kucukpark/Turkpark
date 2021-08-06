<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BillController extends Controller
{
    public function bill(Request $request)
    {

        $a = DB::table('activity_log')->insert([
            'firma_id' => $request->id,
            'firma_adi' => $request->name,
            'mesaj' => $request->mesaj,
            'tutar' => $request->tutar,
            'adres' => $request->adres,
            'tests' => json_encode($request->testler, JSON_UNESCAPED_UNICODE),
            'sayi' => $request->kisi,
            'lab' => $request->labTürü,


        ]);


        $id = DB::getPdo()->lastInsertId();

        date_default_timezone_set('Europe/Istanbul');
        $date =  date("d.m.Y, H:i");

        $data = [
            'id' => $id,
            'name' => $request->name,
            'tutar' => $request->tutar,
            'adres' => $request->adres,
            'testler' => $request->testler,
            'kisi' => $request->kisi,
            'email' => $request->email,
            'lab' => $request->labTürü,
            'time' => $date
        ];

        $email = $request->email;



        Mail::send('email.fatura', $data, function ($message) use ($email) {

            $message->to($email);
            $message->subject('Hizmet Faturası!');
        });
    }


    public function update(Request  $request)
    {
        DB::table('activity_log')->where([['id', $request->id], ['firma_id', $request->firma_id]])->update(['status' => '1']);
    }

    public function getHizmet(Request $request)
    {
        return DB::table('activity_log')->where('firma_id', $request->id)->get();
    }
}
