<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\DataStatisApp;
use App\Models\MenuFrontApp;
use App\Models\Identitas;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use File;
use Image;

class DataStatisController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$isi = [
    		'1' => 'data statis',
    		'2' => 'data statis',
    		'3' => 'profile sekolah'
    	];
    	$no = 1;
        $tanggal = Carbon::now('Asia/Jakarta');
    	$data_statiss = DataStatisApp::orderBy('id_data', 'asc')->get();
    	return view('backends.data_statis.view', [
    			'isi' => $isi,
    			'no' => $no,
    			'data_statiss' => $data_statiss,
                'tanggal' => $tanggal,
    		]);
    }

    public function editData($id_data)
    {
    	$isi = [
    		'1' => 'data statis',
    		'2' => 'profile sekolah',
    		'3' => 'edit'
    	];
    	$edit_data = DataStatisApp::find($id_data);
        $menu_front = MenuFrontApp::orderBy('id_menu', 'asc')->where('parent_id','!=',0)->get();
    	return view('backends.data_statis.edit', [
    			'isi' => $isi,
    			'edit_data' => $edit_data,
                'menu_front' => $menu_front
    		]);
    }

    public function updateData(Request $update, $id_data)
    {
    	$input = $update->all();
    	$validasi = Validator::make($input, [
    			'content' => 'required'
    		]);
    	if($validasi->passes()){
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Update data berhasil'
                                    ]);
    		$table = [
            'content' => $update->Input('content'),
            // 'menu_id' => $update->Input('nama_menu')
            ];
    		DataStatisApp::where('id_data', $id_data)->update($table);
    		return redirect('data-sekolah')->with('success', 'Data berhasil diupdate');
    	}else{
            notify()->flash('Oops !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                                    ]);
    		return redirect()->back()->withErrors($validasi)->withInput();
    	}
    }

    public function profileSekolah($id = null)
    {
        $isi = [
            '1' => 'profile sekolah',
            '2' => 'profile',
            '3' => 'sekolah'
        ];
        $profile = Identitas::where('id',  $id)->firstOrfail();
        return view('backends.data_statis.profile_sekolah', [
                'isi' => $isi,
                'profile' => $profile
            ]);
    }

    public function profileSekolahUpdate(Request $update, $id)
    {
        $profile = Identitas::find($id);
        $request = $update->all();
        $validasi = Validator::make($request, [
                'title' =>'required',
                'nama_sekolah' =>'required',
                'alamat' =>'required',
                'kab_kota' =>'required',
                'telpon' =>'required',
                'web' =>'required',
                'logo' =>'mimes:jpg,jpeg,png,gif | max: 1000'
            ], $pesan = [
                'title' =>'Title tidak boleh kosong.',
                'nama_sekolah' =>'Nama sekolah tidak boleh kosong.',
                'alamat' =>'Alamat tidak boleh kosong.',
                'kab_kota' =>'Kota tidak boleh kosong.',
                'telpon' =>'Telpon tidak boleh kosong.',
                'web' =>'Nama website tidak boleh kosong.',
                'logo' =>'Ekstensi gambar hanya boleh jpg,jpeg,png,gif, max 500 kb.'
            ]);
        if($validasi->fails())
        {
            notify()->flash('Oops !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                                    ]);
            return redirect()->back()->withErrors($pesan)->withInput();
        }
        else
        {
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Update data berhasil'
                                    ]);
            $images = $update->file('logo');
            if($images){
                File::delete('uploads/original'.'/'.$profile->logo);
                File::delete('uploads/images'.'/'.$profile->logo);
            
                $upload = 'uploads/original';
                if(count($fullname = $profile->logo))
                {
                    $fullname = $profile->logo;
                }
                    $nama = $update->Input('kab_kota');
                    $filename = strtolower(str_replace(' ','-',$nama));
                    $fullname = $filename.'-'.rand(11111,99999).'.'.$images->getClientOriginalExtension();
                    $success = $images->move($upload, $fullname);
                    Image::make($success)->resize('170','200')->save('uploads/images/'.$fullname);
                    if($success)
                    {
                        $table = [
                            'title'          => $update->Input('title'),
                            'nama_sekolah'   => $update->Input('nama_sekolah'),
                            'status_sekolah' => $update->Input('status_sekolah'),
                            'alamat_sekolah' => $update->Input('alamat'),
                            'kab_kota'       => $update->Input('kab_kota'),
                            'telepon'        => $update->Input('telpon'),
                            'nama_web'       => $update->Input('web'),
                            'logo'           => $fullname
                        ];
                    }
                        Identitas::where('id', $id)->update($table);
                        return redirect()->back();
                }
                else
                {
                    $table = [
                        'title'          => $update->Input('title'),
                        'nama_sekolah'   => $update->Input('nama_sekolah'),
                        'status_sekolah' => $update->Input('status_sekolah'),
                        'alamat_sekolah' => $update->Input('alamat'),
                        'kab_kota'       => $update->Input('kab_kota'),
                        'telepon'        => $update->Input('telpon'),
                        'nama_web'       => $update->Input('web')
                    ];
                }
                    Identitas::where('id', $id)->update($table);
                    return redirect()->back();
        }
    }

    public function getMenuFront()
    {
        $isi = [
            '1' => 'data statis',
            '2' => 'data statis',
            '3' => 'menu front'
        ];
         $menu_front = MenuFrontApp::where('parent_id', 0)->get();
        return view('backends.data_statis.menu_front', [
                'isi' => $isi,
                 'menu_front' => $menu_front
            ]);
    }

    public function addNewMenu(Request $request)
    {
        $data = $request->all();
        $validasi = Validator::make($data,[
                'id_menu' => 'required',
                'nama_menu' => 'required | min: 5 | max: 30',
                'icon_menu' => 'max: 50',
                'aktiv_menu' => 'required',
                'parent_menu' => 'required'
            ],$pesan = [
                'id_menu' => 'ID-Menu tidak boleh kosong.',
                'nama_menu' => 'Nama menu tidak boleh kosong min: 5 Karakter max: 30 Karakter.',
                'icon_menu' => 'Icon menu max: 50 karakter.',
                'parent_menu' => 'Silakan pilih parent menu.'
            ]);
        if($validasi->fails()){
            notify()->flash('Oops !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                                    ]);
            return redirect()->back()->withErrors($pesan)->withInput();
        }else{
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Data menu berhasil disimpan'
                                    ]);
            $table = new MenuFrontApp;
            $table->id_menu = $request->Input('id_menu');
            $table->nama_menu = $request->Input('nama_menu');
            $table->slugs = str_slug($request->Input('nama_menu'));
            $table->icon_menu = $request->Input('icon_menu');
            $table->parent_id = $request->Input('parent_menu');
            $table->is_aktiv = $request->Input('aktiv_menu');
            $success = $table->save();
            if($success){
                $data_statis = new DataStatisApp;
                $data_statis->content = '<p style="line-height: 20.8px;"><b><font color="#ff0000">Belum ada konten !!</font></b></p><p style="line-height: 20.8px;">Silakan Anda kunjungi halaman ini beberapa saat lagi.</p>';
                $data_statis->menu_id = $request->Input('id_menu');
                $data_statis->save();
            }
            return redirect()->back();
        }

    }

    public function getListMenuFront()
    {
        $menu_front = MenuFrontApp::all();
        return view('backends.data_statis.list_menu', [
                'menu_front' => $menu_front
            ]);
    }

    public function aktiv($id)
    {
         $table = array(
                'is_aktiv' => '1'
            );
        MenuFrontApp::where('id_menu',$id)->update($table);

        return response()->json(['success' => 'true']);
    }

    public function nonaktiv($id)
    {
         $table = array(
                'is_aktiv' => '0'
            );
        MenuFrontApp::where('id_menu',$id)->update($table);

        return response()->json(['success' => 'true']);
    }

    public function edit($id_menu)
    {
        $menu = MenuFrontApp::find($id_menu);
         $menu_front = MenuFrontApp::where('parent_id', 0)->where('level', 0)->get();
        return view('backends.data_statis.edit_menu',[
                'menu' => $menu,
                'menu_front' => $menu_front
            ]);
    }

    public function updateMenu(Request $request,$id_menu )
    {
        $data = $request->all();
        $validasi = Validator::make($data,[
                'nama' => 'required | min: 5 | max: 30',
                'icon' => 'max: 50',
            ],$data=[
                'nama' => 'Nama menu tidak boleh kosong min: 5 Karakter max: 30 Karakter.',
                'icon' => 'Icon menu max: 50 karakter.',
            ]);
        if($validasi->fails()){
            notify()->flash('Oops !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                                    ]);
            return redirect()->back()->withErrors($data)->withInput();
        }else{
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Update data berhasil'
                                    ]);
            $menu = MenuFrontApp::findOrfail($id_menu);
            if($menu->id_menu == 2.1 || $menu->id_menu == 4.2 || $menu->id_menu == 4.4 || $menu->id_menu == 4.5 || $menu->id_menu == 5.1 || $menu->id_menu == 6.1){
                $table = [
                    'nama_menu' => $request->Input('nama'),
                    'icon_menu' => $request->Input('icon'),
                    'parent_id' => $request->Input('parent_menu')
                ];
            
            MenuFrontApp::where('id_menu',$id_menu)->update($table);
            return redirect()->back();
            }
                $table = [
                        'nama_menu' => $request->Input('nama'),
                        'slugs' => str_slug($request->Input('nama')),
                        'icon_menu' => $request->Input('icon'),
                        'parent_id' => $request->Input('parent_menu')
                    ];
            
            MenuFrontApp::where('id_menu',$id_menu)->update($table);
            return redirect()->back();
        }
    }

    public function delete($id_menu)
    {
        $menu = MenuFrontApp::findOrfail($id_menu);
        if($menu->parent_id == 0){
            return response()->json(['success' => 'false']);
        }else if($menu->id_menu == 2.1 || $menu->id_menu == 4.2 || $menu->id_menu == 4.4 || $menu->id_menu == 4.5 || $menu->id_menu == 5.1 || $menu->id_menu == 6.1){
            return response()->json(['success' => 'true-false']);
        }
            $menu->delete();
            return response()->json(['success' => 'true']);
    }
}
