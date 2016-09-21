    <footer>
      <hr>
        &copy;&nbsp;2016&nbsp;-&nbsp;{{ date('Y') }}&nbsp;<a href="mailto:wahyu.dhiraashandy8@gmail.com?Subject=Hello%20_dev" target="_top">{{ strtolower($identitas->nama_web) }}</a>
    </footer>
    <footer id="footer" class="footer-collapse">
      <hr>
        &copy;&nbsp;2016&nbsp;-&nbsp;{{ date('Y') }}&nbsp;<a href="mailto:wahyu.dhiraashandy8@gmail.com?Subject=Hello%20_dev" target="_top">{{ strtolower($identitas->nama_web) }}</a>
    </footer>
      <div id="sticky">
        <span class="sticky-none">
          <a href="#" class="sticky"><i class="fa fa-chevron-up"></i></a>
        </span>
      </div>
  <script src="{{asset('asset-frontend/Customize/js/jquery-1.11.3.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
        <script src="{{asset('asset-frontend/dist/js/lightgallery.js')}}"></script>
        <script src="{{asset('asset-frontend/dist/js/lg-fullscreen.js')}}"></script>
        <script src="{{asset('asset-frontend/dist/js/lg-thumbnail.js')}}"></script>
        <script src="{{asset('asset-frontend/dist/js/lg-video.js')}}"></script>
        <script src="{{asset('asset-frontend/dist/js/lg-autoplay.js')}}"></script>
        <script src="{{asset('asset-frontend/dist/js/lg-zoom.js')}}"></script>
        <script src="{{asset('asset-frontend/dist/js/lg-hash.js')}}"></script>
        <script src="{{asset('asset-frontend/dist/js/lg-pager.js')}}"></script>
        <script src="{{asset('asset-frontend/dist/lib/jquery.mousewheel.min.js')}}"></script>
@yield('js')
<script type="text/javascript">
      $(document).ready(function(){
          $('#lightgallery').lightGallery();
          $(window).load(function(){
            $('.windows8').delay(1500).fadeOut('slow');
          });
      });
</script>
@if (notify()->ready())
      <script type="text/javascript">
          swal({
              title: "{!! notify()->message() !!}",
              text: "{!! notify()->option('text') !!}",
              type: "{{ notify()->type() }}",   
              confirmButtonColor: "#3edc81",
              confirmButtonText: "OK", 
              @if (notify()->option('timer'))
                  timer:" {{ notify()->option('timer') }}",
                  showConfirmButton: false
              @endif
          });
      </script>
    @endif
</body>
</html>