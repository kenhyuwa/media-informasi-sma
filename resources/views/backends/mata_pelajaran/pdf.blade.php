<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{{ ucwords($identitas->nama_sekolah) }} | Data Pelajaran</title>
    <style type="text/css">
      body{ padding: 5px;font-family: Times New Roman;font-size: 14px;padding-top: 20px; }
      table { border: 1px solid #000;margin: 0 auto;margin-bottom: 20px; }
      th { height: 25px;font-size: 14px;padding: 0px 8px; }
      td{ padding: 0px 10px;height: 20px; }
      h4 { margin-bottom: 0px;font-size: 16px; }
      h2 { margin-bottom: 5px !important;margin-top: 5px; }
      h5 { margin-bottom: 0px !important;margin-top: 0px;font-style: normal; }
      h3 { margin-top: -40px;}
      i { margin-bottom: -10px; }
      .hr { border: 1px solid #000;margin-top: 6px; }
      .space { margin-top: 10px; }
      .logo { width: 115px;height: 110px;min-width: 100%;margin-left: 5px;margin-bottom: -6px; }
      .stempel { width: 120px;height: 150px;min-width: 100%;margin-left: -25px;margin-bottom: 100px;background: transparent; }
      .top { margin-top: 20px; }
      #top { height: 100px; }
      #content { margin-top: -20px;height: 400px; }
      #content td { font-size: 14px; padding: 5px 5px; }
      @page { margin: 180px 50px; }
      #header { position: fixed; left: 0px; top: -160px; right: 0px; height: 150px; text-align: center; margin-bottom: -50px;}
      #footer { position: fixed; left: 0px; bottom: -130px; right: 0px; height: 150px; margin-top: 50px; }
      #footer .page:after { content: counter(page, upper-roman); }
    </style>
<body>
  <div id="header">
    <div id="top">
      <table border="0">
        <tr>
          <td>
            <img class="logo" src="{{ asset('asset-sma/OxigGn/avatar/logo.png') }}">
          </td>
          <td class="top">
            <center>
                <h4>{{ strtoupper($identitas->title) }}</h4>
                <h2>{{ strtoupper($identitas->nama_sekolah) }}&nbsp;{{ strtoupper($identitas->kab_kota) }}</h2>
                <h2 style="font-weight: normal;font-size: 20px;">{{ strtoupper($identitas->status_sekolah) }}</h2>
                <h5><i>{{ ucwords($identitas->alamat_sekolah) }},&nbsp;{{ $identitas->telepon }},&nbsp;{{ $identitas->nama_web }}</i></h5>
            </center>
          </td>
        </tr>
      </table>
    </div><br/>
    <div class="hr"></div>
    <div class="space">
      <h2>DATA MATA PELAJARAN</h2>
    </div>
  </div>
  <!-- /header -->
  <div id="footer">
    <table border="0">
      <tr>
        <td width="100"><span class="src-only"></span></td>
        <td width="200"><span class="src-only"></span></td>
        <td width="100">
          &nbsp;&nbsp;{{ ucwords($identitas->kab_kota) }},&nbsp;
                <?php      
                date_default_timezone_set('Asia/Jakarta');      
                  $bulan = array(
                      '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                    );
                  $kode_bulan = date("m");
                      for($i=1; $i<=12; $i++){
                        }
                ?>
                {{ $date=date('d') }} {{ $bulan[$kode_bulan] }} {{ $year=date('Y') }}<br/><br/>
          <center style="margin-top: -13px; z-index: 10">
            Mengetahui :<br/>
            Kepala Sekolah<br/><br/><br/><br/><br/>
            <u>
               @if(count($kepala_sekolah))
                  {{ ucwords($kepala_sekolah->nama_guru) }}
                @else
                  {{ '.......................................' }}
               @endif
            </u>
          </center>
        </td>
      </tr>
    </table>
  </div>
  <!-- /footer -->
  <div id="content">
    <table border="1" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th width="5" style="padding: 5px 0px;font-size: 16px;">No</th>
          <th width="40" style="padding: 5px 0px;font-size: 16px;">Kode pelajaran</th>
          <th width="90" style="padding: 5px 0px;font-size: 16px;">Nama pelajaran</th>
          <th width="75" style="padding: 5px 0px;font-size: 16px;">Keterangan</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($pelajarans as $pelajaran)
        <tr>
          <td><center>{{ $no++ }}</center></td>
          <td>{{ strtoupper($pelajaran->kode_matpel) }}</td>
          <td>{{ ucwords($pelajaran->matpel) }}</td>
          <td>{{ ucwords($pelajaran->keterangan) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /content -->
</body>
</html>