<?php

namespace App\Http\Controllers\Apps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CerfController extends Controller
{
    public function get(Request $request)
    {
        return  DB::table('certificate')->get();



    }

    public function sertifika(Request $request)
    {
        $a = DB::table('certificate')->where('id', $request->id)->first();

        return response()->json($a);
    }
}
