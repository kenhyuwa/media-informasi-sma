<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ ucwords($identitas->nama_sekolah) }} @yield('title')</title>
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <meta name="description" content="SMA Muhammadiyah 1 Simo berada di Kab. Boyolali">
  <meta name="keywords" content="sma-boyolali,sma-simo,sma muhammadiyah boyolali">
  <meta name="author" content="SMASimo">
  <meta name="robots" content="all,index,follow">
<!-- ____________________________________________________________________________
                _______ ____ ____  ___ _  ______ (_)___ ___  ___        
                / ____/ / __ `__ \/ __ `// ____// / __ `__ \/ __ \    
               (___   )/ / / / / / /_/ /(___   ) / / / / / / /_/ /    
              \______//_/ /_/ /_/\__,_/\______/_/_/ /_/ /_/\____/
  Wahyu Dhira Ashandy (c) 2016-{{ date('Y') }} SMA Muhammadiyah 1 Simo BOYOLALI     
 _________________________________________________________________________________ -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <!-- Mobile Specific Metas –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

  <!-- FONT –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" type="text/css" href="{{asset('asset-frontend/Skeleton/css/normalize.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('asset-frontend/Skeleton/css/skeleton.css')}}">
  @yield('css')

  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="{{ asset('asset-frontend/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

  <!-- Favicon –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="{{asset('uploads/images')}}/{{ $identitas->logo }}">
  <link href="{{asset('asset-frontend/dist/css/lightgallery.css')}}" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>