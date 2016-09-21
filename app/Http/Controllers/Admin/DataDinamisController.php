<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\BeritaApp;
use App\Models\PengumumanApp;
use App\Models\AgendaApp;
use App\Models\AlbumApp;
use App\Models\GaleriApp;
use App\Models\PesanApp;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use File;
use Image;

class DataDinamisController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function indexBerita()
    {
    	$isi = [
    		'1' => 'data dinamis',
    		'2' => 'data dinamis',
    		'3' => 'indexs berita'
    	];
    	return view('backends.data_dinamis.berita', [
    			'isi' => $isi
    		]);
    }

    public function addBerita()
    {
        $beritas = BeritaApp::orderBy('id_berita', 'decs')->get();
        return view('backends.data_dinamis.add_berita', [
                'beritas' => $beritas
            ]);
    }

    public function addNew(Request $data)
    {
    	$request = $data->all();
    	$validasi = Validator::make($request,[
    			'judul_berita' => 'required | min: 10',
    			'content' => 'required',
    			'gambar' => 'mimes:jpg,jpeg,png,gif | max:500'
    		], $pesan = [
    			'judul_berita' => 'Judul berita tidak boleh kosong.',
    			'content' => 'Isi berita tidak boleh kosong.',
    			'gambar' => 'Gambar berita tidak boleh kosong.'
    		]);
    	if($validasi->fails()){
    		notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->withErrors($pesan)->withInput();
    	}else{
    		notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Berita berhasil dipublish'
                            ]);
                $images = $data->file('gambar');
                $upload = 'uploads/original';
	            $filename = str_slug($data->Input('judul_berita'));
                $fullname = $filename.'-'.date('d-m-Y').'-'.rand(11111,99999).'.'.$images->getClientOriginalExtension();
                $success = $images->move($upload, $fullname);
                Image::make($success)->resize('110','110')->save('uploads/images/'.$fullname);
                if($success) {
		    		$berita = new BeritaApp;
		    		$berita->judul_berita = $data->Input('judul_berita');
		    		$berita->slugs = $filename;
		    		$berita->isi_berita = $data->Input('content');
		    		$berita->gambar = $fullname;
		    		$berita->author = auth()->user()->id_guru;
		    		$berita->created_at = Carbon::now('Asia/Jakarta');
		    		$berita->updated_at = Carbon::now('Asia/Jakarta');

		    		$berita->save();
		    		return redirect()->back();
		    	}
    	}
    }

    public function editBerita($id_berita)
    {
    	$isi = [
    		'1' => 'data dinamis',
    		'2' => 'berita',
    		'3' => 'edit berita'
    	];
    	$berita = BeritaApp::findOrfail($id_berita);
    		return view('backends.data_dinamis.berita_edit',[
    				'isi' => $isi,
    				'berita' => $berita
    			]);
    }

    public function updateBerita(Request $data, $id)
    {
        $berita = BeritaApp::find($id);
        $request = $data->all();
    	$validasi = Validator::make($request,[
    			'judul_berita' => 'required',
    			'content' => 'required',
    			'gambar' => 'mimes:jpg,jpeg,png,gif | max:500'
    		], $pesan = [
    			'judul_berita' => 'Judul berita tidak boleh kosong.',
    			'content' => 'Isi berita tidak boleh kosong.',
    			'gambar' => 'Gambar max 500 kb.'
    		]);
    	if($validasi->fails()){
    		notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->withErrors($pesan)->withInput();
        }else{
    		notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Berita berhasil diupdate'
                            ]);

            $images = $data->file('gambar');
            if($images){
                File::delete('uploads/original'.'/'.$berita->gambar);
                File::delete('uploads/images'.'/'.$berita->gambar);
            
	            $upload = 'uploads/original';
	            if(count($fullname = $berita->gambar)){
	                    $fullname = $berita->gambar;
	                }
	                	$filename = str_slug($data->Input('judul_berita'));
		                $fullname = $filename.'-'.date('d-m-Y').'-'.rand(11111,99999).'.'.$images->getClientOriginalExtension();
			            $success = $images->move($upload, $fullname);
                        Image::make($success)->resize('110','110')->save('uploads/images/'.$fullname);
			            if($success){
			                	$table =array(
									'judul_berita' => $data->Input('judul_berita'),          
									'isi_berita'      => $data->Input('content'),
									'gambar'       => $fullname,
									'updated_at'   => Carbon::now('Asia/Jakarta')
				                		);
			            			}
		                    BeritaApp::where('id_berita', $id)->update($table);

		                return redirect('indexs-berita');
                
	            }else{
	            	$table =array(
							'judul_berita' => $data->Input('judul_berita'),          
							'isi_berita'      => $data->Input('content'),
							'updated_at'   => Carbon::now('Asia/Jakarta')
	                		);
            			}
	                    BeritaApp::where('id_berita', $id)->update($table);

	                return redirect('indexs-berita');
	        }
	            
    }

    public function delete($id_berita)
    {
    	$berita =BeritaApp::find($id_berita);
        if($berita)
        {
            File::delete('uploads/original'.'/'.$berita->gambar);
            File::delete('uploads/images'.'/'.$berita->gambar);

            $berita->delete();
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function indexPengumuman()
    {
    	$isi = [
    		'1' => 'data dinamis',
    		'2' => 'data dinamis',
    		'3' => 'pengumuman'
    	];
    	$pengumumans = PengumumanApp::orderBy('id_pengumuman', 'desc')->get();
    	return view('backends.data_dinamis.pengumuman', [
    			'isi' => $isi,
    			'pengumumans' => $pengumumans
    		]);
    }

    public function addNewPengumuman(Request $data)
    {
    	$request = $data->all();
    	$validasi = Validator::make($request,[
    			'judul_pengumuman' => 'required',
    			'content' => 'required'
    		], $pesan = [
    			'judul_pengumuman' => 'Judul pengumuman tidak boleh kosong.',
    			'content' => 'Isi pengumuman tidak boleh kosong.',
    		]);
    	if($validasi->fails()){
    		notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->withErrors($pesan)->withInput();
    	}else{
    		notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Pengumuman berhasil dipublish'
                            ]);
		    		$pengumuman = new PengumumanApp;
		    		$pengumuman->judul = $data->Input('judul_pengumuman');
		    		$pengumuman->isi = $data->Input('content');
		    		$pengumuman->author = auth()->user()->id_guru;
		    		$pengumuman->created_at = Carbon::now('Asia/Jakarta');
		    		$pengumuman->updated_at = Carbon::now('Asia/Jakarta');

		    		$pengumuman->save();
		    		return redirect()->back();
    	}
    }

    public function editPengumuman($id_pengumuman)
    {
    	$isi = [
    		'1' => 'data dinamis',
    		'2' => 'pengumuman',
    		'3' => 'edit'
    	];
    	$pengumuman = PengumumanApp::find($id_pengumuman);
    	return view('backends.data_dinamis.pengumuman_edit', [
    			'isi' => $isi,
    			'pengumuman' => $pengumuman
    		]);
    }

    public function updatePengumuman(Request $data, $id)
    {
        $request = $data->all();
    	$validasi = Validator::make($request,[
    			'judul_pengumuman' => 'required',
    			'content' => 'required'
    		], $pesan = [
    			'judul_pengumuman' => 'Judul pengumuman tidak boleh kosong.',
    			'content' => 'Isi pengumuman tidak boleh kosong.'
    		]);
    	if($validasi->fails()){
    		notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->withErrors($pesan)->withInput();
        }else{
    		notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Berita berhasil diupdate'
                            ]);
            	$table =array(
						'judul' => $data->Input('judul_pengumuman'),          
						'isi'      => $data->Input('content'),
						'updated_at'   => Carbon::now('Asia/Jakarta')
                		);
                    PengumumanApp::where('id_pengumuman', $id)->update($table);

                return redirect('pengumuman');
	        }
	            
    }

    public function deletePengumuman($id_pengumuman)
    {
    	$pengumuman = PengumumanApp::find($id_pengumuman);
        if($pengumuman)
        {
            $pengumuman->delete();
        
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function indexAgenda()
    {
    	$isi = [
    		'1' => 'data dinamis',
    		'2' => 'data dinamis',
    		'3' => 'agenda'
    	];
    	$agendas = AgendaApp::orderBy('id_agenda', 'desc')->get();
    	return view('backends.data_dinamis.agenda', [
    			'isi' => $isi,
    			'agendas' => $agendas
    		]);
    }

    public function addNewAgenda(Request $data)
    {
    	$request = $data->all();
    	$validasi = Validator::make($request,[
    			'judul_agenda' => 'required',
    			'content' => 'required',
    			'mulai' => 'required',
    			'selesai' => 'required',
    			'tempat' => 'required',
    			'jam' => 'required',
    			'keterangan' => 'required'
    		], $pesan = [
    			'judul_agenda' => 'Judul agenda tidak boleh kosong.',
    			'content' => 'Isi agenda tidak boleh kosong.',
    			'mulai' => 'Tanggal agenda tidak boleh kosong.',
    			'selesai' => 'Tanggal agenda tidak boleh kosong.',
    			'tempat' => 'Tempat agenda tidak boleh kosong.',
    			'jam' => 'Jam agenda tidak boleh kosong.',
    			'keterangan' => 'Keterangan agenda tidak boleh kosong.'
    		]);
    	if($validasi->fails()){
    		notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->withErrors($pesan)->withInput();
    	}else{
    		notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Agenda berhasil dipublish'
                            ]);
		    		$agenda = new AgendaApp;
		    		$agenda->tema = $data->Input('judul_agenda');
		    		$agenda->isi = $data->Input('content');
		    		$agenda->tgl_mulai = $data->Input('mulai');
		    		$agenda->tgl_selesai = $data->Input('selesai');
		    		$agenda->tempat = $data->Input('tempat');
		    		$agenda->jam = $data->Input('jam');
		    		$agenda->keterangan = $data->Input('keterangan');
		    		$agenda->user_id = auth()->user()->id_guru;
		    		$agenda->created_at = Carbon::now('Asia/Jakarta');
		    		$agenda->updated_at = Carbon::now('Asia/Jakarta');

		    		$agenda->save();
		    		return redirect()->back();
    	}
    }

    public function editAgenda($id_agenda)
    {
    	$isi = [
    		'1' => 'data dinamis',
    		'2' => 'agenda',
    		'3' => 'edit'
    	];
    	$agenda = AgendaApp::find($id_agenda);
    	return view('backends.data_dinamis.agenda_edit', [
    			'isi' => $isi,
    			'agenda' => $agenda
    		]);
    }

    public function updateAgenda(Request $data, $id)
    {
        $request = $data->all();
    	$request = $data->all();
    	$validasi = Validator::make($request,[
    			'judul_agenda' => 'required',
    			'content' => 'required',
    			'mulai' => 'required',
    			'selesai' => 'required',
    			'tempat' => 'required',
    			'jam' => 'required',
    			'keterangan' => 'required'
    		], $pesan = [
    			'judul_agenda' => 'Judul agenda tidak boleh kosong.',
    			'content' => 'Isi agenda tidak boleh kosong.',
    			'mulai' => 'Tanggal agenda tidak boleh kosong.',
    			'selesai' => 'Tanggal agenda tidak boleh kosong.',
    			'tempat' => 'Tempat agenda tidak boleh kosong.',
    			'jam' => 'Jam agenda tidak boleh kosong.',
    			'keterangan' => 'Keterangan agenda tidak boleh kosong.'
    		]);
    	if($validasi->fails()){
    		notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->withErrors($pesan)->withInput();
        }else{
    		notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Agenda berhasil diupdate'
                            ]);
            	$table =array(
						'tema'        => $data->Input('judul_agenda'),
						'isi'         => $data->Input('content'),
						'tgl_mulai'   => $data->Input('mulai'),
						'tgl_selesai' => $data->Input('selesai'),
						'tempat'      => $data->Input('tempat'),
						'jam'         => $data->Input('jam'),
						'keterangan'  => $data->Input('keterangan'),
						'user_id'     => auth()->user()->id_guru,
						'updated_at'  => Carbon::now('Asia/Jakarta'),
						);
					AgendaApp::where('id_agenda', $id)->update($table);

                return redirect('agenda');
	        }
	            
    }

    public function deleteAgenda($id_Agenda)
    {
    	$Agenda = AgendaApp::find($id_Agenda);
        if($Agenda)
        {
            $Agenda->delete();
        
           return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function indexGallery()
    {
    	$isi = [
    		'1' => 'data dinamis',
    		'2' => 'data dinamis',
    		'3' => 'Gallery'
    	];
    	$albums = AlbumApp::orderBy('id_album', 'desc')->paginate(8);
    	return view('backends.data_dinamis.album', [
    			'isi' => $isi,
    			'albums' => $albums
    		]);
    }

    public function getGallery($id_album)
    {
    	$albums = GaleriApp::orderBy('id_foto', 'desc')->where('album_id', $id_album)->paginate(8);
    	foreach($albums as $al):
    		$album = $al->getAlbum->nama_album;
    	endforeach;
    	if(count($albums)){
	    		$isi = [
	    		'1' => 'data dinamis',
	    		'2' => 'album',
	    		'3' => $album
	    	];
    		}else{
	    		$isi = [
	    		'1' => 'data dinamis',
	    		'2' => 'album',
	    		'3' => ''
	    	];
			}
		$exist = AlbumApp::where('id_album', $id_album)->firstOrfail();
    	return view('backends.data_dinamis.album_gallery', [
    			'isi' => $isi,
    			'albums' => $albums,
    			'exist' => $exist
    		]);
    }

    public function addNewAlbum(Request $data)
    {
    	$request = $data->all();
    	$validasi = Validator::make($request,[
    			'album' => 'required'
    		], $pesan = [
    			'album' => 'Nama album tidak boleh kosong.'
    		]);
    	if($validasi->fails()){
    		notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->withErrors($pesan)->withInput();
    	}else{
    		notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Tambah album berhasil'
                            ]);
		    		$album = new AlbumApp;
		    		$album->nama_album = $data->Input('album');
                    $album->slugs = str_slug($data->Input('album'));

		    		$album->save();
		    		return redirect()->back();
    	}
    }

    public function addNewFoto(Request $data)
    {
    	$request = $data->all();
    	$validasi = Validator::make($request,[
    			'album' => 'required',
    			'keterangan' => 'required',
    			'foto' => 'required | mimes:jpg,jpeg,png,gif | max: 3000'
    		], $pesan = [
    			'album' => 'Nama album tidak boleh kosong.',
    			'keterangan' => 'Keterangan tidak boleh kosong.',
    			'foto' => 'Foto tidak boleh kosong max 1000kb.'
    		]);
    	if($validasi->fails()){
    		notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
    		return redirect()->back()->withErrors($pesan)->withInput();
    	}else{
    		notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Tambah foto berhasil'
                            ]);
    		$foto = $data->file('foto');
    		$upload = 'uploads/original';
            $filename = str_slug($data->Input('keterangan'));
            $fullname = $filename.'-'.date('d-m-Y').'-'.rand(11111,99999).'.'.$foto->getClientOriginalExtension();
            $success = $foto->move($upload, $fullname);
            Image::make($success)->resize('205','155')->save('uploads/images/'.$fullname);
            if($success){
            	$galeri = new GaleriApp;
	    		$galeri->album_id = $data->Input('album');
	    		$galeri->keterangan = $data->Input('keterangan');
	    		$galeri->images = $fullname;

	    		$galeri->save();
	    		return redirect()->back();
            }else{
            	return redirect()->back();
            }
    	}
    }

    public function deleteAlbum($id_album)
    {
    	$foto = GaleriApp::orderBy('album_id','desc')->where('album_id',$id_album)->get();
    	if(count($foto)){
            for($a=0;$a<count($foto);$a++){
                foreach($foto as $b){
                    while($b){
                        $album = AlbumApp::find($id_album);
                        if($album){
                            File::delete('uploads/original'.'/'.$b->images);
                            File::delete('uploads/images'.'/'.$b->images);

                            $album->delete();
                        
                            return response()->json(['success' => 'true']);
                        }
                            return response()->json(['success' => 'false']);
                    }
                }
            }
        }else{
            $album = AlbumApp::find($id_album);
            if($album){
                $album->delete();
                return response()->json(['success' => 'true']);
            }
                return response()->json(['success' => 'false']);
        }
    }

    public function deleteFoto($id_foto)
    {
    	$foto = GaleriApp::find($id_foto);
        if($foto)
        {
            File::delete('uploads/original'.'/'.$foto->images);
            File::delete('uploads/images'.'/'.$foto->images);

            $foto->delete();
        
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }

    public function show($id_pesan)
    {
            $table = array(
                'status' => '1'
            );
        $pesan = PesanApp::where('id_pesan',$id_pesan)->update($table);
        if($pesan){
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Pesan berhasil diapprove'
                            ]);
            return redirect()->back();
        }
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back();
    }

    public function hide($id_pesan)
    {
            $table = array(
                'status' => '0'
            );
        $pesan = PesanApp::where('id_pesan',$id_pesan)->update($table);
        if($pesan){
            notify()->flash('Success !!!', 'success', [
                                    'text'  => 'Pesan berhasil diblock'
                            ]);
            return redirect()->back();
        }
            notify()->flash('Opps !!!', 'error', [
                                    'text'  => 'Ada kesalahan'
                            ]);
            return redirect()->back();
    }

    public function destroy($id_pesan)
    {
        $pesan = PesanApp::find($id_pesan);
        if($pesan)
        {
            $pesan->delete();
        
            return response()->json(['success' => 'true']);
        }
            return response()->json(['success' => 'false']);
    }
}
