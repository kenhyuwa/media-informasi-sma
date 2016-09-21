<div class="row">
  <div class="form-group col-md-3 col-lg-3 col-xs-12">
    <label for="nama_menu">Nama Menu :</label>
  </div>
  <div class="form-group col-md-9 col-lg-9 col-xs-12">
    <input type="text" class="form-control data-add" id="nama_menu" name="nama_menu" placeholder="Menu Utama" autofocus="autofocus" autocomplete="off">
    @if($errors->has('nama_menu'))<small class="reds"><i>* {!!$errors->first('nama_menu')!!}</i></small>@endif
  </div>
</div>
<div class="row">
  <div class="form-group col-md-3 col-lg-3 col-xs-12">
    <label for="link_menu">Link Menu :</label>
  </div>
  <div class="form-group col-md-9 col-lg-9 col-xs-12">
    <input type="text" class="form-control data-add" id="link_menu" name="link_menu" autofocus="autofocus" autocomplete="off" placeholder="dashboards">
    @if($errors->has('link_menu'))<small class="reds"><i>* {!!$errors->first('link_menu')!!}</i></small>@endif
  </div>
</div>
<div class="row">
  <div class="form-group col-md-3 col-lg-3 col-xs-12">
    <label for="icon_menu">Icon Menu :</label>
  </div>
  <div class="form-group col-md-9 col-lg-9 col-xs-12">
    <input type="text" class="form-control data-add" id="icon_menu" name="icon_menu" placeholder="fa fa-user" autofocus="autofocus" autocomplete="off">
    @if($errors->has('icon_menu'))<small class="reds"><i>* {!!$errors->first('icon_menu')!!}</i></small>@endif
    <a target="_blank" href="http://fontawesome.io/icons/">*<small><i> Referensi Icon Menu</i></small></a>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-3 col-lg-3 col-xs-12">
    <label for="aktiv_menu">Aktivasi Menu :</label>
  </div>
  <div class="form-group col-md-9 col-lg-9 col-xs-12">
      {{ Form::select("aktiv_menu",array(
                    '1'=>'YA','0'=>'Tidak Aktiv'
                ),'',['id' => 'aktiv_menu','class' => 'form-control data-add','placeholder' => '--pilih--']) }}
    @if($errors->has('aktiv_menu'))<small class="reds"><i>* {!!$errors->first('aktiv_menu')!!}</i></small>@endif
  </div>
</div>
<div class="row">
  <div class="form-group col-md-3 col-lg-3 col-xs-12">
    <label for="parent_menu">Parent Menu :</label>
  </div>
  <div class="form-group col-md-9 col-lg-9 col-xs-12">
      <select class="form-control data-add" name="parent_menu" id="parent_menu">
          <option selected="selected" value="">--pilih--</option>
          <option value="1">Menu Utama</option>
        @foreach ( $menu_app as $menu )
          @if ( $menu->id !== 1 && $menu->id !== 2 )
            @if( $menu->parent_menu !== 1 || $menu->hak_akses == 3 )
            @else
            <option value="{{ $menu->id }}">{{ strtoupper($menu->nama_menu) }}</option>
            @endif
          @endif
        @endforeach

      </select>
    @if($errors->has('parent_menu'))<small class="reds"><i>* {!!$errors->first('parent_menu')!!}</i></small>@endif
  </div>
</div>
<div class="row">
  <div class="form-group col-md-3 col-lg-3 col-xs-12">
    <label for="hak_akses">Hak Akses Menu :</label>
  </div>
  <div class="form-group col-md-9 col-lg-9 col-xs-12">
      {{ Form::select("hak_akses",array(
                    '1'=>'ADMINISTRATOR', '2' =>'ADMIN & GURU', '3' =>'SISWA'
                ),'',['id' => 'hak_akses','class' => 'form-control data-add','placeholder' => '--pilih--']) }}
    @if($errors->has('hak_akses'))<small class="reds"><i>* {!!$errors->first('hak_akses')!!}</i></small>@endif
  </div>
</div>
<script type="text/javascript">
  $('.btn-defaulty').click(function(){
        $('.reds').fadeOut();
          $('.data-add').val('');
    });
</script>