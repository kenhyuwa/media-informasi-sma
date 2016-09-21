@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12 top-to-bottom-300">
              <div id="content" class="col-md-12 clearfix content">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-tags icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span>
                                <?php

                                  date_default_timezone_set('Asia/Jakarta');

                                  $waktu = getdate();

                                  if($waktu['hours'] <= 9)
                                  {
                                    echo '<span class="hidden-xs">SELAMAT</span> PAGI';
                                  }
                                  else if($waktu['hours'] <= 14)
                                  {
                                    echo '<span class="hidden-xs">SELAMAT</span> SIANG';
                                  }
                                  else if($waktu['hours'] <= 18)
                                  {
                                    echo '<span class="hidden-xs">SELAMAT</span> SORE';
                                  }
                                  else
                                  {
                                    echo '<span class="hidden-xs">SELAMAT</span> MALAM';
                                  }

                                  $users = (auth('siswa')->user()->nama);
                                  $jumlah = 1;
                                  $hasil = implode(' ', array_slice(explode(' ', $users), 0, $jumlah));

                                 ?> {{ strtoupper($hasil) }}</span><span class="hidden-lg hidden-md">'s</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ $keterangan->getKelas->kelas }}</span>
                              </div>
                            </div>
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection