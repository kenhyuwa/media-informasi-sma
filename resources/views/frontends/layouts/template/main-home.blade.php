<div class="windows8">
  <div class="wBall" id="wBall_1">
    <div class="wInnerBall"></div>
  </div>
  <div class="wBall" id="wBall_2">
    <div class="wInnerBall"></div>
  </div>
  <div class="wBall" id="wBall_3">
    <div class="wInnerBall"></div>
  </div>
  <div class="wBall" id="wBall_4">
    <div class="wInnerBall"></div>
  </div>
  <div class="wBall" id="wBall_5">
    <div class="wInnerBall"></div>
  </div>
</div>
  <div class="box-background">
      <div class="logo"></div>
      <div class="student-top xs-hidden sm-hidden md-hidden"></div>
      <div class="student-bottom xs-hidden sm-hidden md-hidden"></div>
  </div>
  <section class="content">
    <header class="nav-menu">
    <img class="logo-brands" src="{{ asset('uploads/images') }}/{{ $identitas->logo }}">
      <span class="brands-logo">
        <h6>{{ ucwords($identitas->nama_sekolah) }}</h6>
        <h5>{{ strtoupper($identitas->kab_kota) }}</h5>
      </span>
      <input type="checkbox" id="btn-menu">
      <label for="btn-menu"><i class="fa fa-bars"></i></label>
      <nav class="menu">
        <ul>
        @foreach($main as $m)
        <?php $subs = App\models\MenuFrontApp::find($m->id_menu)->where('parent_id', $m->id_menu)
                            ->where('is_aktiv', 1)
                            ->get(); ?>
          @if($subs->count())
          <li class="submenu">
            <a href="{{ URL('') }}/{{ $m->slugs }}" class="a-menu @if($active == $m->slugs) active @endif">
              <span class="icon">
                <i class="icon fa {{ $m->icon_menu }}"></i>
              </span>
              {{ strtoupper($m->nama_menu) }}
              <span class="arrow">
                <i class="fa fa-chevron-left"></i>
              </span>
            </a>
            <ul>
            @foreach ($subs as $sub)
              <li>
                <a href="{{ URL('') }}/page/{{ $m->slugs }}/{{ $sub->slugs }}" class="@if($submenu == $sub->slugs) active @endif">
                  <i class="icon-right fa fa-angle-double-right" aria-hidden="true"></i>
                  {{ strtoupper($sub->nama_menu) }}
                </a>
              </li>
            @endforeach
            </ul>
          </li>
          @else
          <li class="single-menu">
            <a href="{{ URL('/') }}" class="b-menu @if($active == $m->slugs) active @else @endif">
              <span class="icon">
                <i class="icon fa {{ $m->icon_menu }}"></i>
              </span>
                {{ strtoupper($m->nama_menu) }}
            </a>
          </li>
          @endif
        @endforeach
        </ul>
      </nav>
    </header>
    <div id="guestbook" class="guestbook">
      <div class="flat"></div>
        <div class="trigger">
          <a type="button" id="book"><i class="fa fa-chevron-up"></i></a>
        </div>
      <div class="book">
        <div class="title-book">
          <span>Kirim pesan</span>
        </div>
        <div id="user-data"></div>
        <form method="POST" action="{{url(action('Frontends\HomeController@pesan'))}}">
          <label>Nama :</label>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="text" id="username" name="username" class="form-control text" placeholder="Nama minimal 3 karakter" autocomplete="off">
          <div id="email-data"></div>
          <label>E-mail :</label>
          <input type="email" id="email" name="email" class="form-control text" placeholder="yourmail@mail.com" required="true" autocomplete="off">
          <div id="pesan-data"></div>
          <label>Pesan :</label>
          <textarea id="pesan" name="pesan" class="form-control" placeholder="Hello Word" autocomplete="off"></textarea>
          <input type="button" id="btn-book" value="Kirim" name="" class="button-primary u-pull-right">
        </form>
      </div>
    </div>
      <article>
          @yield('head-title')
          <hr class="hr">
              @yield('main-content')
          <hr class="hr-2 none">
            <div class="programs">
              <div id="dropdown-collpase">
                <ul id="accordion" class="accordion">
                  <li>
                    <div class="link"><i class="fa fa-calendar-check-o"></i>AGENDA TERBARU<i class="fa fa-chevron-down"></i></div>
                    <ul class="submenu-accordion">
                      @foreach($agenda as $agenda_baru)
                      <div class="list">
                        <span class="agenda-head head">
                          <h2>{{ ucwords($agenda_baru->tema) }}</h2>
                        </span>
                        <span class='tanggalberita'>
                          <h3>Diposting pada tanggal :
                          <?php        
                              $bulan = array(
                                  '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                );
                              $tgl = date("d", strtotime($agenda_baru->created_at));
                              $bulank = date("m", strtotime($agenda_baru->created_at));
                              $tahun = date("Y", strtotime($agenda_baru->created_at));
                                  for($i=1; $i<=12; $i++){
                                    }
                            ?>
                         {{$tgl}}-{{$bulan[$bulank]}}-{{$tahun}}</br>oleh <b>{{ ucwords($agenda_baru->getAdmin->nama_guru) }}</b></h3>
                        </span><br>
                        <span class="agenda-body isi">
                          {!! $agenda_baru->isi !!}
                        </span>
                        <span class="agenda-body ket">
                          <b>Tanggal</b> : {{ date('d-m-Y',strtotime($agenda_baru->tgl_mulai)) }} sampai {{ date('d-m-Y',strtotime($agenda_baru->tgl_selesai)) }}
                        </span><br>
                        <span class="agenda-body ket">
                          <b>Tempat</b> : {{ ucwords($agenda_baru->tempat) }}
                        </span><br>
                        <span class="agenda-body ket">
                          <b>Waktu</b> : {{ strtoupper($agenda_baru->jam) }}
                        </span><br>
                        <span class="agenda-body ket">
                          <b>Keterangan</b> : {{ $agenda_baru->keterangan }}
                        </span>
                      </div>
                      @endforeach
                    </ul>
                  </li>
                  <li>
                    <div class="link"><i class="fa fa-bullhorn"></i>PENGUMUMAN TERBARU<i class="fa fa-chevron-down"></i></div>
                    <ul class="submenu-accordion">
                      @foreach($pengumumans as $pengumuman)
                      <div class="list">
                        <span class="agenda-head">
                          <h2>{{ ucwords($pengumuman->judul) }}</h2>
                        </span>
                        <span class='tanggalberita'>
                          <h3>Diposting pada tanggal :
                          <?php        
                              $bulan = array(
                                  '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                );
                              $tgl = date("d", strtotime($pengumuman->created_at));
                              $bulank = date("m", strtotime($pengumuman->created_at));
                              $tahun = date("Y", strtotime($pengumuman->created_at));
                                  for($i=1; $i<=12; $i++){
                                    }
                            ?>
                         {{$tgl}}-{{$bulan[$bulank]}}-{{$tahun}}</br>Oleh <b>{{ ucwords($pengumuman->getAdmin->nama_guru) }}</b></h3>
                        </span><br>
                        <span class="agenda-body isi">
                          {!! $pengumuman->isi !!}
                        </span>
                      </div>
                      @endforeach
                    </ul>
                  </li>
                  <li>
                    <div class="link"><i class="fa fa-newspaper-o"></i>BERITA TERBARU<i class="fa fa-chevron-down"></i></div>
                    <ul class="submenu-accordion">
                      @foreach($beritas as $berita)
                      <div class="list">
                        <span class="agenda-head">
                          <h2>{{ ucwords($berita->judul_berita) }}</h2>
                        </span>
                        <span class='tanggalberita'>
                          <h3>Diposting pada tanggal :
                          <?php        
                              $bulan = array(
                                  '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                );
                              $tgl = date("d", strtotime($berita->created_at));
                              $bulank = date("m", strtotime($berita->created_at));
                              $tahun = date("Y", strtotime($berita->created_at));
                                  for($i=1; $i<=12; $i++){
                                    }
                            ?>
                         {{$tgl}}-{{$bulan[$bulank]}}-{{$tahun}}</br>oleh <b>{{ ucwords($berita->getAdmin->nama_guru) }}</b></h3>
                        </span><br>
                        <div class="agenda-body isi">
                          <td>
                            @if(!count($berita->gambar))
                            <img class="berita-images" src="{{ asset('uploads/images/default.gif') }}">
                            @else
                            <img class="berita-images" src="{{ asset('uploads/images') }}/{{ $berita->gambar }}">
                            @endif
                          </td>
                          <td><p>{!! substr($berita->isi_berita,'0','500') !!}...<a class="more" href="{{ URL('berita') }}/{{ $berita->slugs }}">Selengkapnya</a></p></td>
                        </div>
                      </div>
                      @endforeach
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <hr class="hr-2 none">
      </article>
            <div class="large-window">
              <div class="info">
                  <article>
                    <h5>TEMPAT PENDAFTARAN</h5>
                      <span>KANTOR {{ strtoupper($identitas->nama_sekolah) }}</span><br/>
                      <span>{{ ucwords($identitas->alamat_sekolah) }}</span><br/>
                      <span>Telp. {{ $identitas->telepon }}</span>
                    <hr class="hr-2 hr-info none">
                    <h5>WAKTU PENDAFTARAN</h5>
                    <?php 
                      date_default_timezone_set('Asia/Jakarta');

                        $bulan = date('m');

                        if($bulan >= 06 && $bulan <= 07)
                        {
                          echo '<span>MULAI SEKARANG s.d. JULI '. date('Y').'</span><br/>
                                <span>TIAP HARI KERJA</span><br/>
                                <span>JAM 07.00 WIB s.d. 13.30 WIB</span>';
                        }
                        else if($bulan >= 08 && $bulan <= 12)
                        {
                          echo '<span>BATAS WAKTU PENDAFTARAN TELAH LEWAT</span>';
                        }
                        else
                        {
                          echo '<span>BELUM WAKTUNYA PENDAFTARAN</span>';
                        }
                     ?>
                  </article>
                </div>
            </div>
  </section>
  <section class="maps">
    <div class="album">
      <div class="album-inner">
        <div id="dropdown-collpase">
          <ul id="accordion" class="accordion">
            <li class="open-accordion">
              <div class="link"><i class="fa fa-photo purple"></i>FOTO TERBARU</div>
            </li>
          </ul>
        </div>
          <div class="pics-logo">
            <div class="row img-row row-new">
                @foreach($galeri as $album)
                  <figure class="columns three new">
                    <img class="foto" src="{{ asset('uploads/images') }}/{{ $album->images }}">
                    <figcaption class="foto">
                      <p>
                        {{ ucwords($album->keterangan) }}
                      </p>
                    </figcaption>
                  </figure>
                @endforeach
            </div>
              <li><a href="{{ URL('album') }}" class="button button-primary">Lihat Album</a></li>
          </div>
      </div>
    </div>
@yield('maps')
  </section>
<!-- Js script -->
@section('js')
 <script src="{{asset('asset-frontend/Customize/js/jQuery-customize.js')}}"></script>
@endsection