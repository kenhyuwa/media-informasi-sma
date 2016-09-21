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
                            {!! Form::open(array('action' => ['Admin\DataDinamisController@updateAgenda', $agenda->id_agenda])) !!}
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tema agenda : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <input type="text" id="judul_agenda" name="judul_agenda" class="form-control" autocomplete="off" value="{{ $agenda->tema }}">
                                    @if($errors->has('judul_agenda'))<small class="reds"><i>* {!!$errors->first('judul_agenda')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="content">Isi : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea class="form-control" rows="2" id="agenda-content" name="content">{{ $agenda->isi }}</textarea>
                                    @if($errors->has('content'))<small class="reds"><i>* {!!$errors->first('content')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tanggal mulai : </label>
                                  </div>
                                  <div class="form-group col-md-4 col-lg-4 col-xs-12">
                                    <input type="text" id="tanggal1" name="mulai" class="form-control" autocomplete="off" value="{{ $agenda->tgl_mulai }}">
                                    @if($errors->has('mulai'))<small class="reds"><i>* {!!$errors->first('mulai')!!}</i></small>@endif
                                  </div>
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tanggal selesai : </label>
                                  </div>
                                  <div class="form-group col-md-4 col-lg-4 col-xs-12">
                                    <input type="text" id="tahun1" name="selesai" class="form-control" autocomplete="off" value="{{ $agenda->tgl_selesai }}">
                                    @if($errors->has('selesai'))<small class="reds"><i>* {!!$errors->first('selesai')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Tempat : </label>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 col-xs-12">
                                    <input type="text" id="tempat" name="tempat" class="form-control" autocomplete="off" value="{{ $agenda->tempat }}">
                                    @if($errors->has('tempat'))<small class="reds"><i>* {!!$errors->first('tempat')!!}</i></small>@endif
                                  </div>
                                  <div class="form-group col-md-1 col-lg-1 col-xs-12">
                                    <label for="nama_menu">Jam : </label>
                                  </div>
                                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                    <input type="text" id="jam" name="jam" class="form-control" autocomplete="off" value="{{ $agenda->jam }}">
                                    @if($errors->has('jam'))<small class="reds"><i>* {!!$errors->first('jam')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Keterangan : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea id="keterangan" name="keterangan" class="form-control" autocomplete="off">{{ $agenda->keterangan }}</textarea>
                                    @if($errors->has('keterangan'))<small class="reds"><i>* {!!$errors->first('keterangan')!!}</i></small>@endif
                                  </div>
                                </div>
                              <div class="box-footer col-md-12 col-lg-12 col-xs-12">
                                <div class="form-group pull-right">
                                  <a href="{{ URL('agenda') }}" class="btn btn-sm btn-yellow">Cancel</a>
                                  <button type="submit" id="btn-agenda" class="btn btn-sm btn-green">Update</button>
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