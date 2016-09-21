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
                              <center><h4>Nilai di kelas belum tersedia</h4></center>
                            </div>
                          </div>
                        </div>
                      <div class="col-lg-3 col-md-3 hidden-xs"></div>
                      @else
                      @foreach( $kelass as $kelas )
                      <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-aqua">
                          <a type="button" data-id="{{ $kelas->id }}" id="search-nilai" data-toggle="modal" data-target="#modal-search"><i class="fa fa-search-plus icon-kelas"></i></a>
                          </span>
                          <div class="info-box-content">
                            <table>
                              <tr>
                                <td class="hidden-xs">Kelas</td>
                                <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
                                <td>&nbsp;&nbsp;{{ strtoupper($kelas->getKelas->kelas) }}</td>
                              </tr>
                              <tr>
                                <td class="hidden-xs">Tahun ajaran</td>
                                <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
                                <td>&nbsp;&nbsp;{{ $kelas->getTahunAjar->tahun }}</td>
                              </tr>
                              <tr>
                                <td class="hidden-xs">Wali kelas</td>
                                <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
                                <td>&nbsp;&nbsp;{{ ucwords($kelas->getWaliKelas->nama_guru) }}</td>
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
              </div>
                <!-- Modal search-->
                <div class="modal fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header bg-purple">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Form Lihat Nilai</h4>
                      </div>
                        <!-- form Edit start -->
                        {!! Form::open(array('action' => 'Admin\NilaiSiswaController@cariNilai','method' => 'GET')) !!}
                          <div class="modal-body">
                            <div class="row">
                              <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                <label for="matpel">Mata pelajaran :</label>
                              </div>
                              <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                <select class="form-control data-add" name="matpel" id="pelajaran">
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
                                <label for="semester">Semester :</label>
                              </div>
                              <div class="form-group col-md-9 col-lg-9 col-xs-12">
                                <select class="form-control data-add" name="semester" id="semester">
                                    <option selected="selected" value="">--pilih--</option>
                                    <option value="ganjil">GANJIL</option>
                                    <option value="genap">GENAP</option>
                                </select>
                              </div>
                              <div class="col-lg-2">
                                <input type="hidden" name="id_kelas" id="kelas" value="">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer bg-purple padding-teen">
                            <button type="button" class="btn btn-sm btn-pink" data-dismiss="modal">Close</button>
                            <button type="submit" id="btn-lihat-nilai" class="btn btn-sm btn-purples">Search</button>
                          </div>
                        {!! Form::close() !!}
                    </div>
                  </div>
                </div>
                <!-- /modal -->
            </div>
          </div>
@endsection