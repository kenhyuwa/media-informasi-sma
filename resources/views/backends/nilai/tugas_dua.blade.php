@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                <div class="bottom">
                  <center><h3>FORM NILAI TUGAS-2</h3></center><hr>
                </div>
                  <div class="row">
                  <!-- form -->
                        <!-- form start -->
                        {!! Form::open(array('action' => ['Admin\NilaiSiswaController@nilaiTugasDua'])) !!}
                    <div class="col-md-12 col-lg-12 left right">
                      <div class="row">
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <label for="nama_matpel">Kode pelajaran :</label>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <input type="hidden" name="pelajaran_id" value="{{ $id_pel }}" class="form-control">
                            <input type="text" value="{{ strtoupper($input->getMatpel->kode_matpel) }}" class="form-control" disabled="true">
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <label for="nama_matpel">Mata pelajaran :</label>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-xs-12">
                            <input type="text" value="{{ strtoupper($input->getMatpel->matpel) }}" class="form-control" disabled="true">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <label for="semester">Semester :</label>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            {!! Form::select('semester', [
                                        'ganjil' => 'Ganjil', 'genap' => 'Genap'
                                  ], '$input->semester', ['class' => 'form-control','disabled']) !!}
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <label for="nama_matpel">Guru pengajar :</label>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-xs-12">
                            <select name="guru_id" class="form-control" disabled="true">
                                <option selected="selected" value="{{ $input->getGuru->id_guru }}">{{ strtoupper($input->getGuru->nama_guru) }}</option>
                            </select>
                        </div>
                      </div>
                    </div>
                  <div class="col-lg-12 col-md-12 col-xs-12">
                          <div class="box-body">
                        @include('backends.layouts.message.success')
                            <table class="table table-bordered table-hover table-responsive">
                              <thead>
                                <tr>
                                  <th width="6">No</th>
                                  <th width="100"><center>NIS</center></th>
                                  <th><center>Nama Siswa</center></th>
                                  <th width="200"><center>Nilai</center></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($inputs as $input)
                                <tr>
                                  <td>
                                    <center>
                                      {{ $no++ }}
                                    </center>
                                  </td>
                                  <td>
                                    {{ $input->getSiswa->nis }}
                                  </td>
                                  <td>
                                    {{ ucwords($input->getSiswa->nama) }}
                                  </td>
                                  <td>
                                    <input type="number" name="id_nilai[{{ $input->id_nilai }}]" value="{{ $input->tugas_2 }}" class="form-control">
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>

                              <div class="box-footer col-md-6 col-lg-12 col-xs-12">
                                <div class="form-group pull-right">
                                  <a href="{{ URL('kelola') }}" class="btn btn-sm btn-pink">Back</a>
                                  <button type="submit" class="btn btn-sm btn-aqua">Save</button>
                                </div>
                              </div>
                          </div><!-- /.box-body -->
                      {!! Form::close() !!}
                          <!-- /form -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection