<div class="modal-header bg-blue">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Form Buat Kelas</h4>
</div>
  <!-- form Edit start -->
  {!! Form::open(array('action' =>[ 'Admin\KelasController@update',$kelas_siswa->id])) !!}
    <div class="modal-body">
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="kelas">Kelas :</label>
        </div>
        <div class="form-group col-md-5 col-lg-5 col-xs-12">
          <select class="form-control" name="kelas" disabled>
            <option selected="selected" value="{{ $kelas_siswa->kode_kelas }}">{{ strtoupper($kelas_siswa->getKelas->kelas) }}</option>
              @foreach ( $kelas as $class )
              @if($class->kelas===$kelas_siswa->getKelas->kelas)
              @else
                  <option value="{{ $class->id_kelas }}">{{ strtoupper($class->kelas) }}</option>
                  @endif
              @endforeach

            </select>
            @if($errors->has('kelas'))<small class="reds"><i>* {!!$errors->first('kelas')!!}</i></small>@endif
        </div>
      <div class="col-lg-2"></div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="wali_kelas">Wali kelas :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <select class="form-control" name="wali_kelas">
            <option selected="selected" value="{{ $kelas_siswa->guru_id }}">{{ ucwords($kelas_siswa->getWaliKelas->nama_guru) }}</option>
              @foreach ( $gurus as $guru )
              @if($guru->nama_guru === $kelas_siswa->getWaliKelas->nama_guru)
              @else
                  <option value="{{ $guru->id_guru }}">{{ ucwords($guru->nama_guru) }}</option>
                  @endif
              @endforeach

            </select>
            @if($errors->has('wali_kelas'))<small class="reds"><i>* {!!$errors->first('wali_kelas')!!}</i></small>@endif
        </div>
        <div class="col-lg-2"></div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="tahun_ajaran">Tahun ajaran :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <select class="form-control" name="tahun_ajaran">
            <option selected="selected" value="{{ $kelas_siswa->tahun_ajaran_id }}">{{ strtoupper($kelas_siswa->getTahunAjar->tahun) }}</option>
              @foreach ( $tahuns as $tahun )
              @if($tahun->tahun === $kelas_siswa->getTahunAjar->tahun)
              @else
                  <option value="{{ $tahun->id_tahun }}">{{ strtoupper($tahun->tahun) }}</option>
                  @endif
              @endforeach

            </select>
            @if($errors->has('tahun_ajaran'))<small class="reds"><i>* {!!$errors->first('tahun_ajaran')!!}</i></small>@endif
        </div>
      <div class="col-lg-2"></div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
         <label for="aktiv">Status kelas :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          {!! Form::select('aktiv', [
              '1' => 'AKTIV', '0' => 'TIDAK AKTIV'
          ], $kelas_siswa->status, ['class' => 'form-control']) !!}
          @if($errors->has('aktiv'))<small class="reds"><i>* {!!$errors->first('aktiv')!!}</i></small>@endif
        </div>
      <div class="col-lg-2"></div>
      </div>
    </div>
    <div class="modal-footer bg-blue padding-teen">
      <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
      <button type="submit" id="btn-edit-kelas" class="btn btn-sm btn-green">Save changes</button>
    </div>
  {!! Form::close() !!}