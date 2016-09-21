@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                    <div class="col-md-12 col-lg-12 left">
                      <table>
                        <tr>
                          <td>
                            <a href="{{ URL('kelola') }}/{{ $kode }}" type="button" class="btn btn-sm btn-reds">Back</a>
                            <button type="button" id="btn_tambah" type="button" class="btn btn-sm btn-blue">Input nilai</button>
                          </td>
                        </tr>
                      </table>
                      <div id="form_tambah">
                        <div class="row">
                          <div class="col-md-12 col-lg-12 col-xs-12">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12" style="margin-top: 20px;">
                              <a href="{{ URL('kelola') }}/{{ $kode }}/{{ $id_pel }}/uas" class="btn btn-sm btn-green pull-right">Uas</a>
                              <a href="{{ URL('kelola') }}/{{ $kode }}/{{ $id_pel }}/uts" class="btn btn-sm btn-purples pull-right">Uts</a>
                              <a href="{{ URL('kelola') }}/{{ $kode }}/{{ $id_pel }}/dua" class="btn btn-sm btn-aqua pull-right">Tugas 2</a>
                              <a href="{{ URL('kelola') }}/{{ $kode }}/{{ $id_pel }}/satu" class="btn btn-sm btn-reds pull-right">Tugas 1</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        @include('backends.layouts.message.error')
                        <table class="table table-bordered table-hover table-responsive">
                          <thead>
                            <tr>
                              <th width="6">No</th>
                              <th class="hidden-xs"><center>NIS</center></th>
                              <th><center>Nama Siswa</center></th>
                              <th><center>Tugas 1</center></th>
                              <th><center>Tugas 2</center></th>
                              <th><center>Uts</center></th>
                              <th><center>Uas</center></th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(count($inputs))
                            @foreach($inputs as $input)
                            <?php 
                              $guru = $input->getGuru->nama_guru; 
                              $matpel = $input->getMatpel->matpel;
                            ?>
                            <tr>
                              <td>
                                <center>
                                  {{ $no++ }}
                                </center>
                              </td>
                              <td class="hidden-xs">
                                {{ $input->getSiswa->nis }}
                              </td>
                              <td>
                                {{ ucwords($input->getSiswa->nama) }}
                              </td>
                              <td width="100">
                                <center>
                                  {{ $input->tugas_1 }}
                                </center>
                              </td>
                              <td width="100">
                                <center>
                                  {{ $input->tugas_2 }}
                                </center>
                              </td>
                              <td width="100">
                                <center>
                                  {{ $input->uts }}
                                </center>
                              </td>
                              <td width="100">
                                <center>
                                  {{ $input->uas }}
                                </center>
                              </td>
                            </tr>
                            @endforeach
                            @else
                            <?php $guru = '...'; $matpel = '...'; ?>
                            <tr>
                              <center><h3 class="reds">Data masih kosong</h3></center>
                            </tr>
                            @endif
                          </tbody>
                        </table>
                      <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                            <label for="nama_matpel">Nama Guru : {{ ucwords($guru) }}</label>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                            <label for="nama_matpel">Mata pelajaran : {{ ucwords($matpel) }}</label>
                        </div>
                      </div>
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection