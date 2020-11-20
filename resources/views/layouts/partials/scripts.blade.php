<!-- jQuery -->
<script src="{{ asset('backend/admin/assets/js/jquery-3.2.1.min.js')}}"></script>

<!-- FontAwesome -->
<script src="{{ asset('backend/admin/assets/js/all.js')}}"></script>

{{--CK EDITOR--}}
<script src="//cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('backend/admin/assets/js/popper.min.js')}}"></script>
<script src="{{ asset('backend/admin/assets/js/bootstrap.min.js')}}"></script>

<!-- Slimscroll JS -->
<script src="{{ asset('backend/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<script src="{{ asset('backend/admin/assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('backend/admin/assets/plugins/morris/morris.min.js')}}"></script>
<script src="{{ asset('backend/admin/assets/js/chart.morris.js')}}"></script>

{{--SweetAlert --}}
<script src="{{ asset('backend/admin/assets/js/sweetalert.min.js')}}"></script>

@if( Session::has('success') )
    <script>
        swal("Success!","{!! Session::get('success') !!}", "success",{
            buttons: {
                confirm: true,
            },
        })
    </script>
@endif

<!-- Custom JS -->
<script  src="{{ asset('backend/admin/assets/js/script.js')}}"></script>
<script  src="{{ asset('backend/admin/assets/js/custom/script.js')}}"></script>
