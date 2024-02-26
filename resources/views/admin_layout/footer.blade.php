<script src="{{asset('admin/assets/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('admin/assets/js/feather.min.js')}}"></script>

<script src="{{asset('admin/assets/js/jquery.slimscroll.min.js')}}"></script>

<script src="{{asset('admin/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/assets/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('admin/assets/plugins/apexchart/apexcharts.min.js')}}"></script>

<script src="{{asset('admin/assets/plugins/apexchart/chart-data.js')}}"></script>

<script src="{{asset('admin/assets/js/script.js')}}"></script>

<script src="{{asset('admin/assets/plugins/owlcarousel/owl.carousel.min.js')}}"></script>

<script src="{{asset('admin/assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/toastr/toastr.js')}}"></script>

<script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/select2/js/custom-select.js')}}"></script>

<script src="{{asset('admin/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/fileupload/fileupload.min.js')}}"></script>





<script>
    @if(Session::has('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>
</body>
</html>
