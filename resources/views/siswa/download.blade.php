@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 col-xs-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body box-inner">
                      <!-- materi -->
                        <div class="col-md-12 col-lg-6 col-xs-12">
                          <!-- box -->
                          @if(!count($materis))
                          <div class="info-box">
                            <span class="info-box-icon bg-aqua">
                              <i class="fa fa-info-circle"></i>
                            </span>
                            <div class="info-box-content">
                              <center><h4>Tidak ada Materi.</h4></center>
                            </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->
                          @else
                          @foreach( $materis as $materi )
                          <div class="info-box">
                            <span class="info-box-icon bg-aqua">
                              <a href="{{ URL::to('download') }}/{{ $materi->id_download }}"><i class="icon-download fa fa-cloud-download"></i></a>
                            </span>
                            <div class="info-box-content">
                              <table>
                                <thead>
                                  <tr><th class="hidden-xs">Keterangan</th><th class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</th><th>&nbsp;&nbsp;{{ ucwords($materi->keterangan) }}&nbsp;Kelas&nbsp;{{ $materi->getKelas->kelas }}</th></tr>
                                  <tr><td class="hidden-xs">Mata pelajaran</td><td class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td>&nbsp;&nbsp;{{ ucwords($materi->mata_pelajaran) }}</td></tr>
                                  <tr class="hidden-xs"><td>Tanggal upload</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td>&nbsp;
                                  <?php        
                                    $bulan = array(
                                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                      );
                                    $tgl = date("d", strtotime($materi->created_at));
                                    $bulank = date("m", strtotime($materi->created_at));
                                    $tahun = date("Y", strtotime($materi->created_at));
                                        for($i=1; $i<=12; $i++){
                                          }
                                          echo $tgl.' '; 
                                          echo $bulan[$bulank].' '; 
                                          echo $tahun;
                                  ?>
                                  </td></tr>
                                  <tr><td class="hidden-xs">Nama file</td><td class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td>&nbsp;&nbsp;<i>{{ strtolower($materi->nama_file) }}</i></td></tr>
                                </thead>
                              </table>
                            </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->
                          @endforeach
                          @endif
                        </div>
                        <!-- tugas -->
                        <div class="col-md-12 col-lg-6 col-xs-12">
                          <!-- box -->
                          @if(!count($tugass))
                          <div class="info-box">
                            <span class="info-box-icon bg-red">
                              <i class="fa fa-info-circle"></i>
                            </span>
                            <div class="info-box-content">
                              <center><h4>Tidak ada Tugas.</h4></center>
                            </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->
                          @else
                          @foreach( $tugass as $tugas )
                          <div class="info-box">
                            <span class="info-box-icon bg-red">
                              <a href="{{ URL::to('download') }}/{{ $tugas->id_download }}"><i class="icon-download fa fa-cloud-download"></i></a>
                            </span>
                            <div class="info-box-content">
                              <table>
                                <thead>
                                  <tr><th class="hidden-xs">Keterangan</th><th class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</th><th>&nbsp;&nbsp;{{ ucwords($tugas->keterangan) }}&nbsp;Kelas&nbsp;{{ $tugas->getKelas->kelas }}</th></tr>
                                  <tr><td class="hidden-xs">Mata pelajaran</td><td class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td>&nbsp;&nbsp;{{ ucwords($tugas->mata_pelajaran) }}</td></tr>
                                  <tr class="hidden-xs"><td>Tanggal upload</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td>&nbsp;
                                  <?php        
                                    $bulan = array(
                                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                      );
                                    $tgl = date("d", strtotime($tugas->created_at));
                                    $bulank = date("m", strtotime($tugas->created_at));
                                    $tahun = date("Y", strtotime($tugas->created_at));
                                        for($i=1; $i<=12; $i++){
                                          }
                                          echo $tgl.' '; 
                                          echo $bulan[$bulank].' '; 
                                          echo $tahun;
                                  ?>
                                  </td></tr>
                                  <tr><td class="hidden-xs">Nama file</td><td class="hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td>&nbsp;&nbsp;<i>{{ strtolower($tugas->nama_file) }}</i></td></tr>
                                </thead>
                              </table>
                            </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->
                          @endforeach
                          @endif
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection