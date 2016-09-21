@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body box-inner">
                        <div id="student-profile">
                          <div class="col-md-3 col-sm-3 col-xs-12 col-lg-3 v-align">
                            @if (count(auth()->user()->foto))
                              <img class="student-profile" src="{{ asset('uploads/images') }}/{{ auth()->user()->foto }}">
                              @else
                              <img class="student-profile" src="{{ asset('uploads/images') }}/default.gif">
                            @endif
                            <div class="box-inner bg-aqua user-profile">
                              <ul>
                                <li><strong>NIP :</strong> {{ auth()->user()->nip }}</li>
                                <li><strong>Nama :</strong> {{ ucwords(auth()->user()->nama_guru) }}</li>
                                <li><strong>Username :</strong> {{ auth()->user()->username }}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-12 col-lg-9">
                            <center class="reset-password green">
                            <i class="fa fa-recycle fa-2x blue"></i>
                            <span>&nbsp;Reset password</span>
                            </center>
                                <!-- form start -->
                                {!! Form::open(array('action' => 'Admin\AdminController@UpdateProfile')) !!}
                                  <div class="box-body">
                                    <div class="row">
                                      <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                        <label for="username">Username :</label>
                                      </div>
                                      <div class="form-group col-md-8 col-lg-8 col-xs-12">
                                        <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Username">
                                        <small>&nbsp;&nbsp;<i class="blue">* Tidak boleh sama dengan username sebelumnya</i></small><br/>
                                        <small>&nbsp;&nbsp;<i class="blue">** Kosongkan jika tidak diubah</i></small><br/>
                                          @if($errors->has('username'))<small><i>* {!!$errors->first('username')!!}</i></small>@endif 
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                        <label for="pass_lama">Password lama :</label>
                                      </div>
                                      <div class="form-group col-md-8 col-lg-8 col-xs-12">
                                        <input type="password" name="pass_lama" id="id_1" autocomplete="off" class="form-control" placeholder="Password lama">
                                          <input type="checkbox" name="check" id="show_pass_1" class="icheckbox"><small>&nbsp;&nbsp;<i class="blue">* Show Password</i></small><br/>
                                          @if($errors->has('pass_lama'))<small><i>* {!!$errors->first('pass_lama')!!}</i></small>@endif 
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                        <label for="pass_baru">Password baru :</label> 
                                      </div>
                                      <div class="form-group col-md-8 col-lg-8 col-xs-12">
                                        <input type="password" name="pass_baru" id="id_2" autocomplete="off" class="form-control" placeholder="Password baru">
                                          <input type="checkbox" name="check" id="show_pass_2" class="icheckbox"><small>&nbsp;&nbsp;<i class="blue">* Show Password</i></small><br/>
                                          @if($errors->has('pass_baru'))<small><i>* {!!$errors->first('pass_baru')!!}</i></small>@endif 
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-md-3 col-lg-3 col-xs-12">
                                        <label for="confirm_pass">Confirm password :</label>
                                      </div>
                                      <div class="form-group col-md-8 col-lg-8 col-xs-12">
                                        <input type="password" name="confirm_pass" id="id_3" autocomplete="off" class="form-control" placeholder="Ulangi Password">
                                          <input type="checkbox" name="check" id="show_pass_3" class="icheckbox"><small>&nbsp;&nbsp;<i class="blue">* Show Password</i></small><br/>
                                          @if($errors->has('confirm_pass'))<small><i>* {!!$errors->first('confirm_pass')!!}</i></small>@endif 
                                      </div>
                                    </div>
                                    <div class="box-footer col-md-12 col-lg-12 col-xs-12">
                                      <div class="form-group pull-right">
                                        <button type="reset" class="btn btn-sm btn-reds">Cancel</button>
                                        <button type="submit" id="btn-profile-user" class="btn btn-sm btn-green">Update</button>
                                      </div>
                                    </div>

                                  </div><!-- /.box-body -->
                              {!! Form::close() !!}
                          </div>
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
          </div>
        </div>
@endsection