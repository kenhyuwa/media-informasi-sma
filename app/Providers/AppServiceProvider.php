<?php

namespace App\Providers;
use App\Models\MenuFrontApp;
use App\Models\Identitas;
use App\Models\GaleriApp;
use App\Models\BeritaApp;
use App\Models\PengumumanApp;
use App\Models\AgendaApp;
use App\Models\PesanApp;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $identitas = Identitas::orderBy('id','desc')->first();
        view()->share('identitas',$identitas);

        $main = MenuFrontApp::where('parent_id', 0)
                    // ->where('level', 0)
                    ->where('is_aktiv', 1)
                    ->get();
        view()->share('main', $main);

        $galeri = GaleriApp::orderBy('id_foto','desc')->limit(4)->get();
        view()->share('galeri',$galeri);

        $beritas = BeritaApp::orderBy('id_berita','desc')->limit(3)->get();
        view()->share('beritas',$beritas);

        $pengumumans = PengumumanApp::orderBy('id_pengumuman','desc')->limit(3)->get();
        view()->share('pengumumans',$pengumumans);

        $agenda = AgendaApp::orderBy('id_agenda','desc')->limit(3)->get();
        view()->share('agenda',$agenda);

        $pesans = PesanApp::orderBy('tgl_pesan', 'desc')->get();
        view()->share('pesans',$pesans);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
