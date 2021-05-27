<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */



    public function login(Request $request)
    {

        //Bilgi doğrulama
        $user = DB::table('users')->where('email', $request->email)->first();






        if ($user) {
            //sifre kontrolü
            $sifre = Hash::check($request->password, $user->password);

            if ($sifre) {
                //Aktif mi değil mi işlemi burada yapılıyor.
                $a = DB::table('users')->where([['email', $request->email], ['status', '=', '1']])->get();
                $b = $a->count();
                if ($b == 0) {
                    return response()->json(['error' => 'yetkisiz'], 400);
                } else {

                    $credentials = request(['email', 'password',]);

                    if (!$token = Auth::attempt($credentials)) {
                        return response()->json(['error' => 'Unauthorized'], 401);
                    }
                    return $this->respondWithToken($token,);
                }
            } else {

                return response()->json(['error' => 'Şifre Yanlış'], 404);
            }
        } else {
            return response()->json(['error' => 'Bilgiler Yanlış'], 404);
        }
    }




    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token)
    {

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth::factory()->getTTL() * 60,
            'user' => auth()->user(),




        ]);
    }
}
