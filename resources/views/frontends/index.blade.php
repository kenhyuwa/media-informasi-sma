@extends('frontends.layouts.master-home')
@section('title')
| Beranda
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
			<div id="logo-sekolah">
				<img class="logo-sekolah" src="{{ asset('uploads/images') }}/{{ $identitas->logo }}">
			</div>
			<p>
              <h3>Selamat Datang di Website {{ ucwords($identitas->nama_sekolah) }} {{ strtoupper($identitas->kab_kota) }}</h3>
              Kami Menyambut baik terbitnya Website {{ ucwords($identitas->nama_sekolah) }}, dengan dipublikasinya website ini sekolah berharap Peningkatan layanan pendidikan kepada siswa, orangtua, dan masyarakat pada umumnya semakin meningkat. Sebaliknya orangtua dapat mengakses informasi tentang kegiatan akademik dan non akademik putra - puterinya di sekolah ini. Dengan fasilitas ini Siswa dapat mengakses berbagai informasi pembelajaran dan informasi akademik.
          </p>
		</div>
	</div>
@endsection()
@section('maps')
<div class="google-maps">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63282.326164021004!2d110.78379240370822!3d-7.559122617688377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a16627ad11ab1%3A0xe7fe4e0454bc3095!2sSurakarta%2C+Kota+Surakarta%2C+Jawa+Tengah!5e0!3m2!1sid!2sid!4v1473168505549" width="950" height="288" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
@endsection