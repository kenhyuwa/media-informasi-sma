@extends('frontends.layouts.master-home')
@section('title')
| {{ str_slug('KEPALA SEKOLAH') }}
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
    <div class="content-page">
      <center><h5><b>KEPALA SEKOLAH</b></h5></center>
        <div class="kepala-sekolah-padd">
          <div class="kepala-sekolah">
            <img src="{{ asset('uploads/images') }}/{{ $kepala_sekolah->foto }}">
          </div>
          <div class="keterangan-kepala-sekolah">
            <table class="kepala-sekolah-data">
              <tr>
                <td>Nama</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td><td>{{ ucwords($kepala_sekolah->nama_guru) }}</td>
              </tr><br/>
              <tr>
                <td>Tempat, TGL. Lahir</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td><td>
                  {{ucfirst( $kepala_sekolah->tempat_lahir) }},
                  <?php        
                    $bulan = array(
                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                      );
                    $tgl = date("d", strtotime($kepala_sekolah->tgl_lahir));
                    $bulank = date("m", strtotime($kepala_sekolah->tgl_lahir));
                    $tahun = date("Y", strtotime($kepala_sekolah->tgl_lahir));
                        for($i=1; $i<=12; $i++){
                          }
                          echo $tgl.' '; 
                          echo $bulan[$bulank].' '; 
                          echo $tahun;
                  ?>
                </td>
              </tr><br/>
              <tr>
                <td>Alamat</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td><td>{{ ucwords($kepala_sekolah->alamat) }}</td>
              </tr>
          </table>
          </div>
        </div>
    </div>
  </div>
@endsection()