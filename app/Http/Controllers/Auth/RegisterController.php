<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'detail' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $prov = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $decpro = json_decode($prov, true);
        $jml = sizeof($decpro);

        for($i = 0; $i < $jml; $i++){
            if($decpro[$i]['id'] == $data['provinces']){
                $prov = $decpro[$i]['name'];
            }
        }

        $kota = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/'.$data['provinces'].'.json');
        $decpro = json_decode($kota, true);
        $jml = sizeof($decpro);

        for($i = 0; $i < $jml; $i++){
            if($decpro[$i]['id'] == $data['regencies']){
                $kota = $decpro[$i]['name'];
            }
        }

        $kec = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/'.$data['regencies'].'.json');
        $decpro = json_decode($kec, true);
        $jml = sizeof($decpro);

        for($i = 0; $i < $jml; $i++){
            if($decpro[$i]['id'] == $data['districts']){
                $kec = $decpro[$i]['name'];
            }
        }

        $kel = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/'.$data['districts'].'.json');
        $decpro = json_decode($kel, true);
        $jml = sizeof($decpro);

        for($i = 0; $i < $jml; $i++){
            if($decpro[$i]['id'] == $data['villages']){
                $kel = $decpro[$i]['name'];
            }
        }
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'prov' => $prov,
            'kab' => $kota,
            'kec' => $kec,
            'des' => $kel,
            'detail' => $data['detail'],
        ]);
    }
}
