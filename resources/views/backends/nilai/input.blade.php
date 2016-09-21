@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                    <!-- form -->
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                        <div id="content-2" class="col-md-12 clearfix">
                            <div class="row">
                              <div class="col-md-12">
                                <!-- form start -->
                                {!! Form::open(array('action' => ['Admin\NilaiSiswaController@setNilai'])) !!}
                                  <div class="box-body">
                                    <div class="col-md-2">
                                        <label for="tahun" class="pull-right">Tahun ajaran :</label>
                                    </div>
                                    <div class="col-md-10">
                                      <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                          <select class="form-control select2" name="tahun_ajaran" style="width: 100%;">
                                            <option selected="selected" value="">--pilih--</option>
                                                  <option value="{{ $tahun_ajarans->id_tahun }}">{{ strtoupper($tahun_ajarans->tahun) }}</option>

                                          </select>
                                          @if($errors->has('tahun_ajaran'))<small class="reds"><i>* {!!$errors->first('tahun_ajaran')!!}</i></small>@endif
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <label for="kelas" class="pull-right">Kelas :</label>
                                    </div>
                                    <div class="col-md-10">
                                      <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                        <select id="kelas" class="form-control" name="kelas">
                                          <option selected="selected" value="">--pilih--</option>

                                            @foreach ( $kelass as $kelas )
                                                <option value="{{ $kelas->id }}">{{ strtoupper($kelas->getKelas->kelas) }}</option>
                                            @endforeach

                                        </select>
                                        @if($errors->has('kelas'))<small class="reds"><i>* {!!$errors->first('kelas')!!}</i></small>@endif
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <label for="semester" class="pull-right">Semester :</label>
                                    </div>
                                    <div class="col-md-10">
                                      <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                        <select class="form-control" name="semester">
                                          <option selected="selected" value="">--pilih--</option>

                                            @foreach ( $semesters as $semester )
                                                <option value="{{ $semester->id_smt }}">{{ strtoupper($semester->semester) }}</option>
                                            @endforeach

                                        </select>
                                        @if($errors->has('semester'))<small class="reds"><i>* {!!$errors->first('semester')!!}</i></small>@endif
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <label for="pelajaran" class="pull-right">Mata pelajaran :</label>
                                    </div>
                                    <div class="col-md-10">
                                      <div class="form-group col-md-5 col-lg-5 col-xs-12">
                                        <select class="form-control" name="pelajaran">
                                          <option selected="selected" value="">--pilih--</option>

                                            @foreach ( $pelajarans as $pelajaran )
                                                <option value="{{ $pelajaran->id_matpel }}">{{ strtoupper($pelajaran->matpel) }}</option>
                                            @endforeach

                                        </select>
                                        @if($errors->has('pelajaran'))<small class="reds"><i>* {!!$errors->first('pelajaran')!!}</i></small>@endif
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <label for="guru" class="pull-right">Guru :</label>
                                    </div>
                                    <div class="col-md-10">
                                      <div class="form-group col-md-5 col-lg-5 col-xs-12">
                                        <select class="form-control" name="guru">
                                          <option selected="selected" value="">--pilih--</option>

                                            @foreach ( $gurus as $guru )
                                                <option value="{{ $guru->id_guru }}">{{ strtoupper($guru->nama_guru) }}</option>
                                            @endforeach

                                        </select>
                                        @if($errors->has('guru'))<small class="reds"><i>* {!!$errors->first('guru')!!}</i></small>@endif
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="nis" class="pull-right">NIS :</label>
                                    </div>
                                    <div class="col-md-10">
                                      <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                          <select id="nisn" class="form-control select2" name="nis" style="width: 100%;">
                                            <option selected="selected" value="">--pilih--</option>

                                              @foreach ( $siswas as $siswa )
                                                  <option value="{{ $siswa->getSiswa->id_siswa }}">{{ strtoupper($siswa->getSiswa->nis) }}</option>
                                              @endforeach

                                          </select>
                                          @if($errors->has('nis'))<small class="reds"><i>* {!!$errors->first('nis')!!}</i></small>@endif
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="siswa" class="pull-right">Nama siswa :</label>
                                    </div>
                                    <div class="col-md-10">
                                      <div class="form-group col-md-6 col-lg-6 col-xs-12">
                                          <input type="text" id="siswa" name="nama" autocomplete="off" class="form-control">
                                            @if($errors->has('nama'))<small class="reds"><i>* {!!$errors->first('nama')!!}</i></small>@endif
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                          <label for="tugas_1">Tugas 1 :</label>
                                          <input type="text" name="tugas_1" autocomplete="off" class="form-control">
                                            @if($errors->has('tugas_1'))<small class="reds"><i>* {!!$errors->first('tugas_1')!!}</i></small>@endif
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                          <label for="tugas_2">Tugas 2 :</label>
                                          <input type="text" name="tugas_2" autocomplete="off" class="form-control">
                                            @if($errors->has('tugas_2'))<small class="reds"><i>* {!!$errors->first('tugas_2')!!}</i></small>@endif
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                          <label for="uts">Uts :</label>
                                          <input type="text" name="uts" autocomplete="off" class="form-control">
                                            @if($errors->has('uts'))<small class="reds"><i>* {!!$errors->first('uts')!!}</i></small>@endif
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                          <label for="uas">Uas :</label>
                                          <input type="text" name="uas" autocomplete="off" class="form-control">
                                            @if($errors->has('uas'))<small class="reds"><i>* {!!$errors->first('uas')!!}</i></small>@endif
                                        </div>
                                    </div>

                                    <div class="box-footer col-md-12 col-lg-12 col-xs-12">
                                      <div class="form-group pull-right">
                                        <a href="{{ URL('tahun') }}" class="btn btn-yellow">Cancel</a>
                                        <button type="submit" class="btn btn-green">Simpan</button>
                                      </div>
                                    </div>

                                  </div><!-- /.box-body -->
                              {!! Form::close() !!}
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /form -->
              </div>
            </div>
          </div>
@endsection