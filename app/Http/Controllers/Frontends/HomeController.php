<?php

namespace App\Http\Controllers\Frontends;
use App\Models\DataStatisApp;
use App\Models\MenuFrontApp;
use App\Models\AgendaApp;
use App\Models\PengumumanApp;
use App\Models\BeritaApp;
use App\Models\User;
use App\Models\SiswaApp;
use App\Models\AlbumApp;
use App\Models\GaleriApp;
use App\Models\PesanApp;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    public function __construct()
    {
    	$this->middleware('web');
    }

    public function index()
    {
        $active = 'beranda';
        $submenu = null;
    	return view('frontends.index',[
                    'active' => $active,
                    'submenu' => $submenu
                ]);
    }
    public function home($link,$slugs=null)
    {
        $links = MenuFrontApp::where('slugs',$slugs)->get()->first();
        if(count($links)){
            $link = MenuFrontApp::where('id_menu',$links->parent_id)->get()->first();
            $url = $link->slugs;
                if(!$slugs == $url.'/'.$links)
                {
                    return response()->view('errors.404', [], 404);
                }

                $cekslugs = MenuFrontApp::where('slugs', $slugs)->first();
                $cekdata = $cekslugs->id_menu;

                if($slugs == 'sambutan-kepala-sekolah')
                {
                    $kepala_sekolah = User::where('jabatan','kepala sekolah')->get()->first();
                    $profile = DataStatisApp::where('menu_id',$cekdata)->get()->first();
                    $active = $url;
                    $submenu = $slugs;
                    return view('frontends.guru.sambutan',[
                            'kepala_sekolah' => $kepala_sekolah,
                            'profile' => $profile,
                            'active' => $active,
                            'submenu' => $submenu
                        ]);
                }
                else if($slugs == 'kepala-sekolah')
                {
                   $kepala_sekolah = User::where('jabatan','kepala sekolah')->get()->first();
                    $active = $url;
                    $submenu = $slugs;
                    return view('frontends.guru.kepala_sekolah',[
                            'kepala_sekolah' => $kepala_sekolah,
                            'active' => $active,
                            'submenu' => $submenu
                        ]);
                }
                else if($slugs == 'data-guru')
                {
                    $data_guru = User::where('status','guru')->paginate(15);
                    $active = $url;
                    $submenu = $slugs;
                    return view('frontends.guru.guru',[
                            'data_guru' => $data_guru,
                            'active' => $active,
                            'submenu' => $submenu
                        ]);
                }
                else if($slugs == 'data-pegawai')
                {
                    $data_guru = User::where('status','pegawai')->paginate(15);
                    $active = $url;
                    $submenu = $slugs;
                    return view('frontends.guru.pegawai',[
                            'data_guru' => $data_guru,
                            'active' => $active,
                            'submenu' => $submenu
                        ]);
                }

                else if($slugs == 'data-alumni')
                {
                    $data_alumni = SiswaApp::orderBy('tahun_lulus', 'desc')->where('status','alumni')->paginate(50);
                    $active = $url;
                    $submenu = $slugs;
                    return view('frontends.siswa.alumni',[
                            'data_alumni' => $data_alumni,
                            'active' => $active,
                            'submenu' => $submenu
                        ]);
                }
                else if($slugs == 'e-learning')
                {
                    return redirect::to($slugs);
                }
                    $profile = DataStatisApp::where('menu_id',$cekdata)->get()->first();
                    $active = $url;
                    $submenu = $slugs;
                        return view('frontends.home',[
                                'profile' => $profile,
                            'active' => $active,
                            'submenu' => $submenu
                            ]);
        }else{
            return response()->view('errors.404', [], 404);
        }
    }

    public function getBerita($slugs)
    {
        $berita = BeritaApp::where('slugs',$slugs)->firstOrfail();
        $active = null;
        $submenu = null;
        return view('frontends.berita.berita',[
                'berita' => $berita,
                    'active' => $active,
                            'submenu' => $submenu
            ]); 
    }

    public function getAllAlbum()
    {
        $albums = AlbumApp::orderBy('id_album', 'desc')->paginate(4);
        $active = null;
        $submenu = null;
        return view('frontends.album.album',[
                'albums' => $albums,
                    'active' => $active,
                            'submenu' => $submenu
            ]); 
    }

    public function getAlbum($slugs = null)
    {
        $cekalbum = AlbumApp::where('slugs', $slugs)->firstOrfail();
        if(!$slugs == $slugs)
        {
            return abort(404);
        }
        $id_album = $cekalbum->id_album;
        $fotos = GaleriApp::orderBy('id_foto', 'desc')->where('album_id', $id_album)->paginate(12);
        $active = null;
        $submenu = null;
        return view('frontends.album.foto',[
                'fotos' => $fotos,
                    'active' => $active,
                            'submenu' => $submenu
            ]); 
    }

    public function pesan(Request $request)
    {
        $data = $request->all();
        $validasi = Validator::make($data,[
                'username' => 'required | max: 20 | min: 3',
                'email' => 'required | email | max:50',
                'pesan' => 'required | max: 500'
            ], $pesan = [
                'username' => 'Maaf, Nama tidak boleh kosong Min 3 Huruf Max 20 Huruf',
                'email' => 'Maaf, Alamat email harus valid',
                'pesan' => 'Isi pesan tidak boleh kosong'
            ]);
        if($validasi->fails()){
            return response::json(['success' => 'false']);
        }
        $table = new PesanApp;
        $table->nama = $request->Input('username');
        $table->email = $request->Input('email');
        $table->pesan = $request->Input('pesan');
        $table->tgl_pesan = Carbon::now('Asia/Jakarta');
        $table->save();
        return response::json(['success' => 'true']);
    }

    public function cariAlumni(Request $request, $link)
    {
        $query = $request->get('q');
        if($query === ''){
            $data_alumni = SiswaApp::orderBy('tahun_lulus', 'desc')->where('status','alumni')->paginate(50);
            $active = $link;
            return view('frontends.siswa.alumni',[
                    'data_alumni' => $data_alumni,
                    'active' => $active
                ]);
        }
        $data_alumni = SiswaApp::where('nis', 'LIKE', '%' . $query . '%')
                        ->orwhere('nama', 'LIKE', '%' . $query . '%')
                        ->orwhere('tahun_lulus', 'LIKE', '%' . $query . '%')
                        ->paginate(5);
        $active = $link;
        return view('frontends.siswa.cari_alumni',[
                'data_alumni' => $data_alumni,
                    'active' => $active,
                    'query' => $query
            ]);
    }
}
