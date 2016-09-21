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
                          {!! Form::open(array('action' => ['Admin\DataStatisController@updateData', $edit_data->id_data],'files' => true)) !!}
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Nama menu : </label>
                                  </div>
                                  <div class="form-group col-md-4 col-lg-3 col-xs-12">
                                    <select name="nama_menu" id="nama_menu" class="form-control">
                                    <option selected="selected" value="{{ $edit_data->menu_id }}">{{ ucwords($edit_data->getMenuFront->nama_menu) }}</option>
                                      @foreach($menu_front as $front)
                                        @if($front->id_menu == $edit_data->menu_id)
                                        @else
                                        <option value="{{ $front->id_menu }}">{{ ucwords($front->nama_menu) }}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="content">Content : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea class="form-control" rows="2" id="data_statis" name="content" required>{{ $edit_data->content }}</textarea>
                                    @if($errors->has('content'))<h5>{!!$errors->first('content')!!}</h5>@endif
                                  </div>
                                </div>
                              <div class="box-footer col-md-12 col-lg-12 col-xs-12">
                                <div class="form-group pull-right">
                                  <a href="{{ URL('data-sekolah') }}" class="btn btn-sm btn-yellow">Cancel</a>
                                  <button type="submit" id="statis" class="btn btn-sm btn-green">Update</button>
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