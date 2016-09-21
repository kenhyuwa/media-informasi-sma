@extends('frontends.layouts.master-home')
@section('title')
| {{ str_slug('data alumni') }}
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
	<div id="main-content" class="index">
		<div class="content-page center">
			<h5><b>Data Alumni SMA Muhammadiyah 1 Simo</b></h5>
			<div class="colomns three">
				<label>Cari alumni :</label>
				<form method="GET" action="{{ URL('page/kesiswaan/data-alumni/cari') }}">
					<input type="text" name="q" class="search" autocomplete="off" placeholder="Search..."><button type="submit" class="button button-search"><i class="fa fa-search fa-2x"></i></button>
				</form>
			</div>
			<div class="card-panel green white-text">Hasil pencarian : <b class="blue">{{$query}}</b></div>
				@if(count($data_alumni))
				<table class="table-alumni">
					<thead>
						<tr>
							<th><center>No</center></th>
							<th><center>NIS</center></th>
							<th><center>NAMA</center></th>
							<th><center>LULUS</center></th>
						</tr>
					</thead>
					<tbody><?php $no = 1; ?>
					@foreach($data_alumni as $data)
						<tr>
							<td><center>{{ $no++ }}</center></td>
							<td>{{ $data->nis }}</td>
							<td>{{ ucwords($data->nama) }}</td>
							<td>{{ $data->tahun_lulus }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				@else
				<div class="card-panel green white-text">Oops.. Data <b class="blue">{{$query}}</b> Tidak Ditemukan</div>
				@endif
		</div>
		<div class="pagina">
			<table>
				<td class="paginate">{{ $data_alumni->links() }}</td>
			</table>
		</div>
	</div>
@endsection()