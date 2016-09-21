@extends('frontends.layouts.master-home')
@section('title')
| {{ str_slug('album galeri') }}
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
			<h5><b>Album Gallery</b></h5>
			<div class="album-all">
	          <div class="pics-logo">
	            <div class="row row-album img-row">
	                @foreach($albums as $album)
	                  <figure class="columns al three">
						<a href="{{ URL('album') }}/{{ $album->slugs }}"><div id='album-besar'>
							<div id='sub-album'><img src="{{ asset('asset-frontend/Customize/images/album.png') }}" border='0'></div>
							<figcaption class="albums"><strong>{{ ucwords($album->nama_album) }}</strong></figcaption>
						</a>
	                  </figure>
	                @endforeach
	            </div>
	          </div>
			</div>
		</div>
		<div class="pagina">
			<table>
				<td class="paginate">{{ $albums->links() }}</td>
			</table>
		</div>
	</div>
@endsection()