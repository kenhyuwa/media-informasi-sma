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
                            {!! Form::open(array('action' => 'Admin\SiswaController@addNewExcel','files' =>'true')) !!}
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-12 col-lg-12 col-xs-12">
                                    <label for="excel">Import from Excel :</label>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 col-xs-12">
                                    <input type="file" id="excel" name="file" class="data-add">
                                    @if($errors->has('file'))<small class="reds"><i>* {!!$errors->first('file')!!}</i></small>@endif
                                     @if(Session::has('Error'))<small class="reds"><i>* {!!Session::get('Error')!!}</i></small>@endif
                                    <p class="help-block"><small class="green">* Pilih file Excel</small></p>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 col-xs-12">
                                    <span class="help-block"><small class="blue"><a target="_blank" href="{{ URL('siswa/format') }}">* Lihat format</a></small></span>
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                              </div>
                              <div class="modal-footer bg-green padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-excel" class="btn btn-sm btn-green">Import</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <!-- Modal add-->
                    <div class="modal fade" id="modal-add-siswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div id="add-modal-siswa" class="modal-content">
                          
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <!-- Modal edit-->
                    <div class="modal fade" id="modal-edit-siswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div id="edit-modal-siswa" class="modal-content">
                          
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-add-siswa">Tambah</button>
                        <button type="button" class="btn btn-sm btn-green" data-toggle="modal" data-target="#modal-excel">excel</button>
                        <a href="{{ URL('siswa/pdf')}}" target="_blank" class="btn btn-sm btn-reds pull-right"><i class="fa fa-file-pdf-o"></i></a>
                        <a href="{{ URL('siswa/excel')}}" class="btn btn-sm btn-green pull-right"><i class="fa fa-file-excel-o"></i></a>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-responsive">
                          <thead>
                            <tr>
                              <th width="6">No</th>
                              <th class="hidden-xs"><center>NIS</center></th>
                              <th><center>Nama Siswa</center></th>
                              <th class="hidden-xs"><center>T. Tgl.lahir</center></th>
                              <th class="hidden-xs"><center>Alamat</center></th>
                              <th class="hidden-xs"><center>No. telpon</center></th>
                              <th class="hidden-xs"><center>Kelas</center></th>
                              <th class="hidden-xs"><center>Username</center></th>
                              <th class="hidden-xs"><center>Foto</center></th>
                              <th class="hidden-xs"><center>Status</center></th>
                              <th width="110"><center>Aksi</center></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($siswas as $siswa)
                            <tr data-id="{{ $siswa->id_siswa }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td class="hidden-xs">{{ $siswa->nis }}</td>
                              <td>{{ ucwords($siswa->nama) }}</td>
                              <td class="hidden-xs">
                                <?php //$time=date('d M, Y', strtotime($siswa->tgl_lahir)); ?>
                                {{ucfirst( $siswa->tempat_lahir) }},
                              <?php        
                                $bulan = array(
                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                  );
                                $tgl = date("d", strtotime($siswa->tgl_lahir));
                                $bulank = date("m", strtotime($siswa->tgl_lahir));
                                $tahun = date("Y", strtotime($siswa->tgl_lahir));
                                    for($i=1; $i<=12; $i++){
                                      }
                                      echo $tgl.' '; 
                                      echo $bulan[$bulank].' '; 
                                      echo $tahun;
                              ?>
                              </td>
                              <td class="hidden-xs">{{ ucwords($siswa->alamat) }}</td>
                              <td class="hidden-xs">{{ str_replace("_"," ",$siswa->no_telp) }}</td>
                              <td class="hidden-xs">
                                <center>
                                  @foreach($get_kelas as $get)
                                    <?php 
                                      $id_get = $get->kode_kelas;
                                      $id_siswa = $get->siswa_id;
                                      $kelas_app = App\Models\KelasApp::where(['id' => $id_get])->get()->first(); 
                                    ?>
                                    @if($id_siswa == $siswa->id_siswa)
                                      {{ $kelas_app->getKelas->kelas }}<br/>
                                    @endif
                                    
                                  @endforeach  
                                </center>
                              </td>
                              <td class="hidden-xs">{{ $siswa->username }}</td>
                              <td class="hidden-xs">
                                <center>
                              @if (count($siswa->foto))
                                  <img class="user-images" src="{{asset('uploads-smasimo/images')}}/{{$siswa->foto}}">
                                  @else
                                  <img class="user-images" src="{{asset('uploads-smasimo/images/default.gif')}}">
                              @endif
                                </center>
                              </td>
                              <td class="hidden-xs">
                                <center>
                                    {{ ucfirst($siswa->status) }}
                                </center>
                              </td>
                              <td>
                              <center>
                            @if (!auth()->user()->hasRole('super-admin') && !auth()->user()->hasRole('admin'))
                            <small class="reds"><i>* Anda tidak punya akses</i></small>
                              @else
                              <button type="button" id="edit-siswa" data-id="{{ $siswa->id_siswa }}" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-edit-siswa"><i class="fa fa-edit"></i></button>
                            @endif
                            @if( auth()->user()->hasRole('super-admin') )
                              <button class="btn btn-sm btn-reds hapus_siswa" data-id="{{ $siswa->id_siswa }}"><i class="fa fa-trash"></i></button>
                              @else
                            @endif
                              </center>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th width="6">No</th>
                              <th class="hidden-xs"><center>NIS</center></th>
                              <th><center>Nama Siswa</center></th>
                              <th class="hidden-xs"><center>T. Tgl.lahir</center></th>
                              <th class="hidden-xs"><center>Alamat</center></th>
                              <th class="hidden-xs"><center>No. telpon</center></th>
                              <th class="hidden-xs"><center>Kelas</center></th>
                              <th class="hidden-xs"><center>Username</center></th>
                              <th class="hidden-xs"><center>Foto</center></th>
                              <th class="hidden-xs"><center>Status</center></th>
                              <th width="110"><center>Aksi</center></th>
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
  // add siswa
    var addSiswa = function()
    {
        $.ajax({
            type:'get',
            url:APP_URL+'/'+'siswa/form',
            success: function(data){
                $('#add-modal-siswa').empty().html(data);
            }
        });
    }
    addSiswa();
    var editSiswa = function()
      {
        var id_siswa = 8;
          $.ajax({
              type:'get',
              url:APP_URL+'/'+'siswa/edit/'+id_siswa,
              success: function(data){
                  $('#edit-modal-siswa').empty().html(data);
              }
          });
      }
      editSiswa();
    $(document).on('click','#edit-siswa', function(e){
      console.log(e);

      var id_guru = $(this).attr('data-id');
      var url =APP_URL+'/'+'siswa/edit';

        //ajax
        $.ajax({
          type:'GET',
          url:url+'/'+id_guru,
          data:{id_guru:id_guru},
          success:function(data){
            $('#edit-modal-siswa').empty().html(data);
          }
        })
      });
</script>
@endsection