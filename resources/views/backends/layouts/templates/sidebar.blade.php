    <div class="container-fluid display-table nav-menu col-lg-12 col-md-12 col-xs-12 @if(auth('siswa')->check())box-background @else @endif">
    <!-- header -->
      <header id="nav-header">
        <div class="col-sm-6 col-md-6 col-lg-12">
          <nav class="navbar-default pull-left">
            <button type="button" class="navbar-toggle collapsed" data-toggle="sidemenu" data-target="#side-menu" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </nav>
        </div>
          <div class="logo-brand">
              <h3>
              @if(auth()->check())
                <a href="{{ URL::to('dashboards') }}"><b>SYSTEM<small class="white"><i>media</i></small></b></a>
                @else
                <a href="{{ URL::to('dashboard') }}"><b>SYSTEM<small class="white"><i>media</i></small></b></a>
              @endif
              </h3>
          </div>
          <!-- profile handle -->
          @if(auth()->check())
            @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
          <div id="profil-btn" class="row hidden-sm hidden-xs pull-right">
            <a class="profile-btn" data-toggle="tooltip" title="Pengingat"><i class="fa fa-cogs fa-2x col-flat-purple"></i></a>
          </div>
            @else
            @endif
          @else
          @endif
        <!-- end profile handle -->
      </header>
      <!-- end header -->
        <!-- profile -->
        @if(auth()->check())
        <div id="profile">
          <div class="row">
              <div class="col-md-2 hidden-xs display-table-cell valign-top" id="side-menu-student">
            <ul>
              <li class="envelope">
                <a type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-pesan"><i class="fa fa-envelope purple"></i> Lihat pesan
                </a>
              </li>
              <li class="active setting-btn">
                <a>
                    <span>
                     Daftar Menu Siswa
                    </span>
                </a>
              </li>
              <!-- menu siswa -->
              <?php
                  $main = App\Models\MenuApp::where('parent_menu', 1)
                                  ->where('is_aktiv', 1)
                                  ->where('hak_akses', 3)
                                  ->get();
                   ?>
              @foreach($main as $m)
              <?php
                $subs = App\Models\MenuApp::find($m->id)->where('parent_menu', $m->id)
                                          ->where('is_aktiv', 1)
                                          ->get();
                ?>
                  <!-- cek menu yang punya parent -->
                      @if($subs->count())
                            <li class="link active" data-id="{{ $m->id }}">
                              <a data-toggle="collapse" aria-controls="up-down_{{ $m->id }}">
                                <span><i class="icon {{ $m->icon_menu }} blue"></i></span>
                                  <span>
                                    {{ strtoupper($m->nama_menu) }}
                                  </span>
                                <i class="icon fa fa-angle-down pull-right"></i>
                              </a>
                              <ul class="collapse collapseable" id="up-down_{{ $m->id }}">
                                  @foreach ($subs as $sub)
                                <li data-id="{{ $sub->id }}">
                                  <a>
                                    <span class="span"><i class="icon fa fa-angle-double-right"></i></span>
                                    <span>
                                      {{ strtoupper($sub->nama_menu) }}
                                    </span>
                                  </a>
                                </li>
                                  @endforeach
                              </ul>
                            </li>
                              @else
                                  <li class="link active" data-id="{{ $m->id }}">
                                    <a>
                                      <span><i class="icon {{ $m->icon_menu }} blue"></i></span>
                                        <span>
                                          {{ strtoupper($m->nama_menu) }}
                                        </span>
                                    </a>
                                  </li>
                      @endif
                      <!-- </end parent -->
              @endforeach
              </ul><!-- /.nav-list -->
            </div>
          </div>
        </div>
        @else
        @endif
        <!-- end profile -->
      <div class="row display-table-row">
      <!-- side menu -->
        <div class="col-md-2 xs-hidden-menu display-table-cell valign-top" id="side-menu">
          <div class="user">
          @if(auth()->check())
              @if (count(auth()->user()->foto))
                <img class="user-photo" src="{{ asset('uploads/images') .'/'. auth()->user()->foto }}">
                @else
                <img class="user-photo" src="{{ asset('uploads/images/default.gif')}}">
              @endif
            @else
              @if (count(auth('siswa')->user()->foto))
                <img class="user-photo" src="{{ asset('uploads-smasimo/images') .'/'. auth('siswa')->user()->foto }}">
                @else
                <img class="user-photo" src="{{ asset('uploads-smasimo/images/default.gif')}}">
              @endif
          @endif
          </div>
            <ul>
              <li class="link logout">
                  <h5>
                  @if(auth()->check())
                    <a href="{{ URL('dashboards/logout') }}" class="tool-tip" data-toggle="tooltip" title="Sign~Out"><i class="fa fa-circle green-icon"></i></a>
                      <i>
                        <?php 
                                $users = (auth()->user()->nama_guru);
                                $jumlah = 2;
                                $hasil = implode(' ', array_slice(explode(' ', $users), 0, $jumlah));
                       ?>{{ ucwords($hasil) }}
                      </i><br>
                      @foreach (Auth::user()->roles as $role)
                        <i class="aqua">
                          {{ ucfirst($role->nama_role) }}
                        </i>
                        @endforeach
                      @else
                    <a href="{{ URL('dashboard/logout') }}" class="tool-tip" data-toggle="tooltip" title="Sign~Out"><i class="fa fa-circle green-icon"></i></a>
                      <i>
                        <?php 
                                $users = (auth('siswa')->user()->nama);
                                $jumlah = 2;
                                $hasil = implode(' ', array_slice(explode(' ', $users), 0, $jumlah));
                       ?>{{ ucwords($hasil) }}
                      </i>
                  @endif
                  </h5>
              </li>
                <!-- Cek user yang login -->
@if(auth()->check())
  @if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
  <?php
    $main = App\Models\MenuApp::where('parent_menu', 1)
                      ->where('is_aktiv', 1)
                      ->where('hak_akses', 1)
                      ->orwhere('hak_akses', 2)
                      //->orwhere('hak_akses', 3)
                      ->get();
       ?>
       @elseif(auth()->user()->hasRole('guru'))
  <?php
      $main = App\Models\MenuApp::where('parent_menu', 1)
                      ->where('is_aktiv', 1)
                      ->where('hak_akses', 2)
                      ->get();
       ?>
       @else
  @endif
@else
<!-- menu siswa -->
<?php
    $main = App\Models\MenuApp::where('parent_menu', 1)
                    ->where('is_aktiv', 1)
                    ->where('hak_akses', 3)
                    ->get();
     ?>
<!-- /menu siswa -->
@endif
<!-- </ end check user login -->
<!-- ambil sub menu -->
@foreach($main as $m)
<?php
  $subs = App\Models\MenuApp::find($m->id)->where('parent_menu', $m->id)
                            ->where('is_aktiv', 1)
                            ->get();
  ?>
    <!-- cek menu yang punya parent -->
        @if($subs->count())
              <li class="link active" data-id="{{ $m->id }}">
                <a href="#up-down_{{ $m->id }}" data-toggle="collapse" aria-controls="up-down_{{ $m->id }}">
                  <span class="icon-left-menu"><i class="icon {{ $m->icon_menu }} blue"></i></span>
                    <span class="menu-title">
                      {{ strtoupper($m->nama_menu) }}
                    </span>
                  <span class="icon-right-menu"><i class="icon fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="collapse collapseable" id="up-down_{{ $m->id }}">
                    @foreach ($subs as $sub)
                  <li data-id="{{ $sub->id }}">
                    <a href="{{ URL('') }}/{{ $sub->link_menu }}">
                      <span class="span"><i class="icon fa fa-angle-double-right"></i></span>
                      <span>
                        {{ strtoupper($sub->nama_menu) }}
                      </span>
                    </a>
                  </li>
                    @endforeach
                </ul>
              </li>
                @else
                    <li class="link active" data-id="{{ $m->id }}">
                      <a href="{{ URL('') }}/{{ $m->link_menu }}">
                        <span><i class="icon {{ $m->icon_menu }} blue"></i></span>
                          <span>
                            {{ strtoupper($m->nama_menu) }}
                          </span>
                      </a>
                    </li>
        @endif
        <!-- </end parent -->
@endforeach
 <!--</end ambil submenu-->
@if(auth()->check())
<!-- ambil menu manajement system -->
<?php
  $mains = App\Models\MenuApp::where('parent_menu', 0)
                ->where('is_aktiv', 1)
                ->orderBy('id', 'desc')
                ->get();
     ?>
@foreach($mains as $ma)
                @if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                    <li class="active setting-btn" data-id="{{ $ma->id }}">
                        <a href="{{ URL('') }}/{{ $ma->link_menu }}">
                            <i class="icon {{ $ma->icon_menu }} aqua"></i>
                            <span>
                               {{ strtoupper($ma->nama_menu) }}
                            </span>
                        </a>
                    </li>
                    @else
                @endif
@endforeach
<!-- </end -->
@else
@endif
                </ul><!-- /.nav-list -->
          <div class="nav-bottom">
          </div>
        </div>
        <!-- end side menu -->
        <div class="col-md-10 display-table-cell valign-top">
        <!-- breadcrumb -->
          <div class="row">
            <div id="nav-breadcrumbs" class="clearfix">
              <div class="col-md-9">
                <div class="breadcrumbs">
                  <h4>
                  <span class="col-flat-silver"><i>{{ ucfirst($isi[2]) }}</i></span>&nbsp;<small><i class="icon fa fa-angle-double-right col-flat-orange"></i></small><small class="col-flat-aqua">&nbsp;<i>{{ ucfirst($isi[3]) }}</i></small>
                  </h4>
                </div>
              </div>
              <div class="col-md-3 hidden-sm hidden-xs">
                <div class="pull-right">
                <?php
                  date_default_timezone_set('Asia/Jakarta');        
                  $bulan = array(
                      '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                    );
                  $kode_bulan = date("m");
                      for($i=1; $i<=12; $i++){
                        }
                ?>
                <div id="header-search-field" class="hidden-sm hidden-xs">
                  <i><i class="fa fa-calendar-check-o aqua"></i>&nbsp; {{ $date=date('d') }} {{ $bulan[$kode_bulan] }} {{ $year=date('Y') }} &nbsp;<i class="fa fa-history aqua"></i>&nbsp; {{ date('H:i') }} WIB</i>
                </div>
                  <!-- <input type="text" class="hidden-sm hidden-xs" id="header-search-field" placeholder="search...">
                  <i class="fa fa-search aqua hidden-sm left"></i> -->
                </div>
              </div>
            </div>
          </div>
          <!-- end breadcrumb -->
          <div class="clearfix"></div>
          <!-- Content area -->
          <div id="main-contain">
            @if(auth()->check())
            @include('backends.pesan.pesan')
            @else
            @endif
            @yield('content')
          </div>