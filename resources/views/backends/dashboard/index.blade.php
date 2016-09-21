@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix content">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 dashboard">
                      <div class="box-body">
                        <div class="col-lg-4 col-md-6 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-briefcase icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span><i class="fa fa-tags"></i>&nbsp;KEPEGAWAIAN</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ count($guru) }}</span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-group icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span><i class="fa fa-tags"></i>&nbsp;KESISWAAN</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ count($siswa) }}</span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-graduation-cap icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span><i class="fa fa-tags"></i>&nbsp;ALUMNI</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ count($alumni) }}</span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-calendar-check-o icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span><i class="fa fa-tags"></i>&nbsp;TAHUN AJARAN</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ count($tahun) }}</span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-book icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span><i class="fa fa-tags"></i>&nbsp;MATA PELAJARAN</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ count($matpel) }}</span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-area-chart icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span><i class="fa fa-tags"></i>&nbsp;KELAS</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ count($kelas) }}</span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-key icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span><i class="fa fa-tags"></i>&nbsp;USER-ADMIN</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ count($user) }}</span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-cogs icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span><i class="fa fa-tags"></i>&nbsp;MANAGE-SYSTEM</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ count($system) }}</span>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12 push-to-top">
                            <div class="radius-info bg-aqua">
                                <span class="box-radius">
                                  <i class="fa fa-line-chart icon-radius"></i>
                                </span>
                            </div>
                            <div class="box-style">
                              <div class="content-box-left bg-flat-medium-purple">
                                <span><i class="fa fa-tags"></i>&nbsp;KELAS AKTIV</span>
                              </div>
                              <div class="radius-info-inner"></div>
                              <div class="content-box-right bg-flat-aqua">
                                <span class="text-right">{{ count($kelasApp) }}</span>
                              </div>
                            </div>
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection