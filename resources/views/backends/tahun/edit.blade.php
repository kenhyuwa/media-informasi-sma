<div class="modal-header bg-blue">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Form Data Tahun Ajaran</h4>
</div>
  <!-- form Edit start -->
  {!! Form::open(array('action' => ['Admin\TahunController@update',$tahun->id_tahun])) !!}
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-md-3 col-lg-3 col-xs-12">
            <label for="tahun_ajaran">Tahun ajaran :</label>
          </div>
          <div class="form-group col-md-9 col-lg-9 col-xs-12">
            <input type="text" id="tahun_ajaran_master" name="tahun_ajaran" autocomplete="off" class="form-control" value="{{ $tahun->tahun }}">
              @if($errors->has('tahun_ajaran'))<small class="reds"><i>* {!!$errors->first('tahun_ajaran')!!}</i></small>@endif
          </div>
        <div class="col-lg-2"></div>
      </div>
    </div>
    <div class="modal-footer bg-blue padding-teen">
      <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
      <button type="submit" id="tahun-update" class="btn btn-sm btn-green">Save changes</button>
    </div>
  {!! Form::close() !!}