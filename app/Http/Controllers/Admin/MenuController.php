<?php

namespace App\Http\Controllers\Admin;
use App\Models\MenuApp;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class MenuController extends Controller
{
    public function __construct()
    {
    	return $this->middleware('auth');
    }

    public function index()
    {
        $menu = MenuApp::orderBy('hak_akses', 'asc')
                        ->get();
    	$isi = [
            '1' =>'management system',
            '2' =>'setting',
            '3' =>'menu'
            ];
    	if (auth()->user()->hasRole('super-admin'))
        {
            return view('backends.menu.view',[
                    'isi' => $isi,
                    'menu' => $menu
                ]);
        }
        notify()->flash('Opps !!!', 'error', [
                                    'timer' => 2000,
                                    'text'  => 'Anda tidak punya hak akses'
                            ]);
        
        return redirect()->back();
    	//return redirect()->to('auth-login');
    }

/*
|--------------------------------------------------------------------------
| Form tambah Menu
|--------------------------------------------------------------------------
*/
    public function addMenu()
    {
        $menu_app = MenuApp::all();

        return view('backends.menu.add', [
                                'menu_app' => $menu_app,
                                ]);
    }

/*
|--------------------------------------------------------------------------
| Create Menu
|--------------------------------------------------------------------------
*/
    public function addNew(Request $data)
    {
        $validation = Validator::make($data->all(), [
            'nama_menu' => 'min : 3 | max : 20 | required',
            'link_menu' => 'min : 1 | required',
            'icon_menu' => 'required',
            'aktiv_menu' => 'min : 1 | max : 1 | required',
            'parent_menu' => 'min : 1 | required',
            'hak_akses' => 'min : 1 | max : 1 | required'
            ]);

        if($validation->fails())
        {
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return Redirect::to('menu')
                            ->witherrors($validation)
                            ->withInput();
        }
        else
        {
                notify()->flash('success !!!', 'success', [
                                'text'  => 'Tambah data berhasil'
                        ]);

            $table = new MenuApp;

            $table->nama_menu = $data->Input('nama_menu');
            $table->link_menu = $data->Input('link_menu');
            $table->icon_menu = $data->Input('icon_menu');
            $table->is_aktiv = $data->Input('aktiv_menu');
            $table->parent_menu = $data->Input('parent_menu');
            $table->hak_akses = $data->Input('hak_akses');

            $table->save();

        return Redirect::to('menu');
        }

    }

/*
|--------------------------------------------------------------------------
| Form edit Menu
|--------------------------------------------------------------------------
*/
    public function edit($id)
    {
        $menu_app = MenuApp::find($id);
        $menu = MenuApp::all();
        return view('backends.menu.edit', [
                                'menu' => $menu,
                                'menu_app' => $menu_app
                                ]);
    }

/*
|--------------------------------------------------------------------------
| Update Menu
|--------------------------------------------------------------------------
*/
    public function update(Request $data, $id)
    {
        $validation = Validator::make($data->all(), [
            'nama_menu' => 'min : 3 | max : 20 | required',
            'link_menu' => 'min : 1 | required',
            'aktiv_menu' => 'min : 1 | max : 1',
            'parent_menu' => 'min : 1',
            'hak_akses' => 'min : 1 | max : 1'
            ]);

        if($validation->fails())
        {
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return Redirect()->back()
                            ->witherrors($validation)
                            ->withInput();
        }
        else
        {
                notify()->flash('success !!!', 'success', [
                                'text'  => 'Update data berhasil'
                        ]);
            $table = array(
                    'nama_menu'   => $data->Input('nama_menu'),
                    'link_menu'   => $data->Input('link_menu'),
                    'icon_menu'   => $data->Input('icon_menu'),
                    'is_aktiv'    => $data->Input('aktiv_menu'),
                    'parent_menu' => $data->Input('parent_menu'),
                    'hak_akses'   => $data->Input('hak_akses')
                    );
            
            MenuApp::where('id', $id)->update($table);

        return Redirect::to('menu');
        }

    }

/*
|--------------------------------------------------------------------------
| Hapus menu
|--------------------------------------------------------------------------
*/
    public function destroy($id)
    {

        $delete = MenuApp::find($id);
        $cek = $delete->parent_menu;
        if( $cek == 1){
            
            return response()->json(['success' => 'false']);
        }
            $delete->delete();
            return response()->json(['success' => 'true']);
    }
}
