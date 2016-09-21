@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                    <!-- Modal Excel-->
                    <div class="modal fade" id="modal-excel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-green">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Form Import Excel</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\GuruController@addNewExcel','files' =>'true')) !!}
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-12 col-lg-12 col-xs-12">
                                    <label for="excel">Import from Excel :</label>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 col-xs-12">
                                    <input type="file" id="excel-guru" name="file">
                                    @if($errors->has('file'))<small class="reds"><i>* {!!$errors->first('file')!!}</i></small>@endif
                                     @if(Session::has('Error'))<small class="reds"><i>* {!!Session::get('Error')!!}</i></small>@endif
                                    <p class="help-block"><small class="green">* Pilih file Excel</small></p>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 col-xs-12">
                                    <span class="help-block"><small class="blue"><a target="_blank" href="{{ URL('guru/format') }}">* Lihat format</a></small></span>
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                              </div>
                              <div class="modal-footer bg-green padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-excel-guru" class="btn btn-sm btn-green">Import</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <!-- Modal add-->
                    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div id="add-modal-guru" class="modal-content">
                          
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <!-- Modal edit-->
                    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div id="edit-modal-guru" class="modal-content">
                          
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-add">tambah</button>
                        <button type="button" class="btn btn-sm btn-green" data-toggle="modal" data-target="#modal-excel">excel</button>
                        <a href="{{ URL('guru/pdf')}}" target="_blank" class="btn btn-sm btn-reds pull-right"><i class="fa fa-file-pdf-o"></i></a>
                        <a href="{{ URL('guru/excel')}}" class="btn btn-sm btn-green pull-right"><i class="fa fa-file-excel-o"></i></a>
                      </div>
                    </div>
                  <div id="list-guru" class="row">
                    
                  </div>
              </div>
            </div>
          </div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function()
  {
      var listGuru = function()
      {

        $.ajax({
          type:'GET',
          url:APP_URL+'/list',
          success:function(data)
          {
            $('#list-guru').empty().html(data);
          }
        });

      }

        listGuru();
      // add guru
        var addGuru = function()
        {
            $.ajax({
                type:'get',
                url:APP_URL+'/'+'guru/form',
                success: function(data){
                    $('#add-modal-guru').empty().html(data);
                }
            });
        }
        addGuru();
        // edit
        var editGuru = function(id)
        {
          var id = 1;
            $.ajax({
                type:'get',
                url:APP_URL+'/'+'guru/edit/'+id,
                success: function(data){
                    $('#edit-modal-guru').empty().html(data);
                }
            });
        }
        editGuru();
        $(document).on('click','#edit-guru', function(e){
          console.log(e);

          var id_guru = $(this).attr('data-id');
          var url =APP_URL+'/'+'guru/edit';

            //ajax
            $.ajax({
              type:'GET',
              url:url+'/'+id_guru,
              data:{id_guru:id_guru},
              success:function(data){
                $('#edit-modal-guru').empty().html(data);
              }
            })
          });

      //approve guru
        $(function(){
          $.ajaxSetup({
            type : "post",
            cache : false,
            datatype : "json"
          });
          $(document).on("click", "#btn-approve", function(){
            var id = ($(this).attr('data-id'));
              var url = APP_URL+'/'+'guru/approve';
            swal({   
              title: "Apakah Anda yakin?",   
              text: "Akan memiliki hak akses !",   
              type: "warning",
              html: true,   
              showCancelButton: true,   
              // confirmButtonColor: "#DD6B55",   
              confirmButtonColor: "#3edc81",
              confirmButtonText: "Approve",    
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
                          listGuru();
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
          $(document).on("click", "#btn-block", function(){
            var id = ($(this).attr('data-id'));
              var url = APP_URL+'/'+'guru/block';
            swal({   
              title: "Apakah Anda yakin?",   
              text: "Tidak akan memiliki hak akses !",   
              type: "warning",
              html: true,   
              showCancelButton: true,   
              // confirmButtonColor: "#DD6B55",   
              confirmButtonColor: "#3edc81",
              confirmButtonText: "Block",    
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
                          listGuru();
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
      // Validasi add guru
      $(document).on('click', '#btn-add-guru', function(){
        var nip = $('#nip').val();
        var nama = $('#nama').val();
        var tempat = $('#tempat_lahir').val();
        var tgl = $('#tanggal1').val();
        var alamat = $('#alamat').val();
        var agama = $('#agama').val();
        var jabatan = $('#jabatan').val();
        var status = $('#status').val();
        var pdd = $('#pdd').val();
        if(nip=='' && nama=='' && tempat=='' && tgl=='' && alamat=='' && agama=='' && jabatan=='' && status=='' && pdd==''){
          swal({
            title:"Warning !",
            text:"Data tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(nip==''){
          swal({
            title:"Warning !",
            text:"NIP tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(nama==''){
          swal({
            title:"Warning !",
            text:"Nama tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(tempat==''){
          swal({
            title:"Warning !",
            text:"Tempat lahir tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(tgl==''){
          swal({
            title:"Warning !",
            text:"Tanggal lahir tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(alamat==''){
          swal({
            title:"Warning !",
            text:"Alamat tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(agama==''){
          swal({
            title:"Warning !",
            text:"Silakan pilih Agama",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(jabatan==''){
          swal({
            title:"Warning !",
            text:"Silakan pilih Jabatan",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(status==''){
          swal({
            title:"Warning !",
            text:"Silakan pilih Status",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(pdd==''){
          swal({
            title:"Warning !",
            text:"Silakan pilih Pendidikan",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
      });
      
      // Validasi edit guru
      $(document).on('click','#form-edit-guru #btn-edit-guru', function(){
        var nip = $('#nips').val();
        var nama = $('#namas').val();
        var tempat = $('#tempat_lahirs').val();
        var tgl = $('#tanggal3').val();
        var alamat = $('#alamats').val();
        var agama = $('#agamas').val();
        var jabatan = $('#jabatans').val();
        var status = $('#statuss').val();
        var pdd = $('#pdds').val();
        if(nip=='' && nama=='' && tempat=='' && tgl=='' && alamat=='' && agama=='' && jabatan=='' && status=='' && pdd==''){
          swal({
            title:"Warning !",
            text:"Data tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(nip==''){
          swal({
            title:"Warning !",
            text:"NIP tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(nama==''){
          swal({
            title:"Warning !",
            text:"Nama tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(tempat==''){
          swal({
            title:"Warning !",
            text:"Tempat lahir tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(tgl==''){
          swal({
            title:"Warning !",
            text:"Tanggal lahir tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(alamat==''){
          swal({
            title:"Warning !",
            text:"Alamat tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(agama==''){
          swal({
            title:"Warning !",
            text:"Silakan pilih Agama",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(jabatan==''){
          swal({
            title:"Warning !",
            text:"Silakan pilih Jabatan",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(status==''){
          swal({
            title:"Warning !",
            text:"Silakan pilih Status",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
        if(pdd==''){
          swal({
            title:"Warning !",
            text:"Silakan pilih Pendidikan",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
      });
      // Validasi import excel guru
      $(document).on('click', '#btn-excel-guru', function(){
        var file = $('#excel-guru').val();
        if(file==''){
          swal({
            title:"Warning !",
            text:"File tidak boleh kosong",
            type:"error",
            timer:1000,
            showConfirmButton:false
          });
            return false;
        }
      });
  });
</script>
@endsection