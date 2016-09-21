<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pages Not Found</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('asset-sma/bootstrap-customize/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-frontend/font-awesome/css/font-awesome.min.css') }}">
    <link rel="icon" type="image/png" href="{{asset('asset-frontend/Customize/images/brands-logo.png')}}">
    <style>
      @import url(https://fonts.googleapis.com/css?family=Lato:100);
      /*!
      *   
      *   Author: Wahyu Dhira Ashandy
      *
      *
      !*/
      /*
      *
      * -------------------------
      */

      html,
      body {
        min-height: 100%;
      }
      body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-family: 'lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-weight: 400;
        overflow-x: hidden;
        overflow-y: auto;
      }
      .btn-danger {
        -webkit-transition: all 0.3s linear;
        -o-transition: all 0.3s linear;
        transition: all 0.3s linear;
      }
      .btn-danger:hover {
        color: #000;
        background-color: transparent;
        border: 1px solid #22A7F0;
        -webkit-transition: all 0.3s linear;
        -o-transition: all 0.3s linear;
        transition: all 0.3s linear;
      }
      .pages {
        background: #d2d6de;
      }
      .pages-logo {
        font-size: 35px;
        text-align: center;
        margin-bottom: 25px;
        font-weight: 300;
      }
      .pages-wrapper {
        max-width: 800px;
        margin: 0 auto;
        margin-top: 10%;
      }
      .pages .pages-name {
        text-align: center;
        font-weight: 600;
      }
      .pages-logo h1 {
        color: #22A7F0;
        font-size: 55px;
      }
      .pages-name h1 {
        color: #F64747;
      }
      .row {
        margin-top: 15px;
      }
    </style>
  </head>
  <body class="hold-transition pages">
    <div class="pages-wrapper">
      <div class="pages-logo">
        <i class="fa fa-refresh fa-spin fa-2x fa-fw margin-bottom"></i>
            <span class="sr-only">Loading...</span><h1><b>404</b></h1>
      </div>
        <div class="pages-name">
            <h1>Oops!</h1>Halaman yang Anda cari tidak ada.
          <div class="row">
            <a href="{{ URL('/') }}" class="btn btn-sm btn-danger">&laquo go back</a>
          </div>
        </div>
    </div>
    <script src="{{asset('asset-frontend/Skeleton/js/jquery-3.0.0.js')}}"></script>
    <script src="{{ asset('asset-sma/bootstrap-customize/js/bootstrap.min.js') }}"></script>
  </body>
</html>