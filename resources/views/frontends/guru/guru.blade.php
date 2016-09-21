@extends('frontends.layouts.master-home')
@section('title')
| {{ str_slug('data guru') }}
@endsection
<!-- css -->
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('asset-frontend/Customize/css/all-custom-front.css') }}">
@endsection
<!-- name head -->
@section('head-title')
	
@endsection
<!-- main content -->
@section('main-content')
	<div id="main-content">
		<div class="content-page center">
			<h5><b>Data Guru SMA Muhammadiyah 1 Simo</b></h5>
				@foreach($data_guru as $data)
			<div class="row">
				<div>
					<img class="berita-images-full" src="{{ asset('uploads/images') }}/{{ $data->foto }}">
				</div>
				<table border="0">
					<tr>
						<td>NIP</td><td>:</td><td>{{ $data->nip }}</td>
					</tr>
					<tr>
						<td>Nama</td><td>:</td><td>{{ ucwords($data->nama_guru) }}</td>
					</tr>
					<tr>
						<td>Kelahiran</td><td>:</td><td>{{ ucwords($data->tempat_lahir) }},
	                              <?php        
	                                $bulan = array(
	                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
	                                  );
	                                $tgl = date("d", strtotime($data->tgl_lahir));
	                                $bulank = date("m", strtotime($data->tgl_lahir));
	                                $tahun = date("Y", strtotime($data->tgl_lahir));
	                                    for($i=1; $i<=12; $i++){
	                                      }
	                                      echo $tgl.' '; 
	                                      echo $bulan[$bulank].' '; 
	                                      echo $tahun;
	                              ?>
	                              	
	                              </td>
					</tr>
					<tr>
						<td>Status</td><td>:</td><td>{{ strtoupper($data->status) }}</td>
					</tr>
					<tr>
						<td>Jabatan</td><td>:</td><td>{{ strtoupper($data->jabatan) }}</td>
					</tr>
				</table>
			</div>
			@endforeach
		</div>
		<div class="pagina">
			<table>
				<td class="paginate">{{ $data_guru->links() }}</td>
			</table>
		</div>
	</div>
@endsection()