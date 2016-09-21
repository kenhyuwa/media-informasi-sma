@if( Session::has( 'error' ) )
<div class="alert alert-reds">
  <button type="button" class="close" data-dismiss="alert">
    <i class="fa fa-times"></i>
  </button>
  <center>
    <i class="ace-icon fa fa-warning"></i>
      <strong>
        {{ Session::get('error') }}
      </strong>
  </center>
</div><!--/alert-->
@endif