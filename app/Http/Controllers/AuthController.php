<?php

namespace App\Http\Controllers;
use App\Models\SiswaApp;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
/*
|--------------------------------------------------------------------------
| GetForm Login Admin & Guru
|--------------------------------------------------------------------------
*/
    public function index()
    {
    	$content = [
                '1' => 'system media | login',
                '2' => 'System Media',
                '3' => 'sign in',
                '4' => 'i forgot my password',
                '5' => 'copyright'
            ];
    	return view('auth.login', ['content' => $content]);
    }
/*
|--------------------------------------------------------------------------
| GetForm Login Siswa
|--------------------------------------------------------------------------
*/
    public function siswa()
    {
        $content = [
                '1' => 'system media | login',
                '2' => 'System Media',
                '3' => 'sign in',
                '4' => 'i forgot my password',
                '5' => 'copyright'
            ];
        return view('auth.siswa-login', ['content' => $content]);
    }
/*
|--------------------------------------------------------------------------
| Check login Applications
|--------------------------------------------------------------------------
*/
    public function postLogin(Request $request)
    {
        $credentials = [
            'username' =>  $request->username,
            'password' =>  $request->password
            ];

        if(Auth()->attempt($credentials))
        {
            return Redirect::to('/notify');

        }else{
                    return Redirect::to('/error')->with('error', 'login failed');
             }
    }
/*
|--------------------------------------------------------------------------
| Check login Applications
|--------------------------------------------------------------------------
*/

    public function cekSiswa(Request $request)
    {
        $credentials = [
            'username' =>  $request->nama,
            'password' =>  $request->password,
            ];

            if(Auth('siswa')->attempt($credentials))
            {
                return Redirect::to('/notify');
            }
                else{
                    return 'false';
                }
    }
/*
|--------------------------------------------------------------------------
| Check login Applications
|--------------------------------------------------------------------------
*/

    public function error()
    {
        notify()->flash('Failed to Sign in', 'dangerous');

        return redirect('/auth-login');

    }
/*
|--------------------------------------------------------------------------
| Check login Applications
|--------------------------------------------------------------------------
*/

    public function errors()
    {
        notify()->flash('Failed to Sign in', 'dangerous');

        return redirect('/elearning');

    }

}
