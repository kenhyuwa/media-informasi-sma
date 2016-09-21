@extends('backends.layouts.master')
@section('content')
          <div class="row">
            <div class="col-md-12 col-md-12 col-xs-12 col-sm-12">
              <div id="content" class="col-md-12 clearfix">
                <div class="flat-top flat-aqua"></div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="box-body">
                          <!-- form start -->
                            {!! Form::open(array('action' => ['Admin\DataDinamisController@updateBerita', $berita->id_berita],'files' => 'true')) !!}
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="nama_menu">Judul berita : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <input type="text" id="judul_berita" name="judul_berita" class="form-control" value="{{ $berita->judul_berita }}">
                                    @if($errors->has('judul_berita'))<small class="reds"><i>* {!!$errors->first('judul_berita')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="content">Content : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <textarea class="form-control" id="berita-content" name="content">{{ $berita->isi_berita }}</textarea>
                                    @if($errors->has('content'))<small class="reds"><i>* {!!$errors->first('content')!!}</i></small>@endif
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-2 col-lg-2 col-xs-12">
                                    <label for="content">Gambar : </label>
                                  </div>
                                  <div class="form-group col-md-10 col-lg-10 col-xs-12">
                                    <input type="file" id="foto" name="gambar">
                                    @if($errors->has('gambar'))<small class="reds"><i>* {!!$errors->first('gambar')!!}</i></small>@endif
                                  </div>
                                  <div>
                                    <img class="berita-images" src="{{ asset('uploads/images') }}/{{ $berita->gambar }}" id="showgambar">
                                  </div>
                                </div>
                              <div class="box-footer col-md-12 col-lg-12 col-xs-12">
                                <div class="form-group pull-right">
                                  <a href="{{ URL('indexs-berita') }}" class="btn btn-sm btn-yellow">Cancel</a>
                                  <button type="submit" id="add-berita" class="btn btn-sm btn-green">Update</button>
                                </div>
                              </div>
                          {!! Form::close() !!}
                      </div><!-- /.box-body -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
@endsection
@section('script')
<script type="text/javascript">
  $(function(){
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
  });
</script>
@endsection