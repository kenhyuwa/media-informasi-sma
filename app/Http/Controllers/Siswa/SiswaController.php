<?php

namespace App\Http\Controllers\Siswa;
use App\Models\DownloadApp;
use App\Models\KelasSiswaApp;
use App\Models\KelasApp;
use App\Models\SiswaApp;
use App\Models\NilaiApp;
use App\Models\User;
use App\Models\Identitas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PDF;

class SiswaController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:siswa');
    }

    public function index()
    {
        if(auth('siswa')->user()->status == 'siswa'){
            $isi = [
                '1' => 'dashboard',
                '2' => 'dashboard',
                '3' => ''
            ];
            $kelas = KelasSiswaApp::orderBy('kode_kelas','desc')->where('siswa_id', auth('siswa')->user()->id_siswa)->get()->first();
            if(!count($kelas)){
                return redirect('dashboard/logout');
            }
            $keterangan = KelasApp::where('id', $kelas->kode_kelas)->firstOrfail();
            return view('siswa.index', [
                    'isi' => $isi,
                    'keterangan' =>$keterangan
                ]);
            }else{
                return redirect('dashboard/logout');
            }
    }

    public function getKelas()
    {
        $isi = [
            '1' => 'kelasku',
            '2' => 'my class',
            '3' => ''
        ];
        $no = 1;
        $kelas = KelasSiswaApp::orderBy('kode_kelas','desc')->where('siswa_id', auth('siswa')->user()->id_siswa)->get()->first();
        $keterangan = KelasApp::where('id', $kelas->kode_kelas)->first();
        $semua_siswa = KelasSiswaApp::where('kode_kelas', $kelas->kode_kelas)->get();
        $jadwal = DownloadApp::where('keterangan', 'jadwal')->where('kelas_id', $keterangan->kode_kelas)->first();
        return view('siswa.kelasku', [
                'isi' => $isi,
                'no' => $no,
                'keterangan' => $keterangan,
                'semua_siswa' => $semua_siswa,
                'jadwal' => $jadwal
            ]);
    }

    public function jadwal($id_jadwal)
    {
        $jadwal = DownloadApp::where('id_download','=', $id_jadwal)->firstOrfail();
        $pathToFile = ( public_path().'/uploads-smasimo/files/'.$jadwal->nama_file);
        return(Response::download($pathToFile));
    }

    public function lihatNilai()
    {
        $isi = [
            '1' => 'nilai',
            '2' => 'lihat nilai',
            '3' => ''
        ];
        return view('siswa.nilai', [
                'isi' => $isi
            ]);
    }

    public function getNilai()
    {
        $no = 1;
        //nilai terbaru ini
        $kelas = KelasSiswaApp::orderBy('kode_kelas','desc')->where('siswa_id', auth('siswa')->user()->id_siswa)->get()->first();
        $keterangan = KelasApp::where('id', $kelas->kode_kelas)->first();
        $nilai_siswa = NilaiApp::orderBy('kelas_id','desc')->where('kelas_id',$keterangan->id)->where('siswa_id', auth('siswa')->user()->id_siswa)->get();
        return view('siswa.get_nilai', [
                'no' => $no,
                'nilai_siswa' => $nilai_siswa
            ]);
    }

    public function getSemester(Request $smt)
    {
        $no = 1;
        $semester = $smt->Input('semester');
        $kelas = KelasSiswaApp::orderBy('kode_kelas','desc')->where('siswa_id', auth('siswa')->user()->id_siswa)->get()->first();
        $keterangan = KelasApp::where('id', $kelas->kode_kelas)->first();
        $nilai_siswa = NilaiApp::orderBy('kelas_id','desc')->where('kelas_id',$keterangan->id)->where('siswa_id', auth('siswa')->user()->id_siswa)->where('semester', $semester)->get();
        return view('siswa.get_nilai', [
                'no' => $no,
                'nilai_siswa' => $nilai_siswa
            ]);
    }

    public function getPdf($semester){
        $identitas = Identitas::all()->first();
        $kepala_sekolah = User::where('jabatan', 'kepala sekolah')
                                              ->get()
                                              ->first();
        $kelas = KelasSiswaApp::orderBy('kode_kelas','desc')->where('siswa_id', auth('siswa')->user()->id_siswa)->get()->first();
        $keterangan = KelasApp::where('id', $kelas->kode_kelas)->first();
        $nilai_siswa = NilaiApp::orderBy('kelas_id','desc')->where('kelas_id',$keterangan->id)->where('siswa_id', auth('siswa')->user()->id_siswa)->where('semester', $semester)->get();
        $pdf = PDF::loadView('siswa.pdf', compact('identitas','kepala_sekolah','keterangan','nilai_siswa','semester'));
        return $pdf->stream('semester-'.$semester.'.pdf');
    }

    public function download()
    {
        $isi = [
            '1' => 'download',
            '2' => 'download',
            '3' => ''
        ];
        $id_siswa = auth('siswa')->user()->id_siswa;
        $ambilKodeKelas = KelasSiswaApp::orderBy('kode_kelas','desc')->where('siswa_id', $id_siswa)->firstOrfail();
        $kode_kelas = $ambilKodeKelas->kode_kelas;
        $ambilIdKelas = KelasApp::where('id', $kode_kelas)->firstOrfail();
        $idKelas = $ambilIdKelas->kode_kelas;
        $materis = DownloadApp::where('keterangan', 'materi')->where('kelas_id', $idKelas)->get();
        $tugass = DownloadApp::where('keterangan', 'tugas')->where('kelas_id', $idKelas)->get();
        return view('siswa.download', [
                'isi' => $isi,
                'materis' => $materis,
                'tugass' => $tugass
            ]); 
    }

    public function getDownload($id_download)
    {
        $getFile = DownloadApp::where('id_download', '=', $id_download)->firstOrfail();
        $pathToFile = ( public_path().'/uploads-smasimo/files/'.$getFile->nama_file);
        return(Response::download($pathToFile));
    }

    public function profile()
    {
        $isi = [
            '1' => 'my profile',
            '2' => 'my profile',
            '3' => ''
        ];
        return view('siswa.profile', [
                'isi' => $isi
            ]);
    }

    public function UpdateProfile(Request $request)
    {
        $idProfile = auth('siswa')->user()->id_siswa;
        $profile = $request->all();
        $validasi = Validator::make($profile, [
                'pass_lama' => 'required',
                'pass_baru' => 'required | min: 6 | max: 15 | alpha_num | same:confirm_pass',
                'confirm_pass' => 'required',
            ],$pesans =[
                'pass_lama' => 'Masukan Password lama Anda',
                'pass_baru' => 'Password hanya boleh berisi huruf dan angka,  min 6 huruf, maks 15 huruf',
                'confirm_pass' => 'Password baru dan konfirmasi password harus sama'
            ]);
        if($validasi->fails()){
            notify()->flash('Opps !!!', 'error', [
                                        'text'  => 'Terdapat kesalahan !'
                                ]);
            return redirect()->back()->witherrors($pesans)->withInput();
        }
        $passLama = SiswaApp::find($idProfile);
        $pass = $passLama->password;
        $pass_baru = $request->Input('pass_lama');
        $new = $request->Input('pass_baru');
        if(password_verify($pass_baru, $pass)){
            $update = [
                'password' => bcrypt($request->Input('pass_baru')),
            ];
            SiswaApp::where('id_siswa', $idProfile)->update($update);
            notify()->flash('Success !!!', 'success', [
                                        'text'  => 'Selamat, Password Anda telah dirubah menjadi'.' '.$new
                                ]);
                return redirect('profile');
        }else {
            notify()->flash('Opps !!!', 'error', [
                                        'text'  => 'Maaf, Konfimasi Password lama yang Anda masukan tidak cocok dengan system kami'
                                ]);
                return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::guard('siswa')->logout();

        return Redirect::to('/');
    }
}
// pdf dan liat nilai blm selesai bro .....