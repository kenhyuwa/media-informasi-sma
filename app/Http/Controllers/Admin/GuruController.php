<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Identitas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use PDF;
use Image;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $no = 1;
        $users = User::all();
    	$isi = [
            '1' =>'data guru',
            '2' =>'master data',
            '3' =>'guru',
            '4' =>'',
            '5' =>''
            ];
    	return view('backends.guru.view', [
                    'isi' => $isi,
                    'no' => $no,
                    'users' => $users
                    ]);
    }

    public function listGuru()
    {
        $no = 1;
        $users = User::all();
        return view('backends.guru.list_guru', [
                    'no' => $no,
                    'users' => $users
                    ]);
    }

    public function approve($id)
    {
        $user = User::find($id);
        $success = $user->assignRole('guru');

        return response()->json(['success' => 'true']);
    }

    public function block($id)
    {
        $user = User::find($id);
        $user->revokeRole('guru');

        return response()->json(['success' => 'true']);
    }

    public function addNew()
    {
        return view('backends.guru.add', [
                    ]);
    }

    public function add(Request $data)
    {
            $validation = Validator::make($data->all(), [
                'nip'          => 'min : - | max : 20 | required',
                'nama'         => 'min : 3 | max : 100 | required',
                'tempat_lahir' => 'min : 3 | max : 100 | required',
                'tgl_lahir'    => 'required | date:yy-mm-dd',
                'alamat'       => 'min : 3 | max : 100 | required',
                'gender'       => 'required',
                'agama'        => 'required',
                'jabatan'      => 'required',
                'status'       => 'required',
                'pdd_akhir'    => 'required',
                // 'username'     => 'min : 6 | max : 15 | unique:guru_app,username',
                // 'password'     => 'min : 6 | max : 15 | alpha_num',
                'image'        => 'mimes:jpg,jpeg,png,gif | max : 500',
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
            $image = $data->file('image');
            if($image ==''){

                            $table = new User;

                                    $table->nip          =$data->Input('nip');
                                    $table->nama_guru    =$data->Input('nama');
                                    $table->tempat_lahir =$data->Input('tempat_lahir');
                                    $table->tgl_lahir    =$data->Input('tgl_lahir');
                                    $table->alamat       =$data->Input('alamat');
                                    $table->no_telp      =$data->Input('telpon');
                                    $table->gender       =$data->Input('gender');
                                    $table->agama     =$data->Input('agama');
                                    $table->jabatan   =$data->Input('jabatan');
                                    $table->status       =$data->Input('status');
                                    $table->pdd_akhir =$data->Input('pdd_akhir');
                                    $table->username     =$data->input('nip');
                                    $table->password     =bcrypt($data->Input('nip'));
                            $table->save();

                            return redirect()->back();
            }
            
                $data->file('image');
                $images = $data->file('image');
                $upload = 'uploads/original';
                $nama = $data->Input('nama');
                $filename = strtolower(str_replace(' ','-',$nama));
                $fullname = $filename.'-'.rand(11111,99999).'.'.$images->getClientOriginalExtension();
                $success = $images->move($upload, $fullname);
                Image::make($success)->resize('110','150')->save('uploads/images/'.$fullname);
                if($success) {

                            $table = new User;

                                    $table->nip          =$data->Input('nip');
                                    $table->nama_guru    =$data->Input('nama');
                                    $table->tempat_lahir =$data->Input('tempat_lahir');
                                    $table->tgl_lahir    =$data->Input('tgl_lahir');
                                    $table->alamat       =$data->Input('alamat');
                                    $table->no_telp      =$data->Input('telpon');
                                    $table->gender       =$data->Input('gender');
                                    $table->agama     =$data->Input('agama');
                                    $table->jabatan   =$data->Input('jabatan');
                                    $table->status       =$data->Input('status');
                                    $table->pdd_akhir =$data->Input('pdd_akhir');
                                    $table->username     =$data->input('nip');
                                    $table->password     =bcrypt($data->Input('nip'));
                                    $table->foto         =$fullname;
                            
                            $table->save();

                        return redirect()->back();
                    }
        }
    }
    public function edit($id)
    {
        $guru = User::findOrfail($id);
        return view('backends.guru.edit', [
                    'guru' => $guru,
                    ]);
    }

    public function update(Request $data, $id)
    {
        $guru = User::find($id);
        $validation = Validator::make($data->all(), [
                'nip'          => 'required | min : - | max : 20',
                'nama'         => 'required | min : 3 | max : 100',
                'tempat_lahir' => 'min : 3 | max : 100 | required',
                'tgl_lahir'    => 'date:yy-mm-dd | required',
                'alamat'       => 'min : 3 | max : 100 | required',
                'gender'       => 'required',
                'agama'        => 'required',
                'jabatan'      => 'required',
                'status'       => 'required',
                'pdd_akhir'    => 'required',
                'username'     => 'min : 6 | max : 15 | unique:guru_app,username',
                'password'     => 'min : 6 | max : 15 | alpha_num',
                'image'        => 'mimes:jpg,jpeg,png,gif | max: 500',
            ]);

        if($validation->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return Redirect()->back()
                            ->witherrors($validation)
                            ->withInput();
        }else{
                    notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Data berhasil diupdate'
                            ]);

            $images = $data->file('image');
            if($images){
                File::delete('uploads/original'.'/'.$guru->foto);
                File::delete('uploads/images'.'/'.$guru->foto);
            
                $upload = 'uploads/original';
                if(count($fullname = $guru->foto)){
                    $fullname = $guru->foto;
                }
                $nama = $data->Input('nama');
                $filename = strtolower(str_replace(' ','-',$nama));
                $fullname = $filename.'-'.rand(11111,99999).'.'.$images->getClientOriginalExtension();
                $success = $images->move($upload, $fullname);
                Image::make($success)->resize('110','150')->save('uploads/images/'.$fullname);
                if($success){
                if($data->Input('username')=='' && $data->Input('password')==''){
                    $table =array(
                                'nip'          => $data->Input('nip'),
                                'nama_guru'    => $data->Input('nama'),
                                'tempat_lahir' => $data->Input('tempat_lahir'),
                                'tgl_lahir'    => $data->Input('tgl_lahir'),
                                'alamat'       => $data->Input('alamat'),
                                'no_telp'      => $data->Input('telpon'),
                                'gender'       => $data->Input('gender'),
                                'agama'     => $data->Input('agama'),
                                'jabatan'   => $data->Input('jabatan'),
                                'status'       => $data->Input('status'),
                                'pdd_akhir' => $data->Input('pdd_akhir'),
                                'foto'         => $fullname
                            );
                }else{
                    $table =array(
                                'nip'          => $data->Input('nip'),
                                'nama_guru'    => $data->Input('nama'),
                                'tempat_lahir' => $data->Input('tempat_lahir'),
                                'tgl_lahir'    => $data->Input('tgl_lahir'),
                                'alamat'       => $data->Input('alamat'),
                                'no_telp'      => $data->Input('telpon'),
                                'gender'       => $data->Input('gender'),
                                'agama'     => $data->Input('agama'),
                                'jabatan'   => $data->Input('jabatan'),
                                'status'       => $data->Input('status'),
                                'pdd_akhir' => $data->Input('pdd_akhir'),
                                'username'     => $data->Input('username'),
                                'password'     => bcrypt($data->Input('password')),
                                'foto'         => $fullname
                            );
                }

                            User::where('id_guru', $id)->update($table);

                        return redirect()->back();
                    }

            }else{
                if($data->Input('username')=='' && $data->Input('password')==''){
                    $table =array(
                            'nip'          => $data->Input('nip'),
                            'nama_guru'    => $data->Input('nama'),
                            'tempat_lahir' => $data->Input('tempat_lahir'),
                            'tgl_lahir'    => $data->Input('tgl_lahir'),
                            'alamat'       => $data->Input('alamat'),
                            'no_telp'      => $data->Input('telpon'),
                            'gender'       => $data->Input('gender'),
                            'agama'     => $data->Input('agama'),
                            'jabatan'   => $data->Input('jabatan'),
                            'status'       => $data->Input('status'),
                            'pdd_akhir' => $data->Input('pdd_akhir'),
                        );
                }else{
                    $table =array(
                            'nip'          => $data->Input('nip'),
                            'nama_guru'    => $data->Input('nama'),
                            'tempat_lahir' => $data->Input('tempat_lahir'),
                            'tgl_lahir'    => $data->Input('tgl_lahir'),
                            'alamat'       => $data->Input('alamat'),
                            'no_telp'      => $data->Input('telpon'),
                            'gender'       => $data->Input('gender'),
                            'agama'     => $data->Input('agama'),
                            'jabatan'   => $data->Input('jabatan'),
                            'status'       => $data->Input('status'),
                            'pdd_akhir' => $data->Input('pdd_akhir'),
                            'username'     => $data->Input('username'),
                            'password'     => bcrypt($data->Input('password')),
                    );
                }
                
                    User::where('id_guru', $id)->update($table);

                return redirect()->back();
                }
            }
    }

    public function delete($id)
    {
        
        $guru =User::find($id);
        if($guru)
        {
            File::delete('uploads/original'.'/'.$guru->foto);
            File::delete('uploads/images'.'/'.$guru->foto);

            $guru->delete();
        
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
                        User::firstOrCreate($sheet->toArray());
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

    public function format(){
        $isi = [
            '1' =>'format excel',
            '2' =>'guru',
            '3' =>'format excel',
            '4' =>'',
            '5' =>''
            ];
        return view('backends.guru.format', [
                'isi' => $isi
            ]);
    }

    public function getExcel(){
        $guru = User::select('nip','nama_guru','tempat_lahir','tgl_lahir','alamat','no_telp','gender','agama','jabatan','status','pdd_akhir')->get();
        $export = Excel::create('data-guru', function($excel) use($guru){
            $excel->sheet('sheet 1', function($sheet) use($guru){
                $sheet->fromArray($guru);
            });
        })->export('xlsx');
        if ($export){
            return view('guru', 'refresh');
        }
    }

    public function getPdf()
    {
        //$identitas = Identitas::all()->first();
        $kepala_sekolah = User::where('jabatan', 'kepala sekolah')
                                              ->get()
                                              ->first();
        $no = 1;
        $gurus = User::orderBy('id_guru','desc')->paginate(50);
        $pdf = PDF::loadView('backends.guru.pdf', compact('kepala_sekolah', 'gurus','no'));
        return $pdf->stream('data-guru.pdf');

    }
}
