<div class="modal-header bg-blue">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Form Data Mata Pelajaran</h4>
</div>
  <!-- form Edit start -->
  {!! Form::open(array('action' =>['Admin\PelajaranController@update', $id_matpel ])) !!}
    <div class="modal-body">
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="kd_pelajaran">Kode pelajaran :</label>
        </div>
        <div class="form-group col-md-5 col-lg-5 col-xs-12">
          <input type="text" id="kode-pel" name="kd_pelajaran" autocomplete="off" class="form-control" value="{{ strtoupper($pelajaran->kode_matpel) }}" readonly="true">
        </div>
      <div class="col-lg-2"></div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="pelajaran">Mata pelajaran :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <input type="text" id="pelajaran" name="pelajaran_update" autocomplete="off" class="form-control" value="{{ strtoupper($pelajaran->matpel) }}">
                @if($errors->has('pelajaran_update'))<small class="reds"><i>* {!!$errors->first('pelajaran_update')!!}</i></small>@endif
        </div>
      <div class="col-lg-2"></div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="keterangan">Keterangan :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <select id="keterangan" class="form-control" name="keterangan_update">
            @if( $pelajaran->keterangan == 'tambahan' )
              <option selected="selected" value="tambahan">Tambahan</option>
            <option value="wajib">Wajib</option>
            @else
              <option value="tambahan">Tambahan</option>
            <option selected="selected" value="wajib">Wajib</option>
            @endif
            </select>
                @if($errors->has('keterangan_update'))<small class="reds"><i>* {!!$errors->first('keterangan_update')!!}</i></small>@endif
        </div>
      <div class="col-lg-2"></div>
      </div>
    </div>
    <div class="modal-footer bg-blue padding-teen">
      <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
      <button type="submit" id="btn-matpel-edit" class="btn btn-sm btn-green">Save changes</button>
    </div>
  {!! Form::close() !!}