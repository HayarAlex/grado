<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invent</title>
    <!-- base:css plugins-->
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../../../vendors/jquery-toast-plugin/jquery.toast.min.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />

    <link rel="stylesheet" href="../../../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../../../vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="../../../../vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../../../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../../../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../../../images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- seccion navbar -->
      @include('layouts.navbar')
      <!-- end seccion navbar -->
      
      <div class="container-fluid page-body-wrapper">
        <!-- sidebar section -->
        @include('layouts.sidebar')
        <!-- en sidebar section -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12">
                @yield('content')
              </div>
              <!-- footer section -->
              
              <!-- end footer section -->
            </div>
          </div>
          <div class="footer-wrapper" style="margin-top: -40px;">
            @include('layouts.footer')
          </div>
          <!-- content-wrapper ends -->
          
        <!-- main-panel ends -->
        </div>
      <!-- page-body-wrapper ends -->
      </div>
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="../../vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->

    <script src="../../vendors/chart.js/Chart.min.js"></script>
    <script src="../../vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../../vendors/flot/jquery.flot.js"></script>
    <script src="../../vendors/flot/jquery.flot.resize.js"></script>
    <script src="../../vendors/flot/curvedLines.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../../js/dashboard.js"></script>
    <!-- End custom js for this page-->
    <!-- plugins-->
    <script src="../../../../vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
    <script src="../../../../vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="../../../../js/toastDemo.js"></script>
    <script src="../../../../js/chart.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @section('script')
    @show
  </body>
</html>