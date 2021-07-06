<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered(Request $request, User $user)
    {
        if ($user instanceof MustVerifyEmail) {
            return response()->json(['status' => trans('verification.sent')]);
        }

        return response()->json($user);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email:filter|max:255|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        date_default_timezone_set('Europe/Istanbul');
        $date =  date("d.m.Y, H:i");

        if ($data['role'] === "Bireysel") {
            DB::table('individual')->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'isArch' => '0',
                'telefon' => $data['telefon'],

            ]);
            $kullanici = DB::table('individual')->where('email', $data['email'])->first();
            sleep(2);

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['Şifre']),
                'role' => $data['role'],
                'status' => '2',
                'telefon' => $data['telefon'],
                'created_at' => $date,
                'user_id' => $kullanici->id


            ]);
        } else {

            DB::table('clients')->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'isArch' => '0',
                'telefon' => $data['telefon'],

            ]);

            $kullanici = DB::table('clients')->where('email', $data['email'])->first();





            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['Şifre']),
                'role' => $data['role'],
                'status' => '2',
                'telefon' => $data['telefon'],
                'created_at' => $date,
                'user_id' => $kullanici->id

            ]);
        }
    }
}
