<div class="modal-header bg-blue">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Form Data Menu Frontend</h4>
</div>
  <!-- form Edit start -->
  {!! Form::open(array('action' => ['Admin\DataStatisController@updateMenu',$menu->id_menu])) !!}
    <div id="add-menu" class="modal-body">
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="hak_akses">ID Menu :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <input type="text" class="form-control data-add" id="id_menu" name="id_menu" value="{{ $menu->id_menu }}" readonly="true">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="nama_menu">Nama Menu :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <input type="text" class="form-control data-add" id="nama_menuu" name="nama" value="{{ $menu->nama_menu }}" autofocus="autofocus" autocomplete="off">
          @if($errors->has('nama'))<small class="reds"><i>* {!!$errors->first('nama')!!}</i></small>@endif
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="icon_menu">Icon Menu :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
          <input type="text" class="form-control data-add" id="icon_menu" name="icon" value="{{ $menu->icon_menu }}" autofocus="autofocus" autocomplete="off">
          @if($errors->has('icon'))<small class="reds"><i>* {!!$errors->first('icon')!!}</i></small>@endif
          <a target="_blank" href="http://fontawesome.io/icons/">*<small><i> Referensi Icon Menu</i></small></a>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3 col-lg-3 col-xs-12">
          <label for="parent_menu">Parent Menu :</label>
        </div>
        <div class="form-group col-md-9 col-lg-9 col-xs-12">
            <select class="form-control data-add" name="parent_menu" id="parent_menu">
              @if($menu->parent_id == 0)
                  <option selected="selected" value="{{ $menu->parent_id }}">{{ strtoupper($menu->nama_menu) }}</option>
              @else
                @foreach ( $menu_front as $m )
                  @if($m->id_menu == $menu->parent_id)
                  <option selected="selected" value="{{ $menu->parent_id }}">{{ strtoupper($m->nama_menu) }}</option>
                  @else
                    @if($m->id_menu == 1)
                    @else
                    <option value="{{ $m->id_menu }}">{{ strtoupper($m->nama_menu) }}</option>
                    @endif
                    @endif
                @endforeach
              @endif

            </select>
        </div>
      </div>
    </div>
    <div class="modal-footer bg-blue padding-teen">
      <button type="button" class="btn btn-sm btn-defaulty" data-dismiss="modal">Close</button>
      <button type="submit" id="front" class="btn btn-sm btn-green">Save</button>
    </div>
  {!! Form::close() !!}