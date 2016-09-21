@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                    <div class="row">
                      <div class="col-md-12">
                        <a href="{{ URL('alumni/pdf')}}" target="_blank" class="btn btn-sm btn-reds pull-right"><i class="fa fa-file-pdf-o"></i></a>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-responsive">
                          <thead>
                            <tr>
                              <th width="6">No</th>
                              <th class="hidden-xs"><center>NIS</center></th>
                              <th><center>Nama Siswa</center></th>
                              <th class="hidden-xs"><center>T. Tgl.lahir</center></th>
                              <th class="hidden-xs"><center>Alamat</center></th>
                              <th class="hidden-xs"><center>No. telpon</center></th>
                              <th class="hidden-xs"><center>Kelas</center></th>
                              <th class="hidden-xs"><center>Tahun lulus</center></th>
                              <th class="hidden-xs"><center>Foto</center></th>
                              <th class="hidden-xs"><center>Status</center></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($alumnis as $alumni)
                            <tr data-id="{{ $alumni->id_siswa }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td class="hidden-xs">{{ $alumni->nis }}</td>
                              <td>{{ ucwords($alumni->nama) }}</td>
                              <td class="hidden-xs">
                                <?php //$time=date('d M, Y', strtotime($siswa->tgl_lahir)); ?>
                                {{ucfirst( $alumni->tempat_lahir) }},
                              <?php        
                                $bulan = array(
                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                  );
                                $tgl = date("d", strtotime($alumni->tgl_lahir));
                                $bulank = date("m", strtotime($alumni->tgl_lahir));
                                $tahun = date("Y", strtotime($alumni->tgl_lahir));
                                    for($i=1; $i<=12; $i++){
                                      }
                                      echo $tgl.' '; 
                                      echo $bulan[$bulank].' '; 
                                      echo $tahun;
                              ?>
                              </td>
                              <td class="hidden-xs">{{ ucwords($alumni->alamat) }}</td>
                              <td class="hidden-xs">{{ str_replace("_"," ",$alumni->no_telp) }}</td>
                              <td class="hidden-xs">
                                <center>
                                  @foreach($get_kelas as $get)
                                    <?php 
                                      $id_get = $get->kode_kelas;
                                      $id_siswa = $get->siswa_id;
                                      $kelas_app = App\Models\KelasApp::where(['id' => $id_get])->get()->first(); 
                                    ?>
                                    @if($id_siswa === $alumni->id_siswa)
                                      {{ $kelas_app->getKelas->kelas }}<br/>
                                    @endif
                                    
                                  @endforeach  
                                </center>
                              </td>
                              <td class="hidden-xs">{{ $alumni->tahun_lulus }}</td>
                              <td class="hidden-xs">
                                <center>
                              @if (count($alumni->foto))
                                  <img class="user-images" src="{{asset('uploads-smasimo/images')}}/{{$alumni->foto}}">
                                  @else
                                  <img class="user-images" src="{{asset('uploads-smasimo/images/default.gif')}}">
                              @endif
                                </center>
                              </td>
                              <td class="hidden-xs">
                                <center>
                                    {{ ucfirst($alumni->status) }}
                                </center>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th width="6">No</th>
                              <th class="hidden-xs"><center>NIS</center></th>
                              <th><center>Nama Siswa</center></th>
                              <th class="hidden-xs"><center>T. Tgl.lahir</center></th>
                              <th class="hidden-xs"><center>Alamat</center></th>
                              <th class="hidden-xs"><center>No. telpon</center></th>
                              <th class="hidden-xs"><center>Kelas</center></th>
                              <th class="hidden-xs"><center>Tahun lulus</center></th>
                              <th class="hidden-xs"><center>Foto</center></th>
                              <th class="hidden-xs"><center>Status</center></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>

@endsection