<?php

namespace App\Http\Controllers\Admin;
use App\Models\KelasApp;
use App\Models\User;
use App\Models\Kelas;
use App\Models\TahunApp;
use App\Models\SiswaApp;
use App\Models\KelasSiswaApp;
use App\Models\Identitas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class KelasController extends Controller
{
    public function __construct()
    {
    	return $this->middleware('auth');
    }

    public function index()
    {
        $no = 1;
        $kelas_siswa = KelasApp::orderBy('tahun_ajaran_id', 'desc')->get();
        $gurus = User::orderBy('nama_guru', 'asc')->get();
        $kelas = Kelas::all();
        $tahuns = TahunApp::where('is_aktiv', 1)->orderBy('id_tahun', 'desc')->get();
    	$isi = [
            '1' =>'management kelas',
            '2' =>'management kelas',
            '3' =>'kelas'
            ];
            return view('backends.kelas.view',[
                    'isi' => $isi,
                    'no' => $no,
                    'kelas_siswa' => $kelas_siswa,
                    'gurus' => $gurus,
                    'kelas' => $kelas,
                    'tahuns' => $tahuns
                ]);
    }

    public function addKelas()
    {
        $isi = [
            '1' => 'master kelas',
            '2' => 'master data',
            '3' => 'master kelas'
        ];
        $no = 1;
        $kelass = Kelas::all();
        $buat_kode = Kelas::max('kode_kelas');
        $kode = (int) substr($buat_kode, 1, 3);
        $kode++;
        $char = "K";
        $newKode = $char.sprintf("%03s", $kode);
        return view('backends.kelas.master', [
                'isi' => $isi,
                'no' => $no,
                'kelass' => $kelass,
                'newKode' => $newKode
            ]);
    }

    public function addNewKelas(Request $request)
    {
        $input = $request->all();
        $validasi = Validator::make($input, [
                'kelas_tambah' => 'required'
            ],$pesan = [
                'kelas_tambah' => 'Kolom kelas tidak boleh kosong.'
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
        $table = new Kelas;
        $table->kode_kelas = strtolower($request->Input('kode_kelas'));
        $table->kelas = strtoupper($request->Input('kelas_tambah'));
        $table->save();
        return redirect()->back();
    }

    public function editKelas(Request $response)
    {
        $edit_kelas = $response->get('id_kelas');
        $kelas = Kelas::find($edit_kelas);
        return Response::json($kelas);
    }

    public function updateKelas(Request $data, $id_kelas)
    {
        $update = $data->all();
        $validasi = Validator::make($update, [
                'kelas' => 'required'
            ],$pesan = [
                'kelas' => 'Kolom kelas tidak boleh kosong.'
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
            'kode_kelas' => strtolower($data->Input('kode_kelas')),
            'kelas' => $data->Input('kelas')
        ];
            Kelas::where('id_kelas', $id_kelas)->update($table);
            return redirect()->back();
    }

    public function destroyKelas($id_kelas)
    {
        $delete = Kelas::find($id_kelas)->delete();
        if($delete){
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function buatKelas(Request $data)
    {
        $validation = Validator::make($data->all(), [
            'kelas' => 'required',
            'wali_kelas' => 'required',
            'tahun_ajaran' => 'required'
            ],$pesan = [
                'kelas' => 'Kolom Kelas tidak bleh kosong.',
                'wali_kelas' => 'Kolom Wali kelas tidak boleh kosong.',
                'tahun_ajaran' => 'Kolom Tahun ajaran tidak boleh kosong.'
            ]);

        if($validation->fails())
        {
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()
                            ->witherrors($pesan)
                            ->withInput();
        }
        else
        {
                notify()->flash('success !!!', 'success', [
                                'text'  => 'Kelas berhasil dibuat'
                        ]);

            $table = new KelasApp;

            $table->kode_kelas = $data->Input('kelas');
            $table->guru_id = $data->Input('wali_kelas');
            $table->tahun_ajaran_id = $data->Input('tahun_ajaran');

            $table->save();

        return redirect()->back();
        }
    }

    public function edit($id)
    {
        $kelas_siswa = KelasApp::findOrfail($id);
        $gurus = User::all();
        $kelas = Kelas::all();
        $tahuns = TahunApp::where('is_aktiv', 1)->get();
            return view('backends.kelas.edit',[
                    'kelas_siswa' => $kelas_siswa,
                    'gurus' => $gurus,
                    'kelas' => $kelas,
                    'tahuns' => $tahuns
                ]);
        return redirect()->back();
    }

    public function update(Request $data, $id)
    {

                notify()->flash('success !!!', 'success', [
                                'text'  => 'Update kelas berhasil'
                        ]);
                $table = array(
                    'guru_id'         => $data->Input('wali_kelas'),
                    'tahun_ajaran_id' => $data->Input('tahun_ajaran'),
                    'status' => $data->Input('aktiv')
                    );
            
            KelasApp::where('id', $id)->update($table);

        return redirect()->back();
        
    }

    public function delKelas($id_kelas)
    {
        $delete = KelasApp::find($id_kelas)->delete();
        if($delete){
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function lihatKelas($id_kelas)
    {
        $no = 1;
        $tahuns = TahunApp::where('is_aktiv', 1)->get();
        $id = $id_kelas;
         $wali = KelasApp::find(['kode_kelas' => $id_kelas])->first();
         $siswas = SiswaApp::orderBy('nis', 'asc')->where('status', 'siswa')->get();
         $lihat_kelas=KelasSiswaApp::orderBy('siswa_id', 'asc')->where('kode_kelas',$id_kelas)->get();
         $id_pdf = KelasApp::find(['kode_kelas' => $id_kelas])->first();
                                
        $isi = [
            '1' =>'management kelas',
            '2' =>'kelas',
            '3' =>'kelas siswa'
            ];
            return view('backends.kelas.lihat_kelas',[
                    'isi' => $isi,
                    'no' => $no,
                    'wali' => $wali,
                     'siswas' => $siswas,
                    'tahuns' => $tahuns,
                    'lihat_kelas' => $lihat_kelas,
                    'id_pdf' => $id_pdf,
                    'id' => $id
                ]);
    }

    public function getTahun(Request $response)
    {
        $tahun_id = $response->Input('tahun_masuk');
        $siswa = SiswaApp::orderBy('nis', 'asc')->where('tahun_masuk', $tahun_id)->where('status', 'siswa')->get();
        return Response::json($siswa);
    }

    public function getSiswa(Request $response)
    {
        $siswa_id = $response->Input('id_siswa');
        $siswa = SiswaApp::where('id_siswa','=', $siswa_id)->get();
        return Response::json($siswa);
    }

    public function addNewSiswa(Request $data)
    {
        $validasi = Validator::make($data->all(), [
                'nis' => 'required',
                'siswa_perkelas' => 'required'
            ],$pesan = [
                'nis' => 'Kolom NIS tidak boleh kosong.',
                'siswa_perkelas' => 'Kolom Nama siswa tidak boleh kosong.'
            ]);
        if($validasi->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return Redirect()->back()
                            ->witherrors($pesan)
                            ->withInput();
        }
        notify()->flash('success !!!', 'success', [
                                'text'  => 'Siswa berhasil dimasukan dikelas ini'
                        ]);

            
            $a = $data->input('id_kelas');
            $b = $data->Input('nis');
            $cek = KelasSiswaApp::where('kode_kelas',$a )->where('siswa_id', $b)->get();
            if(count($cek)){
                notify()->flash('Maaf !!!', 'error', [
                                'text'  => 'Siswa tersebut sudah ada dikelas ini'
                        ]);
                return Redirect()->back();
            }else{
                $table = new KelasSiswaApp;

                    $table->kode_kelas = $data->Input('id_kelas');
                    $table->siswa_id = $data->Input('nis');
                    $table->save();

                return Redirect()->back();
            }

    }

    public function drop($kode_kelas)
    {

        $drop = KelasSiswaApp::where('kode_kelas',$kode_kelas)->delete();
        if($drop){
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function destroy($id_kelas, $id_siswa)
    {

        $delete = KelasSiswaApp::where('siswa_id',$id_siswa)->where('kode_kelas', $id_kelas)->delete();
        if($delete){
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function getExcel($id_kelas){
        $cek = KelasSiswaApp::where('kode_kelas',$id_kelas )->get();
            if(!count($cek)){
                notify()->flash('Maaf !!!', 'error', [
                                'text'  => 'Kelas ini masih kosong'
                        ]);
                return Redirect()->back();
            }
                $kelas_app = KelasSiswaApp::findOrfail($id_kelas);
                $kelas = SiswaApp::select(
                                    'nis', 'nama', 'gender'
                                )->where(['id_siswa' => $kelas_app->siswa_id])
                                ->where('status','siswa')
                                  ->get();
                $ambil_nama_kelas = KelasApp::where('id', $id_kelas)->first();
                $nama = $ambil_nama_kelas->getKelas->kelas;
                $export = Excel::create('data-siswa-kelas-'.$nama, function($excel) use($kelas){
                    $excel->sheet('sheet 1', function($sheet) use($kelas){
                        $sheet->fromArray($kelas);
                    });
                })->export('xlsx');
                if ($export){
                    return view('kelas', 'refresh');
                }
    }

    public function getPdf($id)
    {
        $kepala_sekolah = User::where('jabatan', 'kepala sekolah')
                                              ->get()
                                              ->first();
        $kelas_app = KelasApp::findOrfail($id);
        $data_kelas = KelasApp::find(['kode_kelas' => $kelas_app->id])->first();
        $ambil_nama_kelas = KelasApp::where('id', $id)->first();
        $nama = $ambil_nama_kelas->getKelas->kelas;
        $kelass=KelasSiswaApp::orderBy('siswa_id','asc')->where(['kode_kelas' => $kelas_app->id])->get();
        $pdf = PDF::loadView('backends.kelas.pdf', compact('kelas_app', 'kelass', 'data_kelas','identitas','kepala_sekolah'));
        return $pdf->stream('data-siswa-kelas-'.$nama.'.pdf');
    }

    public function setAlumni(Request $request)
    {
        $input = $request->all();
        $alumni = $request->Input('alumni');
        $tahun = $request->Input('tahun');
        
        foreach ($alumni as $alumni_key => $alumni_value) {
            
            $table = array(
                    'tahun_lulus' => $tahun,
                    'status' => $alumni_value
                );
            SiswaApp::where('id_siswa', $alumni_key)->update($table);
        }
        notify()->flash('success !!!', 'success', [
                                'text'  => 'Tambah alumni berhasil'
                        ]);
            return Redirect('alumni');
    }
}
