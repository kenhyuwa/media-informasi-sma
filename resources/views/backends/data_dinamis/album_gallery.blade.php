@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                 <!-- Modal add-->
                    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-xs" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-aqua">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Form Upload Foto</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\DataDinamisController@addNewFoto','files' => 'true')) !!}
                              <div id="agenda" class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="nama_menu">Album : </label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                  <input type="hidden"  name="album" value="{{ $exist->id_album }}">
                                    <input type="text" value="{{ ucwords($exist->nama_album) }}" class="form-control" readonly="true">
                                    @if($errors->has('album'))<small class="reds"><i>* {!!$errors->first('album')!!}</i></small>@endif
                                  </div>
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="nama_menu">Keterangan : </label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <textarea type="text" id="keterangan-foto" name="keterangan" class="form-control"></textarea>
                                    @if($errors->has('keterangan'))<small class="reds"><i>* {!!$errors->first('keterangan')!!}</i></small>@endif
                                  </div>
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="nama_menu">Pilih Foto : </label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <input type="file" id="foto" name="foto" class="form-control">
                                    @if($errors->has('foto'))<small class="reds"><i>* {!!$errors->first('foto')!!}</i></small>@endif
                                  </div>
                                  <div class="form-group col-md-3 col-lg-3 hidden-xs"></div>
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <img id="showgambar" src="http://placehold.it/100x100" class="berita-images">
                                  </div>
                                </div>
                            </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-foto" class="btn btn-sm btn-green">Save</button>
                              </div>
                            {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        @if(count($albums))
                        <a href="{{ URL('gallery') }}" class="btn btn-sm btn-reds">back</a>
                        @else
                        @endif
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-create">Tambah</button>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                          @if(count($albums))
                            @foreach($albums as $album)
                            <div id="foto-album" class="col-lg-3 col-md-3 col-xs-12 center" data-id="{{ $album->id_foto }}">
                              <div class="outer-album">
                                <img class="album" src="{{ asset('uploads/images') }}/{{ $album->images }}">
                              </div>
                              @if(auth()->user()->hasRole('super-admin'))
                              <a type="button" id="hapus-foto" data-id="{{ $album->id_foto }}"><i class="fa fa-trash col-flat-red fa-2x"></i></a>
                              @else
                              @endif
                              <p>
                                {{ ucfirst($album->keterangan) }}
                              </p>
                            </div>
                            @endforeach
                          @else
                         <div class="col-lg-3 col-md-3 hidden-xs"></div>
                          <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-aqua">
                                <i class="fa fa-info-circle"></i>
                              </span>
                              <div class="info-box-content">
                                <center><h4>Album masih kosong.</h4></center>
                                <center><a href="{{ URL('gallery') }}" class="btn btn-sm btn-reds">back</a></center>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-3 hidden-xs"></div>
                          @endif
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                     <div class="pull-right right">{{ $albums->links() }}</div>
                  </div>
              </div>
            </div>
          </div>
@endsection
@section('script')
<script type="text/javascript">

// var form = document.getElementById('upload');
// var request = new XMLHttpRequest();

//   form.addEventListener('submit', function(e){
//     e.preventDefault();
//     var formdata = new FormData(form);

//     request.open('post', '/foto');
//     request.addEventListener("load", uploadBerhasil);
//     request.send(formdata);
//   });

//   function uploadBerhasil(data){
//     response = JSON.parse(data.currentTarget.response);
//     if(response.success){
//       document.getElementById('messase').innerHTML = "Upload berhasil."
//     } 
//   }

    $(document).ready(function(){

      $(function(){
        $.ajaxSetup({
          type : "post",
          cache : false,
          datatype : "json"
        });
        $(document).on("click", "#hapus-foto", function(){
          var id = ($(this).attr('data-id'));
            var url = APP_URL+'/'+'gallery/delete';
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
                      $("#foto-album[data-id='"+id+"']").fadeOut("fast", function(){
                        $(this).remove();
                      });
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