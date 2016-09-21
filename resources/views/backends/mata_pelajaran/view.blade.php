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
                          <h4 class="modal-title" id="myModalLabel">Form Data Mata Pelajaran</h4>
                        </div>
                          <!-- form Edit start -->
                          {!! Form::open(array('action' => 'Admin\PelajaranController@addNew')) !!}
                            <div class="modal-body">
                              <div class="row">
                                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                  <label for="kd_pelajaran">Kode pelajaran :</label>
                                </div>
                                <div class="form-group col-md-5 col-lg-5 col-xs-12">
                                  <input type="text" name="kd_pelajaran" autocomplete="off" class="form-control" value="{{ $newKode }}" readonly="true">
                                </div>
                              <div class="col-lg-2"></div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                  <label for="pelajaran">Mata pelajaran :</label>
                                </div>
                                <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                  <input type="text" id="pel" name="pelajaran" autocomplete="off" class="form-control data-add data-add" placeholder="Ex. Bahasa Indonesia">
                                      @if($errors->has('pelajaran'))<small class="reds"><i>* {!!$errors->first('pelajaran')!!}</i></small>@endif
                                </div>
                              <div class="col-lg-2"></div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                  <label for="keterangan">Keterangan :</label>
                                </div>
                                <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                  {{ Form::select("keterangan",array(
                                                  'wajib'=>'Wajib','tambahan'=>'Tambahan'
                                              ),'',['class' => 'form-control data-add data-add','id' => 'ket','placeholder' => '--pilih--']) }}
                                              @if($errors->has('keterangan'))<small class="reds"><i>* {!!$errors->first('keterangan')!!}</i></small>@endif
                                </div>
                              <div class="col-lg-2"></div>
                              </div>
                            </div>
                            <div class="modal-footer bg-aqua padding-teen">
                              <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                              <button type="submit" id="btn-matpel" class="btn btn-sm btn-green">Save</button>
                            </div>
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <!-- Modal Edit-->
                    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div id="edit-pelajaran" class="modal-content">
                          
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-create">Tambah</button>
                        <a href="{{ URL('materi/pdf')}}" target="_blank" class="btn btn-sm btn-reds pull-right"><i class="fa fa-file-pdf-o"></i></a>
                      </div>
                    </div>
                  <div id="listData" class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-responsive">
                          <thead>
                            <tr>
                              <th width="6">No</th>
                              <th class="hidden-xs"><center>Kode pelajaran</center></th>
                              <th><center>Mata pelajaran</center></th>
                              <th class="hidden-xs"><center>Keterangan</center></th>
                              <th width="70"><center>Aksi</center></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($pelajarans as $pelajaran)
                            <tr data-id="{{ $pelajaran->id_matpel }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td class="hidden-xs">{{ $pelajaran->kode_matpel }}</td>
                              <td>{{ strtoupper($pelajaran->matpel) }}</td>
                              <td class="hidden-xs">{{ strtoupper($pelajaran->keterangan) }}</td>
                              <td>
                              <center>
                            @if (!auth()->user()->hasRole('super-admin') && !auth()->user()->hasRole('admin'))
                            <small class="reds"><i>* Anda tidak punya akses</i></small>
                              @else
                              <button type="button" id="edit-matpel" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-edit" data-id="{{ $pelajaran->id_matpel }}"><i class="fa fa-edit"></i></button>
                            @endif
                            @if( auth()->user()->hasRole('super-admin') )
                              <button type="button" class="btn btn-sm btn-reds hapus_pelajaran" data-id="{{ $pelajaran->id_matpel }}"><i class="fa fa-trash"></i></button>
                              @else
                            @endif
                              </center>
                              </td>
                            </tr><?php //$min++; ?>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th width="6">No</th>
                              <th class="hidden-xs"><center>Kode pelajaran</center></th>
                              <th><center>Mata pelajaran</center></th>
                              <th class="hidden-xs"><center>Keterangan</center></th>
                              <th width="70"><center>Aksi</center></th>
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

    $('.btn-defaulty').click(function(){
        $('.reds').fadeOut();
          $('.data-add').val('');
    });

    var editPelajaran = function(id)
    {
      //var id = 3;

      $.ajax({
        type:"GET",
        url:APP_URL+'/pelajaran/edit/'+id,
        success:function(data){
          $('#edit-pelajaran').empty().html(data);
        }
      });

    }

      //editPelajaran();

    $(document).on('click', '#edit-matpel', function(e){

      console.log(e);

      var id_matpel = $(this).attr('data-id');

      $.ajax({
        type:"GET",
        url:APP_URL+'/pelajaran/edit/'+id_matpel,
        success:function(data){
          $('#edit-pelajaran').empty().html(data);
        }
      });

    });

// delete pelajaran ajax success
  $(function(){
    $.ajaxSetup({
      type : "post",
      cache : false,
      datatype : "json"
    });
    $(document).on("click", ".hapus_pelajaran", function(){
      var id = ($(this).attr('data-id'));
        var url = APP_URL+'/'+'pelajaran/delete';
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