  <div class="modal-header bg-aqua">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Form Data Siswa</h4>
  </div>
      <!-- form start -->
      {!! Form::open(array('action' => 'Admin\SiswaController@addNew','files' =>'true')) !!}
<!-- START CUSTOM TABS -->
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#tab_1" data-toggle="tab"><label>Biodata Siswa</label></a></li>
        <li><a href="#tab_2" data-toggle="tab"><label>Orang Tua</label></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="top">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="nis">NIS :</label>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <input type="text" class="form-control data-add" id="nis" name="nis" placeholder="Ex. 1234567990" autofocus="autofocus" autocomplete="off">
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
                  <input type="text" class="form-control data-add" id="nama_siswa" name="nama" placeholder="Nama lengkap" autocomplete="off">
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
                  <input type="text" class="form-control data-add" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat lahir" autocomplete="off">
                  @if($errors->has('tempat_lahir'))<small class="reds"><i>* {!!$errors->first('tempat_lahir')!!}</i></small>@endif
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-4">
                  <input type="text" class="form-control data-add" id="tanggal1" name="tgl_lahir" placeholder="Tanggal lahir" autocomplete="off">
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
                  <textarea class="form-control data-add" id="alamat" name="alamat" placeholder="Alamat"></textarea>
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
                  <input type="text" class="form-control data-add" id="telpon" name="telpon" data-inputmask='"mask": "(9999) 99-999-999"' data-mask name="telpon" placeholder="No. telpon" autocomplete="off">
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
                    <input type="radio" id="laki-laki" name="gender" value="laki-laki" checked="checked">
                    <label for="laki-laki">Laki-laki</label>
                    <input type="radio" id="perempuan" name="gender" value="perempuan">
                    <label for="perempuan">Perempuan</label>
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
                  ], '', ['class' => 'form-control data-add','id' => 'agama','placeholder' => '--pilih--']) !!}
                    @if($errors->has('agama'))<small class="reds"><i>* {!!$errors->first('agama')!!}</i></small>@endif
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="tahun_masuk">Tahun Masuk :</label>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                    <select class="form-control data-add" name="tahun_masuk" id="tahun_masuk">
                    <option selected="selected" value="">--pilih--</option>

                      @foreach ( $tahuns as $tahun )
                          <option value="{{ strtoupper($tahun->id_tahun) }}">{{ strtoupper($tahun->tahun) }}</option>
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
                  <textarea class="form-control data-add" id="asal_sekolah" name="asal_sekolah" placeholder="Sekolah asal"></textarea>
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
                  <input type="text" class="form-control data-add" id="nama_wali" name="nama_wali" placeholder="Nama Orang Tua/Wali" autocomplete="off">
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
                  <textarea class="form-control data-add" id="alamat_wali" name="alamat_wali" placeholder="Alamat Orang tua/wali"></textarea>
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
                            ),'siswa',['class' => 'form-control data-add']) }}
                            @if($errors->has('status'))<small class="reds"><i>* {!!$errors->first('status')!!}</i></small>@endif
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="status">Tahun lulus :</label>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <input type="text" name="tahun_lulus" class="form-control" placeholder="2015/2016">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <label for="exampleInputFile">Foto :</label>
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <input type="file" id="foto" class="data-add" name="foto">
                  @if($errors->has('foto'))<small class="reds"><i>* {!!$errors->first('foto')!!}</i></small>@endif
                  <p class="help-block"><small class="blue">* Pilih foto</small></p>
                </div>
                <div class="form-group col-md-3 col-lg-3 col-xs-12">
                  <img class="berita-images" src="http://placehold.it/100x100" id="showgambar">
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <div class="top">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="anak_ke">Anak Ke :</label>
                  {{ Form::select("anak_ke",array(
                                'pertama'=>'Pertama','kedua'=>'Kedua','ketiga'=>'Ketiga',
                                'keempat'=>'Keempat', 'kelima'=>'Kelima','keenam'=>'Keenam'
                            ),1,['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="jml_sdr">Jumlah Saudara :</label>
                  {{ Form::select("jml_sdr",array(
                                '1'=>'1 (Satu)','2'=>'2 (Dua)','3'=>'3 (Tiga)',
                                '4'=>'4 (Empat)', '5'=>'5 Lima)','6'=>'6 (Enam)'
                            ),1,['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="nama_ayah">Nama Ayah :</label>
                  <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" autocomplete="off">
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="nama_ibu">Nama Ibu :</label>
                  <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" autocomplete="off">
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
                  ], '', ['class' => 'form-control data-add','id' => 'agama_ayah','placeholder' => '--pilih--']) !!}
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
                  ], '', ['class' => 'form-control data-add','id' => 'agama_ibu','placeholder' => '--pilih--']) !!}
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
                    ],'', ['class' => 'form-control data-add','id' => 'pdd_ayah','placeholder' => '--pilih--']) !!}
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
                    ],'', ['class' => 'form-control data-add','id' => 'pdd_ibu','placeholder' => '--pilih--']) !!}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="kerja_ayah">Pekerjaan Ayah :</label>
                  {{ Form::select("pekerjaan_ayah",array(
                                'tidak bekerja' => 'TIDAK BEKERJA','nelayan' => 'NELAYAN','petani' => 'PETANI',
                                'peternak' => 'PETERNAK','pns/tni/polri' => 'PNS/ TNI/ POLRI','karyawan swasta' => 'KARYAWAN SWASTA',
                                'pedagang kecil' => 'pedagang besar','9' => 'PEDAGANG BESAR','wiraswasta' => 'WIRASWASTA',
                                'wirausaha' => 'WIRAUSAHA','buruh' => 'BURUH','pensiunan' => 'PENSIUNAN','lainnya' => 'LAINNYA'
                            ),'tidak bekerja',['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xs-12">
                  <label for="kerja_ibu">Pekerjaan Ibu :</label>
                  {{ Form::select("pekerjaan_ibu",array(
                                'tidak bekerja' => 'TIDAK BEKERJA','nelayan' => 'NELAYAN','petani' => 'PETANI',
                                'peternak' => 'PETERNAK','pns/tni/polri' => 'PNS/ TNI/ POLRI','karyawan swasta' => 'KARYAWAN SWASTA',
                                'pedagang kecil' => 'pedagang besar','9' => 'PEDAGANG BESAR','wiraswasta' => 'WIRASWASTA',
                                'wirausaha' => 'WIRAUSAHA','buruh' => 'BURUH','pensiunan' => 'PENSIUNAN','lainnya' => 'LAINNYA'
                            ),'tidak bekerja',['class' => 'form-control']) }}
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.tab-pane -->
      </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
<!-- END CUSTOM TABS -->
    <div class="modal-footer bg-aqua padding-teen">
      <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
      <button type="submit" id="btn-add-siswa" class="btn btn-sm btn-green">Save</button>
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

    $("#foto").change(function () {
        readURL(this);
    });

    $("#tanggal1").datepicker({
      format:'yyyy-mm-dd'
    });

    $("#tahun1").datepicker({
      format:'yyyy-mm-dd'
    });

    //Money Euro
      $("[data-mask]").inputmask();

      // Hapus message
    $('.btn-defaulty').click(function(){
        $('.reds').fadeOut();
          $('.data-add').val('');
            $('#showgambar').attr('src', 'http://placehold.it/100x100');
    });
  </script>