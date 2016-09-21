<?php
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Route Web/Frontend
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'web'], function(){
    Route::get('/', [
            'as' => 'home',
            'uses' => 'Frontends\HomeController@index'
        ]);
    Route::get('home', [
            'as' => 'home',
            'uses' => 'Frontends\HomeController@index'
        ]);
    Route::get('page/{link}/{slugs}', [
            'as' => 'home',
            'uses' => 'Frontends\HomeController@home'
        ]);
    Route::get('page/{link}/{slugs}/cari', [
            'as' => 'home',
            'uses' => 'Frontends\HomeController@cariAlumni'
        ]);
    Route::get('berita/{slugs}', [
            'as' => 'home',
            'uses' => 'Frontends\HomeController@getBerita'
        ]);
    Route::get('/album', [
            'as' => 'home',
            'uses' => 'Frontends\HomeController@getAllAlbum'
        ]);
    Route::get('/album/{slugs}', [
            'as' => 'home',
            'uses' => 'Frontends\HomeController@getAlbum'
        ]);
    Route::post('/pesan', [
        'as' => 'home',
        'uses' => 'Frontends\HomeController@pesan'
    ]);
});
/*
|--------------------------------------------------------------------------
| Notify handling
|--------------------------------------------------------------------------
*/
Route::get('error', 'AuthController@error');
Route::get('errors', 'AuthController@errors');

Route::get('/notify', function () {
        notify()->flash('Welcome', 'success', [
            'text' => 'You\'re sign in',
        ]);
        if (Auth()->check())
        {
            return redirect('dashboards');
        }
         elseif (Auth('siswa')->check())
        {
            return redirect('dashboard');
        }else
        {
            notify()->flash('Maaf !!!', 'error', [
                                            'text'  => 'Anda sudah LULUS.'
                                    ]);
            return redirect()->to('/dashboard/logout');
        }
});
/*
|--------------------------------------------------------------------------
| Route Guest
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'guest'], function(){
    Route::get('auth-login', [
        'as' => 'login',
        'uses' => 'AuthController@index'
    ]);
    Route::post('auth-login', [
        'as' => 'login',
        'uses' => 'AuthController@postLogin'
    ]);
    Route::get('e-learning', [
        'as' => 'login',
        'uses' => 'AuthController@siswa'
    ]);
    Route::post('e-learning', [
        'as' => 'login',
        'uses' => 'AuthController@cekSiswa'
    ]);
});
/*
|--------------------------------------------------------------------------
| Route Group Auth()
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function(){
/*Dasdboard Route*/
    Route::get('dashboards', [
            'as' => 'dashboards',
            'uses' => 'Admin\AdminController@index'
        ]);
    Route::get('dashboards/logout', [
            'as' => 'dashboards',
            'uses' => 'Admin\AdminController@logout'
        ]);
    Route::get('user', [
            'as' => 'user',
            'uses' => 'Admin\AdminController@userAdmin'
        ]);
    Route::get('list-user', [
            'as' => 'user',
            'uses' => 'Admin\AdminController@listUser'
        ]);
    Route::post('user/approve/{id}', [
            'as' => 'user',
            'uses' => 'Admin\AdminController@approve'
        ]);
    Route::post('user/block/{id}', [
            'as' => 'user',
            'uses' => 'Admin\AdminController@block'
        ]);
    Route::post('user', [
            'as' => 'user',
            'uses' => 'Admin\AdminController@userReset'
        ]);
    Route::get('myprofile', [
            'as' => 'user',
            'uses' => 'Admin\AdminController@myProfile'
        ]);
    Route::post('myprofile', [
            'as' => 'user',
            'uses' => 'Admin\AdminController@UpdateProfile'
        ]);
    Route::get('1', [
            'as' => 'success',
            'uses' => 'Admin\AdminController@success'
        ]);
    Route::get('pesan/approve/{id_pesan}', [
            'as' => 'success',
            'uses' => 'Admin\DataDinamisController@show'
        ]);
    Route::get('pesan/block/{id_pesan}', [
            'as' => 'success',
            'uses' => 'Admin\DataDinamisController@hide'
        ]);
    Route::post('pesan/destroy/{id_pesan}', [
            'as' => 'success',
            'uses' => 'Admin\DataDinamisController@destroy'
        ]);
/* Menu Route */
    Route::get('menu', [
            'as' => 'menu',
            'uses' => 'Admin\MenuController@index'
        ]);
    Route::get('addMenu', [
            'as' => 'menu',
            'uses' => 'Admin\MenuController@addMenu'
        ]);
    Route::post('menu/form', [
            'as' => 'menu',
            'uses' => 'Admin\MenuController@addNew'
        ]);
    Route::get('menu/edit/{id}', [
            'as' => 'menu',
            'uses' => 'Admin\MenuController@edit'
        ]);
    Route::post('menu/update/{id}', [
            'as' => 'menu',
            'uses' => 'Admin\MenuController@update'
        ]);
    Route::post('menu/delete/{id}', [
            'as' => 'menu',
            'uses' => 'Admin\MenuController@destroy'
        ]);
/* Guru Route */
    Route::get('guru', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@index'
        ]);
    Route::get('list', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@listGuru'
        ]);
    Route::post('guru/approve/{id}', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@approve',
        ]);
    Route::post('guru/block/{id}', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@block',
        ]);
    Route::get('guru/form', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@addNew',
        ]);
    Route::post('guru/form', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@add',
        ]);
    Route::get('guru/edit/{id}', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@edit',
        ]);
    Route::post('guru/update/{id}', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@update',
        ]);
    Route::post('guru/delete/{id}', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@delete',
        ]);
    Route::get('guru/excel', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@getExcel',
        ]);
    Route::get('guru/format', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@format',
        ]);
    Route::post('guru/excel', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@addNewExcel',
        ]);
    Route::get('guru/pdf', [
            'as' => 'guru',
            'uses' => 'Admin\GuruController@getPdf',
        ]);
/* Siswa Route*/
    Route::get('siswa', [
            'as' => 'siswa',
            'uses' => 'Admin\SiswaController@index'
        ]);
    Route::get('siswa/form', [
            'as' => 'siswa/form',
            'uses' => 'Admin\SiswaController@add'
        ]);
    Route::post('siswa/form', [
            'as' => 'siswa/form',
            'uses' => 'Admin\SiswaController@addNew'
        ]);
    Route::get('siswa/edit/{id}', [
            'as' => 'siswa',
            'uses' => 'Admin\SiswaController@edit'
        ]);
    Route::post('siswa/update/{id}', [
            'as' => 'siswa',
            'uses' => 'Admin\SiswaController@update'
        ]);
    Route::post('siswa/delete/{id}', [
            'as' => 'siswa',
            'uses' => 'Admin\SiswaController@destroy'
        ]);
    Route::post('siswa/excel', [
            'as' => 'siswa',
            'uses' => 'Admin\SiswaController@addNewExcel'
        ]);
    Route::get('siswa/format', [
            'as' => 'siswa',
            'uses' => 'Admin\SiswaController@formatExcel'
        ]);
    Route::get('siswa/excel', [
            'as' => 'siswa',
            'uses' => 'Admin\SiswaController@getExcel'
        ]);
    Route::get('siswa/pdf', [
            'as' => 'siswa',
            'uses' => 'Admin\SiswaController@getPdf'
        ]);
    Route::get('alumni', [
            'as' => 'alumni',
            'uses' => 'Admin\SiswaController@getAlumni'
        ]);
    Route::get('alumni/pdf', [
            'as' => 'alumni',
            'uses' => 'Admin\SiswaController@getPdfAlumni'
        ]);
/* Kelas Route */
    Route::get('kelas', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@index'
        ]);
    Route::get('master/kelas', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@addKelas'
        ]);
    Route::post('master/kelas', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@addNewKelas'
        ]);
    Route::get('master/kelas/edit/{id}', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@editKelas'
        ]);
    Route::post('master/kelas/edit/{id}', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@updateKelas'
        ]);
    Route::post('master/kelas/destroy/{id_kelas}', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@destroyKelas'
        ]);
    Route::post('kelas', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@buatKelas'
        ]);
    Route::get('kelas/tahun/siswa', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@getTahun'
        ]);
    Route::get('kelas/add/siswa', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@getSiswa'
        ]);
    Route::post('kelas/siswa', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@addNewSiswa'
        ]);
    Route::get('kelas/edit/{id}', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@edit'
        ]);
    Route::post('kelas/edit/{id}', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@update'
        ]);
    Route::post('kelas/delete/{id}', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@delKelas'
        ]);
    Route::post('kelas/drop/{kode_kelas}', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@drop'
        ]);
    Route::post('kelas/destroy/{id_kelas}/{id_siswa}', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@destroy'
        ]);
    Route::get('kelas/{id_kelas}', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@lihatKelas'
        ]);
    Route::get('kelas/{id_kelas}/pdf', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@getPdf'
        ]);
    Route::get('kelas/{id_kelas}/excel', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@getExcel'
        ]);
    Route::post('kelas/alumni', [
            'as' => 'kelas',
            'uses' => 'Admin\KelasController@setAlumni'
        ]);
// Route tahun ajaran
    Route::get('tahun', [
            'as' => 'tahun',
            'uses' => 'Admin\TahunController@index'
        ]);
    Route::get('data', [
            'as' => 'tahun',
            'uses' => 'Admin\TahunController@listTahun'
        ]);
    Route::post('tahun/add', [
            'as' => 'tahun',
            'uses' => 'Admin\TahunController@addNew'
        ]);
    Route::get('tahun/show/{id_tahun}', [
            'as' => 'tahun',
            'uses' => 'Admin\TahunController@show'
        ]);
    Route::get('tahun/hide/{id_tahun}', [
            'as' => 'tahun',
            'uses' => 'Admin\TahunController@hide'
        ]);
    Route::get('tahun/edit/{id_tahun}', [
            'as' => 'tahun',
            'uses' => 'Admin\TahunController@edit'
        ]);
    Route::post('tahun/edit/{id_tahun}', [
            'as' => 'tahun',
            'uses' => 'Admin\TahunController@update'
        ]);
    Route::post('tahun/delete/{id_tahun}', [
            'as' => 'tahun',
            'uses' => 'Admin\TahunController@destroy'
        ]);
// Route mata pelajaran & download materi
    Route::get('pelajaran', [
            'as' => 'pelajaran',
            'uses' => 'Admin\PelajaranController@index'
        ]);
    Route::post('pelajaran', [
            'as' => 'pelajaran',
            'uses' => 'Admin\PelajaranController@addNew'
        ]);
    Route::get('pelajaran/edit/{id_matpel}', [
            'as' => 'pelajaran',
            'uses' => 'Admin\PelajaranController@edit'
        ]);
    Route::post('pelajaran/edit/{id_matpel}', [
            'as' => 'pelajaran',
            'uses' => 'Admin\PelajaranController@update'
        ]);
    Route::post('pelajaran/delete/{id_matpel}', [
            'as' => 'pelajaran',
            'uses' => 'Admin\PelajaranController@destroy'
        ]);
    Route::get('materi', [
            'as' => 'materi',
            'uses' => 'Admin\PelajaranController@formUpload'
        ]);
    Route::post('materi', [
            'as' => 'materi',
            'uses' => 'Admin\PelajaranController@upload'
        ]);
    Route::post('materi/delete/{id_download}', [
            'as' => 'materi',
            'uses' => 'Admin\PelajaranController@destDownload'
        ]);
    Route::get('materi/pdf', [
            'as' => 'materi',
            'uses' => 'Admin\PelajaranController@getPdf'
        ]);
    Route::get('jadwal', [
            'as' => 'materi',
            'uses' => 'Admin\PelajaranController@jadwal'
        ]);
    Route::post('jadwal', [
            'as' => 'materi',
            'uses' => 'Admin\PelajaranController@uploadJadwal'
        ]);
    Route::post('jadwal/delete/{id_jadwal}', [
            'as' => 'materi',
            'uses' => 'Admin\PelajaranController@destJadwal'
        ]);
// Route Nilai siswa
    Route::get('nilai', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@index'
        ]);
    Route::get('carinilai', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@cariNilai'
        ]);
    Route::get('nilai/pdf/{pelajaran}/{semester}/{kelas}', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@getPdf'
        ]);
    Route::get('input', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@input'
        ]);
    Route::post('input', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@setNilai'
        ]);
    Route::get('input/nilai', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@getSiswa'
        ]);
    Route::get('kelola', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@kelolaNilai'
        ]);
    Route::get('kelola/{id_kelas}/{id_pel}', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@tugasSatu'
        ]);
    Route::get('kelola/{id_kelas}/{id_pel}/satu', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@tugasSatu'
        ]);
    Route::post('kelola/satu/{id_kelas}', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@nilaiTugasSatu'
        ]);
    Route::post('kelola/satu/', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@updateTugasSatu'
        ]);
    Route::get('kelola/{id_kelas}/{id_pel}/dua', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@tugasDua'
        ]);
    Route::post('kelola/dua/', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@nilaiTugasDua'
        ]);
    Route::get('kelola/{id_kelas}/{id_pel}/uts', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@uts'
        ]);
    Route::post('kelola/uts/', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@nilaiUts'
        ]);
    Route::get('kelola/{id_kelas}/{id_pel}/uas', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@uas'
        ]);
    Route::post('kelola/uas/', [
            'as' => 'nilai',
            'uses' => 'Admin\NilaiSiswaController@nilaiUas'
        ]);
    // Route Data statis
    Route::get('data-sekolah', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@index'
        ]);
    Route::get('data-sekolah/{id_data}', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@editData'
        ]);
    Route::post('data-sekolah/{id_data}', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@updateData'
        ]);
    Route::get('profile-sekolah/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@profileSekolah'
        ]);
    Route::post('profile-sekolah/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@profileSekolahUpdate'
        ]);
    Route::get('menu-front', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@getMenuFront'
        ]);
    Route::get('list-menu-front', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@getListMenuFront'
        ]);
    Route::post('menu-front/aktiv/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@aktiv'
        ]);
    Route::post('menu-front', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@addNewMenu'
        ]);
    Route::get('menu-front/edit/{id}', [
            'as' => 'menu',
            'uses' => 'Admin\DataStatisController@edit'
        ]);
    Route::post('menu-front/{id_menu}', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@updateMenu'
        ]);
    Route::post('menu-front/delete/{id_menu}', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@delete'
        ]);
    Route::post('menu-front/nonaktiv/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataStatisController@nonaktiv'
        ]);
    // Data dinamis
    Route::get('indexs-berita', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@indexBerita'
        ]);
    Route::post('indexs-berita', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@addNew'
        ]);
    Route::post('indexs-berita/delete/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@delete'
        ]);
    Route::get('indexs-berita/edit/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@editBerita'
        ]);
    Route::post('indexs-berita/update/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@updateBerita'
        ]);
    Route::get('pengumuman', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@indexPengumuman'
        ]);
    Route::post('pengumuman', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@addNewPengumuman'
        ]);
    Route::get('pengumuman/edit/{id_pengumuman}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@editPengumuman'
        ]);
    Route::post('pengumuman/update/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@updatePengumuman'
        ]);
    Route::post('pengumuman/delete/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@deletePengumuman'
        ]);
    Route::get('agenda', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@indexAgenda'
        ]);
    Route::post('agenda', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@addNewAgenda'
        ]);
    Route::get('agenda/edit/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@editAgenda'
        ]);
    Route::post('agenda/update/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@updateAgenda'
        ]);
    Route::post('agenda/delete/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@deleteAgenda'
        ]);
    Route::get('gallery', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@indexGallery'
        ]);
    Route::get('gallery/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@getGallery'
        ]);
    Route::post('gallery/album', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@addNewAlbum'
        ]);
    Route::post('gallery/foto', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@addNewFoto'
        ]);
    Route::post('gallery/delete/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@deleteFoto'
        ]);
    Route::post('gallery/album-delete/{id}', [
            'as' => 'data',
            'uses' => 'Admin\DataDinamisController@deleteAlbum'
        ]);
});


/*
|--------------------------------------------------------------------------
| Route Group Siswa
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:siswa'], function(){
    Route::get('dashboard', [
            'as' => 'siswa',
            'uses' => 'Siswa\SiswaController@index'
        ]);
    Route::get('dashboard/logout', [
            'as' => 'siswa',
            'uses' => 'Siswa\SiswaController@logout'
        ]);
    Route::get('kelasku', [
            'as' => 'siswa',
            'uses' => 'Siswa\SiswaController@getKelas'
        ]);
    Route::get('jadwal/{id_jadwal}', [
            'as' => 'siswa',
            'uses' => 'Siswa\SiswaController@jadwal'
        ]);
    Route::get('nilaiku', [
            'as' => 'nilai',
            'uses' => 'Siswa\SiswaController@lihatNilai'
        ]);
    Route::get('lihat_nilai', [
            'as' => 'nilai',
            'uses' => 'Siswa\SiswaController@getNilai'
        ]);
    Route::get('print/{semester?}', [
            'as' => 'nilai',
            'uses' => 'Siswa\SiswaController@getPdf'
        ]);
    Route::get('semester', [
            'as' => 'nilai',
            'uses' => 'Siswa\SiswaController@getSemester'
        ]);
    Route::get('download', [
            'as' => 'download',
            'uses' => 'Siswa\SiswaController@download'
        ]);
    Route::get('download/{id_download}', [
            'as' => 'download',
            'uses' => 'Siswa\SiswaController@getDownload'
        ]);
    Route::get('profile', [
            'as' => 'siswa',
            'uses' => 'Siswa\SiswaController@profile'
        ]);
    Route::post('profile', [
            'as' => 'siswa',
            'uses' => 'Siswa\SiswaController@UpdateProfile'
        ]);
});

Route::get('/testkelas', function(){
    $kelas=App\Models\KelasApp::all();
    foreach($kelas as $kel){
        echo $kel->getWaliKelas->nama_guru;
    }

});
Route::get('/lihatkelas/{id}', function($id){
    $kelas=App\Models\KelasSiswaApp::find(['kode_kelas' => $id]);
    
    foreach($kelas as $kel){
       $kode = $kel->kode_kelas;
         $k=App\Models\KelasSiswaApp::where('kode_kelas', $kode);
         echo $kel->getSiswa->nama;
    }

         $gurus = App\Models\User::all();
         $wali = App\Models\KelasApp::find(['kode_kelas' => $id]);
         $w = App\Models\KelasApp::findOrfail($id);
         foreach($wali as $wal){
            echo $wal->getWaliKelas->nama_guru;
         }
         //echo $w->guru_id;

});
// Route::get('alumni', function(){
    

//         $kelas = App\Models\KelasSiswaApp::all();
//         foreach($kelas as $kel){
//             $siswa = App\Models\SiswaApp::all();
//             foreach($siswa as $s){
//                 if($kel->siswa_id !== $s->id_siswa){
//                     $table = array(
//                             'status' => 'siswa'
//                         );
//                     App\Models\SiswaApp::where('id_siswa',$s->id_siswa)->update($table);
//                 }
//                 elseif(count($kel->siswa_id) == 0){
//                     $table = array(
//                             'status' => 'siswa'
//                         );
//                     App\Models\SiswaApp::where('id_siswa',$s->id_siswa)->update($table);
//                 }
//             }
            
//         }
        
    
// });

