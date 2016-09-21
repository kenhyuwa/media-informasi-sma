@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 col-xs-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                    <div class="row">
                      <div class="form-group col-md-2 col-lg-2 col-xs-12">
                        <label for="smt">SEMESTER :</label>
                      </div>
                      <div class="form-group col-md-3 col-lg-3 col-xs-10">
                        <select id="semester" class="form-control select2" name="semester" style="width: 100%;">
                          <option selected="selected" value="">--pilih--</option>
                          <option value="ganjil">GANJIL</option>
                          <option value="genap">GENAP</option>
                        </select>
                      </div>
                      <div class="form-group col-md-1 col-lg-1 col-xs-1">
                      	<button type="button" id="btn-refresh" class="btn btn-sm btn-green"><i class="fa fa-refresh fa-spin"></i></button>
                      </div>
                      <div class="col-lg-2"></div>
                    </div>
                  <div id="list-nilai" class="row">
                      
                  </div>
              </div>
            </div>
          </div>
@endsection