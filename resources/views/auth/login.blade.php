<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ ucwords($identitas->nama_sekolah) }} | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="{{asset('uploads/images')}}/{{ $identitas->logo }}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('asset-sma/bootstrap-customize/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('asset-frontend/font-awesome/css/font-awesome.min.css')}}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('asset-frontend/Customize/css/login.css') }}">
    <!-- customize css -->
    <link href="{{ asset('asset-sma/OxigGn/css/OxigGn-login.css') }}" rel="stylesheet">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
        <div class="box-inner-1"></div>
        <div class="box-inner-2"></div>
        <div class="box-inner-3"></div>
        <div class="box-inner-4"></div>
      <div class="login-box-body">
          <div class="center">
            <center>
              <h3 class="header blue lighter bigger">
                <i class="fa fa-cogs fa-2x blue-fish hidden-xs"></i>
                <i class="fa fa-cogs blue-fish hidden-sm hidden-lg"></i>
                <span class="green" id="id-text2">{{ $content[2] }}</span>
              </h3>
            </center>
          </div>
              <div id="callback" class="alert-block" style="display: none">
                <center>
                  <i class="fa fa-warning"></i>
                  <strong id="message" class="blue"></strong>
                </center>
              </div>
              @if(Notify()->ready())
              <div class="alert alert-block alert-dangerous">
                <button type="button" class="close" data-dismiss="alert">
                  <i class="fa fa-times"></i>
                </button>
                <center>
                  <i class="fa fa-warning"></i>
                <strong class="blue">
                  {{ notify()->message() }}
                </strong>
                </center>
              </div>
              @endif

              <form method="POST" action="{{url(action('AuthController@postLogin'))}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}" method="POST">
                <div class="form-group has-feedback">
                  <input id="username" name="username" type="text" class="form-control-custom" placeholder="Username" autocomplete="off" autofocus="true" />
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input id="password" name="password" type="password" class="form-control-custom" placeholder="Password"/>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                  <button id="loading-btn" type="submit" class="btn btn-primary btn-block btn-flat width bottom" data-loading-text="Please waiting..." onclick="return myValidation();">
                    <i class="fa fa-key"></i>
                    <span class="bigger-110">{{ ucwords($content[3]) }}</span>
                  </button>
                  </div><!-- /.col -->
                  <div class="col-xs-12">
                    <span class="pull-right black bottom">&nbsp;&nbsp;</span>
                  </div><!-- /.col -->
                </div>
              </form>
              <div class="row">
                  <div class="col-xs-12">
                    <a href="{{ url('/') }}"><center><small>{{ strtolower($identitas->nama_web) }}</small></center></a>
                    <div class="box-inner-5 hidden-xs"></div>
                  </div><!-- /.col -->
              </div>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('asset-frontend/Customize/js/jquery-1.11.3.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('asset-sma/bootstrap-customize/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script type="text/javascript">
      jQuery(function($) {
        $('#loading-btn').on('click', function () {
          var btn = $(this);
          btn.button('loading')
          setTimeout(function () {
            btn.button('reset')
          }, 2000)
        });
      });

      function myValidation(){
        var form = $('form').serializeArray();
        var username = $('#username').val();
        var password = $('#password').val();
        if(username =='' && password ==''){
          $('#callback').addClass('alert alert-info').fadeIn(2000, function(){
                $(this).hide();
              });
              $('#message').text('Username & Password tidak boleh kosong !');
              $.each(form, function(){
                $('#username').val('');
                $('#password').val('');
              });
              return false;
        }

        if(username !=='' && password ==''){
          $('#callback').addClass('alert alert-info').fadeIn(2000, function(){
                $(this).hide();
              });
              $('#message').text('Password tidak boleh kosong !');
              $.each(form, function(){
                $('#username').val('');
                $('#password').val('');
              });
              return false;
        }

        if(username =='' && password !==''){
          $('#callback').addClass('alert alert-info').fadeIn(2000, function(){
                $(this).hide();
              });
              $('#message').text('Username tidak boleh kosong !');
              $.each(form, function(){
                $('#username').val('');
                $('#password').val('');
              });
              return false;
        }else{
          $('#callback').addClass('alert alert-update').fadeIn();
          $('#message').text('Silakan tunggu...');
          return true
        }
      }
    </script>
  </body>
</html>
