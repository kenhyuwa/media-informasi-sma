@extends('frontends.layouts.master-home')
@section('title')
| {{ str_slug($berita->judul_berita) }}
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
		<div class="content-page p">
			<h5><b>{{ ucwords($berita->judul_berita) }}</b></h5>
			<div class='keterangan'><i class="fa fa-tags"></i><b><i>Berita</i></b>
			  <?php        
                $bulan = array(
                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                  );
                $tgl = date("d", strtotime($berita->created_at));
                $bulank = date("m", strtotime($berita->created_at));
                $tahun = date("Y", strtotime($berita->created_at));
                $jam = date("H:i:s", strtotime($berita->created_at));
                    for($i=1; $i<=12; $i++){
                      }
              ?>
			 	<i class="fa fa-calendar-check-o"></i>{{ $tgl }}-{{ $bulan[$bulank] }}-{{  $tahun }}
			 	<i class="fa fa-history"></i>{{ $jam }}<br/>
			  oleh <strong>{{ $berita->getAdmin->nama_guru }}</strong></div>
			<td>
				@if(!count($berita->gambar))
                @else
                <img class="berita-images-full" src="{{ asset('uploads/images') }}/{{ $berita->gambar }}">
                @endif
			</td>
			<td>
				{!! $berita->isi_berita !!}
			</td>
		</div>
	</div>
@endsection()
