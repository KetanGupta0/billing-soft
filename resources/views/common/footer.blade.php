<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © Billing.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by SpecBits
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="{{ asset('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/js/plugins.js') }}"></script>

<!--datatable js-->

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script src="{{ asset('public/assets/js/pages/datatables.init.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('public/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Dashboard init -->
{{-- <script src="{{ asset('public/assets/js/pages/dashboard-ecommerce.init.js') }}"></script> --}}

<!-- App js -->
{{-- <script src="{{ asset('public/assets/js/app.js') }}"></script> --}}

<script>
    $(document).ready(function() {
        // console.clear();
        function stockAlert() {
            $.ajax({
                url: "{{ url('stock-alert') }}",
                type: "GET",
                success: function(data) {
                    setTimeout(() => {
                        $('.notif-counters').text(data);
                    }, 100);
                }
            })
        }
        stockAlert();

        $(document).on('click','.btnNotif',function(){
            window.location.href = `{{ url('stock-alert-page') }}`;
        });
    });
</script>

</body>

</html>
<style>
    .highlight_row {
        background: #405189;
        color: white;
    }
</style>