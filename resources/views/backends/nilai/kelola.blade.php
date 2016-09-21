@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                    <div class="box-body">
                     @if(!count($kelass))
                     <div class="col-lg-3 col-md-3 hidden-xs"></div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-aqua">
                              <i class="fa fa-info-circle"></i>
                            </span>
                            <div class="info-box-content">
                              <center><h4>kelas belum tersedia</h4></center>
                            </div>
                          </div>
                        </div>
                      <div class="col-lg-3 col-md-3 hidden-xs"></div>
                      @else
                      @foreach( $kelass as $kelas )
                      <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-green">
                          <a type="button" data-id="{{ $kelas->id }}" id="input-nilai" data-toggle="modal" data-target="#modal-nilai"><i class="fa fa-book icon-kelas"></i></a>
                          </span>
                          <div class="info-box-content">
                            <table>
                              <tr>
                                <td class="hidden-xs">Kelas</td>
                                <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
                                <td>&nbsp;&nbsp;{{ strtoupper($kelas->getKelas->kelas) }}</td>
                              </tr>
                              <tr>
                                <td class="hidden-xs">Wali kelas</td>
                                <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
                                <td>&nbsp;&nbsp;{{ ucwords($kelas->getWaliKelas->nama_guru) }}</td>
                              </tr>
                              <tr>
                                <td class="hidden-xs">Tahun ajaran</td>
                                <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
                                <td>&nbsp;&nbsp;{{ strtoupper($kelas->getTahunAjar->tahun) }}</td>
                              </tr>
                            </table>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                      </div><!-- /.box-body -->
                      @endforeach
                      @endif
                    </div>
                    <div class="pull-right right">
                      {{ $kelass->links() }}
                    </div>
                  </div>
                <!-- Modal Input Nilai-->
                <div class="modal fade" id="modal-nilai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header bg-purple">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Pilih Mata Pelajaran</h4>
                      </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                <label for="matpel">Mata pelajaran :</label>
                              </div>
                              <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                <select class="form-control data-add" name="matpel" id="matpel">
                                    <option selected="selected" value="">--pilih--</option>
                                    @foreach($pelajarans as $pelajaran)
                                    <option value="{{ $pelajaran->id_matpel }}">{{ strtoupper($pelajaran->matpel) }}</option>
                                    @endforeach
                                </select>
                              </div>
                            <div class="col-lg-2"></div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                <label for="matpel">Nilai :</label>
                              </div>
                              <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                <select class="form-control data-add" name="nilai" id="nilai">
                                    <option selected="selected" value="">--pilih--</option>
                                    <option value="satu">TUGAS - 1</option>
                                    <option value="dua">TUGAS - 2</option>
                                    <option value="uts">UTS</option>
                                    <option value="uas">UAS</option>
                                </select>
                              </div>
                            <div class="col-lg-2"></div>
                            </div>
                          </div>
                          <div class="modal-footer bg-purple padding-teen">
                            <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
                            <a id="insert-nilai" class="btn btn-sm btn-green">OK</a>
                          </div>
                    </div>
                  </div>
                </div>
                <!-- /modal -->
              </div>
            </div>
          </div>
@endsection