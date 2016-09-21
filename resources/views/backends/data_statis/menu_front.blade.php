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
                            <h4 class="modal-title" id="myModalLabel">Form Data Menu Frontend</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\DataStatisController@addNewMenu')) !!}
                              <div id="add-menu" class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="hak_akses">ID Menu :</label>
                                  </div>
                                  <div class="form-group col-md-4 col-lg-4 col-xs-12">
                                    <input type="text" class="form-control data-add" id="id_menu" name="id_menu" placeholder="ID Menu" autofocus="autofocus" autocomplete="off">
                                    @if($errors->has('id_menu'))<small class="reds"><i>* {!!$errors->first('id_menu')!!}</i></small>@endif
                                  </div>
                                  <div class="col-lg-5 col-md-5 col-xs-12">
                                    <span class="reds"><small>**<i>Di cek lagi ID-Menu Parent pada tabel</i></small></span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="nama_menu">Nama Menu :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <input type="text" class="form-control data-add" id="nama_menu" name="nama_menu" placeholder="Menu Utama" autofocus="autofocus" autocomplete="off">
                                    @if($errors->has('nama_menu'))<small class="reds"><i>* {!!$errors->first('nama_menu')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="icon_menu">Icon Menu :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <input type="text" class="form-control data-add" id="icon_menu" name="icon_menu" placeholder="fa fa-user" autofocus="autofocus" autocomplete="off">
                                    @if($errors->has('icon_menu'))<small class="reds"><i>* {!!$errors->first('icon_menu')!!}</i></small>@endif
                                    <a target="_blank" href="http://fontawesome.io/icons/">*<small><i> Referensi Icon Menu</i></small></a>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="aktiv_menu">Aktivasi Menu :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                      {{ Form::select("aktiv_menu",array(
                                                    '1'=>'YA','0'=>'Tidak Aktiv'
                                                ),'',['id' => 'aktiv_menu','class' => 'form-control data-add','placeholder' => '--pilih--']) }}
                                    @if($errors->has('aktiv_menu'))<small class="reds"><i>* {!!$errors->first('aktiv_menu')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="parent_menu">Parent Menu :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                      <select class="form-control data-add" name="parent_menu" id="parent_menu">
                                          <option selected="selected" value="">--pilih--</option>
                                        @foreach ( $menu_front as $menu )
                                          @if($menu->id_menu == 1)
                                            @else
                                              <option value="{{ $menu->id_menu }}">{{ strtoupper($menu->nama_menu) }}</option>
                                          @endif
                                        @endforeach

                                      </select>
                                    @if($errors->has('parent_menu'))<small class="reds"><i>* {!!$errors->first('parent_menu')!!}</i></small>@endif
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="menu-front" class="btn btn-sm btn-green">Save</button>
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
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-create">Tambah</button>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div id="list-menu" class="box-body">
                        
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection
@section('script')
<script type="text/javascript">
      //approve guru
$(document).ready(function()
{
  var listMenu = function()
      {

        $.ajax({
          type:'GET',
          url:APP_URL+'/list-menu-front',
          success:function(data)
          {
            $('#list-menu').empty().html(data);
          }
        });

      }
      listMenu();
        $(function(){
          $.ajaxSetup({
            type : "post",
            cache : false,
            datatype : "json"
          });
          $(document).on("click", "#btn-b", function(){
            var id = ($(this).attr('data-id'));
              var url = APP_URL+'/'+'menu-front/aktiv';
            swal({   
              title: "Apakah Anda yakin?",   
              text: "Menu diaktivkan !",   
              type: "warning",
              html: true,   
              showCancelButton: true,   
              // confirmButtonColor: "#DD6B55",   
              confirmButtonColor: "#3edc81",
              confirmButtonText: "Aktiv",    
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
                        if(data.success=='true')
                        {
                          listMenu();
                        }
                      }
                    });
                  //}     
                swal("Berhasil!", "", "success");   
              } else {     
                swal("Dibatalkan!", "", "error");   
              } 
            });
          });
        });
      // block guru
        $(function(){
          $.ajaxSetup({
            type : "post",
            cache : false,
            datatype : "json"
          });
          $(document).on("click", "#btn-a", function(){
            var id = ($(this).attr('data-id'));
              var url = APP_URL+'/'+'menu-front/nonaktiv';
            swal({   
              title: "Apakah Anda yakin?",   
              text: "Menu dinonaktivkan !",   
              type: "warning",
              html: true,   
              showCancelButton: true,   
              // confirmButtonColor: "#DD6B55",   
              confirmButtonColor: "#3edc81",
              confirmButtonText: "Nonaktiv",    
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
                        if(data.success=='true')
                        {
                          listMenu();
                        }
                      }
                    });
                  //}     
                swal("Berhasil!", "", "success");   
              } else {     
                swal("Dibatalkan!", "", "error");   
              } 
            });
          });
        });

          $(function(){
            $.ajaxSetup({
              type : "post",
              cache : false,
              datatype : "json"
            });
            $(document).on("click", "#hapus_menu_front", function(){
              var id = ($(this).attr('data-id'));
                var url = APP_URL+'/'+'menu-front/delete';
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
                            if(data.success == 'false'){
                              swal({   
                                title: "Opps !!!",   
                                text: "Menu yang Anda hapus memiliki Submenu !",   
                                type: "error",
                                showConfirmButton:true
                              });
                            }
                            if(data.success == 'true-false'){
                              swal({   
                                title: "Opps !!!",   
                                text: "Jika Menu ini Anda hapus akan mempengaruhi kerja sistem !",   
                                type: "error",
                                showConfirmButton:true
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