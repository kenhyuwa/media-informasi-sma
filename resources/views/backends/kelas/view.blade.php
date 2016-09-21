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
                            <h4 class="modal-title" id="myModalLabel">Form Buat Kelas</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\KelasController@buatKelas')) !!}
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="kelas">Kelas :</label>
                                  </div>
                                  <div class="form-group col-md-5 col-lg-5 col-xs-12">
                                    <select id="kelas" class="form-control data-add" name="kelas">
                                        <option selected="selected" value="">--pilih--</option>

                                          @foreach ( $kelas as $class )
                                              <option value="{{ $class->id_kelas }}">{{ strtoupper($class->kelas) }}</option>
                                          @endforeach

                                        </select>
                                        @if($errors->has('kelas'))<small class="reds"><i>* {!!$errors->first('kelas')!!}</i></small>@endif
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="wali_kelas">Wali kelas :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <select id="wali_kelas" class="form-control data-add" name="wali_kelas">
                                        <option selected="selected" value="">--pilih--</option>

                                          @foreach ( $gurus as $guru )
                                              <option value="{{ $guru->id_guru }}">{{ ucwords($guru->nama_guru) }}</option>
                                          @endforeach

                                        </select>
                                        @if($errors->has('wali_kelas'))<small class="reds"><i>* {!!$errors->first('wali_kelas')!!}</i></small>@endif
                                  </div>
                                  <div class="col-lg-2"></div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="tahun_ajaran">Tahun ajaran :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <select id="tahun" class="form-control data-add" name="tahun_ajaran">
                                        <option selected="selected" value="">--pilih--</option>

                                          @foreach ( $tahuns as $tahun )
                                              <option value="{{ $tahun->id_tahun }}">{{ strtoupper($tahun->tahun) }}</option>
                                          @endforeach

                                        </select>
                                        @if($errors->has('tahun_ajaran'))<small class="reds"><i>* {!!$errors->first('tahun_ajaran')!!}</i></small>@endif
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                              </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-add-kelas" class="btn btn-sm btn-green">Save</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <!-- Modal Tambah-->
                    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div id="modal-edit-kelas-siswa" class="modal-content">
                          
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-tambah">Buat kelas</button>
                      </div>
                    </div>
                  <div id="table-list" class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <!-- alert -->
                        @if( Session::has( 'success' ) )
                          <div class="alert alert-aqua">
                            <button type="button" class="close" data-dismiss="alert">
                              <i class="fa fa-times"></i>
                            </button>
                            <center>
                              <i class="ace-icon fa fa-warning"></i>
                                <strong>
                                  {{ Session::get('success') }}
                                </strong>
                            </center>
                          </div><!--/alert-->
                          @endif
                        <table id="example1" class="table table-bordered table-hover table-responsive">
                          <thead>
                            <tr>
                              <th width="6">No</th>
                              <th class="hidden-xs"><center>Kode Kelas</center></th>
                              <th><center>Nama kelas</center></th>
                              <th class="hidden-xs"><center>Wali kelas</center></th>
                              <th class="hidden-xs"><center>Tahun ajaran</center></th>
                              <th class="hidden-xs"><center>Status kelas</center></th>
                              <th width="110"><center>Aksi</center></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($kelas_siswa as $kelas)
                            <tr data-id="{{ $kelas->id }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td class="hidden-xs">{{ strtoupper($kelas->getKelas->kode_kelas) }}</td>
                              <td>{{ strtoupper($kelas->getKelas->kelas) }}</td>
                              <td class="hidden-xs">{{ ucwords($kelas->getWaliKelas->nama_guru) }}</td>
                              <td class="hidden-xs">{{ strtoupper($kelas->getTahunAjar->tahun) }}</td>
                              <td class="hidden-xs">
                                <center>
                                  @if($kelas->status == 1)
                                    {{ 'AKTIV' }}
                                    @else
                                    {{ 'TIDAK AKTIV' }}
                                  @endif
                                </center>
                              </td>
                              <td>
                              <center>
                            @if (!auth()->user()->hasRole('super-admin') && !auth()->user()->hasRole('admin'))
                            <small class="reds"><i>* Anda tidak punya akses</i></small>
                              @else
                              <a href="{{ URL('kelas') }}/{{ $kelas->id }}" class="btn btn-sm btn-green" ><i class="fa fa-search-plus"></i></a>
                            <button type="button" id="btn-kelas-siswa" data-id="{{ $kelas->id }}" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>
                            @endif
                            @if( auth()->user()->hasRole('super-admin') )
                              <button type="button" class="btn btn-sm btn-reds hapus_manage_kelas" data-id="{{ $kelas->id }}"><i class="fa fa-trash"></i></button>
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
                              <th class="hidden-xs"><center>Kode Kelas</center></th>
                              <th><center>Nama kelas</center></th>
                              <th class="hidden-xs"><center>Wali kelas</center></th>
                              <th class="hidden-xs"><center>Tahun ajaran</center></th>
                              <th class="hidden-xs"><center>Status kelas</center></th>
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
  $(document).ready(function()
    {

      var editKelasSiswa = function(id_kelas)
      {

        $.ajax({
          type:'GET',
          url:APP_URL+'/kelas/edit/'+id_kelas,
          success:function(data)
          {
            $('#modal-edit-kelas-siswa').empty().html(data);
          }
        });

      }

      $(document).on('click', '#btn-kelas-siswa', function()
        {
          var id_kelas = $(this).attr('data-id');
          $.ajax({
            type:'GET',
            url:APP_URL+'/kelas/edit/'+id_kelas,
            data:{id_kelas:id_kelas},
            success:function(data)
            {
              $('#modal-edit-kelas-siswa').empty().html(data);
            }
          });
        });

    });
</script>
@endsection