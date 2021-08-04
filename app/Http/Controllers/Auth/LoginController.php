<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\VerifyEmailException;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();


        return $user;

        if ($user) {

            $sifre = Hash::check($request->password, $user->password);

            if($sifre){


            $token = $this->guard()->attempt($this->credentials($request));

            if (!$token) {
                return false;
            }

            $user = $this->guard()->user();
            if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
                return false;
            }

            $this->guard()->setToken($token);

            return true;
        }else{
            return response()->json(['error' => 'Bilgiler Yanlış'], 404);


        }
        }



        else {
            return response()->json(['error' => 'Bilgiler Yanlış'], 404);
        }






    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
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
    protected function respondWithToken($token)
    {

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth::factory()->getTTL() * 60,
            'user' => auth()->user(),




        ]);
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
    }
}
