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
                          {!! Form::open(array('action' => ['Admin\DataStatisController@profileSekolahUpdate', $profile->id],'files' => true)) !!}
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="title">Title : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                  <input type="text" id="title" name="title" class="form-control" value="{{ $profile->title }}">
                                  @if($errors->has('title'))
                                  <small class="reds"><i>* {!! $errors->first('title') !!}</i></small>
                                  @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_sekolah">Nama sekolah : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                  <input type="text" id="nama_sekolah" name="nama_sekolah" class="form-control" value="{{ $profile->nama_sekolah }}">
                                  @if($errors->has('nama_sekolah'))
                                  <small class="reds"><i>* {!! $errors->first('nama_sekolah') !!}</i></small>
                                  @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="status">Status sekolah : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                  <input type="text" id="status_sekolah" name="status_sekolah" class="form-control" value="{{ $profile->status_sekolah }}">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="alamat">Alamat sekolah : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea id="alamat" name="alamat" class="form-control">{{ $profile->alamat_sekolah }}</textarea>
                                    @if($errors->has('alamat'))
                                    <small class="reds"><i>* {!! $errors->first('alamat') !!}</i></small>
                                    @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="kab_kota">Kab. Kota : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                  <input type="text" id="kab_kota" name="kab_kota" class="form-control" value="{{ $profile->kab_kota }}">
                                  @if($errors->has('kab_kota'))
                                  <small class="reds"><i>* {!! $errors->first('kab_kota') !!}</i></small>
                                  @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="telpon">Telpon : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                  <input type="text" id="telpon" name="telpon" class="form-control" value="{{ $profile->telepon }}">
                                  @if($errors->has('telpon'))
                                  <small class="reds"><i>* {!! $errors->first('telpon') !!}</i></small>
                                  @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="web">Nama website : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                  <input type="text" id="web" name="web" class="form-control" value="{{ $profile->nama_web }}">
                                  @if($errors->has('web'))
                                  <small class="reds"><i>* {!! $errors->first('web') !!}</i></small>
                                  @endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="logo">Logo : </label>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-4 col-xs-8">
                                  <input type="file" id="logo" name="logo" class="form-control">
                                  @if($errors->has('logo'))
                                  <small class="reds"><i>* {!! $errors->first('logo') !!}</i></small>
                                  @endif
                                  </div>
                                  <img class="logo-images" src="{{ asset('uploads/images') }}/{{ $profile->logo }}">
                                </div>
                              <div class="box-footer col-md-12 col-lg-12 col-xs-12">
                                <div class="form-group pull-right">
                                  <a href="{{ URL('data-sekolah') }}" class="btn btn-sm btn-yellow">Cancel</a>
                                  <button type="submit" id="btn-identitas" class="btn btn-sm btn-green">Update</button>
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