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
                          <div class="info-box">
                                <table class="left">
                                  <tr>
                                    <td style="height: 25px;font-weight: bold;">Wali kelas</td>
                                    <td style="height: 25px;font-weight: bold;">&nbsp;:&nbsp;</td>
                                    <td>
                                      {{ ucwords($keterangan->getWaliKelas->nama_guru) }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="height: 25px;font-weight: bold;">Tahun ajaran</td>
                                    <td style="height: 25px;font-weight: bold;">&nbsp;:&nbsp;</td>
                                    <td>
                                      {{ $keterangan->getTahunAjar->tahun }}
                                    </td>
                                  </tr>
                                </table>
                            <center><h4>MY CLASS - {{ $keterangan->getKelas->kelas }}</h4></center>
                            <table class="table table-bordered table-hover table-responsive">
                              <thead>
                                <tr>
                                  <th width="10"><center>No</center></th>
                                  <th><center>NIS</center></th>
                                  <th><center>Nama</center></th>
                                  <th><center>Jenis kelamin</center></th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach( $semua_siswa as $siswa )
                                <tr>
                                  <td><center>{{ $no++ }}</center></td>
                                  <td>{{ $siswa->getSiswa->nis }}</td>
                                  <td>{{ strtoupper($siswa->getSiswa->nama) }}</td>
                                  <td>{{ ucwords($siswa->getSiswa->gender) }}</td>
                                </tr>
                              @endforeach
                              </tbody>
                            </table>
                          </div><!-- /.info-box -->
                        </div>
                        <!-- tugas -->
                        <div class="col-md-12 col-lg-6 col-xs-12">
                          <!-- box -->
                          @if(!count($jadwal))
                          <div class="info-box">
                            <span class="info-box-icon bg-red">
                              <i class="fa fa-info-circle"></i>
                            </span>
                            <div class="info-box-content">
                              <center><h4>Jadwal belum tersedia</h4></center>
                            </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->
                          @else
                          <div class="info-box">
                            <span class="info-box-icon bg-aqua">
                              <a href="{{ URL('jadwal') }}/{{ $jadwal->id_download }}"><i class="icon-download fa fa-cloud-download"></i></a>
                            </span>
                            <div class="info-box-content">
                              <center><h4>JADWAL KELAS {{ $keterangan->getKelas->kelas }}</h4></center>
                              <center>Silakan unduh Jadwal<span class="hidden-lg hidden-md">.</span> <span class="hidden-xs">melalui icon di samping.</span></center>
                            </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->
                          @endif
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection