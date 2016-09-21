@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                    <!-- Modal Tambah-->
                    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-aqua">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Form Data Tahun Ajaran</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\TahunController@addNew')) !!}
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="tahun_ajaran">Tahun ajaran :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <input type="text" id="tahun_ajaran" name="tahun" autocomplete="off" class="form-control data-add" placeholder="ex.2000/2001">
                                      @if($errors->has('tahun'))<small class="reds"><i>* {!!$errors->first('tahun')!!}</i></small>@endif
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                              </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-tahun-add" class="btn btn-sm btn-green">Save</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <!-- Modal Edit-->
                    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div id="modal-edit-tahun" class="modal-content">
                          
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-tambah">Tambah</button>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div id="listTahun" class="box-body">
                        
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

    var listTahun = function()
    {
      $.ajax({
        type:"GET",
        url:APP_URL+'/data',
        success:function(data){
          $('#listTahun').empty().html(data);
        }
      });
    }
    listTahun();

  // Show hide

  $(document).on('click', '#aktiv_hide', function(){
    var id_tahun = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        cache:false,
        datatype:"json",
        url:APP_URL+'/tahun/hide/'+id_tahun,
            beforeSend:function(xhr){
              var token = $('meta[name="csrf_token"]').attr('content');

              if(token){
                return xhr.setRequestHeader('X-CSRF-TOKEN',token);
              }
            },
        success:function(data){
          if(data.success=='true'){
            listTahun();
            swal({
              title:'Success',
              text:'Tahun telah dinonaktivkan',
              type:'success',
              showConfirmButton:true
            });
          }
        }
      });
  });

  $(document).on('click', '#aktiv_show', function(){
    var id_tahun = $(this).attr('data-id');
      $.ajax({
        type:"GET",
        cache:false,
        datatype:"json",
        url:APP_URL+'/tahun/show/'+id_tahun,
            beforeSend:function(xhr){
              var token = $('meta[name="csrf_token"]').attr('content');

              if(token){
                return xhr.setRequestHeader('X-CSRF-TOKEN',token);
              }
            },
        success:function(data){
          if(data.success=='true'){
            listTahun();
            swal({
              title:'Success',
              text:'Tahun telah diaktivkan',
              type:'success',
              showConfirmButton:true
            });
          }
        }
      });
  });

    var ediTahun = function(id)
    {
      $.ajax({
        type:'GET',
        url:APP_URL+'/tahun/edit/'+id,
        success:function(data){
          $('#modal-edit-tahun').empty().html(data);
        }
      });
    }

    $(document).on('click', '#tahun-edit', function(e){
      console.log(e);
      var id = $(this).attr('data-id');
      $.ajax({
        type:'GET',
        url:APP_URL+'/tahun/edit/'+id,
        data:{id_tahun:id},
        success:function(data){
          $('#modal-edit-tahun').empty().html(data);
        }
      });
    });

    $(function(){
      $.ajaxSetup({
        type : "post",
        cache : false,
        datatype : "json"
      });
      $(document).on("click", ".hapus_tahun", function(){
        var id = ($(this).attr('data-id'));
          var url = APP_URL+'/'+'tahun/delete';
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
                      if(data.success =='true'){
                          $("tr[data-id='"+id+"'],li[data-id='"+id+"']").fadeOut("fast", function(){
                          $(this).remove();
                          listTahun();
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