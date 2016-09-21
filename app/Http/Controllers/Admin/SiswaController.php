<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\SiswaApp;
use App\Models\TahunApp;
use App\Models\KelasSiswaApp;
use App\Models\Identitas;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use PDF;
use Image;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $no = 1;
        $siswas = SiswaApp::orderBy('nis', 'desc')->get();
        $get_kelas = KelasSiswaApp::all();
           
    	$isi = [
            '1' =>'data siswa',
            '2' =>'master data',
            '3' =>'siswa',
            '4' =>'',
            '5' =>''
            ];
    	return view('backends.siswa.view', [
                    'isi' => $isi,
                    'no' => $no,
                    'siswas' => $siswas,
                    'get_kelas' => $get_kelas
                    ]);
    }

    public function add()
    {
	        $tahuns = TahunApp::all();
	        $isi = [
	            '1' =>'tambah data siswa',
	            '2' =>'siswa',
	            '3' =>'tambah data',
	            '4' =>'',
	            '5' =>''
	            ];
	        return view('backends.siswa.add', [
	                    'isi' => $isi,
	                    'tahuns' => $tahuns
	                    ]);
    }

    public function addNew(Request $data)
    {
            $validation = Validator::make($data->all(), [
				'nis'          => 'min : 3 | max : 15 | required',
				'nama'         => 'min : 3 | max : 100 | required',
				'tempat_lahir' => 'min : 3 | max : 100 | required',
				'tgl_lahir'    => 'required',
				'alamat'       => 'min : 3 | max : 100 | required',
				'gender'       => 'required',
				'agama'        => 'required',
				'tahun_masuk'  => 'required',
				'asal_sekolah' => 'min : 3 | max : 100 | required',
				'nama_wali'    => 'min : 3 | max : 100 | required',
				'alamat_wali'  => 'min : 3 | max : 100 | required',
				//'status'       => 'required',
				//'username'     => 'min : 6 | max : 15 | unique:siswa_app,username',
				//'password'     => 'min : 6 | max : 15 | alpha_num',
				'foto'        => 'mimes:jpg,jpeg,png,gif | max : 500',
                ]);

        if($validation->fails())
        {
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()
                            ->witherrors($validation)
                            ->withInput();
        }else{
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Data berhasil disimpan'
                            ]);
            $image = $data->file('foto');
            if($image ==''){

                $table = new SiswaApp;

                    $table->nis              =$data->Input('nis');          
                    $table->nama             =$data->Input('nama');         
                    $table->tempat_lahir     =$data->Input('tempat_lahir'); 
                    $table->tgl_lahir        =$data->Input('tgl_lahir');    
                    $table->alamat           =$data->Input('alamat');       
                    $table->no_telp          =$data->Input('telpon');
                    $table->gender           =$data->Input('gender');       
                    $table->agama         =$data->Input('agama');      
                    $table->sekolah_asal     =$data->Input('asal_sekolah');  
                    $table->tahun_masuk      =$data->Input('tahun_masuk');  
                    $table->tahun_lulus      =$data->Input('tahun_lulus');  
                    $table->status           =$data->Input('status');
                    $table->anak_ke          =$data->Input('anak_ke');
                    $table->jumlah_sdr       =$data->Input('jml_sdr');
                    $table->nama_ayah        =$data->Input('nama_ayah');
                    $table->pdd_akhir_ayah   =$data->Input('pdd_ayah');
                    $table->pekerjaan_ayah   =$data->Input('pekerjaan_ayah');
                    $table->agama_ayah       =$data->Input('agama_ayah');
                    $table->nama_ibu         =$data->Input('nama_ibu');
                    $table->pdd_akhir_ibu    =$data->Input('pdd_ibu');
                    $table->pekerjaan_ibu    =$data->Input('pekerjaan_ibu'); 
                    $table->agama_ibu        =$data->Input('agama_ibu');
                    $table->nama_ortu_wali   =$data->Input('nama_wali');    
                    $table->alamat_ortu_wali =$data->Input('alamat_wali');         
                    $table->username         =$data->Input('nis');
                    $table->password         =bcrypt($data->Input('nis'));
                    //$table->foto             ='default.gif';
                    //$table->foto           =$filename;
                            
                $table->save();

                return redirect()->back();
            }
                $images = $data->file('foto');
                        $upload = 'uploads-smasimo/original';
                        $nama = $data->Input('nama');
                        $filename = strtolower(str_replace(' ','-',$nama));
                        $fullname = $filename.'-'.rand(11111,99999).'.'.$images->getClientOriginalExtension();
                        $success = $images->move($upload, $fullname);
                        Image::make($success)->resize('110','150')->save('uploads-smasimo/images/'.$fullname);
                        if($success) {

                            $table = new SiswaApp;

								$table->nis              =$data->Input('nis');          
								$table->nama             =$data->Input('nama');         
								$table->tempat_lahir     =$data->Input('tempat_lahir'); 
								$table->tgl_lahir        =$data->Input('tgl_lahir');    
								$table->alamat           =$data->Input('alamat');       
								$table->no_telp          =$data->Input('telpon');
								$table->gender           =$data->Input('gender');       
								$table->agama         =$data->Input('agama');      
								$table->sekolah_asal     =$data->Input('asal_sekolah');  
								$table->tahun_masuk      =$data->Input('tahun_masuk');
								$table->status           =$data->Input('status'); 
                                $table->tahun_lulus      =$data->Input('tahun_lulus');  
								$table->anak_ke          =$data->Input('anak_ke');
								$table->jumlah_sdr       =$data->Input('jml_sdr');
								$table->nama_ayah        =$data->Input('nama_ayah');
								$table->pdd_akhir_ayah   =$data->Input('pdd_ayah');
								$table->pekerjaan_ayah   =$data->Input('pekerjaan_ayah');
								$table->agama_ayah       =$data->Input('agama_ayah');
								$table->nama_ibu         =$data->Input('nama_ibu');
								$table->pdd_akhir_ibu    =$data->Input('pdd_ibu');
								$table->pekerjaan_ibu    =$data->Input('pekerjaan_ibu'); 
								$table->agama_ibu        =$data->Input('agama_ibu');
								$table->nama_ortu_wali   =$data->Input('nama_wali');    
								$table->alamat_ortu_wali =$data->Input('alamat_wali');         
								$table->username         =$data->Input('nis');
								$table->password         =bcrypt($data->Input('nis'));
								$table->foto             =$fullname;
                            
                            $table->save();

                            return redirect()->back();
            }
        }
    }

    public function edit($id)
    {
        
        $siswa = SiswaApp::findOrfail($id);
        $tahuns = TahunApp::all();

        $isi = [
            '1' =>'edit data siswa',
            '2' =>'siswa',
            '3' =>'edit data',
            '4' =>'',
            '5' =>''
            ];
        return view('backends.siswa.edit', [
                    'isi' => $isi,
                    'siswa' => $siswa,
                    'tahuns' => $tahuns
                    ]);
    }
// update fotonya blm selesai
    public function update(Request $data, $id)
    {
        $siswa = SiswaApp::find($id);
        $validation = Validator::make($data->all(), [
                'nis'          => 'min : 3 | max : 15 | required',
                'nama'         => 'min : 3 | max : 100 | required',
                'tempat_lahir' => 'min : 3 | max : 100 | required',
                'tgl_lahir'    => 'required',
                'alamat'       => 'min : 3 | max : 100 | required',
                'gender'       => 'required',
                'agama'        => 'required',
                'tahun_masuk'  => 'required',
                'asal_sekolah' => 'min : 3 | max : 100 | required',
                'nama_wali'    => 'min : 3 | max : 100 | required',
                'alamat_wali'  => 'min : 3 | max : 100 | required',
                'status'       => 'required',
                'username'     => 'min : 6 | max : 15 ',
                'password'     => 'min : 6 | max : 15 | alpha_num',
                'image'         => 'mimes:jpg,jpeg,png,gif | max : 500',
            ]);

        if($validation->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return Redirect()->back()
                            ->witherrors($validation)
                            ->withInput();
        }
        else
        {
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Data berhasil diupdate'
                            ]);

            $images = $data->file('image');
            if($images){
                File::delete('uploads-smasimo/original'.'/'.$siswa->foto);
                File::delete('uploads-smasimo/images'.'/'.$siswa->foto);
            
                $upload = 'uploads-smasimo/original';
                if(count($fullname = $siswa->foto)){
                        $fullname = $siswa->foto;
                }
                $nama = $data->Input('nama');
                $filename = strtolower(str_replace(' ','-',$nama));
                $fullname = $filename.'-'.rand(11111,99999).'.'.$images->getClientOriginalExtension();
                $success = $images->move($upload, $fullname);
                Image::make($success)->resize('110','150')->save('uploads-smasimo/images/'.$fullname);
                if($success){
                        if($data->Input('username')=='' && $data->Input('password')=='') {
                            $table =array(
                                        'nis'              => $data->Input('nis'),          
                                        'nama'             => $data->Input('nama'),         
                                        'tempat_lahir'     => $data->Input('tempat_lahir'), 
                                        'tgl_lahir'        => $data->Input('tgl_lahir'),    
                                        'alamat'           => $data->Input('alamat'),       
                                        'no_telp'          => $data->Input('telpon'),
                                        'gender'           => $data->Input('gender'),       
                                        'agama'         => $data->Input('agama'),      
                                        'sekolah_asal'     => $data->Input('asal_sekolah'),  
                                        'tahun_masuk'      => $data->Input('tahun_masuk'),  
                                        'tahun_lulus'      => $data->Input('tahun_lulus'),
                                        'status'           => $data->Input('status'),        
                                        'anak_ke'          => $data->Input('anak_ke'),
                                        'jumlah_sdr'       => $data->Input('jml_sdr'),
                                        'nama_ayah'        => $data->Input('nama_ayah'),
                                        'pdd_akhir_ayah'   => $data->Input('pdd_ayah'),
                                        'pekerjaan_ayah'   => $data->Input('pekerjaan_ayah'),
                                        'agama_ayah'       => $data->Input('agama_ayah'),
                                        'nama_ibu'         => $data->Input('nama_ibu'),
                                        'pdd_akhir_ibu'    => $data->Input('pdd_ibu'),
                                        'pekerjaan_ibu'    => $data->Input('pekerjaan_ibu'), 
                                        'agama_ibu'        => $data->Input('agama_ibu'),
                                        'nama_ortu_wali'   => $data->Input('nama_wali'),    
                                        'alamat_ortu_wali' => $data->Input('alamat_wali'),      
                                        'foto'             => $fullname
                            );
                    }else{
                            $table =array(
                                        'nis'              => $data->Input('nis'),          
                                        'nama'             => $data->Input('nama'),         
                                        'tempat_lahir'     => $data->Input('tempat_lahir'), 
                                        'tgl_lahir'        => $data->Input('tgl_lahir'),    
                                        'alamat'           => $data->Input('alamat'),       
                                        'no_telp'          => $data->Input('telpon'),
                                        'gender'           => $data->Input('gender'),       
                                        'agama'         => $data->Input('agama'),      
                                        'sekolah_asal'     => $data->Input('asal_sekolah'),  
                                        'tahun_masuk'      => $data->Input('tahun_masuk'),
                                        'tahun_lulus'      => $data->Input('tahun_lulus'),
                                        'status'           => $data->Input('status'),        
                                        'anak_ke'          => $data->Input('anak_ke'),
                                        'jumlah_sdr'       => $data->Input('jml_sdr'),
                                        'nama_ayah'        => $data->Input('nama_ayah'),
                                        'pdd_akhir_ayah'   => $data->Input('pdd_ayah'),
                                        'pekerjaan_ayah'   => $data->Input('pekerjaan_ayah'),
                                        'agama_ayah'       => $data->Input('agama_ayah'),
                                        'nama_ibu'         => $data->Input('nama_ibu'),
                                        'pdd_akhir_ibu'    => $data->Input('pdd_ibu'),
                                        'pekerjaan_ibu'    => $data->Input('pekerjaan_ibu'), 
                                        'agama_ibu'        => $data->Input('agama_ibu'),
                                        'nama_ortu_wali'   => $data->Input('nama_wali'),    
                                        'alamat_ortu_wali' => $data->Input('alamat_wali'),         
                                        'username'         => $data->Input('username'),
                                        'password'         => bcrypt($data->Input('password')),
                                        'foto'             => $fullname
                            );
                    }
                            SiswaApp::where('id_siswa', $id)->update($table);

                        return redirect()->back();
                }

            }else{
                
                if($data->Input('username')=='' && $data->Input('password')==''){

                            $table =array(
                                    'nis'              => $data->Input('nis'),          
                                    'nama'             => $data->Input('nama'),         
                                    'tempat_lahir'     => $data->Input('tempat_lahir'), 
                                    'tgl_lahir'        => $data->Input('tgl_lahir'),    
                                    'alamat'           => $data->Input('alamat'),       
                                    'no_telp'          => $data->Input('telpon'),
                                    'gender'           => $data->Input('gender'),       
                                    'agama'         => $data->Input('agama'),      
                                    'sekolah_asal'     => $data->Input('asal_sekolah'),  
                                    'tahun_masuk'      => $data->Input('tahun_masuk'),
                                    'tahun_lulus'      => $data->Input('tahun_lulus'),
                                    'status'           => $data->Input('status'),        
                                    'anak_ke'          => $data->Input('anak_ke'),
                                    'jumlah_sdr'       => $data->Input('jml_sdr'),
                                    'nama_ayah'        => $data->Input('nama_ayah'),
                                    'pdd_akhir_ayah'   => $data->Input('pdd_ayah'),
                                    'pekerjaan_ayah'   => $data->Input('pekerjaan_ayah'),
                                    'agama_ayah'       => $data->Input('agama_ayah'),
                                    'nama_ibu'         => $data->Input('nama_ibu'),
                                    'pdd_akhir_ibu'    => $data->Input('pdd_ibu'),
                                    'pekerjaan_ibu'    => $data->Input('pekerjaan_ibu'), 
                                    'agama_ibu'        => $data->Input('agama_ibu'),
                                    'nama_ortu_wali'   => $data->Input('nama_wali'),    
                                    'alamat_ortu_wali' => $data->Input('alamat_wali'),    
                            );
                        }else{

                            $table =array(
                                'nis'              => $data->Input('nis'),          
                                'nama'             => $data->Input('nama'),         
                                'tempat_lahir'     => $data->Input('tempat_lahir'), 
                                'tgl_lahir'        => $data->Input('tgl_lahir'),    
                                'alamat'           => $data->Input('alamat'),       
                                'no_telp'          => $data->Input('telpon'),
                                'gender'           => $data->Input('gender'),       
                                'agama'         => $data->Input('agama'),      
                                'sekolah_asal'     => $data->Input('asal_sekolah'),  
                                'tahun_masuk'      => $data->Input('tahun_masuk'),
                                'tahun_lulus'      => $data->Input('tahun_lulus'),
                                'status'           => $data->Input('status'),        
                                'anak_ke'          => $data->Input('anak_ke'),
                                'jumlah_sdr'       => $data->Input('jml_sdr'),
                                'nama_ayah'        => $data->Input('nama_ayah'),
                                'pdd_akhir_ayah'   => $data->Input('pdd_ayah'),
                                'pekerjaan_ayah'   => $data->Input('pekerjaan_ayah'),
                                'agama_ayah'       => $data->Input('agama_ayah'),
                                'nama_ibu'         => $data->Input('nama_ibu'),
                                'pdd_akhir_ibu'    => $data->Input('pdd_ibu'),
                                'pekerjaan_ibu'    => $data->Input('pekerjaan_ibu'), 
                                'agama_ibu'        => $data->Input('agama_ibu'),
                                'nama_ortu_wali'   => $data->Input('nama_wali'),    
                                'alamat_ortu_wali' => $data->Input('alamat_wali'),         
                                'username'         => $data->Input('username'),
                                'password'         => bcrypt($data->Input('password')),
                            );
                        }

                    SiswaApp::where('id_siswa', $id)->update($table);

                return redirect()->back();
                }
            }
    }

    public function destroy($id)
    {
        
        $siswa =SiswaApp::find($id);
        if($siswa)
        {
            File::delete('uploads-smasimo/original'.'/'.$siswa->foto);
            File::delete('uploads-smasimo/images'.'/'.$siswa->foto);

            $siswa->delete();

            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }


    public function addNewExcel(Request $excel) {
        $validation = Validator::make($excel->all(),[
                'file' => 'required | mimes:xlsx,csv',
            ]);
         if($validation->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return Redirect()->back()
                            ->witherrors($validation)
                            ->withInput();
        }else{
            $excel = Excel::load(Input::file('file'), function($reader){
                $reader->each(function($sheet){
                    //foreach ($sheet->toArray() as $row){
                        SiswaApp::firstOrCreate($sheet->toArray());
                    //}
                });
            });
            if($excel){
                notify()->flash('Success', 'success', [
                                'text'  => 'Import data berhasil'
                        ]);
                return redirect()->back();
            }
                notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Opps... kesalahan saat import data'
                            ]);
                return redirect()->back();
        }
    }

    public function formatExcel(){
        $isi = [
            '1' =>'format excel',
            '2' =>'siswa',
            '3' =>'format excel',
            '4' =>'',
            '5' =>''
            ];
        return view('backends.siswa.format', [
                'isi' => $isi
            ]);
    }

    public function getExcel(){
        $siswa = SiswaApp::select(
                'nis', 'nama', 'tempat_lahir', 'tgl_lahir', 'alamat', 'no_telp', 'gender', 'agama', 'sekolah_asal', 'tahun_masuk', 'status', 'anak_ke', 'jumlah_sdr', 'nama_ayah', 'pdd_akhir_ayah', 'pekerjaan_ayah', 'agama_ayah', 'nama_ibu', 'pdd_akhir_ibu', 'pekerjaan_ibu', 'agama_ibu', 'nama_ortu_wali', 'alamat_ortu_wali'
            )->get();
        $export = Excel::create('data-siswa', function($excel) use($siswa){
            $excel->sheet('sheet 1', function($sheet) use($siswa){
                $sheet->fromArray($siswa);
            });
        })->export('xlsx');
        if ($export){
            return view('siswa', 'refresh');
        }
    }

    public function getPdf()
    {
        $no = 1;
        $identitas = Identitas::all()->first();
        $kepala_sekolah = User::where('jabatan', 'kepala sekolah')
                                              ->get()
                                              ->first();
        //$siswas = SiswaApp::all();
        $siswas = SiswaApp::orderBy('nis','desc')->where('status', 'siswa')->get();
        $pdf = PDF::loadView('backends.siswa.pdf', compact('identitas', 'kepala_sekolah', 'siswas','no'));
        return $pdf->stream('data-siswa.pdf');

    }

    public function getAlumni()
    {
        $no = 1;
        $alumnis = SiswaApp::orderBy('nis', 'desc')->where('status', 'alumni')->get();
        $get_kelas = KelasSiswaApp::all();
           
        $isi = [
            '1' =>'data alumni',
            '2' =>'master data',
            '3' =>'alumni',
            '4' =>'',
            '5' =>''
            ];
        return view('backends.siswa.alumni', [
                    'isi' => $isi,
                    'no' => $no,
                    'alumnis' => $alumnis,
                    'get_kelas' => $get_kelas
                    ]);
    }

    public function getPdfAlumni()
    {
        $no = 1;
        $identitas = Identitas::all()->first();
        $kepala_sekolah = User::where('jabatan', 'kepala sekolah')
                                              ->get()
                                              ->first();
        //$siswas = SiswaApp::all();
        $alumnis = SiswaApp::orderBy('nis','desc')->where('status', 'alumni')->get();
        $pdf = PDF::loadView('backends.siswa.alumni_pdf', compact('identitas', 'kepala_sekolah', 'alumnis','no'));
        return $pdf->stream('data-alumni.pdf');

    }
}
