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
                            <h4 class="modal-title" id="myModalLabel">Form Agenda</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\DataDinamisController@addNewAgenda')) !!}
                              <div id="agenda" class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tema agenda : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <input type="text" id="judul_agenda" name="judul_agenda" class="form-control" autocomplete="off">
                                    @if($errors->has('judul_agenda'))<small class="reds"><i>* {!!$errors->first('judul_agenda')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="content">Isi : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea class="form-control" rows="2" id="agenda-content" name="content"></textarea>
                                    @if($errors->has('content'))<small class="reds"><i>* {!!$errors->first('content')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tanggal mulai : </label>
                                  </div>
                                  <div class="form-group col-md-4 col-lg-4 col-xs-12">
                                    <input type="text" id="tanggal1" name="mulai" class="form-control" autocomplete="off">
                                    @if($errors->has('mulai'))<small class="reds"><i>* {!!$errors->first('mulai')!!}</i></small>@endif
                                  </div>
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tanggal selesai : </label>
                                  </div>
                                  <div class="form-group col-md-4 col-lg-4 col-xs-12">
                                    <input type="text" id="tahun1" name="selesai" class="form-control" autocomplete="off">
                                    @if($errors->has('selesai'))<small class="reds"><i>* {!!$errors->first('selesai')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tempat : </label>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 col-xs-12">
                                    <input type="text" id="tempat" name="tempat" class="form-control" autocomplete="off">
                                    @if($errors->has('tempat'))<small class="reds"><i>* {!!$errors->first('tempat')!!}</i></small>@endif
                                  </div>
                                  <div class="form-group col-md-1 col-lg-1 col-xs-12">
                                    <label for="nama_menu">Jam : </label>
                                  </div>
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <input type="text" id="jam" name="jam" class="form-control" autocomplete="off" placeholder="07.30 WIB -10.00 WIB">
                                    @if($errors->has('jam'))<small class="reds"><i>* {!!$errors->first('jam')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Keterangan : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea id="keterangan" name="keterangan" class="form-control" autocomplete="off"></textarea>
                                    @if($errors->has('keterangan'))<small class="reds"><i>* {!!$errors->first('keterangan')!!}</i></small>@endif
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-agenda" class="btn btn-sm btn-green">Save</button>
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
                                <th><center>Tema agenda</center></th>
                                <th width="150" class="hidden-xs"><center>Tanggal</center></th>
                                <th width="150" class="hidden-xs"><center>Jam</center></th>
                                <th width="150" class="hidden-xs"><center>Tempat</center></th>
                                <th width="100"><center>Aksi</center></th>
                              </tr>
                            </thead>
                          <tbody>
                          @if( $no = 1 )
                          @foreach ( $agendas as $agenda )
                            <tr data-id="{{ $agenda->id_agenda }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td>{{ ucwords($agenda->tema) }}</td>
                              <td class="hidden-xs">
                                <center>
                                  <?php        
                                    $bulan = array(
                                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                      );
                                    $tgl = date("d", strtotime($agenda->tgl_mulai));
                                    $bulank = date("m", strtotime($agenda->tgl_mulai));
                                    $tahun = date("Y", strtotime($agenda->tgl_mulai));
                                    $tgl1 = date("d", strtotime($agenda->tgl_selesai));
                                    $bulank1 = date("m", strtotime($agenda->tgl_selesai));
                                    $tahun1 = date("Y", strtotime($agenda->tgl_selesai));
                                        for($i=1; $i<=12; $i++){
                                          }
                                  ?>
                                  {{ $tgl }}-{{ $bulan[$bulank] }}-{{  $tahun }} s.d {{ $tgl1 }}-{{ $bulan[$bulank1] }}-{{  $tahun1 }}
                                </center>
                              </td>
                              <td class="hidden-xs">
                                <center>
                                  {{ $agenda->jam }}
                                </center>
                              </td>
                              <td class="hidden-xs">
                                {{ ucwords($agenda->tempat) }}
                              </td>
                              <td>
                                <center>
                                  <a href="{{ URL('agenda/edit') }}/{{ $agenda->id_agenda }}" class="btn btn-sm btn-aqua"><i class="fa fa-edit"></i></a>
                              @if(auth()->user()->hasRole('super-admin'))
                                  <a type="button" id="hapus_agenda" data-id="{{ $agenda->id_agenda }}" class="btn btn-sm btn-reds"><i class="fa fa-trash"></i></a>
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
                                <th><center>Tema agenda</center></th>
                                <th class="hidden-xs"><center>Tanggal</center></th>
                                <th class="hidden-xs"><center>Jam</center></th>
                                <th width="150" class="hidden-xs"><center>Tempat</center></th>
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
        $(document).on("click", "#hapus_agenda", function(){
          var id = ($(this).attr('data-id'));
            var url = APP_URL+'/'+'agenda/delete';
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