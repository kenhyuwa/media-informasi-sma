@extends('frontends.layouts.master-home')
@section('title')
| {{ str_slug($profile->getMenuFront->nama_menu) }}
@endsection
<!-- css -->
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('asset-frontend/Customize/css/all-custom-front.css') }}">
@endsection
<!-- name head -->
@section('head-title')
  
@endsection
<!-- main content -->
@section('main-content')
  <div id="main-content" class="index">
    <div class="content-page">
      <center><h5><b>{{ strtoupper($profile->getMenuFront->nama_menu) }}</b></h5></center>
  {!! $profile->content !!}
    </div>
  </div>
@endsection()