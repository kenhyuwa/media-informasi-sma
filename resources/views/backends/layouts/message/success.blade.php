@if( Session::has( 'success' ) )
<div class="alert alert-aqua">
  <button type="button" class="close" data-dismiss="alert">
    <i class="fa fa-times"></i>
  </button>
  <center>
    <i class="ace-icon fa fa-warning"></i>
      <strong>
        {{ Session::get('success') }}
      </strong>
  </center>
</div><!--/alert-->
@endif