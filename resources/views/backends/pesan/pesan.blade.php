<!-- Modal user-->
<div class="modal fade" id="modal-pesan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-purple">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pesan masuk</h4>
      </div>
          <div class="modal-body">
          @if(count($pesans))
            @foreach($pesans as $pesan)
            <div id="pesan" class="info-box-content" data-id="{{ $pesan->id_pesan }}">
              <div class="info-box bottom-padd">
                <div class="nama left">
                  <span><i class="fa fa-user aqua"></i>&nbsp;Pengirim :</span><span>{{ ucwords($pesan->nama) }}</span>
                </div>
                <div class="nama left">
                  <span><i class="fa fa-envelope aqua"></i>&nbsp;E-mail :</span><span><i class="blue">{{ $pesan->email }}</i></span>
                </div>
                <div class="nama left">
                    <span>
                      <?php        
                        $bulan = array(
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                          );
                        $tgl = date("d", strtotime($pesan->tgl_pesan));
                        $bulank = date("m", strtotime($pesan->tgl_pesan));
                        $tahun = date("Y", strtotime($pesan->tgl_pesan));
                        $jam = date("H:i:s", strtotime($pesan->tgl_pesan));
                            for($i=1; $i<=12; $i++){
                              }
                      ?>
                    <i class="fa fa-calendar-check-o aqua"></i>&nbsp;{{ $tgl }}-{{ $bulan[$bulank] }}-{{  $tahun }}&nbsp;
                    <i class="fa fa-history aqua"></i>&nbsp;{{ $jam }}<br/>
                    </span>
                </div>
                <div class="nama left">
                  <span>Pesan :</span><br/><span>&quot;&nbsp;{{ ucfirst(substr($pesan->pesan,'0','500')) }}&nbsp;&quot;</span>
                </div>
                @if($pesan->status == 0)
                <a href="{{ URL('pesan/approve') }}/{{ $pesan->id_pesan }}" class="btn btn-sm btn-green"><i class="fa fa-eye-slash"></i></a>
                @else
                <a href="{{ URL('pesan/block') }}/{{ $pesan->id_pesan }}" class="btn btn-sm btn-reds"><i class="fa fa-eye-slash"></i></a>
                @endif
                @if(auth()->user()->hasRole('super-admin'))
                <button id="hapus-pesan" class="btn btn-sm btn-reds" data-id="{{ $pesan->id_pesan }}"><i class="fa fa-trash"></i></button>
                @else
                @endif
              </div>
            </div>
            @endforeach
          @else
            <div id="pesan" class="info-box-content">
              <div class="info-box bottom-padd">
                <center><h3>Tidak Ada pesan.</h3></center>
              </div>
            </div>
          @endif
          </div>
          <div class="modal-footer bg-purple padding-teen">
            <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>
<!-- /modal -->