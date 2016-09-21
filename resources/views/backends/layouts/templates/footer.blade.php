         <!-- end content area -->
          <!-- footer -->
          <div class="row">
            <footer id="admin-footer" class="clearfix">
              <center><b>Copyright&nbsp;</b>&copy;&nbsp;2016-{{ date('Y') }}&nbsp;{{ strtolower($identitas->nama_web) }}</center>
            </footer>
          </div>
          <!-- end footer -->
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('asset-sma/bootstrap-customize/js/jquery-1.12.4.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="{{ asset('asset-sma/bootstrap-customize/js/bootstrap.min.js') }}"></script>
    <!-- datepicker -->
    <script src="{{asset('asset-sma/OxigGn/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
     <!-- InputMask -->
    <script src="{{asset('asset-sma/OxigGn/plugins/input-mask/jquery.inputmask.js')}}"></script>
    <!-- DataTables -->
    <script src="{{ asset('asset-sma/OxigGn/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset-sma/OxigGn/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- select2 -->
    <script src="{{ asset('asset-sma/OxigGn/plugins/select2/select2.full.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{asset('asset-sma/summernote/summernote.js')}}"></script>
    <!-- JQuery custom -->
    @if(auth()->check())
    <script src="{{ asset('asset-sma/OxigGn/js/jQuery-ajax.js') }}"></script>
    @elseif(auth('siswa')->check())
    <script src="{{ asset('asset-sma/OxigGn/js/jQuery-Siswa.js') }}"></script>
    @else
    @endif
    <script src="{{ asset('asset-sma/OxigGn/js/OxigGn.js') }}"></script>
    @if (notify()->ready())
      <script type="text/javascript">
          swal({
              title: "{!! notify()->message() !!}",
              text: "{!! notify()->option('text') !!}",
              type: "{{ notify()->type() }}",
              @if (notify()->option('timer'))
                  timer: "{{ notify()->option('timer') }}",
                  showConfirmButton: true
              @endif
          });
      </script>
    @endif

  <script type="text/javascript">
      var APP_URL= {!! json_encode(url('/')) !!};
      // Select2 focusAble
    $.fn.modal.Constructor.prototype.enforceFocus = function(){};
  </script>
    @yield('script')
  </body>
</html>