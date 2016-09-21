<div class="modal-header bg-blue">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Form Data Managemen Menu</h4>
</div>
  <!-- form Edit start -->
  {!! Form::open(array('url' => ['menu/update', $menu_app->id])) !!}
    <div class="modal-body">
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="nama_menu">Nama Menu :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <input type="text" class="form-control" id="nama" name="nama_menu" value="{{ $menu_app->nama_menu }}" autofocus="autofocus" autocomplete="off">
        @if($errors->has('nama_menu'))<small class="reds"><i>* {!!$errors->first('nama_menu')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="link_menu">Link Menu :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <input type="text" class="form-control" id="link_menu" name="link_menu" value="{{ $menu_app->link_menu }}" autocomplete="off" readonly>
        @if($errors->has('link_menu'))<small class="reds"><i>* {!!$errors->first('link_menu')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="icon_menu">Icon Menu :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <input type="text" class="form-control" id="icon_menu" name="icon_menu" value="{{ $menu_app->icon_menu }}" autocomplete="off">
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
                  ),$menu_app->is_aktiv,['class' => 'form-control']) }}
        @if($errors->has('aktiv_menu'))<small class="reds"><i>* {!!$errors->first('aktiv_menu')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="parent_menu">Parent Menu :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
            <select class="form-control" name="parent_menu">
            <option value="1">Menu Utama</option>
        @foreach ($menu as $m)
          @if ( $m->id <= 2  )
          @else
            @if ( $menu_app->parent_menu == $m->id )
                <option value="{{ $menu_app->parent_menu }}" selected="selected">{{ strtoupper($m->nama_menu) }}</option>
                  @elseif ( $m->parent_menu >= 2 || $m->id == $menu_app->id || $m->hak_akses == 3 )
                  @else
                <option value="{{ $m->id }}">{{ strtoupper($m->nama_menu) }}</option>
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
                  ),$menu_app->hak_akses,['class' => 'form-control']) }}
        @if($errors->has('hak_akses'))<small class="reds"><i>* {!!$errors->first('hak_akses')!!}</i></small>@endif
        </div>
      </div>
    </div>
    <div class="modal-footer bg-blue padding-teen">
      <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
      <button type="submit" id="btn-menu-edit" class="btn btn-sm btn-green">Save changes</button>
    </div>
  {!! Form::close() !!}
  <script type="text/javascript">
    $('.btn-defaulty').click(function(){
        $('.reds').fadeOut();
          $('.data-add').val('');
    });
  </script>