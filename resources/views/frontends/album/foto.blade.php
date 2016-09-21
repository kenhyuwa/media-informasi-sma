@extends('frontends.layouts.master-home')
@section('title')
| {{ str_slug('foto galeri') }}
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
	<div id="main-content">
		<div class="content-page center">
			<h5><b>Foto Gallery</b></h5>
			<div class="album-all">
	          <div class="pics-logo">
	            <div class="row row-foto img-row">
		            <div class="demo-gallery">
			            <ul id="lightgallery" class="list-unstyled row">
		                	@foreach($fotos as $foto)
			                    <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="{{ asset('uploads/original') }}/{{ $foto->images }} 375, {{ asset('uploads/original') }}/{{ $foto->images }} 480, {{ asset('uploads/original') }}/{{ $foto->images }} 800" data-src="{{ asset('uploads/original') }}/{{ $foto->images }}" data-sub-html="<p>{{ ucwords($foto->keterangan) }}</p>">
				                    <a class="figure" href="">
				                        <img class="img-responsive" src="{{ asset('uploads/images') }}/{{ $foto->images }}">
			                    	<figcaption>{{ ucwords($foto->keterangan) }}</figcaption>
				                    </a>
				                </li>
		                	@endforeach
			            </ul>
		            </div>  
	            </div>
	          </div>
			</div>
		</div>
		<div class="pagina">
			<table>
				<td class="paginate">{{ $fotos->links() }}</td>
			</table>
		</div>
	</div>
@endsection()