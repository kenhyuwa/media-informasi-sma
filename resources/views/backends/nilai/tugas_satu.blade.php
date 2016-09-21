@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                <div class="bottom">
                  <center><h3>FORM NILAI TUGAS-1</h3></center><hr>
                </div>
                  <div class="row">
                  <!-- form -->
                        <!-- form start -->
                        {!! Form::open(array('action' => [$action,$kode])) !!}
                    <div class="col-md-12 col-lg-12 left right">
                      <div class="row">
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <label for="nama_matpel">Kode pelajaran :</label>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <input type="hidden" name="pelajaran_id" value="{{ $id_pel }}" class="form-control">
                            <input type="text" value="{{ $kode_matpel }}" class="form-control" disabled="true">
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <label for="nama_matpel">Mata pelajaran :</label>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-xs-12">
                            <input type="text" value="{{ $matpel }}" class="form-control" disabled="true">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <label for="semester">Semester :</label>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            {!! Form::select('semester', [
                                        'ganjil' => 'Ganjil', 'genap' => 'Genap'
                                  ], $semester, ['class' => 'form-control',$disabled]) !!}
                                 @if($errors->has('semester'))<small class="purple"><i>* {!!$errors->first('semester')!!}</i></small>@endif
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-xs-12">
                            <label for="guru">Guru pengajar :</label>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-xs-12">
                            <select id="guru" name="guru_id" class="form-control data-add" {{ $disabled }}>
                                <option selected="selected" value="{{ $IDguru_pengajar }}">{{ $guru_pengajar }}</option>
                              @foreach($semua_guru as $guru)
                                <option value="{{ $guru->id_guru }}">{{ strtoupper($guru->nama_guru) }}</option>
                              @endforeach
                            </select>
                                @if($errors->has('guru_id'))<small class="purple"><i>* {!!$errors->first('guru_id')!!}</i></small>@endif
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
                                    <input type="hidden" name="id_siswa[]" value="{{ $input->getSiswa->id_siswa }}" class="form-control">
                                    <input type="number" name="tugas_1[{{ $input->id_nilai }}]" value="{{ $input->tugas_1 }}" class="form-control">
                                    @if($errors->has('tugas_1'))<small class="purple"><i>* {!!$errors->first('tugas_1')!!}</i></small>@endif
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>

                              <div class="box-footer col-md-6 col-lg-12 col-xs-12">
                                <div class="form-group pull-right">
                                  <a href="{{ URL('kelola') }}" class="btn btn-sm btn-pink">Back</a>
                                  <button type="submit" id="btn-tugas-1" class="btn btn-sm btn-aqua">Save</button>
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