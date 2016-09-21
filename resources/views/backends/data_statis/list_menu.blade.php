<table id="example1" class="table table-bordered table-hover table-responsive">
  <thead>
    <tr>
      <th width="6">No</th>
      <th><center>ID-Menu</center></th>
      <th><center>Nama Menu</center></th>
      <th><center>Link</center></th>
      <th class="hidden-xs"><center>Icon Menu</center></th>
      <th class="hidden-xs"><center>Aktivasi</center></th>
      <th class="hidden-xs"><center>Parent Menu</center></th>
      <th class="hidden-xs"><center>Aksi</center></th>
    </tr>
  </thead>
<tbody>
@if( $no = 1 )
@foreach ( $menu_front as $m )
  <tr data-id="{{ $m->id_menu }}">
    <td><center>{{ $no++ }}</center></td>
    <td><center>{{ $m->id_menu }}</center></td>
    <td>{{ strtoupper($m->nama_menu) }}</td>
    <td><i>{{ strtolower($m->slugs) }}</i></td>
    <td class="hidden-xs"><center><i class="fa {{ $m->icon_menu }}"></i></center></td>
    <td class="hidden-xs">
    <center>
      @if($m->is_aktiv==1)
        <label><a type="button" id="btn-a" data-id="{{ $m->id_menu }}" class="green">Aktiv</a></label>
        @else
        <label><a type="button" id="btn-b" data-id="{{ $m->id_menu }}" class="reds">Nonaktiv</a></label>
      @endif
    </center>
    </td>
    <td class="hidden-xs">
    <center>
      @if($m->parent_id == 0)
          Menu
        @else
          Sub Menu
      @endif
    </center>
    </td>
    <td>
      <center>
        <button type="button" id="menu-edit" data-id="{{ $m->id_menu }}" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>
        <button type="button" id="hapus_menu_front" data-id="{{ $m->id_menu }}" class="btn btn-sm btn-reds"><i class="fa fa-trash"></i></button>
      </center>
    </td>
  </tr>
  @endforeach
  @endif
  </tbody>
  <tfoot>
    <tr>
      <th>No</th>
      <th><center>ID-Menu</center></th>
      <th><center>Nama Menu</center></th>
      <th><center>Link</center></th>
      <th class="hidden-xs"><center>Icon Menu</center></th>
      <th class="hidden-xs"><center>Aktivasi</center></th>
      <th class="hidden-xs"><center>Parent Menu</center></th>
      <th class="hidden-xs"><center>Aksi</center></th>
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
        var editMenu = function(id_menu)
      {
        //var id_menu = 1;
          $.ajax({
              type:'get',
              url:APP_URL+'/'+'menu-front/edit/'+id_menu,
              success: function(data){
                  $('#edit-menu').empty().html(data);
              }
          });
      }
     // editMenu();
  //edit menu
      $(document).on('click','#menu-edit', function(e){
        console.log(e);

        var id_menu = $(this).attr('data-id');
        var url =APP_URL+'/'+'menu-front/edit';

        //ajax
        $.ajax({
          type:'GET',
          url:url+'/'+id_menu,
          data:{id_menu:id_menu},
          success:function(data){
            $('#edit-menu').empty().html(data);
          }
        })
      });
</script>