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
                            <a href="{{ URL('kelola') }}" type="button" class="btn btn-sm btn-reds">Back</a>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-12 col-lg-12 left">
                      <table>
                        <tr>
                          <td style="height: 25px;">Nama kelas</td><td>&nbsp;:&nbsp;</td><td>
                            {{ ucwords($wali->getKelas->kelas) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="height: 25px;">Wali kelas</td><td>&nbsp;:&nbsp;</td><td>
                            {{ ucwords($wali->getWaliKelas->nama_guru) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="height: 25px;">Tahun ajaran</td><td>&nbsp;:&nbsp;</td><td>
                            {{ $wali->getTahunAjar->tahun }}
                          </td>
                        </tr>
                      </table>
                    </div>
                  <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <table class="table table-bordered table-hover table-responsive">
                          <thead>
                            <tr>
                              <th width="6">No</th>
                              <th class="hidden-xs"><center>Kode pelajaran</center></th>
                              <th><center>Mata pelajaran</center></th>
                              <th><center>Aksi</center></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($pelajarans as $pelajaran)
                            <tr data-id="{{ $pelajaran->id_matpel }}">
                              <td><center>{{ $no++ }}</center></td>
                              <td class="hidden-xs">{{ strtoupper($pelajaran->kode_matpel) }}</td>
                              <td>{{ strtoupper($pelajaran->matpel) }}</td>
                              <td>
                              <center>
                              <a href="{{ URL('kelola') }}/{{ $kode }}/{{ $pelajaran->id_matpel }}" class="btn btn-sm btn-blue" ><i class="fa fa-edit"></i></a>
                              </center>
                              </td>
                            </tr><?php //$min++; ?>
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