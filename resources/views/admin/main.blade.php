
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('')}}template/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{asset('')}}template/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('')}}template/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="{{asset('')}}template/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('')}}template/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('')}}template/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('')}}template/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('')}}template/assets/images/favicon.png" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
  </head>
  <body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @yield('container')
        @include('admin.footer')
    </div>
<!-- plugins:js -->
<script src="{{asset('')}}template/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('')}}template/assets/vendors/chart.js/Chart.min.js"></script>
<script src="{{asset('')}}template/assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="{{asset('')}}template/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="{{asset('')}}template/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{asset('')}}template/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('')}}template/assets/js/off-canvas.js"></script>
<script src="{{asset('')}}template/assets/js/hoverable-collapse.js"></script>
<script src="{{asset('')}}template/assets/js/misc.js"></script>
<script src="{{asset('')}}template/assets/js/settings.js"></script>
<script src="{{asset('')}}template/assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{asset('')}}template/assets/js/dashboard.js"></script>
<!-- End custom js for this page -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</body>
</html>