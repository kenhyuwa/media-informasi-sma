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
                            <h4 class="modal-title" id="myModalLabel">Form Berita</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\DataDinamisController@addNew','files' => 'true')) !!}
                              <div id="berita" class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Judul berita : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <input type="text" id="judul_berita" name="judul_berita" class="form-control" autocomplete="off">
                                    @if($errors->has('judul_berita'))<small class="reds"><i>* {!!$errors->first('judul_berita')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="content">Content : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea class="form-control" rows="2" id="berita-content" name="content"></textarea>
                                    @if($errors->has('content'))<small class="reds"><i>* {!!$errors->first('content')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="content">Gambar : </label>
                                  </div>
                                  <div class="form-group col-md-4 col-lg-4 col-xs-12">
                                    <input type="file" id="foto" class="data-add" name="gambar">
                                    @if($errors->has('gambar'))<small class="reds"><i>* {!!$errors->first('gambar')!!}</i></small>@endif
                                  </div>
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12 pull-right">
                                    <img class="berita-images" src="http://placehold.it/100x100" id="showgambar">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="add-berita" class="btn btn-sm btn-green">Save</button>
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
                                <th width="6">No</th>
                                <th><center>Judul berita</center></th>
                                <th class="hidden-xs"><center>Gambar</center></th>
                                <th class="hidden-xs"><center>Tanggal Publish</center></th>
                                <th width="100"><center>Aksi</center></th>
                              </tr>
                            </thead>
                          <tbody>
                          @if( $no = 1 )
                          @foreach ( $beritas as $berita )
                            <tr data-id="{{ $berita->id_berita }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td>{{ ucwords($berita->judul_berita) }}</td>
                              <td class="hidden-xs">
                                <center>
                                  <img class="user-images" src="{{ asset('uploads/images') }}/{{ $berita->gambar }}">
                                </center>
                              </td>
                              <td class="hidden-xs">
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
                                  {{ $tgl }}-{{ $bulan[$bulank] }}-{{  $tahun }} / {{ $jam }} WIB
                              </td>
                              <td>
                                <center>
                                  <a href="{{ URL('indexs-berita/edit') }}/{{ $berita->id_berita }}" class="btn btn-sm btn-aqua"><i class="fa fa-edit"></i></a>
                              @if(auth()->user()->hasRole('super-admin'))
                                  <a type="button" id="hapus_berita" data-id="{{ $berita->id_berita }}" class="btn btn-sm btn-reds"><i class="fa fa-trash"></i></a>
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
                                <th><center>Judul berita</center></th>
                                <th class="hidden-xs"><center>Gambar</center></th>
                                <th class="hidden-xs"><center>Tanggal Publish</center></th>
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
        $(document).on("click", "#hapus_berita", function(){
          var id = ($(this).attr('data-id'));
            var url = APP_URL+'/'+'indexs-berita/delete';
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

    function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#showgambar').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#foto").change(function () {
          readURL(this);
      });

      $('.btn-defaulty').click(function(){
          $('.reds').fadeOut();
            $('.data-add').val('');
               $('#showgambar').attr('src', 'http://placehold.it/100x100');
      });
      
    });
</script>
@endsection