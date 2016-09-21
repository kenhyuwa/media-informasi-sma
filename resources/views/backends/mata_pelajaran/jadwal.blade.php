@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                    <!-- Modal Upload Jadwal-->
                    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-blue">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Form Upload Jadwal</h4>
                          </div>
                            <!-- form Upload Jadwal start -->
                            {!! Form::open(array('action' => 'Admin\PelajaranController@uploadJadwal','files' =>'true')) !!}
                            <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="kelas_id">Kelas :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <select class="form-control data-add" name="kelas_id" id="kelas">
                                        <option selected="selected" value="">--pilih--</option>

                                          @foreach ( $kelas_apps as $class )
                                              <option value="{{ $class->id_kelas }}">{{ strtoupper($class->kelas) }}</option>
                                          @endforeach

                                        </select>
                                        @if($errors->has('kelas_id'))<small class="reds"><i>* {!!$errors->first('kelas_id')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                   <label for="keterangan">Keterangan :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <input type="text" name="keterangan" value="JADWAL KELAS" class="form-control" readonly="true">
                                                  @if($errors->has('keterangan'))<small class="reds"><i>* {!!$errors->first('keterangan')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="upload">Pilih file :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                      <input type="file" id="upload" name="file" class="form-control data-add">
                                        @if($errors->has('file'))<small class="reds"><i>* {!!$errors->first('file')!!}</i></small>@endif
                                        <p class="help-block"><small class="green">* Pilih file pdf, word</small></p>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer bg-blue padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-upload-jadwal" class="btn btn-sm btn-green">Upload</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-blue" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-upload"></i>&nbsp;Upload jadwal</button>
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
                              <th><center>Keterangan</center></th>
                              <th class="hidden-xs"><center>Nama file</center></th>
                              <th class="hidden-xs"><center>Diupload oleh</center></th>
                              @if(auth()->user()->hasRole('super-admin'))
                              <th width="25"><center>Aksi</center></th>
                              @else
                              @endif
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($jadwals as $jadwal)
                            <tr data-id="{{ $jadwal->id_download }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td>{{ ucwords($jadwal->mata_pelajaran) }}&nbsp;{{ $jadwal->getKelas->kelas }}</td>
                              <td class="hidden-xs"><i>{{ strtolower($jadwal->nama_file) }}</i></td>
                              <td class="hidden-xs">{{ ucwords($jadwal->getAuthor->nama_guru) }}</td>
                              @if(auth()->user()->hasRole('super-admin'))
                              <td>
                              <center>
                                <button type="button" class="btn btn-sm btn-reds hapus_jadwal" data-id="{{ $jadwal->id_download }}"><i class="fa fa-trash"></i></button>
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
                              <th><center>Mata pelajaran</center></th>
                              <th class="hidden-xs"><center>Nama file</center></th>
                              <th class="hidden-xs"><center>Diupload oleh</center></th>
                              @if(auth()->user()->hasRole('super-admin'))
                              <th width="25"><center>Aksi</center></th>
                              @else
                              @endif
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