<?php

namespace App\Http\Controllers\Admin;
use App\Models\TahunApp;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class TahunController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$isi = [
    		'1' => 'tahun ajaran',
    		'2' => 'master data',
    		'3' => 'tahun'
    	];
    	
    	return view('backends.tahun.view', [
		    		'isi' => $isi
		    		]);
    }

    public function listTahun()
    {
        $no = 1;
        $tahuns = TahunApp::orderBy('id_tahun','desc')->get();
        return view('backends.tahun.data_tahun', [
                    'no' => $no,
                    'tahuns' => $tahuns
                    ]);
    }

    public function addNew(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'tahun' => 'required | min: 9 max: 9'
        ],$pesan = [
            'tahun' => 'min 9 karakter max 9 karakter'
        ]);
        if($validasi->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->withErrors($pesan)->withInput();
        }
        notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Data berhasil disimpan'
                            ]);
        $create = new TahunApp;
        $create->tahun = $request->Input('tahun');
        $create->is_aktiv = '1';
        $create->save();
        return redirect()->back();
    }

    public function show($id_tahun)
    {
            $table = array(
                'is_aktiv' => '1'
            );
        TahunApp::where('id_tahun',$id_tahun)->update($table);
        return response()->json(['success' => 'true']);
    }

    public function hide($id_tahun)
    {
            $table = array(
                'is_aktiv' => '0'
            );
        TahunApp::where('id_tahun',$id_tahun)->update($table);
        return response()->json(['success' => 'true']);
    }
    
    public function edit($id_tahun)
    {
        $tahun = TahunApp::find($id_tahun);
        return view('backends.tahun.edit', [
                'tahun' => $tahun
            ]);
    }

    public function update(Request $request, $id_tahun)
    {
            $input = $request->all();
            $validasi = Validator::make($input, [
                    'tahun_ajaran' => 'required | min: 9 | max: 9'
                ],$pesans =[
                    'tahun_ajaran' => 'min 9 karakter max 9 karakter'
                ]);
            if($validasi->fails()){
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back()->withErrors($pesans)->withInput();
            }
            notify()->flash('Success !!!', 'success', [
                                        'text'  => 'Data berhasil diupdate'
                                ]);
            $data = [
                'tahun' => $request->Input('tahun_ajaran')
            ];
            TahunApp::where('id_tahun', $id_tahun)->update($data);
            return redirect()->back();
    }

    public function destroy($id_tahun)
    {
        $delete = TahunApp::findOrfail($id_tahun)->delete();
        if($delete){
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }
}
