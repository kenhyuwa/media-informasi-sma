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
                            <h4 class="modal-title" id="myModalLabel">Form Master Kelas</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => 'Admin\KelasController@addNewKelas')) !!}
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="kode_kelas">Kode kelas :</label>
                                  </div>
                                  <div class="form-group col-md-5 col-lg-5 col-xs-12">
                                    <input type="text" name="kode_kelas" autocomplete="off" class="form-control" value="{{ $newKode }}" readonly="true">
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="kelas">Nama kelas :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <input type="text" id="kelas-master" name="kelas_tambah" autocomplete="off" class="form-control data-add" placeholder="Ex. X1">
                                        @if($errors->has('kelas_tambah'))<small class="reds"><i>* {!!$errors->first('kelas_tambah')!!}</i></small>@endif
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                              </div>
                              <div class="modal-footer bg-aqua padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-master" class="btn btn-sm btn-green">Save</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <!-- Modal Edit-->
                    <div class="modal fade" id="modal-edit-kelas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-blue">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Form Master Kelas</h4>
                          </div>
                            <!-- form Edit start -->
                            {!! Form::open(array('action' => ['Admin\KelasController@updateKelas',''],'id' => 'form-edit-kelas')) !!}
                              <div class="modal-body">
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="kode_kelas">Kode kelas :</label>
                                  </div>
                                  <div class="form-group col-md-5 col-lg-5 col-xs-12">
                                    <input type="text" id="kode-kelas" name="kode_kelas" autocomplete="off" class="form-control" value="" readonly="true">
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <label for="kelas">Nama kelas :</label>
                                  </div>
                                  <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                    <input type="text" id="kelas" name="kelas" autocomplete="off" class="form-control" value="">
                                        @if($errors->has('kelas'))<small class="reds"><i>* {!!$errors->first('kelas')!!}</i></small>@endif
                                  </div>
                                <div class="col-lg-2"></div>
                                </div>
                              </div>
                              <div class="modal-footer bg-blue padding-teen">
                                <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-master-edit" class="btn btn-sm btn-green">Save changes</button>
                              </div>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- /modal -->
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-aqua" data-toggle="modal" data-target="#modal-tambah">Tambah</button>
                      </div>
                    </div>
                  <div id="table-list" class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-responsive">
                          <thead>
                            <tr>
                              <th width="6">No</th>
                              <th><center>Kode kelas</center></th>
                              <th><center>Nama kelas</center></th>
                              <th><center>Aksi</center></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($kelass as $kelas)
                            <tr data-id="{{ $kelas->id_kelas }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td>{{ strtoupper($kelas->kode_kelas) }}</td>
                              <td>{{ strtoupper($kelas->kelas) }}</td>
                              <td>
                              <center>
                              <button type="button" class="btn btn-sm btn-aqua edit-kelas" data-toggle="modal" data-target="#modal-edit-kelas" data-id="{{ $kelas->id_kelas }}"><i class="fa fa-edit"></i></button>
                              @if(auth()->user()->hasRole('super-admin'))
                                <button class="btn btn-sm btn-reds hapus_master_kelas" data-id="{{ $kelas->id_kelas }}"><i class="fa fa-trash"></i></button>
                                @else
                                @endif
                              </center>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection