@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                 <!-- Modal add-->
                    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-aqua">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Form pengumuman</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\DataDinamisController@addNewPengumuman')) !!}
                              <div id="pengumuman" class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tema pengumuman : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <input type="text" id="judul_pengumuman" name="judul_pengumuman" class="form-control" autocomplete="off">
                                    @if($errors->has('judul_pengumuman'))<small class="reds"><i>* {!!$errors->first('judul_pengumuman')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="content">Isi : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea class="form-control" rows="2" id="berita-content" name="content"></textarea>
                                    @if($errors->has('content'))<small class="reds"><i>* {!!$errors->first('content')!!}</i></small>@endif
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="add-pengumuman" class="btn btn-sm btn-green">Save</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-create">Tambah</button>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div id="list-menu" class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-responsive">
                            <thead>
                              <tr>
                                <th width="5">No</th>
                                <th><center>Tema pengumuman</center></th>
                                <th class="hidden-xs"><center>Tanggal Publish</center></th>
                                <th class="hidden-xs"><center>Author</center></th>
                                <th><center>Aksi</center></th>
                              </tr>
                            </thead>
                          <tbody>
                          @if( $no = 1 )
                          @foreach ( $pengumumans as $pengumuman )
                            <tr data-id="{{ $pengumuman->id_pengumuman }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td>{{ ucwords($pengumuman->judul) }}</td>
                              <td class="hidden-xs">
                                <center>
                                  <?php        
                                    $bulan = array(
                                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                      );
                                    $tgl = date("d", strtotime($pengumuman->created_at));
                                    $bulank = date("m", strtotime($pengumuman->created_at));
                                    $tahun = date("Y", strtotime($pengumuman->created_at));
                                    $jam = date("H:i:s", strtotime($pengumuman->created_at));
                                        for($i=1; $i<=12; $i++){
                                          }
                                  ?>
                                  {{ $tgl }}-{{ $bulan[$bulank] }}-{{  $tahun }} JAM {{ $jam }} WIB
                                </center>
                              </td>
                              <td class="hidden-xs">
                                <center>
                                  {{ ucwords($pengumuman->getAdmin->nama_guru) }}
                                </center>
                              </td>
                              <td>
                                <center>
                                  <a href="{{ URL('pengumuman/edit') }}/{{ $pengumuman->id_pengumuman }}" class="btn btn-sm btn-aqua"><i class="fa fa-edit"></i></a>
                              @if(auth()->user()->hasRole('super-admin'))
                                  <a type="button" id="hapus_pengumuman" data-id="{{ $pengumuman->id_pengumuman }}" class="btn btn-sm btn-reds"><i class="fa fa-trash"></i></a>
                                  @else
                                  @endif
                                </center>
                              </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>No</th>
                                <th><center>Tema pengumuman</center></th>
                                <th class="hidden-xs"><center>Tanggal Publish</center></th>
                                <th class="hidden-xs"><center>Author</center></th>
                                <th><center>Aksi</center></th>
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
    $(document).ready(function(){

      $(function(){
        $.ajaxSetup({
          type : "post",
          cache : false,
          datatype : "json"
        });
        $(document).on("click", "#hapus_pengumuman", function(){
          var id = ($(this).attr('data-id'));
            var url = APP_URL+'/'+'pengumuman/delete';
          swal({   
            title: "Apakah Anda yakin?",   
            text: "Tetap menghapus data ini !",   
            type: "warning",
            html: true,   
            showCancelButton: true,   
            // confirmButtonColor: "#DD6B55",   
            confirmButtonColor: "#3edc81",
            confirmButtonText: "Delete",    
            cancelButtonText: "Cancel",   
            closeOnConfirm: false,   
            closeOnCancel: false 
            }, 
            function(isConfirm){   
              if (isConfirm) { 
                  $.ajax({
                    url :url +'/'+id,
                    data : { id:id },
                        beforeSend:function(xhr){
                          var token = $('meta[name="csrf_token"]').attr('content');

                          if(token){
                            return xhr.setRequestHeader('X-CSRF-TOKEN',token);
                          }
                        },
                    success : function(data){
                     if(data.success == 'true'){
                       $("tr[data-id='"+id+"']").fadeOut("fast", function(){
                        $(this).remove();
                      });
                     }
                    }
                  });
                //}     
              swal("Terhapus!", "Data berhasil dihapus !", "success");   
            } else {     
              swal("Dibatalkan!", "Data batal dihapus !", "error");   
            } 
          });
        });
      });
    });
</script>
@endsection