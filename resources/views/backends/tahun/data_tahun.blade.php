<table id="example1" class="table table-bordered table-hover table-responsive">
  <thead>
    <tr>
      <th width="6">No</th>
      <th><center>Tahun ajaran</center></th>
      <th class="hidden-xs"><center>Is_aktiv</center></th>
      <th width="100"><center>Aksi</center></th>
    </tr>
  </thead>
  <tbody>
  @foreach($tahuns as $tahun)
    <tr data-id="{{ $tahun->id_tahun }}">
      <td><center>{{ $no++ }}</center></td>
      <td>{{ strtoupper($tahun->tahun) }}</td>
      <td class="hidden-xs">
        <center>
          @if($tahun->is_aktiv === 1)
           <a type="button" id="aktiv_hide" data-id="{{ $tahun->id_tahun }}" class="btn btn-sm btn-green"><i class="fa fa-eye"></i></a>
          @else
            <a type="button" id="aktiv_show" data-id="{{ $tahun->id_tahun }}" class="btn btn-sm btn-reds"><i class="fa fa-eye-slash"></i></a>
          @endif
        </center>
      </td>
      <td>
      <center>
    @if (!auth()->user()->hasRole('super-admin') && !auth()->user()->hasRole('admin'))
    <small class="reds"><i>* Anda tidak punya akses</i></small>
      @else
      <button type="button" id="tahun-edit" class="btn btn-sm btn-aqua " data-toggle="modal" data-target="#modal-edit" data-id="{{ $tahun->id_tahun }}"><i class="fa fa-edit"></i></button>
    @endif
    @if( auth()->user()->hasRole('super-admin') )
      <button  type="button" class="btn btn-sm btn-reds hapus_tahun" data-id="{{ $tahun->id_tahun }}"><i class="fa fa-trash"></i></button>
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
      <th><center>Tahun ajaran</center></th>
      <th class="hidden-xs"><center>Is_aktiv</center></th>
      <th width="70"><center>Aksi</center></th>
    </tr>
  </tfoot>
</table>
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