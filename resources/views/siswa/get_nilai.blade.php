@if(!count($nilai_siswa))
   <div class="col-lg-3 col-md-3 hidden-xs"></div>
    <div class="col-lg-6 col-md-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua">
          <i class="fa fa-info-circle"></i>
        </span>
        <div class="info-box-content">
          <center><h4>Nilai belum tersedia.</h4></center>
        </div>
      </div>
    </div>
  <div class="col-lg-3 col-md-3 hidden-xs"></div>
	@else
		<?php foreach( $nilai_siswa as $nilai ){
			$print = $nilai->semester;
		} ?>
		<div class="col-md-12 col-lg-12 col-xs-12">
	<a href="{{ URL('print') }}/{{ $print }}" target="_blank" class="btn btn-sm btn-reds pull-right right-btn"><i class="fa fa-print"></i></a>
</div>
<div class="col-lg-12 col-md-12 col-xs-12">
  <div class="box-body">
  	<table class="table table-bordered table-hover table-responsive">
  		<thead>
  			<tr>
  				<td width="10"><center>No</center></td>
  				<td><center>Mata pelajaran</center></td>
  				<td width="90" class="hidden-xs"><center>Semester</center></td>
  				<td width="90" class="hidden-xs"><center>Nilai tugas-1</center></td>
  				<td width="90" class="hidden-xs"><center>Nilai tugas-2</center></td>
  				<td width="90" class="hidden-xs"><center>Nilai Uts</center></td>
  				<td width="90" class="hidden-xs"><center>Nilai Uas</center></td>
  				<td width="90" class="hidden-xs"><center>Rata-rata</center></td>
  				<td width="90"><center>Grade</center></td>
  				{{-- <td width="50"><center>Cetak</center></td> --}}
  			</tr>
  		</thead>
  		<tbody>
  		@foreach( $nilai_siswa as $nilai )
  			<tr>
  				<td><center>{{ $no++ }}</center></td>
  				<td>{{ strtoupper($nilai->getMatpel->matpel) }}</td>
  				<td class="hidden-xs"><center>{{ strtoupper($nilai->semester) }}</center></td>
  				<td class="hidden-xs"><center>{{ $nilai->tugas_1 }}</center></td>
  				<td class="hidden-xs"><center>{{ $nilai->tugas_2 }}</center></td>
  				<td class="hidden-xs"><center>{{ $nilai->uts }}</center></td>
  				<td class="hidden-xs"><center>{{ $nilai->uas }}</center></td>
  				<td class="hidden-xs">
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
                          $index ='<b class="black">B</b>';
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
  				<td>
  					<center>
  						{!! $index !!}
  					</center>
  				</td>
  				<!-- <td>
  					<center>
  						<a href="" class="btn btn-sm btn-reds"><i class="fa fa-print"></i></a>
  					</center>
  				</td> -->
  			</tr>
  		@endforeach
  		</tbody>
  	</table>
  </div>
</div>
@endif