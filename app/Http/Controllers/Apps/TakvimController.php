<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TakvimController extends Controller
{

    function takvimler(Request $request)
    {

        return  DB::table('takvim')->where('user_id', $request->id)->get();
    }
    function takvimekle(Request $request)
    {
        $event = $request->event;


        return  DB::table('takvim')->insert([
            'title' => $event["title"],
            'start' => $event["start"],
            'end' => $event["end"],
            'user_id' => $request->user_id


        ]);
    }



    function takvimduzenle(Request $request)
    {
        $event = $request->event;

        DB::table('takvim')->where('id', $event['id'])->update([

            'title' => $event['title'],
            'start' => $event['start'],
            'end' => $event['end']


        ]);

        return $request;
    }
    function takvimsil(Request $request)
    {

        return  DB::table('takvim')->where('id', $request->id)->delete();
        return $request;
    }
}
