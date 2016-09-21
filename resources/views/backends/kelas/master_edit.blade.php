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
                                {!! Form::open(array('action' => ['Admin\KelasController@updateKelas', $edit_kelas->id_kelas ])) !!}
                                  <div class="box-body">

                                    <div class="form-group col-md-4 col-lg-4 col-xs-12">
                                      <label for="kelas">Kode kelas :</label>
                                      <input type="text" name="kode_kelas" autocomplete="off" class="form-control" value="{{ strtoupper($edit_kelas->kode_kelas) }}" readonly="true">
                                    </div>

                                    <div class="form-group col-md-8 col-lg-8 col-xs-12">
                                      <label for="kelas">Nama kelas :</label>
                                      <input type="text" name="kelas" autocomplete="off" class="form-control" value="{{ $edit_kelas->kelas }}">
                                        @if($errors->has('kelas'))<small class="reds"><i>* {!!$errors->first('kelas')!!}</i></small>@endif
                                    </div>

                                    <div class="box-footer col-md-12 col-lg-12 col-xs-12">
                                      <div class="form-group pull-right">
                                        <a href="{{ URL('master/kelas') }}" class="btn btn-sm btn-yellow">Cancel</a>
                                        <button type="submit" class="btn btn-sm btn-green">Update</button>
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