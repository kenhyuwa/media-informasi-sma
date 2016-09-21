<!DOCTYPE html>
<html lang="en" ng-app>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ ucwords($identitas->nama_sekolah) }} {{ strtoupper($identitas->kab_kota) }} | {{ ucwords($isi[1]) }}</title>
    <link rel="icon" type="image/png" href="{{asset('uploads/images')}}/{{ $identitas->logo }}">

    <!-- Bootstrap -->
    <link href="{{ asset('asset-sma/bootstrap-customize/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset-sma/OxigGn/css/OxigGn.css') }}" rel="stylesheet">
    <!--Datepicker-->
    <link rel="stylesheet" href="{{asset('asset-sma/OxigGn/plugins/datepicker/datepicker3.css')}}">
    <!-- font awesome -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset-frontend/font-awesome/css/font-awesome.min.css') }}">
      <!-- Datatables -->
    <link rel="stylesheet" href="{{asset('asset-sma/OxigGn/plugins/datatables/dataTables.bootstrap.css')}}" />
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('asset-sma/OxigGn/plugins/select2/select2.min.css')}}" />
    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{asset('asset-sma/SweetAlert/sweetalert.css')}}" />
    <script src="{{asset('asset-sma/SweetAlert/sweetalert.min.js')}}"></script>
      <!-- Summernote -->
      <link rel="stylesheet" href="{{asset('asset-sma/summernote/summernote.css')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="preload-wrapper">
    <div id="preloader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>