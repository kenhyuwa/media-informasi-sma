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
                            <h4 class="modal-title" id="myModalLabel">Form Kelas Siswa</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\KelasController@addNewSiswa','id' => 'addNewSiswa')) !!}
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="tahun_ajaran">Siswa angkatan :</label>
                                  </div>
                                  <div class="form-group col-md-5 col-lg-5 col-xs-12">
                                    <select id="tahun_ajaran" class="form-control select2" name="tahun_ajaran" style="width: 100%;">
                                          <option selected="selected" value="">--pilih--</option>

                                            @foreach ( $tahuns as $tahun )
                                                <option value="{{ $tahun->id_tahun }}">{{ strtoupper($tahun->tahun) }}</option>
                                            @endforeach

                                        </select>
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="nis">NIS :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <select id="nis" class="form-control select2" name="nis" style="width: 100%;">
                                          <option selected="selected" value="">--pilih--</option>

                                            @foreach ( $siswas as $siswa )
                                                <option value="{{ $siswa->id_siswa }}">{{ strtoupper($siswa->nis) }}</option>
                                            @endforeach

                                        </select>
                                        @if($errors->has('nis'))<small class="reds"><i>* {!!$errors->first('nis')!!}</i></small>@endif
                                  </div>
                                  <div class="col-lg-2"></div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="siswa_perkelas">Nama siswa :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <input type="text" name="siswa_perkelas" id="siswa" class="form-control data-add">
                                        @if($errors->has('siswa_perkelas'))<small class="reds"><i>* {!!$errors->first('siswa_perkelas')!!}</i></small>@endif
                                  </div>
                                <div class="col-lg-2">
                                  <input type="hidden" id="id_kelas" name="id_kelas" value="{{ $id }}">
                                </div>
                                </div>
                              </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-kelas-siswa" class="btn btn-sm btn-green">Save</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        <a href="{{ URL('kelas') }}" class="btn btn-sm btn-reds pull-left">Back</a>
                        <button type="button" class="btn btn-sm btn-aqua pull-left" data-toggle="modal" data-target="#modal-tambah">Tambah siswa</button>
                        @if( auth()->user()->hasRole('super-admin') )
                        <button type="button" id="drop" data-id="{{ $id_pdf->id }}" class="btn btn-sm btn-pink pull-left">Kosongkan</button>
                        @else
                        @endif
                        <a href="{{ URL('kelas')}}/{{ $id_pdf->id }}/pdf" target="_blank" class="btn btn-sm btn-reds pull-right"><i class="fa fa-file-pdf-o"></i></a>
                        <!-- <a href="{{ URL('kelas')}}/{{ $id_pdf->id }}/excel" class="btn btn-sm btn-green pull-right"><i class="fa fa-file-excel-o"></i></a> -->
                      </div>
                    </div>
                  <div id="list-siswa" class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                          <div class="row">
                            <div class="col-md-12 col-lg-12 left">
                              <table>
                                <tr>
                                  <td style="height: 25px;">Nama kelas</td><td>&nbsp;:&nbsp;</td><td>
                                    {{ $wali->getKelas->kelas }}
                                  </td>
                                </tr>
                                <tr>
                                  <td style="height: 25px;">Wali kelas</td><td>&nbsp;:&nbsp;</td><td>
                                    {{ ucwords($wali->getWaliKelas->nama_guru) }}
                                  </td>
                                </tr>
                                <tr>
                                  <td style="height: 25px;">Tahun ajaran</td><td>&nbsp;:&nbsp;</td><td>
                                    {{ $wali->getTahunAjar->tahun }}
                                  </td>
                                </tr>
                              </table>
                            </div>
                              <div class="box-footer bottom col-md-12 col-lg-12"></div>
                          </div>
                          {!! Form::open(array('action' => 'Admin\KelasController@setAlumni')) !!}
                        <table id="example1" class="table table-bordered table-hover table-responsive">
                          <thead>
                            <tr>
                              <th width="6">No</th>
                              <?php 
                                  $nama_kelas = $wali->getKelas->kelas;
                                  $jumlah = 1;
                                  $hasil = implode(' ', array_slice(explode(' ', $nama_kelas), 0, $jumlah));
                               ?>
                              @if($hasil == 'XII')
                              <th width="6">Ceklis</th>
                              @else
                              @endif
                              <th><center>NIS</center></th>
                              <th><center>Nama Siswa</center></th>
                              <th><center>Jenis kelamin</center></th>
                              <th><center>Status</center></th>
                                @if( auth()->user()->hasRole('super-admin') )
                              <th width="100"><center>Aksi</center></th>
                                @else
                                @endif
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($lihat_kelas as $kelas)
                            <tr data-id="{{ $id_pdf->id }}" data="{{ $kelas->getSiswa->id_siswa }}">
                              <td><center>{{ $no++ }}</center></td>
                              <?php 
                                  $nama_kelas = $wali->getKelas->kelas;
                                  $jumlah = 1;
                                  $hasil = implode(' ', array_slice(explode(' ', $nama_kelas), 0, $jumlah));
                               ?>
                              @if($hasil == 'XII')
                              <td>
                              <center>
                                <input type="hidden" name="tahun" value="{{ $wali->getTahunAjar->tahun }}">
                                <input type="checkbox" class="cek_alumni" name="alumni[{{ $kelas->getSiswa->id_siswa }}]" value="alumni">
                              </center>
                              </td>
                              @else
                              @endif
                              <td>{{ $kelas->getSiswa->nis }}</td>
                              <td>{{ ucwords($kelas->getSiswa->nama) }}</td>
                              <td>{{ ucfirst($kelas->getSiswa->gender) }}</td>
                              <td>{{ ucfirst($kelas->getSiswa->status) }}</td>
                                @if( auth()->user()->hasRole('super-admin') )
                              <td>
                              <center>
                              <button type="button" class="btn btn-sm btn-reds hapus_siswa_kelas" data="{{ $kelas->getSiswa->id_siswa }}" data-id="{{ $id_pdf->id }}"><i class="fa fa-trash"></i></button>
                              </center>
                              </td>
                                @else
                                @endif
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th width="6">No</th>
                              <?php 
                                  $nama_kelas = $wali->getKelas->kelas;
                                  $jumlah = 1;
                                  $hasil = implode(' ', array_slice(explode(' ', $nama_kelas), 0, $jumlah));
                               ?>
                              @if($hasil == 'XII')
                              <th width="6">Ceklis</th>
                              @else
                              @endif
                              <th><center>NIS</center></th>
                              <th><center>Nama Siswa</center></th>
                              <th><center>Jenis kelamin</center></th>
                              <th><center>Status</center></th>
                                @if( auth()->user()->hasRole('super-admin') )
                              <th width="100"><center>Aksi</center></th>
                                @else
                                @endif
                            </tr>
                          </tfoot>
                        </table>
                        <button type="submit" id="btn-alumni" class="btn btn-aqua">Set alumni</button>
                        {!! Form::close() !!}
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection
@section('script')

<script type="text/javascript">
  //tambah siswa perkelas dan onchange siswa
  $(document).on('change','#tahun_ajaran', function(e){
        console.log(e);

        var id = e.target.value;
        var url =APP_URL+'/'+'kelas/tahun';

        //ajax
        $.get(url+'/siswa?tahun_masuk='+id, function(data){
          $('#nis').empty();
          $.each(data, function(lihat_kelas, setNis){
            $('#nis').append('<option value="'+setNis.id_siswa+'">'+setNis.nis+'</option>');
          });
        });
      });

    $(document).on('change','#nis', function(e){
      console.log(e);

      var id_siswa = e.target.value;
      var url =APP_URL+'/'+'kelas/add';

      //ajax
      $.get(url+'/siswa?id_siswa='+id_siswa, function(data){
        $('#siswa').empty();
        $.each(data, function(lihat_kelas, setNama){
          $('#siswa').attr('value',setNama.nama.toUpperCase());
        });
      });
    });

//nilai blm fix
    $('#nisn').on('change', function(e){
      console.log(e);

      var id_siswa = e.target.value;
      var url =APP_URL+'/'+'input';

      //ajax
      $.get(url+'/nilai?id_siswa='+id_siswa, function(data){
        $('#siswa').empty();
        $.each(data, function(lihat_kelas, setNama,siswa){
          $('#siswa').attr('value',setNama.nama);
        });
      });
    });

    // Validasi input siswa di kelas
  $(document).on('click', '#btn-kelas-siswa', function(){
    var url = $('#addNewSiswa').attr('action');
    var tahun = $('#tahun_ajaran').val();
    var id_kelas = $('#id_kelas').val();
    var nis = $('#nis').val();
    var siswa = $('#siswa').val();
    if(tahun =='' && nis =='' && siswa ==''){
      swal({
                title: "Warning !",
                text: "Silakan pilih Data",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
        return false;
    }
  });

// drop kelas siswa
$(document).ready(function(){
  $(function(){
    $.ajaxSetup({
      type : "post",
      cache : false,
      datatype : "json"
    });
    $(document).on("click", "#drop", function(){
      var id = ($(this).attr('data-id'));
        var url = APP_URL+'/'+'kelas/drop';
      swal({   
        title: "Apakah Anda yakin?",   
        text: "Tetap kosongkan kelas !",   
        type: "warning",
        html: true,   
        showCancelButton: true,   
        // confirmButtonColor: "#DD6B55",   
        confirmButtonColor: "#3edc81",
        confirmButtonText: "Drop",    
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
          swal("Berhasil!", "Kelas berhasil dikosongkan !", "success");   
        } else {     
          swal("Dibatalkan!", "Kelas batal dikosongkan !", "error");   
        } 
      });
    });
  });
});
</script>
@endsection