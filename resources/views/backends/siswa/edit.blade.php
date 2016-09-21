<div class="modal-header bg-blue">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Form Data Siswa</h4>
</div>
      <!-- form start -->
      {!! Form::open(array('action' => ['Admin\SiswaController@update' ,$siswa->id_siswa],'files' =>'true')) !!}
<!-- START CUSTOM TABS -->
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#tab_3" data-toggle="tab"><label>Biodata Siswa</label></a></li>
        <li><a href="#tab_4" data-toggle="tab"><label>Orang Tua</label></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_3">
          <div class="top">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="nis">NIS :</label>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <input type="text" class="form-control data-add" id="nis" name="nis" value="{{ $siswa->nis }}" autocomplete="off" readonly="true">
                  @if($errors->has('nis'))<small class="reds"><i>* {!!$errors->first('nis')!!}</i></small>@endif
                </div>
               </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="nama">Nama lengkap :</label>
                </div>
                <div class="form-group col-md-9 col-lg-9 col-xs-12">
                  <input type="text" class="form-control data-add" id="nama_siswas" name="nama" value="{{ $siswa->nama }}" autocomplete="off">
                  @if($errors->has('nama'))<small class="reds"><i>* {!!$errors->first('nama')!!}</i></small>@endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="tempat_lahir">Tempat & TGL. Lahir :</label>
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-9">
                  <input type="text" class="form-control data-add" id="tempat_lahirs" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}" autocomplete="off">
                  @if($errors->has('tempat_lahir'))<small class="reds"><i>* {!!$errors->first('tempat_lahir')!!}</i></small>@endif
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-4">
                  <input type="text" class="form-control data-add" id="tanggal-lahir" name="tgl_lahir" value="{{ $siswa->tgl_lahir }}">
                  @if($errors->has('tgl_lahir'))<small class="reds"><i>* {!!$errors->first('tgl_lahir')!!}</i></small>@endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="alamat">Alamat :</label>
                </div>
                <div class="form-group col-md-9 col-lg-9 col-xs-12">
                  <textarea class="form-control data-add" id="alamats" name="alamat">{{ $siswa->alamat }}</textarea>
                  @if($errors->has('alamat'))<small class="reds"><i>* {!!$errors->first('alamat')!!}</i></small>@endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="telpon">No. telpon :</label>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <input type="text" class="form-control data-add" id="telpon" name="telpon" data-inputmask='"mask": "(9999) 99-999-999"' data-mask name="telpon" value="{{ $siswa->no_telp }}" autocomplete="off">
                  @if($errors->has('telpon'))<small class="reds"><i>* {!!$errors->first('telpon')!!}</i></small>@endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                    <label for="gender">Jenis kelamin :</label>
                  </div>
                  <div class="form-group col-md-3 col-lg-3 col-xs-12">
                    @if($siswa->gender == 'laki-laki')
                      <input type="radio" name="gender" value="laki-laki" checked="checked"> Laki-laki&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="radio" name="gender" value="perempuan"> Perempuan
                      @else
                      <input type="radio" name="gender" value="laki-laki"> Laki-laki&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="radio" name="gender" value="perempuan" checked="checked"> Perempuan
                    @endif
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
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
                  ], $siswa->agama, ['class' => 'form-control data-add','id' => 'agamas']) !!}
                  @if($errors->has('agama'))<small class="reds"><i>* {!!$errors->first('agama')!!}</i></small>@endif
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="tahun_masuk">Tahun Masuk :</label>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                    <select class="form-control data-add" name="tahun_masuk" id="tahun_masuks">
                      <option selected="selected" value="{{ $siswa->tahun_masuk }}">{{ strtoupper($siswa->getTahun->tahun) }}</option>
                      @foreach ( $tahuns as $tahun )
                        @if($tahun->tahun===$siswa->getTahun->tahun)
                        @else
                            <option value="{{ $tahun->id_tahun }}">{{ strtoupper($tahun->tahun) }}</option>
                        @endif
                      @endforeach
                    </select>
                    @if($errors->has('tahun_masuk'))<small class="reds"><i>* {!!$errors->first('tahun_masuk')!!}</i></small>@endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="asal_sekolah">Sekolah Asal :</label>
                </div>
                <div class="form-group col-md-9 col-lg-9 col-xs-12">
                  <textarea class="form-control data-add" id="asal_sekolahs" name="asal_sekolah">{{ $siswa->sekolah_asal }}</textarea>
                  @if($errors->has('asal_sekolah'))<small class="reds"><i>* {!!$errors->first('asal_sekolah')!!}</i></small>@endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="nama_wali">Nama Orang Tua/Wali :</label>
                </div>
                <div class="form-group col-md-9 col-lg-9 col-xs-12">
                  <input type="text" class="form-control data-add" id="nama_walis" name="nama_wali" value="{{ $siswa->nama_ortu_wali }}" autocomplete="off">
                  @if($errors->has('nama_wali'))<small class="reds"><i>* {!!$errors->first('nama_wali')!!}</i></small>@endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="alamat_wali">Alamat Orang Tua/Wali :</label>
                </div>
                <div class="form-group col-md-9 col-lg-9 col-xs-12">
                  <textarea class="form-control data-add" id="alamat_walis" name="alamat_wali">{{ $siswa->alamat_ortu_wali }}</textarea>
                  @if($errors->has('alamat_wali'))<small class="reds"><i>* {!!$errors->first('alamat_wali')!!}</i></small>@endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="status">Status :</label>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  {{ Form::select("status",array(
                      'siswa'=>'Siswa','alumni'=>'Alumni'
                  ),$siswa->status,['class' => 'form-control data-add']) }}
                  @if($errors->has('status'))<small class="reds"><i>* {!!$errors->first('status')!!}</i></small>@endif
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="status">Tahun lulus :</label>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <input type="text" name="tahun_lulus" class="form-control" value="{{ $siswa->tahun_lulus }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="username">Username :</label>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                    <input type="text" class="form-control data-add" id="data_id_1" name="username" autocomplete="off" value="{{ $siswa->username }}" disabled>
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
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="exampleInputFile">Foto :</label>
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <input type="file" id="foto" name="image">
                  @if($errors->has('image'))<small class="reds"><i>* {!!$errors->first('image')!!}</i></small>@endif
                <p class="help-block">
                  <small class="blue">* Pilih foto jika diupdate</small><br />
                  <small class="blue">** Kosongkan jika tidak diupdate</small>
                </p>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <img class="berita-images" src="{{ asset('uploads-smasimo/images') }}/{{ $siswa->foto }}">
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
          <div class="top">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="anak_ke">Anak Ke :</label>
                  {{ Form::select("anak_ke",array(
                                          'pertama'=>'Pertama','kedua'=>'Kedua','ketiga'=>'Ketiga',
                                'keempat'=>'Keempat', 'kelima'=>'Kelima','keenam'=>'Keenam'
                                      ),$siswa->anak_ke,['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="jml_sdr">Jumlah Saudara :</label>
                  {{ Form::select("jml_sdr",array(
                                          '1'=>'1 (Satu)','2'=>'2 (Dua)','3'=>'3 (Tiga)',
                                          '4'=>'4 (Empat)', '5'=>'5 Lima)','6'=>'6 (Enam)'
                                      ),$siswa->jumlah_sdr,['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="nama_ayah">Nama Ayah :</label>
                  <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ $siswa->nama_ayah }}" autocomplete="off">
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="nama_ibu">Nama Ibu :</label>
                  <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ $siswa->nama_ibu }}" autocomplete="off">
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="agama_ayah">Agama Ayah :</label>
                    {!! Form::select('agama_ayah', [
                        'islam' => 'ISLAM',
                        'kristen' => 'KRISTEN',
                        'hindhu' => 'HINDHU',
                        'budha' => 'BUDHA',
                        'katolik' => 'KATOLIK',
                        'lainnya' => 'LAINNYA',
                  ], $siswa->agama_ayah, ['class' => 'form-control data-add','id' => 'agama_ayah']) !!}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="agama_ibu">Agama Ibu :</label>
                    {!! Form::select('agama_ibu', [
                        'islam' => 'ISLAM',
                        'kristen' => 'KRISTEN',
                        'hindhu' => 'HINDHU',
                        'budha' => 'BUDHA',
                        'katolik' => 'KATOLIK',
                        'lainnya' => 'LAINNYA',
                  ], $siswa->agama_ibu, ['class' => 'form-control data-add','id' => 'agama_ibu']) !!}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="pdd_ayah">Pendidikan Terakhir Ayah :</label>
                    {!! Form::select('pdd_ayah', [
                          'sd' => 'SD',
                          'smp' => 'SMP',
                          'sma' => 'SMA',
                          's1' => 'S1',
                          's2' => 'S2',
                          's3' => 'S3',
                          '-' => '-',
                    ],$siswa->pdd_akhir_ayah, ['class' => 'form-control data-add','id' => 'pdd_ayah']) !!}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="pdd_ibu">Pendidikan Terakhir Ibu :</label>
                    {!! Form::select('pdd_ibu', [
                          'sd' => 'SD',
                          'smp' => 'SMP',
                          'sma' => 'SMA',
                          's1' => 'S1',
                          's2' => 'S2',
                          's3' => 'S3',
                          '-' => '-',
                    ],$siswa->pdd_akhir_ibu, ['class' => 'form-control data-add','id' => 'pdd_ibu']) !!}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="kerja_ayah">Pekerjaan Ayah :</label>
                  {{ Form::select("pekerjaan_ayah",array(
                                'tidak bekerja' => 'TIDAK BEKERJA','nelayan' => 'NELAYAN','petani' => 'PETANI',
                                'peternak' => 'PETERNAK','pns/tni/polri' => 'PNS/ TNI/ POLRI','karyawan swasta' => 'KARYAWAN SWASTA',
                                'pedagang kecil' => 'pedagang besar','9' => 'PEDAGANG BESAR','wiraswasta' => 'WIRASWASTA',
                                'wirausaha' => 'WIRAUSAHA','buruh' => 'BURUH','pensiunan' => 'PENSIUNAN','lainnya' => 'LAINNYA'
                            ),$siswa->pekerjaan_ayah,['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="kerja_ibu">Pekerjaan Ibu :</label>
                  {{ Form::select("pekerjaan_ibu",array(
                                'tidak bekerja' => 'TIDAK BEKERJA','nelayan' => 'NELAYAN','petani' => 'PETANI',
                                'peternak' => 'PETERNAK','pns/tni/polri' => 'PNS/ TNI/ POLRI','karyawan swasta' => 'KARYAWAN SWASTA',
                                'pedagang kecil' => 'pedagang besar','9' => 'PEDAGANG BESAR','wiraswasta' => 'WIRASWASTA',
                                'wirausaha' => 'WIRAUSAHA','buruh' => 'BURUH','pensiunan' => 'PENSIUNAN','lainnya' => 'LAINNYA'
                            ),$siswa->pekerjaan_ibu,['class' => 'form-control']) }}
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.tab-pane -->
      </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
<!-- END CUSTOM TABS -->
    <div class="modal-footer bg-blue padding-teen">
      <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
      <button type="submit" id="btn-edit-siswa" class="btn btn-sm btn-green">Save changes</button>
    </div>
  {!! Form::close() !!}


  <script type="text/javascript">

    $("#tanggal-lahir").datepicker({
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