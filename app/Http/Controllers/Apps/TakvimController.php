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
        return $request;
        return  DB::table('takvim')->insert([]);
    }
    function takvimduzenle(Request $request)
    {
        return $request;
        return  DB::table('takvim')->update([]);
    }
    function takvimsil(Request $request)
    {
        return $request;
        return  DB::table('takvim')->where('id', $request->id)->get();
    }
}
