@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-responsive">
                          <thead>
                            <tr>
                              <th width="5"><center>No</center></th>
                              <th><center>Content</center></th>
                              <th width="150"><center>Aksi</center></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach( $data_statiss as $data )
                            <tr>
                              <td><center>{{ $no++ }}</center></td>
                              <td>{{ ucwords($data->getMenuFront->nama_menu) }}
                              </td>
                              <td>
                                <center>
                                  <a href="{{ URL('data-sekolah') }}/{{ $data->id_data }}" class="btn btn-sm btn-aqua"><i class="fa fa-edit"></i></a>
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