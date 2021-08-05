<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function email(Request $request)
    {
        date_default_timezone_set('Europe/Istanbul');
        $date =  date("d.m.Y, H:i");



        $data = ['name' => $request->name, 'email' => $request->email, 'telefon' => $request->telefon, 'rol' => $request->role, 'time' => $date];
        $adminmail = 'cengiz.tosun@Türkpark.com';







        Mail::send('email.admin', $data, function ($message) use ($adminmail) {

            $message->to($adminmail);
            $message->subject('Türkpark Kayıt sistemi!');
        });
        return response()->json(['status' => trans('verification.sent')]);
    }



    public function bill(Request $request)
    {

        date_default_timezone_set('Europe/Istanbul');
        $date =  date("d.m.Y, H:i");


        $data = [
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
}
