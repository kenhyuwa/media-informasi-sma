<?php

namespace App\Http\Controllers\Admin;
use App\Models\PelajaranApp;
use App\Models\DownloadApp;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Identitas;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use PDF;

//table pelajaran diganti jgn lupa
class PelajaranController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$no = 1;
    	$isi = [
    		'1' => 'mata pelajaran',
    		'2' => 'master data',
    		'3' => 'pelajaran'
    	];
    	$pelajarans = PelajaranApp::all();
        $buat_kode = PelajaranApp::max('kode_matpel');
        $kode = (int) substr($buat_kode, 1, 3);
        $kode++;
        $char = "P";
        $newKode = $char.sprintf("%03s", $kode);
    	return view('backends.mata_pelajaran.view', [
    			'no' => $no,
    			'isi' => $isi,
    			'pelajarans' => $pelajarans,
                'newKode' => $newKode
    		]);
    }

    public function addNew(Request $request)
    {
    	$data = $request->all();
    	$validasi = Validator::make($data, [
    			'pelajaran' => 'required | min: 3',
    			'keterangan' => 'required'
    		],$pesan = [
                'pelajaran' => 'Kolom pelajaran wajib diisi',
                'keterangan' => 'Kolom keterangan wajib diisi'
            ]);
    	if($validasi->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->witherrors($pesan)->withInput();
    	}
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Data berhasil disimpan'
                            ]);
    	$table = new PelajaranApp;
		$table->kode_matpel  = $request->Input('kd_pelajaran');
		$table->matpel    = strtolower($request->Input('pelajaran'));
		$table->keterangan = $request->Input('keterangan');
    	$table->save();
    	return redirect()->back();
    }

    public function edit($id_matpel)
    {
    	$isi = [
    		'1' => 'mata pelajaran',
    		'2' => 'pelajaran',
    		'3' => 'edit'
    	];
    	$pelajaran = PelajaranApp::where('id_matpel', $id_matpel)->get()->first();
    	return view('backends.mata_pelajaran.edit', [
    			'isi' => $isi,
    			'pelajaran' => $pelajaran,
    			'id_matpel' => $id_matpel
    		]);
    }

    public function update(Request $request, $id_matpel)
    {
    	$data = $request->all();
    	$validasi = Validator::make($data, [
    			'pelajaran_update' => 'required | min: 3',
    			'keterangan_update' => 'required'
    		],$pesan = [
                'pelajaran_update' => 'Kolom pelajaran wajib diisi',
                'keterangan_update' => 'Kolom keterangan wajib diisi'
            ]);
    	if($validasi->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->witherrors($pesan)->withInput();
    	}
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Data berhasil diupdate'
                            ]);
    	$table = [
    		'matpel' => strtolower($request->Input('pelajaran_update')),
    		'keterangan' => $request->Input('keterangan_update')
    	];
    	PelajaranApp::where('id_matpel', $id_matpel)->update($table);
    	return redirect()->back();
    }

    public function supdate(Request $request, $id_matpel)
    {
       
        if ($request->ajax())
        {
            $mark = PelajaranApp::FindOrFail($id_matpel);
            $input = $request->all();
            $result = $mark->fill($input)->save();
            
            if ($result){
                return response()->json(['success'=>'true']);
            } 
            else
            {
              return response()->json(['success'=>'false']);  
            }
        }   
 
        
    }

    public function destroy($id_matpel)
    {
    	$destroy = PelajaranApp::find($id_matpel)->delete();
    	if($destroy){
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function formUpload()
    {
        $no = 1;
        $isi = [
            '1' => 'upload',
            '2' => 'akademik',
            '3' => 'materi'
        ];
        $kelas_apps = Kelas::all();
        $matPels = PelajaranApp::all();
        $materis = DownloadApp::where('keterangan','!=','jadwal')->get();
        return view('backends.mata_pelajaran.materi', [
                'no' => $no,
                'isi' => $isi, 
                'kelas_apps' => $kelas_apps,
                'matPels' => $matPels,
                'materis' => $materis
            ]);
    }

    public function upload(Request $request)
    {
        $upload = $request->all();
        $validasi = Validator::make($upload, [
                'kelas_id' => 'required',
                'mat_pel' => 'required',
                'keterangan' => 'required',
                'file' => 'mimes:doc,docx,pdf,txt | max: 100 | required'
            ],$pesan = [
                'kelas_id' => 'Nama kelas tidak boleh kosong',
                'mat_pel' => 'Mata pelajaran tidak boleh kosong',
                'keterangan' => 'Keterangan tidak boleh kosong',
                'file' => 'Type file hanya docx dan pdf'
            ]);
        if($validasi->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->witherrors($pesan)->withInput();
        }
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Data berhasil disimpan'
                            ]);
        $files = $request->file('file');
        if($files){
            $direktori = 'uploads-smasimo/files';
            $keterangan = $request->Input('keterangan');
            $name_files = $request->Input('mat_pel');
            $name = strtolower(str_replace(' ', '-', $keterangan));
            $names = strtolower(str_replace(' ', '-', $name_files));
            $file_upload = $name.'-'.$names.'-'.rand(11111,99999).'.'.$files->getClientOriginalExtension();
            $uploaded = $files->move($direktori, $file_upload);
            if($uploaded){
                $success = new DownloadApp;
                $success->kelas_id = $request->Input('kelas_id');
                $success->mata_pelajaran = $request->Input('mat_pel');
                $success->keterangan = $request->Input('keterangan');
                $success->author = auth()->user()->id_guru;
                $success->nama_file = $file_upload;
                $success->save();
                return redirect()->back();
            }
        }
    }

    public function destDownload($id_download)
    {
        $download = DownloadApp::find($id_download);
        if($download)
        {
            File::delete('uploads-smasimo/files'.'/'.$download->nama_file);

            $download->delete();
        
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function getPdf()
    {
        $no = 1;
        $kepala_sekolah = User::where('jabatan', 'kepala sekolah')
                                              ->get()
                                              ->first();
        //$siswas = SiswaApp::all();
        $pelajarans = PelajaranApp::orderBy('id_matpel','asc')->get();
        //$min = PelajaranApp::min('kode_matpel');
        $pdf = PDF::loadView('backends.mata_pelajaran.pdf', compact( 'kepala_sekolah', 'pelajarans','no'));
        return $pdf->stream('data-mata-pelajaran.pdf');

    }

    public function jadwal()
    {
        $no = 1;
        $isi = [
            '1' => 'upload',
            '2' => 'akademik',
            '3' => 'jadwal'
        ];
        $kelas_apps = Kelas::all();
        $jadwals = DownloadApp::where('keterangan', 'jadwal')->get();
        return view('backends.mata_pelajaran.jadwal', [
                'no' => $no,
                'isi' => $isi, 
                'kelas_apps' => $kelas_apps,
                'jadwals' => $jadwals
            ]);
    }

    public function uploadJadwal(Request $request)
    {
        $upload = $request->all();
        $validasi = Validator::make($upload, [
                'kelas_id' => 'required',
                'file' => 'mimes:doc,docx,pdf,txt | max: 100 | required'
            ]);
        if($validasi->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->witherrors($validasi)->withInput();
        }
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Data berhasil disimpan'
                            ]);
        $files = $request->file('file');
        if($files){
            $direktori = 'uploads-smasimo/files';
            $keterangan = $request->Input('keterangan');
            $name = strtolower(str_replace(' ', '-', $keterangan));
            $file_upload = $name.'-'.rand(11111,99999).'.'.$files->getClientOriginalExtension();
            $uploaded = $files->move($direktori, $file_upload);
            if($uploaded){
                $success = new DownloadApp;
                $success->mata_pelajaran = strtolower($keterangan);
                $success->keterangan = 'jadwal';
                $success->nama_file = $file_upload;
                $success->kelas_id = $request->Input('kelas_id');
                $success->author = auth()->user()->id_guru;
                $success->save();
                return redirect()->back();
            }
        }
    }

    public function destJadwal($id_download)
    {
        $download = DownloadApp::find($id_download);
        if($download)
        {
            File::delete('uploads-smasimo/files'.'/'.$download->nama_file);

            $download->delete();
        
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }
}
