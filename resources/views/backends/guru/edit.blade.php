<div class="modal-header bg-blue">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Form Data Guru</h4>
</div>
  <!-- form Edit start -->
    {!! Form::open(array('action' => ['Admin\GuruController@update' ,$guru->id_guru],'files' =>'true','id' => 'form-edit-guru')) !!}
    <div class="modal-body">
      <div class="row">
          <div class="form-group col-md-3 col-lg-3 col-xs-12">
            <label for="nip">NIP :</label>
          </div>
          <div class="form-group col-md-3 col-lg-3 col-xs-12">
            <input type="text" class="form-control data-add" id="nips" name="nip" value="{{ $guru->nip }}" readonly="true" autocomplete="off">
            @if($errors->has('nip'))<small class="reds"><i>* {!!$errors->first('nip')!!}</i></small>@endif
          </div>
          <div class="form-group col-md-2 col-lg-2 col-xs-12">
            <label for="nama">Nama :</label>
          </div>
          <div class="form-group col-md-4 col-lg-4 col-xs-12">
            <input type="text" class="form-control data-add" id="namas" name="nama" value="{{ $guru->nama_guru }}" autocomplete="off">
            @if($errors->has('nama'))<small class="reds"><i>* {!!$errors->first('nama')!!}</i></small>@endif
          </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="tempat_lahir">Tempat & TGL. Lahir :</label>
        </div>
        <div class="form-group col-md-6 col-lg-6 col-xs-8">
          <input type="text" class="form-control data-add" id="tempat_lahirs" name="tempat_lahir" value="{{ $guru->tempat_lahir }}" autocomplete="off">
          @if($errors->has('tempat_lahir'))<small class="reds"><i>* {!!$errors->first('tempat_lahir')!!}</i></small>@endif
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-4">
          <input type="text" class="form-control data-add" id="tanggal3" name="tgl_lahir" value="{{ $guru->tgl_lahir }}" autocomplete="off">
          @if($errors->has('tgl_lahir'))<small class="reds"><i>* {!!$errors->first('tgl_lahir')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="alamat">Alamat :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <textarea class="form-control data-add" id="alamats" name="alamat">{{ $guru->alamat }}</textarea>
          @if($errors->has('alamat'))<small class="reds"><i>* {!!$errors->first('alamat')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="telpon">No. telpon :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <input type="text" class="form-control data-add" id="telpon" name="telpon" data-inputmask='"mask": "(9999) 99-999-999"' data-mask name="telpon" value="{{ $guru->no_telp }}" autocomplete="off">
          @if($errors->has('telpon'))<small class="reds"><i>* {!!$errors->first('telpon')!!}</i></small>@endif
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="gender">Jenis kelamin :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          @if($guru->gender == 'laki-laki')
            <input type="radio" id="laki-laki" name="gender" value="laki-laki" checked="checked">
            <label for="laki-laki">Laki-laki</label>
            <input type="radio" id="perempuan" name="gender" value="perempuan">
            <label for="perempuan">Perempuan</label>
            @else
            <input type="radio" id="laki-laki" name="gender" value="laki-laki">
            <label for="laki-laki">Laki-laki</label>
            <input type="radio" id="perempuan" name="gender" value="perempuan" checked="checked">
            <label for="perempuan">Perempuan</label>
          @endif
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
            ], $guru->agama, ['class' => 'form-control data-add','id' => 'agamas']) !!}
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
            ], $guru->jabatan, ['class' => 'form-control data-add','id' => 'jabatans']) !!}
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
              ),$guru->status,['class' => 'form-control data-add','id' => 'statuss']) }}
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
            ], $guru->pdd_akhir, ['class' => 'form-control data-add','id' => 'pdds']) !!}
            @if($errors->has('pdd_akhir'))<small class="reds"><i>* {!!$errors->first('pdd_akhir')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="username">Username :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
            <input type="text" class="form-control data-add" id="data_id_1" name="username" autocomplete="off" value="{{ $guru->username }}" disabled>
              @if($errors->has('username'))<small class="reds"><i>* {!!$errors->first('username')!!}</i></small>@endif <br/>
                <input type="checkbox" name="check" id="check_2" class="icheckbox"><small>&nbsp;&nbsp;<i>* Ceklis jika Username & password akan diubah</i></small>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="password">Password :</label>
        </div>
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
            <input type="password" class="form-control data-add" id="data_id_2" name="password" placeholder="******" autocomplete="off" disabled>
           @if($errors->has('password'))<small class="reds"><i>* {!!$errors->first('password')!!}</i></small>@endif <br/>
            <input type="checkbox" name="check" id="show_pass" class="icheckbox"><small>&nbsp;&nbsp;<i>* Show Password</i></small>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="file">Foto :</label>
        </div>
        <div class="form-group col-md-6 col-lg-6 col-xs-12">
          <input type="file" id="file" name="image">
          @if($errors->has('image'))<small class="reds"><i>* {!!$errors->first('image')!!}</i></small>@endif
          <p class="help-block">
            <small class="blue">* Pilih foto jika diupdate</small>
            <small class="blue">** Kosongkan jika tidak diupdate</small>
          </p>
        </div>
          <div class="form-group col-md-3 col-lg-3 col-xs-12">
            <img class="berita-images" src="{{ asset('uploads/images') }}/{{ $guru->foto }}">
          </div>
      </div>               
    </div>
    <div class="modal-footer bg-blue padding-teen">
      <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
      <button type="submit" id="btn-edit-guru" class="btn btn-sm btn-green">Save changes</button>
    </div>
  {!! Form::close() !!}


  <script type="text/javascript">
    $("#tanggal3").datepicker({
      format:'yyyy-mm-dd'
    });

    $("#tahun1").datepicker({
      format:'yyyy-mm-dd'
    });

    //Money Euro
      $("[data-mask]").inputmask();
      
      $('.btn-defaulty').click(function(){
        $('.reds').fadeOut();
          $('.data-add').val('');
    });

    //checked password
      $('#check_2').click(function(){
        $('#data_id_1').removeAttr('disabled');
          $('#data_id_2').removeAttr('disabled');
            $('#data_id_2').attr('required','true');

        $('#check_2').click(function(){
          $('#data_id_1,#data_id_2').attr('disabled',$(this).is(':checked') ? 
            $('#data_id_1,#data_id_2').attr('disabled'):$('#data_id_1,#data_id_2').removeAttr('disabled'));
        });
      });

      // show pass
        $('#show_pass').click(function(){
          $('#password,#data_id_2').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });

        $('#show_pass_1').click(function(){
          $('#password,#id_1').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });

        $('#show_pass_2').click(function(){
          $('#password,#id_2').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });

        $('#show_pass_3').click(function(){
          $('#password,#id_3').attr('type', $(this).is(':checked') ? 'text' : 'password');
        });
  </script>