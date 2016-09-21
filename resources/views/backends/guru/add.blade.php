<div class="modal-header bg-aqua">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Form Data Guru</h4>
</div>
  <!-- form Edit start -->
  {!! Form::open(array('action' => 'Admin\GuruController@add','files' =>'true','id' => 'form-add-guru')) !!}
    <div class="modal-body">
      <div class="row">
          <div class="form-group col-md-3 col-lg-3 col-xs-12">
            <label for="nip">NIP :</label>
          </div>
          <div class="form-group col-md-3 col-lg-3 col-xs-12">
            <input type="text" class="form-control data-add" id="nip" name="nip" placeholder="Ex. 1234567890" autofocus="autofocus" autocomplete="off">  
            @if($errors->has('nip'))<small class="reds"><i>* {!!$errors->first('nip')!!}</i></small>@endif
          </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="nama">Nama :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <input type="text" class="form-control data-add" id="nama" name="nama" placeholder="Nama lengkap" autocomplete="off">
          @if($errors->has('nama'))<small class="reds"><i>* {!!$errors->first('nama')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="tempat_lahir">Tempat & TGL. Lahir :</label>
        </div>
        <div class="form-group col-md-6 col-lg-6 col-xs-7">
          <input type="text" class="form-control data-add" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat lahir" autocomplete="off">
          @if($errors->has('tempat_lahir'))<small class="reds"><i>* {!!$errors->first('tempat_lahir')!!}</i></small>@endif
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-5">
          <input type="text" class="form-control data-add" id="tanggal1" name="tgl_lahir" placeholder="Tanggl lahir" autocomplete="off">
          @if($errors->has('tgl_lahir'))<small class="reds"><i>* {!!$errors->first('tgl_lahir')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="alamat">Alamat :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <textarea class="form-control data-add" id="alamat" name="alamat" placeholder="Alamat"></textarea>
          @if($errors->has('alamat'))<small class="reds"><i>* {!!$errors->first('alamat')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="telpon">No. telpon :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <input type="text" class="form-control data-add" id="telpon" name="telpon" data-inputmask='"mask": "(9999) 99-999-999"' data-mask name="telpon" placeholder="No. telpon" autocomplete="off">
          @if($errors->has('telpon'))<small class="reds"><i>* {!!$errors->first('telpon')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="gender">Jenis kelamin :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <input type="radio" id="laki-laki" name="gender" value="laki-laki" checked="checked">
          <label for="laki-laki">Laki-laki</label>
          <input type="radio" id="perempuan" name="gender" value="perempuan">
          <label for="perempuan">Perempuan</label>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="agama">Agama :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
            {!! Form::select('agama', [
                  'islam' => 'ISLAM',
                  'kristen' => 'KRISTEN',
                  'hindhu' => 'HINDHU',
                  'budha' => 'BUDHA',
                  'katolik' => 'KATOLIK',
                  'lainnya' => 'LAINNYA',
            ], '', ['class' => 'form-control data-add','id' => 'agama','placeholder' => '--pilih--']) !!}
            @if($errors->has('agama'))<small class="reds"><i>* {!!$errors->first('agama')!!}</i></small>@endif
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="jabatan">Jabatan :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
           {!! Form::select('jabatan', [
                'kepala sekolah' => 'KEPALA SEKOLAH',
                'bendahara sekolah' => 'BENDAHARA SEKOLAH',
                'ka. perpustakaan' => 'KA. PERPUSTAKAAN',
                'ka. bp/bk' => 'KA. BP/BK',
                'waka. kurikulum' => 'WAKA. KURIKULUM',
                'waka. sarpra' => 'WAKA SARPRA',
                'waka. kesiswaan' => 'WAKA. KESISWAAN',
                'waka. humas' => 'WAKA. HUMAS',
                'ka. tata usaha(TU)' => 'KA. TATA USAHA(TU)',
                '-' => '-'
            ], '', ['class' => 'form-control data-add','id' => 'jabatan','placeholder' => '--pilih--']) !!}
            @if($errors->has('jabatan'))<small class="reds"><i>* {!!$errors->first('jabatan')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="status">Status :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          {{ Form::select("status",array(
                        'guru'=>'Guru','pegawai'=>'Pegawai'
                    ),'',['id' => 'status','class' => 'form-control data-add','placeholder' => '--pilih--']) }}
                    @if($errors->has('status'))<small class="reds"><i>* {!!$errors->first('status')!!}</i></small>@endif
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="pdd_akhir">Pendidikan terakhir :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
            {!! Form::select('pdd_akhir', [
                  'sd' => 'SD',
                  'smp' => 'SMP',
                  'sma' => 'SMA',
                  's1' => 'S1',
                  's2' => 'S2',
                  's3' => 'S3',
                  '-' => '-',
            ],'', ['class' => 'form-control data-add','id' => 'pdd','placeholder' => '--pilih--']) !!}
            @if($errors->has('pdd_akhir'))<small class="reds"><i>* {!!$errors->first('pdd_akhir')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="file">Foto :</label>
        </div>
        <div class="form-group col-md-6 col-lg-6 col-xs-12">
          <input type="file" id="file" class="data-add" name="image">
          @if($errors->has('image'))<small class="reds"><i>* {!!$errors->first('image')!!}</i></small>@endif
          <p class="help-block"><small class="blue">* Pilih foto</small></p>
        </div>
          <div class="form-group col-md-3 col-lg-3 col-xs-12">
            <img class="berita-images" src="http://placehold.it/100x100" id="showgambar">
          </div>
      </div>
    </div>
    <div class="modal-footer bg-aqua padding-teen">
      <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
      <button type="submit" id="btn-add-guru" class="btn btn-sm btn-green">Save</button>
    </div>
  {!! Form::close() !!}


  <script type="text/javascript">
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file").change(function () {
        readURL(this);
    });

    $("#tanggal1").datepicker({
      format:'yyyy-mm-dd'
    });

    $("#tahun1").datepicker({
      format:'yyyy-mm-dd'
    });
    $('.btn-defaulty').click(function(){
        $('.reds').fadeOut();
          $('.data-add').val('');
             $('#showgambar').attr('src', 'http://placehold.it/100x100');
    });
    //Money Euro
      $("[data-mask]").inputmask();
  </script>