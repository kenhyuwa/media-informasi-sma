@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                  @if(count($nilai_siswa))
                  <div class="left">
                    <a href="{{ URL('nilai') }}" class="btn btn-sm btn-reds left">back</a>
                    <a href="{{ URL('nilai/pdf') }}/{{ $pelajaran }}/{{ $semester }}/{{ $kelas }}" target="_blank" class="btn btn-sm btn-reds pull-right right-15 "><i class="fa fa-file-pdf-o"></i></a>
                  </div>
                  @else
                  @endif
                    <div class="box-body">
                    @if(!count($nilai_siswa))
                       <div class="col-lg-3 col-md-3 hidden-xs"></div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-aqua">
                              <i class="fa fa-info-circle"></i>
                            </span>
                            <div class="info-box-content">
                              <center><h4>Nilai di kelas ini belum tersedia</h4></center>
                              <center><a href="{{ URL('nilai') }}" class="btn btn-sm btn-reds">back</a></center>
                            </div>
                          </div>
                        </div>
                      <div class="col-lg-3 col-md-3 hidden-xs"></div>
                    @else
                     <div class="col-lg-12 col-md-12 col-xs-12">
                      <center><h3>DAFTAR NILAI KELAS {{ $class->getKelas->kelas }}</h3></center>
                       <table class="table table-bordered table-hover table-responsive">
                         <thead>
                           <tr>
                             <th width="8"><center>No</center></th>
                             <th class="hidden-xs" width="90"><center>NIS</center></th>
                             <th><center>Nama siswa</center></th>
                             <th class="hidden-xs" width="90"><center>Tugas 1</center></th>
                             <th class="hidden-xs" width="90"><center>Tugas 2</center></th>
                             <th class="hidden-xs" width="90"><center>UTS</center></th>
                             <th class="hidden-xs" width="90"><center>UAS</center></th>
                             <th width="90"><center>Rata-rata</center></th>
                             <th class="hidden-xs" width="90"><center>Grade</center></th>
                           </tr>
                         </thead>
                         <tbody>
                            @foreach($nilai_siswa as $nilai)
                             <tr>
                               <td><center>{{ $no++ }}</center></td>
                               <td class="hidden-xs">{{ $nilai->getSiswa->nis }}</td>
                               <td>{{ ucwords($nilai->getSiswa->nama) }}</td>
                               <td class="hidden-xs"><center>{{ $nilai->tugas_1 }}</center></td>
                               <td class="hidden-xs"><center>{{ $nilai->tugas_2 }}</center></td>
                               <td class="hidden-xs"><center>{{ $nilai->uts }}</center></td>
                               <td class="hidden-xs"><center>{{ $nilai->uas }}</center></td>
                               <td>
                                 <center>
                                   <?php 
                                      $tugas1 = $nilai->tugas_1;
                                      $tugas2 = $nilai->tugas_2;
                                      $uts = $nilai->uts;
                                      $uas = $nilai->uas;
                                      $rata_rata = $tugas1*(10/100)+$tugas2*(20/100)+$uts*(30/100)+$uas*(40/100);
                                        if(($rata_rata >= 0) && ($rata_rata < 50))
                                        {
                                          $index ='<b class="reds">E</b>';
                                        }
                                        elseif(($rata_rata >= 50) && ($rata_rata < 60))
                                        {
                                          $index ='<b class="yellow">D</b>';
                                        }
                                        elseif(($rata_rata >= 60) && ($rata_rata < 75))
                                        {
                                          $index ='<b class="blue">C</b>';
                                        }
                                        elseif(($rata_rata >= 75) && ($rata_rata < 85))
                                        {
                                          $index ='<b class="black">E</b>';
                                        }
                                        elseif(($rata_rata >= 85) && ($rata_rata <= 100))
                                        {
                                          $index ='<b class="green">A</b>';
                                        }
                                        else
                                        {
                                          $index ='Nilai diluar Jangkauan';
                                        }

                                    ?>{{ $rata_rata }}
                                 </center>
                               </td>
                               <td class="hidden-xs">
                                 <center>
                                   {!! $index !!}
                                 </center>
                               </td>
                             </tr>
                             @endforeach
                         </tbody>
                       </table>
                     </div>
                     <div class="left">
                       <label class="left">Guru <span class="hidden-xs">Mata Pelajaran</span> :</label> {{ ucwords($nilai->getGuru->nama_guru) }}
                     </div>
                      <div class="pull-right right">
                        {{ $nilai_siswa->links() }}
                      </div>
                    @endif
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection