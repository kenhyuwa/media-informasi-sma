<div class="col-lg-12 col-md-12 col-xs-12">
  <div class="box-body">
    <table id="example1" class="table table-bordered table-hover table-responsive">
      <thead>
        <tr>
          <th width="6">No</th>
          <th class="hidden-xs"><center>NIP</center></th>
          <th><center>Nama Guru</center></th>
          <th class="hidden-xs"><center>T. Tgl.lahir</center></th>
          <th class="hidden-xs"><center>Alamat</center></th>
          <th class="hidden-xs"><center>No. telpon</center></th>
          <th class="hidden-xs"><center>Foto</center></th>
          <th class="hidden-xs"><center>Hak akses</center></th>
          <th width="100"><center>Aksi</center></th>
        </tr>
      </thead>
      <tbody>
      @foreach ($users as $user)
        <tr data-id="{{ $user->id_guru }}">
          <td><center>{{ $no++ }}</center></td>
          <td class="hidden-xs">{{ $user->nip }}</td>
          <td>{{ ucwords($user->nama_guru) }}</td>
          <td class="hidden-xs">
            {{ucfirst( $user->tempat_lahir) }},
          <?php        
            $bulan = array(
                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
              );
            $tgl = date("d", strtotime($user->tgl_lahir));
            $bulank = date("m", strtotime($user->tgl_lahir));
            $tahun = date("Y", strtotime($user->tgl_lahir));
                for($i=1; $i<=12; $i++){
                  }
                  echo $tgl.' '; 
                  echo $bulan[$bulank].' '; 
                  echo $tahun;
          ?>
          </td>
          <td class="hidden-xs">{{ ucwords($user->alamat) }}</td>
          <td class="hidden-xs">{{ str_replace("_"," ",$user->no_telp) }}</td>
          <td class="hidden-xs">
            <center>
          @if (count($user->foto))
              <img class="user-images" src="{{asset('uploads/images')}}/{{$user->foto}}">
              @else
              <img class="user-images" src="{{asset('uploads/images/default.gif')}}">
          @endif
            </center>
          </td>
          <td class="hidden-xs">
            <center>
              @foreach ($user->roles as $role)
                @if ($role->nama_role === 'super-admin')
                  <label><i class="green">Super-admin</i></label>
                  @elseif ($role->nama_role === 'admin')
                  <label><i class="green">Admin</i></label>
                @endif
              @endforeach
              @if ($user->hasRole('super-admin'))
              @elseif ($user->hasRole('admin'))
              @elseif ($user->hasRole('guru'))
              <label><button type="button" id="btn-block" data-id="{{ $user->id_guru }}" class="btn btn-sm btn-reds"><i>Block</i></button></label>
              @else
              <label><button type="button" id="btn-approve" data-id="{{ $user->id_guru }}" class="btn btn-sm btn-green"><i>Approve</i></button></label>
              @endif
              
            </center>
          </td>
          <td>
          <center>
        @if (!auth()->user()->hasRole('super-admin') && $user->hasRole('super-admin'))
        <small class="reds"><i>* Anda tidak punya akses</i></small>
          @else
          <button type="button" id="edit-guru" data-id="{{ $user->id_guru }}" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>
        @endif
        @if( auth()->user()->hasRole('super-admin') )
          <button class="btn btn-sm btn-reds hapus_guru" data-id="{{ $user->id_guru }}"><i class="fa fa-trash"></i></button>
          @else
        @endif
          </center>
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th width="6">No</th>
          <th class="hidden-xs"><center>NIP</center></th>
          <th><center>Nama Guru</center></th>
          <th class="hidden-xs"><center>T. Tgl.lahir</center></th>
          <th class="hidden-xs"><center>Alamat</center></th>
          <th class="hidden-xs"><center>No. telpon</center></th>
          <th class="hidden-xs"><center>Foto</center></th>
          <th class="hidden-xs"><center>Hak akses</center></th>
          <th width="100"><center>Aksi</center></th>
        </tr>
      </tfoot>
    </table>
  </div><!-- /.box-body -->
</div>
<script type="text/javascript">
  // Datatables
  $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
  });
</script>