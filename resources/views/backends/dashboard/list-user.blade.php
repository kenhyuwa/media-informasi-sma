<div class="row">
@foreach( $users as $user )
@if( $user->getUser->gender == 'laki-laki' )
<div class="col-lg-6 col-md-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-red">
      <center>
    @if (count($user->getUser->foto))
        <img class="guru-images" src="{{asset('uploads/images')}}/{{$user->getUser->foto}}">
        @else
        <img class="guru-images" src="{{asset('uploads/images/default.gif')}}">
    @endif
      </center>
    </span>
    <div class="info-box-content">
      <table>
        <tr>
          <td class="hidden-xs">NIP</td>
          <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
          <td>&nbsp;&nbsp;{{ $user->getUser->nip }}</td>
        </tr>
        <tr>
          <td class="hidden-xs">Nama</td>
          <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
          <td>&nbsp;&nbsp;{{ ucwords($user->getUser->nama_guru) }}</td>
        </tr>
        <tr>
          <td class="hidden-xs">Username</td>
          <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
          <td>&nbsp;&nbsp;{{ $user->getUser->username }}</td>
        </tr>
        <tr>
          <td class="hidden-xs">Hak akses</td>
          <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
          <td>&nbsp;&nbsp;{{ strtoupper($user->getRole->nama_role) }}</td>
        </tr>
      </table>
    <span class="pull-right right bottom arrow-user">
      <a type="button" data-id="{{ $user->getUser->id_guru }}" data-toggle="modal" data-target="#modal-user" data-toggle="tooltip" title="Update" class="user-update"><i class="fa fa-arrow-right blue"></i></a>
    </span>
    </div><!-- /.info-box-content -->
    <div class="right-box">
      @if($user->role_id == 3)
      <button id="btn-go-admin" data-id="{{ $user->user_id }}" class="btn btn-sm btn-aqua">Up-Admin</button>
      @elseif($user->role_id == 2)
      <button id="btn-down-admin" data-id="{{ $user->user_id }}" class="btn btn-sm btn-reds">Down-Admin</button>
      @endif
    </div>
  </div><!-- /.info-box -->
</div>
@else
<div class="col-lg-6 col-md-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-aqua">
      <center>
    @if (count($user->getUser->foto))
        <img class="guru-images" src="{{asset('uploads/images')}}/{{$user->getUser->foto}}">
        @else
        <img class="guru-images" src="{{asset('uploads/images/default.gif')}}">
    @endif
      </center>
    </span>
    <div class="info-box-content">
      <table>
        <tr>
          <td class="hidden-xs">NIP</td>
          <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
          <td>&nbsp;&nbsp;{{ $user->getUser->nip }}</td>
        </tr>
        <tr>
          <td class="hidden-xs">Nama</td>
          <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
          <td>&nbsp;&nbsp;{{ ucwords($user->getUser->nama_guru) }}</td>
        </tr>
        <tr>
          <td class="hidden-xs">Username</td>
          <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
          <td>&nbsp;&nbsp;{{ $user->getUser->username }}</td>
        </tr>
        <tr>
          <td class="hidden-xs">Hak akses</td>
          <td class="hidden-xs">&nbsp;&nbsp;&nbsp;:</td>
          <td>&nbsp;&nbsp;{{ strtoupper($user->getRole->nama_role) }}</td>
        </tr>
      </table>
    <span class="pull-right right bottom arrow-user">
      <a type="button" data-id="{{ $user->getUser->id_guru }}" data-toggle="modal" data-target="#modal-user" data-toggle="tooltip" title="Update" class="user-update"><i class="fa fa-arrow-right blue"></i></a>
    </span>
    </div><!-- /.info-box-content -->
    <div class="right-box">
      @if($user->role_id == 3)
      <button id="btn-go-admin" data-id="{{ $user->user_id }}" class="btn btn-sm btn-aqua">Up-Admin</button>
      @elseif($user->role_id == 2)
      <button id="btn-down-admin" data-id="{{ $user->user_id }}" class="btn btn-sm btn-reds">Down-Admin</button>
      @endif
    </div>
  </div><!-- /.info-box -->
</div>
@endif
@endforeach
</div>
<div class="pull-right right">
  {{ $users->links() }}
</div>