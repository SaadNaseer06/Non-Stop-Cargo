</div>
<!-- /Main Wrapper -->

<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Slimscroll JS -->
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.morris.js') }}"></script>

{{--  <!-- include summernote css/js -->  --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/script.js') }}"></script>


</body>
</html> 

<script>
    $(document).ready(function() {
        $('.numericInput').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
</script>
