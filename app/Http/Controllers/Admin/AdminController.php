<?php

namespace App\Http\Controllers\Admin;
use App\Models\UserRole;
use App\Models\User;
use App\Models\SiswaApp;
use App\Models\TahunApp;
use App\Models\PelajaranApp;
use App\Models\Kelas;
use App\Models\MenuApp;
use App\Models\KelasApp;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
/*
|--------------------------------------------------------------------------
| Membatasi hak akses
|--------------------------------------------------------------------------
*/
	public function __construct()
	{
		return $this->middleware('auth');
	}
/*
|--------------------------------------------------------------------------
| Tampilkan halaman dashboard
|--------------------------------------------------------------------------
*/
    public function index()
    {
        $isi = [
            '1' =>'home',
            '2' =>'home',
            '3' =>'dashboard',
            '4' =>'',
            '5' =>''
            ];
    	if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('guru'))
    	{
            $guru = User::all();
            $siswa = SiswaApp::where('status', 'siswa')->get();
            $alumni = SiswaApp::where('status', 'alumni')->get();
            $tahun = TahunApp::all();
            $matpel = PelajaranApp::all();
            $kelas = Kelas::all();
            $user = UserRole::all();
            $system = MenuApp::all();
            $kelasApp = KelasApp::where('status',1)->get();
    		return view('backends.dashboard.index',[
                    'isi' => $isi,
                    'guru' => $guru,
                    'siswa' => $siswa,
                    'alumni' => $alumni,
                    'tahun' => $tahun,
                    'matpel' => $matpel,
                    'kelas' => $kelas,
                    'user' => $user,
                    'system' => $system,
                    'kelasApp' => $kelasApp
                ]);
    	}
        	return redirect()->back();
    }

    public function userAdmin()
    {
        if(!auth()->user()->hasRole('super-admin')){
            notify()->flash('Maaf !!!', 'error', [
                                    'text'  => 'Anda tidak punya hak akses'
                            ]);
            return redirect()->back();
        }
        $isi = [
            '1' => 'data user',
            '2' => 'user-admin',
            '3' => 'user'
        ];
        return view('backends.dashboard.data-user', [
                'isi' => $isi
            ]);
    }

    public function listUser()
    {
        $users = UserRole::orderBy('user_id', 'asc')->paginate(8);
        return view('backends.dashboard.list-user', [
                'users' => $users
            ]);
    }

    public function approve($id)
    {
        $cek = UserRole::where('user_id',$id)->where('role_id',2)->get();
        if(count($cek)){
            return response()->json(['success' => 'false']);
        }
        $user = User::find($id);
        $success = $user->assignRole('admin');

        return response()->json(['success' => 'true']);
    }

    public function block($id)
    {
        $user = User::find($id);
        $user->revokeRole('admin');

        return response()->json(['success' => 'true']);
    }

    public function userReset(Request $data)
    {
        $request = $data->all();
        $validasi = Validator::make($request, [
                'username'     => 'required | min : 6 | max : 15 | unique:guru_app,username',
                'password'     => 'required | min : 6 | max : 15 | alpha_num',
            ], $pesan = [
                'username' => 'Username sudah ada,pilih yang lain, hanya terdiri dari huruf & angka, min 6 hruf, max 15 huruf.',
                'password' => 'Password hanya boleh berisi huruf dan angka,  min 6 huruf, maks 15 huruf.'
            ]);
        if($validasi->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->witherrors($pesan)->withInput();
        }else{
                notify()->flash('Success !!!', 'success', [
                                            'text'  => 'Username & Password telah diupdate'
                                    ]);

            $id = $data->get('id_user');
            $users = [
                'username' => $data->Input('username'),
                'password' => bcrypt($data->Input('password'))
            ];
            User::where('id_guru', $id)->update($users);
            return redirect()->back();
        }
    }

    public function myProfile()
    {
        $isi = [
            '1' => 'profile',
            '2' => 'my profile',
            '3' => ''
        ];
        return view('backends.dashboard.myprofile', [
                'isi' => $isi
            ]);
    }

    public function UpdateProfile(Request $request)
    {
        $idProfile = auth()->user()->id_guru;
        $profile = $request->all();
        $validasi = Validator::make($profile, [
                'username'     => 'min : 6 | max : 15',
                'pass_lama' => 'required',
                'pass_baru' => 'required | min: 6 | max: 15 | alpha_num | same:confirm_pass',
                'confirm_pass' => 'required',
            ],$pesans =[
                'username' => 'Username sudah ada,pilih yang lain, hanya terdiri dari huruf & angka, min 6 hruf, max 15 huruf.',
                'pass_lama' => 'Masukan Password lama Anda.',
                'pass_baru' => 'Password hanya boleh berisi huruf dan angka,  min 6 huruf, maks 15 huruf.',
                'confirm_pass' => 'Password baru dan konfirmasi password harus sama.'
            ]);
        if($validasi->fails()){
            return redirect()->back()->witherrors($pesans)->withInput();
        }
        if($request->Input('username') !== ''){
            $newUsername = $request->Input('username');
            $passLama = User::find($idProfile);
            $pass = $passLama->password;
            $pass_baru = $request->Input('pass_lama');
            $new = $request->Input('pass_baru');
            if(password_verify($pass_baru, $pass)){
                $update = [
                    'username' => $newUsername,
                    'password' => bcrypt($new)
                ];
                User::where('id_guru', $idProfile)->update($update);
                notify()->flash('Success !!!', 'success', [
                                            'timer' => 2500,
                                            'text'  => 'Username & Password Anda telah diubah menjadi'.' '.$newUsername.' & '.$new.'.'
                                    ]);
                    return redirect('myprofile');
            }else {
                notify()->flash('Opps !!!', 'error', [
                                            'text'  => 'Konfimasi Password lama yang Anda masukan tidak cocok dengan system kami.'
                                    ]);
                    return redirect()->back();
            }
        }else{
            $passLama = User::find($idProfile);
            $pass = $passLama->password;
            $pass_baru = $request->Input('pass_lama');
            $new = $request->Input('pass_baru');
            if(password_verify($pass_baru, $pass)){
                $update = [
                    'password' => bcrypt($new),
                ];
                User::where('id_guru', $idProfile)->update($update);
                notify()->flash('Success !!!', 'success', [
                                            'timer' => 2500,
                                            'text'  => 'Password Anda telah diubah menjadi'.' '.$new.'.'
                                    ]);
                    return redirect('myprofile');
            }else {
                notify()->flash('Opps !!!', 'error', [
                                            'text'  => 'Konfimasi Password lama yang Anda masukan tidak cocok dengan system kami.'
                                    ]);
                    return redirect()->back();
            }
        }
    }
/*
|--------------------------------------------------------------------------
| Admin Logout from Application
|--------------------------------------------------------------------------
*/
    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
/*
|--------------------------------------------------------------------------
| success
|--------------------------------------------------------------------------
*/

    public function success(){
        notify()->flash('God job !', 'success', [
            'timer' => 2000,
            'text' => 'Berhasil...',
        ]);
        return redirect()->back();
    }
/*
|--------------------------------------------------------------------------
| errors
|--------------------------------------------------------------------------
*/
    public function error(){
        notify()->flash('Opps..', 'error', [
            'timer' => 2000,
            'text' => 'Ada kesalahan...',
        ]);
        return redirect()->back();
    }
}
