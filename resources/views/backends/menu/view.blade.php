@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                    <!-- Modal add-->
                    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-aqua">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Form Data Managemen Menu</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\MenuController@addNew')) !!}
                              <div id="add-menu" class="modal-body">
                            
                              </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-menu" class="btn btn-sm btn-green">Save</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <!-- Modal edit-->
                    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div id="edit-menu" class="modal-content">
                          
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <?php 
                    $cek_jml = count($menu); 
                    $batas = 32;
                    ?>
                    @if($cek_jml == $batas)
                    @elseif($cek_jml < $batas)
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-create">Tambah</button>
                      </div>
                    </div>
                    @endif
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-responsive">
                          <thead>
                            <tr>
                              <th width="6">No</th>
                              <th><center>Nama Menu</center></th>
                              <th class="hidden-xs"><center>Link</center></th>
                              <th class="hidden-xs"><center>Icon Menu</center></th>
                              <th class="hidden-xs"><center>Aktivasi</center></th>
                              <th class="hidden-xs"><center>Parent Menu</center></th>
                              <th class="hidden-xs"><center>Hak Akses</center></th>
                              <th width="100"><center>Aksi</center></th>
                            </tr>
                          </thead>
                        <tbody>
                        @if( $no = 1 )
                        @foreach ( $menu as $m )
                          <tr data-id="{{ $m->id }}">
                            <td><center>{{ $no++ }}</center></td>
                            <td>{{ $m->nama_menu }}</td>
                            <td class="hidden-xs">{{ $m->link_menu }}</td>
                            <td class="hidden-xs"><center><i class="fa {{ $m->icon_menu }}"></i></center></td>
                            <td class="hidden-xs">
                            <center>
                              @if($m->is_aktiv==1)
                                  <b style="color:#14CD01">AKTIV</b>
                                @else
                                  <b style="color:#FF0000">TIDAK AKTIV</b>
                              @endif
                            </center>
                            </td>
                            <td class="hidden-xs">
                            <center>
                              @if($m->parent_menu <= 1)
                                  Menu
                                @else
                                  Sub Menu
                              @endif
                            </center>
                            </td>
                            <td class="hidden-xs">
                            <center>
                              @if($m->hak_akses==1)
                                  Administrator
                                @elseif($m->hak_akses==2)
                                  Admin & Guru
                                @else
                                  Siswa
                              @endif
                            </center>
                            </td>
                            <td>
                            <center>
                            @if ( $m->parent_menu == 0 )
                            <small><i>Tidak untuk dihapus</i></small>
                             @else
                              <button type="button" id="menu-edit" data-id="{{ $m->id }}" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>
                              <button class="btn btn-sm btn-reds hapus_menu" data-id="{{ $m->id }}"><i class="fa fa-trash"></i></button></a>
                            </center>
                            @endif
                            </td>
                          </tr>
                          @endforeach
                          @endif
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>No</th>
                              <th><center>Nama Menu</center></th>
                              <th class="hidden-xs"><center>Link</center></th>
                              <th class="hidden-xs"><center>Icon Menu</center></th>
                              <th class="hidden-xs"><center>Aktivasi</center></th>
                              <th class="hidden-xs"><center>Parent Menu</center></th>
                              <th class="hidden-xs"><center>Hak Akses</center></th>
                              <th width="100"><center>Aksi</center></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection
@section('script')
<script type="text/javascript">
  // add management menu
    $(document).ready(function(){
      var addMenu = function()
      {
          $.ajax({
              type:'get',
              url:APP_URL+'/'+'addMenu',
              success: function(data){
                  $('#add-menu').empty().html(data);
              }
          });
      }
      addMenu();

      var editMenu = function(id_menu)
      {
        var id_menu = 1;
          $.ajax({
              type:'get',
              url:APP_URL+'/'+'menu/edit/'+id_menu,
              success: function(data){
                  $('#edit-menu').empty().html(data);
              }
          });
      }
      editMenu();
  //edit menu
      $(document).on('click','#menu-edit', function(e){
        console.log(e);

        var id_menu = $(this).attr('data-id');
        var url =APP_URL+'/'+'menu/edit';

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
    });
</script>
@endsection