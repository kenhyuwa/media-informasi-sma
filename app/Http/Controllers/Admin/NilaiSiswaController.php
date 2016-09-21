<?php

namespace App\Http\Controllers\Admin;
use App\Models\KelasApp;
use App\Models\SemesterApp;
use App\Models\PelajaranApp;
use App\Models\User;
use App\Models\SiswaApp;
use App\Models\TahunApp;
use App\Models\KelasSiswaApp;
use App\Models\Kelas;
use App\Models\NilaiApp;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PDF;

class NilaiSiswaController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$isi = [
    		'1' => 'nilai siswa',
    		'2' => 'akademik',
    		'3' => 'nilai'
    	];
        $kelass = KelasApp::orderBy('tahun_ajaran_id', 'desc')->where('status', 1)->paginate(8);
        $pelajarans = PelajaranApp::all();
    	return view('backends.nilai.view', [
    			'isi' => $isi,
                'kelass' => $kelass,
                'pelajarans' => $pelajarans
    		]);
    }

    public function cariNilai(Request $request)
    {
        $no = 1;
        $kelas = $request->get('id_kelas');
        $pelajaran = $request->get('matpel');
        $semester = $request->get('semester');
        $cek = NilaiApp::where('kelas_id', $kelas)
                            ->where('pelajaran_id', $pelajaran)
                            ->where('semester', $semester)
                            ->get();
        if(count($cek)){
            $nilai = NilaiApp::where('kelas_id', $kelas)
                            ->where('pelajaran_id', $pelajaran)
                            ->where('semester', $semester)
                            ->firstOrfail();
            $nilai_siswa = NilaiApp::orderBy('siswa_id', 'asc')
                            ->where('kelas_id', $kelas)
                            ->where('pelajaran_id', $pelajaran)
                            ->where('semester', $semester)
                            ->paginate(50);
            $matpel = $nilai->getMatpel->matpel;
            $class = KelasApp::find(['kode_kelas' => $kelas])->first();
            $isi = [
                '1' => 'nilai kelas',
                '2' => $matpel,
                '3' => $semester
            ];
            //$info = '';
            return view('backends.nilai.search', [
                    'no' => $no,
                    'nilai_siswa' =>$nilai_siswa,
                    'isi' => $isi,
                    'class' => $class,
                    'kelas' => $kelas,
                    'pelajaran' => $pelajaran,
                    'semester' => $semester
                ]);
        }
            $isi = [
                '1' => 'nilai kelas',
                '2' => '',
                '3' => ''
            ];
            $nilai_siswa = NilaiApp::orderBy('siswa_id', 'asc')
                            ->where('kelas_id', $kelas)
                            ->where('pelajaran_id', $pelajaran)
                            ->where('semester', $semester)
                            ->get();
            return view('backends.nilai.search', [
                    'isi' => $isi,
                    'nilai_siswa' =>$nilai_siswa
                ]);
    }

    public function kelolaNilai()
    {
    	$no = 1;
    	$isi = [
    		'1' => 'kelola nilai',
    		'2' => 'akademik',
    		'3' => 'kelola nilai'
    	];
    	$kelass = KelasApp::orderBy('tahun_ajaran_id', 'desc')->where('status', 1)->paginate(8);
        $pelajarans = PelajaranApp::all();
    	return view('backends.nilai.kelola', [
    			'no' => $no,
    			'isi' => $isi,
    			'kelass' => $kelass,
                'pelajarans' => $pelajarans
    		]);
    }

    public function tugasSatu($id_kelas, $id_pel)
    {
    	$no = 1;
    	$isi = [
    		'1' => 'input nilai tugas-1',
    		'2' => 'nilai',
    		'3' => 'tugas-1'
    	];
    	$kode = $id_kelas;
    	$id_pel = $id_pel;
    	$cek = NilaiApp::where('kelas_id',$id_kelas)->where('pelajaran_id', $id_pel)->get();
    	if(count($cek)){
            $input = NilaiApp::where('kelas_id',$id_kelas)->where('pelajaran_id', $id_pel)->firstOrfail();
            $inputs = NilaiApp::orderBy('siswa_id', 'asc')->where('kelas_id',$id_kelas)->where('pelajaran_id', $id_pel)->get();
            $semua_guru = User::all();
            $kode_matpel = strtoupper($input->getMatpel->kode_matpel);
            $matpel = strtoupper($input->getMatpel->matpel);
            $IDguru_pengajar = strtoupper($input->getGuru->id_guru);
            $guru_pengajar = strtoupper($input->getGuru->nama_guru);
            $semester = '';
            $disabled = 'disabled';
            $action = 'Admin\NilaiSiswaController@updateTugasSatu';
	    	return view('backends.nilai.tugas_satu', [
	    			'no' => $no,
	    			'isi' => $isi,
                    'action' => $action,
                    'input' => $input,
	    			'inputs' => $inputs,
	    			'kode' => $kode,
	    			'id_pel' => $id_pel,
                    'kode_matpel' => $kode_matpel,
                    'matpel' => $matpel,
                    'IDguru_pengajar' => $IDguru_pengajar,
                    'guru_pengajar' => $guru_pengajar,
                    'semester' => $semester,
                    'semua_guru' => $semua_guru,
                    'disabled' => $disabled,
	    		]);
    	}else{
    		$inputs = KelasSiswaApp::orderBy('siswa_id', 'asc')->where('kode_kelas',$id_kelas)->get();
	    	$pelajaran = PelajaranApp::where('id_matpel', $id_pel)->firstOrfail();
            $semua_guru = User::all();
            $kode_matpel = strtoupper($pelajaran->kode_matpel);
            $matpel = strtoupper($pelajaran->matpel);
            $IDguru_pengajar = '';
            $guru_pengajar = '--Pilih--';
            $semester = '';
            $disabled = '';
            $action = 'Admin\NilaiSiswaController@nilaiTugasSatu';
	    	return view('backends.nilai.tugas_satu', [
	    			'no' => $no,
	    			'isi' => $isi,
                    'action' => $action,
	    			'inputs' => $inputs,
	    			'kode' => $kode,
	    			'id_pel' => $id_pel,
                    'kode_matpel' => $kode_matpel,
	    			'pelajaran' => $pelajaran,
                    'matpel' => $matpel,
                    'IDguru_pengajar' => $IDguru_pengajar,
                    'guru_pengajar' => $guru_pengajar,
                    'semester' => $semester,
                    'semua_guru' => $semua_guru,
                    'disabled' => $disabled,
	    		]);
    	}
    }

    public function nilaiTugasSatu(Request $request, $id_kelas)
    {
    	$input = $request->all();
        $validasi = Validator::make($input, [
                'semester' => 'required',
                'guru_id' => 'required',
                'tugas_1' => 'between:1,10'
            ], $pesan = [
                'semester' => 'Silakan pilih semester',
                'guru_id' => 'Silakan pilih guru yang mengajar',
                'tugas_1' => 'Nilai hanya berupa angka'
            ]);
        if($validasi->fails()){
             notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->withErrors($pesan)->withInput();
        }
             notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Nilai tugas berhasil disimpan'
                            ]);
    	$tugas = $request->Input('tugas_1');
    	$id_siswa = $request->Input('id_siswa');
    	$data_store = count($tugas);
    	for($a=0;$a<$data_store;$a++){
    		$table = new NilaiApp;
    		$table->pelajaran_id = $request->input('pelajaran_id');
    		$table->kelas_id = $id_kelas;
            $table->semester = $request->Input('semester');
            $table->guru_id = $request->Input('guru_id');
    		$table->siswa_id = $id_siswa[$a];
    		$table->tugas_1 = $tugas[$a];
    		$table->save();
    	}
            return redirect('kelola');
    }

    public function updateTugasSatu(Request $request)
    {
        $input = $request->all();
        $validasi = Validator::make($input, [
                'tugas_1' => 'between:1,10'
            ], $pesan = [
                'tugas_1' => 'Nilai hanya berupa angka'
            ]);
        if($validasi->fails()){
             notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->withErrors($pesan)->withInput();
        }
             notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Nilai tugas berhasil disimpan'
                            ]);
        $tugas_1 = $request->Input('tugas_1');
        $id_pel = $request->Input('id_siswa');
        
        foreach ($tugas_1 as $tugas_key => $tugas_value) {
            
            $table = array('tugas_1' => $tugas_value );
            NilaiApp::where('id_nilai', $tugas_key)->update($table);
        }
            return Redirect('kelola');
        
    }

    public function tugasDua($id_kelas, $id_pel)
    {
        $cek = NilaiApp::where('kelas_id', $id_kelas)->where('pelajaran_id', $id_pel)->get();
        if(!count($cek)){
             notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Nilai Tugas 1 masih kosong'
                            ]);
            return redirect('kelola');
        }
    	$no = 1;
    	$isi = [
    		'1' => 'input nilai tugas-2',
    		'2' => 'nilai',
    		'3' => 'tugas-2'
    	];
    	$kode = $id_kelas;
    	$input = NilaiApp::where('kelas_id',$id_kelas)->where('pelajaran_id', $id_pel)->firstOrfail();
    	$inputs = NilaiApp::orderBy('siswa_id', 'asc')->where('kelas_id',$id_kelas)->where('pelajaran_id', $id_pel)->get();
    	return view('backends.nilai.tugas_dua', [
    			'no' => $no,
    			'isi' => $isi,
    			'input' => $input,
    			'inputs' => $inputs,
    			'kode' => $kode,
    			'id_pel' => $id_pel
    		]);
    }

    public function nilaiTugasDua(Request $request)
    {
    	$input = $request->all();
        $validasi = Validator::make($input, [
                'tugas_2' => 'between:1,10'
            ], $pesan = [
                'tugas_2' => 'Nilai hanya berupa angka'
            ]);
        if($validasi->fails()){
             notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->withErrors($pesan)->withInput();
        }
             notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Nilai tugas berhasil disimpan'
                            ]);
    	$tugas = $request->Input('id_nilai');
    	$id_pel = $request->Input('id_siswa');
    	
		foreach ($tugas as $tugas_key => $tugas_value) {
			
			$table = array('tugas_2' => $tugas_value );
			NilaiApp::where('id_nilai', $tugas_key)->update($table);
    	}
            return redirect('kelola')->with('success', 'Input Nilai berhasil');
    	
    }

    public function uts($id_kelas, $id_pel)
    {
        $cek = NilaiApp::where('kelas_id', $id_kelas)->where('pelajaran_id', $id_pel)->get();
        if(!count($cek)){
             notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Nilai Tugas 1 & Tugas 2 masih kosong'
                            ]);
            return redirect('kelola');
        }
    	$no = 1;
    	$isi = [
    		'1' => 'input nilai uts',
    		'2' => 'nilai',
    		'3' => 'uts'
    	];
    	$kode = $id_kelas;
    	$input = NilaiApp::where('kelas_id',$id_kelas)->where('pelajaran_id', $id_pel)->firstOrfail();
    	$inputs = NilaiApp::orderBy('siswa_id', 'asc')->where('kelas_id',$id_kelas)->where('pelajaran_id', $id_pel)->get();
    	return view('backends.nilai.uts', [
    			'no' => $no,
    			'isi' => $isi,
    			'input' => $input,
    			'inputs' => $inputs,
    			'kode' => $kode,
    			'id_pel' => $id_pel
    		]);
    }

    public function nilaiUts(Request $request)
    {
    	$input = $request->all();
        $validasi = Validator::make($input, [
                'id_nilai' => 'between:1,10'
            ], $pesan = [
                'id_nilai' => 'Nilai hanya berupa angka'
            ]);
        if($validasi->fails()){
             notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->withErrors($pesan)->withInput();
        }
             notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Nilai UTS berhasil disimpan'
                            ]);
    	$uts = $request->Input('id_nilai');
    	$id_pel = $request->Input('id_siswa');
    	
		foreach ($uts as $uts_key => $uts_value) {
			
			$table = array('uts' => $uts_value );
			NilaiApp::where('id_nilai', $uts_key)->update($table);
    	}
            return redirect('kelola');
    	
    }

    public function uas($id_kelas, $id_pel)
    {
        $cek = NilaiApp::where('kelas_id', $id_kelas)->where('pelajaran_id', $id_pel)->get();
        if(!count($cek)){
             notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Nilai Tugas 2 & UTS masih kosong'
                            ]);
            return redirect('kelola');
        }
    	$no = 1;
    	$isi = [
    		'1' => 'input nilai uas',
    		'2' => 'nilai',
    		'3' => 'uas'
    	];
    	$kode = $id_kelas;
    	$input = NilaiApp::where('kelas_id',$id_kelas)->where('pelajaran_id', $id_pel)->firstOrfail();
    	$inputs = NilaiApp::orderBy('siswa_id', 'asc')->where('kelas_id',$id_kelas)->where('pelajaran_id', $id_pel)->get();
    	return view('backends.nilai.uas', [
    			'no' => $no,
    			'isi' => $isi,
    			'input' => $input,
    			'inputs' => $inputs,
    			'kode' => $kode,
    			'id_pel' => $id_pel
    		]);
    }

    public function nilaiUas(Request $request)
    {
    	$input = $request->all();
        $validasi = Validator::make($input, [
                'id_nilai' => 'between:1,10'
            ], $pesan = [
                'id_nilai' => 'Nilai hanya berupa angka'
            ]);
        if($validasi->fails()){
             notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->withErrors($pesan)->withInput();
        }
             notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Nilai UAS berhasil disimpan'
                            ]);
    	$uas = $request->Input('id_nilai');
    	$id_pel = $request->Input('id_siswa');
    	
		foreach ($uas as $uas_key => $uas_value) {
			
			$table = array('uas' => $uas_value );
			NilaiApp::where('id_nilai', $uas_key)->update($table);
    	}
            return redirect('kelola');
    	
    }

    public function getPdf($pelajaran,$semester,$kelas)
    {
        $kepala_sekolah = User::where('jabatan', 'kepala sekolah')
                                              ->get()
                                              ->first();
        $no = 1;
            $nilai = NilaiApp::where('kelas_id', $kelas)
                            ->where('pelajaran_id', $pelajaran)
                            ->where('semester', $semester)
                            ->firstOrfail();
            $nilai_siswa = NilaiApp::orderBy('siswa_id', 'asc')
                            ->where('kelas_id', $kelas)
                            ->where('pelajaran_id', $pelajaran)
                            ->where('semester', $semester)
                            ->paginate(20);
            $class = KelasApp::find(['kode_kelas' => $kelas])->first();
        $pdf = PDF::loadView('backends.nilai.pdf', compact('kepala_sekolah', 'nilai','nilai_siswa','class','no'));
        return $pdf->stream('data-nilai.pdf');

    }
}
//sementara clear jgn lupa validasi dan redirectnya belum coyy
// detail nilai dan ajax get semester belum