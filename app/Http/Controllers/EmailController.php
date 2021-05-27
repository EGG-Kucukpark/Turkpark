<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function email(Request $request)
    {
        date_default_timezone_set('Europe/Istanbul');
        $date =  date("d.m.Y, H:i");



        $data = ['name' => $request->name, 'email' => $request->email, 'telefon' => $request->telefon, 'rol' => $request->role, 'time' => $date];
        $adminmail = 'cengiz.tosun@riskomer.com';

         $email = $request->email;

        Mail::send('email.welcome', $data, function ($message) use ($email) {

            $message->to($email);
            $message->subject('Hoşgeldin!');
        });




        Mail::send('email.admin', $data, function ($message) use ($adminmail) {

            $message->to($adminmail);
            $message->subject('Riskomer Kayıt sistemi!');
        });
        return response()->json(['status' => trans('verification.sent')]);
    }





}
