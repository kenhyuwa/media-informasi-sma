@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                <!-- Modal user-->
                <div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header bg-aqua">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Form Reset Password</h4>
                      </div>
                        <!-- form Edit start -->
                        {!! Form::open(array('action' => 'Admin\AdminController@userReset')) !!}
                          <div class="modal-body">
                            <div class="row">
                              <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                <label for="username">Username :</label>
                              </div>
                              <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                <input type="text" class="form-control data-add" id="data_id_1" name="username" autocomplete="off" placeholder="Username">
                                      @if($errors->has('username'))<small class="reds"><i>* {!!$errors->first('username')!!}</i></small>@endif
                              </div>
                            <div class="col-lg-2"></div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                <label for="password">Password :</label>
                              </div>
                              <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                <input type="password" class="form-control data-add" id="data_id_2" name="password" placeholder="Password">
                                   @if($errors->has('password'))<small class="reds"><i>* {!!$errors->first('password')!!}</i></small>@endif <br/>
                                    <input type="checkbox" name="check" id="show_pass" class="icheckbox"><small>&nbsp;&nbsp;<i>* Show Password</i></small>
                              </div>
                              <div class="col-lg-2">
                                <input type="hidden" name="id_user" id="user" value="">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer bg-aqua padding-teen">
                            <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                            <button type="submit" id="user-admin" class="btn btn-sm btn-green">Reset</button>
                          </div>
                        {!! Form::close() !!}
                    </div>
                  </div>
                </div>
                <!-- /modal -->
                  <div id="list-user">
                    
                  </div>
              </div>
            </div>
          </div>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    var listUser = function()
    {
      $.ajax({
          type:'GET',
          url:APP_URL+'/list-user',
          success:function(data)
          {
            $('#list-user').empty().html(data);
          }
        });
    }
    listUser();

          $.ajaxSetup({
            type : "post",
            cache : false,
            datatype : "json"
          });
          $(document).on("click", "#btn-go-admin", function(){
            var id = ($(this).attr('data-id'));
              var url = APP_URL+'/'+'user/approve';
            swal({   
              title: "Apakah Anda yakin?",   
              text: "Akan dijadikan admin !",   
              type: "warning",
              html: true,   
              showCancelButton: true,   
              // confirmButtonColor: "#DD6B55",   
              confirmButtonColor: "#3edc81",
              confirmButtonText: "Up-Admin",    
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
                          listUser();
                        }
                          if(data.success=='false')
                          {
                            swal({
                              title:'Maaf',
                              text:'User tersebut sudah menjadi Admin',
                              type:'error',
                              showConfirmButton:true
                            });
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

          $.ajaxSetup({
            type : "post",
            cache : false,
            datatype : "json"
          });
          $(document).on("click", "#btn-down-admin", function(){
            var id = ($(this).attr('data-id'));
              var url = APP_URL+'/'+'user/block';
            swal({   
              title: "Apakah Anda yakin?",   
              text: "Keluarkan dari admin !",   
              type: "warning",
              html: true,   
              showCancelButton: true,   
              // confirmButtonColor: "#DD6B55",   
              confirmButtonColor: "#3edc81",
              confirmButtonText: "Down-Admin",    
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
                          listUser();
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
</script>
@endsection