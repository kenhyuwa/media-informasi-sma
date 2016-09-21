@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                          <!-- form start -->
                            {!! Form::open(array('action' => ['Admin\DataDinamisController@updatePengumuman', $pengumuman->id_pengumuman])) !!}
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tema pengumuman : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <input type="text" id="judul_pengumuman" name="judul_pengumuman" class="form-control" value="{{ $pengumuman->judul }}">
                                    @if($errors->has('judul'))<small class="reds"><i>* {!!$errors->first('judul_pengumuman')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="content">Content : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea class="form-control" id="berita-content" name="content">{{ $pengumuman->isi }}</textarea>
                                    @if($errors->has('content'))<small class="reds"><i>* {!!$errors->first('content')!!}</i></small>@endif
                                  </div>
                                </div>
                              <div class="box-footer col-md-12 col-lg-12 col-xs-12">
                                <div class="form-group pull-right">
                                  <a href="{{ URL('pengumuman') }}" class="btn btn-sm btn-yellow">Cancel</a>
                                  <button type="submit" id="add-pengumuman" class="btn btn-sm btn-green">Update</button>
                                </div>
                              </div>
                          {!! Form::close() !!}
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection